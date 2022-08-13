<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Wallet;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Mail\NotificationMail;
use App\Models\InvestorPackage;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

class FunctionsController extends Controller
{
    public function __construct()
    {
        $this->setting = Setting::first();
    }

    public function uploadImage($image, $location, $width = null, $height = null)
    {
        $imgName = time() . uniqid() . '.'. $image->getClientOriginalExtension();

        if (!is_dir($location)) {
            mkdir($location);
        }

        if (!is_null($width) && !is_null($height)) {
            $image = Image::make($image)->resize($width, $height);
        } else {
            $image = Image::make($image);
        }

        // Check if file exist before saving, to avoid duplicates
        $this->deleteImage($location . '/' . $imgName);

        $image->save($location . '/' . $imgName);
        return $location . '/' . $imgName;
    }

    //Files must be in public and folder name must be appended to the filename for this to work
    public function deleteImage($image)
    {

        if (file_exists($image))
            unlink($image);
        return;
    }

    public function sendEmails($data)
    {
       
        try {
            Mail::to($data['email'])->send(new NotificationMail($data));
            $message = 1;
        } catch (\Exception $th) {
            //throw $th;
            $message = 0;
            // dd($th->getMessage());
            \Log::error($th->getMessage());
        }
       
        return $message;
    }

    public function checkFilledFields($user){
        $fields = [
            'phone',
            'wallet_type',
            'wallet_addrress'
        ];

        $check = true;

        foreach($fields as $field){
            if(empty($user->investor->$field)){
                $check = false;
            }
        }
        return $check;
    }

    public function hasPackages($user)
    {
        $packages = InvestorPackage::where('investor_id', $user->id)->where('status', 'active')->where('end_date', '>=', \Carbon\Carbon::today())->get();

        if(isset($packages) && $packages->count() > 0){
            return $packages;
        }
        return collect([]);

    }
    public function generateTransactionReference(){
        return date('Y') . '-' . date('m') . '-' . rand(1111111, 9999999);
    }

    public function createCharge($data){

        // Delete expired pending charges
        \DB::table('investors_packages')->whereStatus('pending')->where('expires_at', '>', now())->delete();
        // Check if Investor has this package and its active

        $trx = $this->generateTransactionReference();
        $headers = array(
            "Content-Type: application/json",
            "X-CC-Api-Key: ". $this->setting->api_key,
            "X-CC-Version: 2018-03-22",
        );

        $d = [
            "name" => $data['name'],
            "description" => $data['description'],
            "pricing_type" => 'fixed_price',
            "redirect_url" => $this->setting->callback_url.'/'. $trx,
            "local_price" => [
                "amount" => $data['amount'],
                "currency" => $this->setting->currency,
            ],
            "metadata" => [
                'reference' => $trx,
                "customer_id" => auth()->user()->id ?? null,
                "customer_name" => auth()->user()->name ?? null,
                "package_id" => $data['package_id'],
            ],
        ];
      
        $url = "https://api.commerce.coinbase.com/charges";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($d));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);

        if($response->data){
            return [
                'code' => $response->data->code,
                'fee_rate' => $response->data->fee_rate,
                'rid' => $response->data->id,
                'reference' => $response->data->metadata->reference,
                'package_id' => $response->data->metadata->package_id,
                'investor_id' => $response->data->metadata->customer_id,
                'created_at' => date('Y-m-d h:i:s', strtotime($response->data->created_at)),
                'expires_at' => Carbon::parse($response->data->expires_at)->addHour(),
                'amount' => $response->data->pricing->local->amount,
                'currency' => $response->data->pricing->local->currency,
                'url' => $response->data->hosted_url
            ];
        }

        return NULL;
    }

    public function queryCharge($code){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.commerce.coinbase.com/charges/" . $code,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "X-CC-Api-Key: ".$this->setting->api_key."",
                "Content-Type: application/json",
                "Cache-Control: no-cache",
                "X-CC-Version: 2018-03-22"
            ),
        ));
        $response = curl_exec($curl);
        $response = json_decode($response);

        if (isset($response)) {
            return $response->data;
        }else{
            return null;
        }
    }

    public function canWithdraw(?float $amount = null, ?User $user = null){
        // $settings = Setting::latest()->first();
        // $amount ??= $settings->minimum_withdrawal_amount;
        $user ??= auth()->user();

        $data['eligibility'] = true;
        $data['min'] = $this->getMinimumWithdrawalAmount();
        $data['max'] = $this->getMaximumWithdrawalAmount($user);
        $data['reasons'] = [];

        // Minimum withdrawal amount
        if($user->walletBalance() < $this->getMinimumWithdrawalAmount()){
            $data['eligibility'] = false;
            $data['reasons'][] = 'Wallet balance is less than minimum withdrawal amount of: '. $this->setting->currency_sign.$data['min'];
        }

        // Must fill details
        if(is_null($user->investor()->whereNotNull($this->investorMustFillBeForeWithdrawal())->first())){
            $data['eligibility'] = false;
            $data['reasons'][] = 'You have not filled one of the following details: '. ucfirst(str_replace('_', ' ', implode(',', $this->investorMustFillBeForeWithdrawal())));
        }

        if($user->withdrawals()->where('status', 'pending')->get()->count() > 0){
            $data['eligibility'] = false;
            $data['reasons'][] = 'You have a pending withdrawal request';
        }
        $frequency = $this->setting->withdrawal_frequency ?? 0;
        if($user->withdrawals->where('status', '!=', 'rejected')->whereBetween('created_at', [now()->subDays($frequency), now()])->count() > 0){
            $data['eligibility'] = false;
            $data['reasons'][] = 'You can only make 1 withdrawal request in ' . $frequency. ' days';
        };
        
        
        return $data;
    }

    public function getMinimumWithdrawalAmount(){
        return $this->setting->minimum_withdrawal_amount ?? 0;
    }

    public function getMaximumWithdrawalAmount($user)
    {
       return $user->walletBalance() < $this->setting->maximum_withdrawal_amount  ? $user->walletBalance() : $this->setting->maximum_withdrawal_amount;
    }

    public function investorMustFillBeForeWithdrawal()
    {
        return ['phone', 'wallet_type', 'wallet_addrress', 'profile_picture'];
    }


// Check 5:
// Withdrawal Frequency - this is the frequency an investor can make withdrawal requests. It is in days and default is 30 days. If set to 30 days for example, investor can only make a request for withdrawal(pending, approved or declined) once in 30 days.
// This value is set by an admin

   
    // Conditions
    // <ol>
    // <li>You must have filled these on your profile page
    //     <li></li>
    // </li>
    // </ol>
    // <li>You m</li>

    public function updateTransaction($reference, $middleware = 'no'){
        //Check payment status and deliver value accordingly
        $transaction = InvestorPackage::with('user')->whereReference($reference)->whereStatus('pending')->first();

        if(isset($transaction) && $transaction->count() > 0){
            // if(env('ENT') == 'demo'){
            //    $data = json_decode($this->dummyCoinbaseCharge());
            // }else{
            $data  = $this->queryCharge($transaction->code);
            // }

            if (isset($data) && !empty($data->payments)) {
                if ($data->payments[0]->status == 'CONFIRMED' && $data->code == $transaction->code) {
                    $status = $transaction->status;
                    if(Carbon::parse($data->confirmed_at)->addMonth(1) < now()){
                        $status = 'expired';
                    }else{
                        $status = 'active';
                    }
                    $transaction->update([
                        'status' => $status,
                        'start_date' => Carbon::parse($data->confirmed_at),
                        'end_date' => Carbon::parse($data->confirmed_at)->addMonth(1),
                        'last_cron_date' => NULL,
                        'test' => json_encode($data),
                    ]);
                }
            }
        }

        if ($middleware == 'none') {
            if($transaction->status == 'pending'){
                return back()->with('error', 'Status is: ' . $transaction->status);
            }else{
                return back()->with('message', 'Status is: ' . $transaction->status);
            }
        }

        if ($middleware == 'admin') {
            return redirect(route('investors.edit', ['investor' => $transaction->user->investor->id, 'hid' => 'packages']))->with('message', 'Status is: '. $transaction->status);
        }
        if($middleware == 'yes'){
            return;
        }else{
            return redirect(route('investor.packages'));
        }
    }

    public function getInvestorPacakgeValidity($investor_id, $package_id){

        $validity = false;

        $transaction = InvestorPackage::where(['investor_id'=>$investor_id, 'package_id' => $package_id])->first();
        if($transaction){
            if(!is_null($transaction) && ($transaction->status == 'pending' || $transaction->end_date < now())){
                $validity = false;
            }
            if (!is_null($transaction) && ($transaction->status != 'pending' && $transaction->end_date >= now())) {
                $validity = true;
            }
        }

        return $validity;

    }

    public function logWallet($type, $amount, $investor_id, $reference = null){
        
        try {
            $rec = Wallet::create([
                'type' => $type,
                'amount' => $amount,
                'user_id' => $investor_id,
                'reference' => $reference,
            ]);
            //code...
        } catch (\Throwable $th) {
            $rec = $th->getMessage();
        }
       
        return $rec;
    }

    public function dummyCoinbaseCharge(){
        return '{
                "id": "f765421f2-1451-fafb-a513-aac6c819fba9",
                "resource": "charge",
                "code": "4EAGRJEJ",
                "name": "The Sovereign Individual",
                "description": "Mastering the Transition to the Information Age",
                "logo_url": "https://commerce.coinbase.com/charges/ybjknds.png",
                "hosted_url": "https://commerce.coinbase.com/charges/66BEOV2A",
                "created_at": "2017-01-31T20:49:02Z",
                "expires_at": "2017-01-31T21:49:02Z",
                "confirmed_at": "2017-01-31T20:50:02Z",
                "checkout": {
                    "id": "a76721f2-1611-48fb-a513-aac6c819a9d6"
                },
                "timeline": [
                    {
                    "time": "2017-01-31T20:49:02Z",
                    "status": "NEW"
                    },
                    {
                    "time": "2017-01-31T20:50:02Z",
                    "status": "PENDING"
                    },
                    {
                    "time": "2017-01-31T20:50:02Z",
                    "status": "COMPLETED"
                    },
                    {
                    "time": "2017-01-31T20:50:02Z",
                    "status": "UNRESOLVED",
                    "context": "UNDERPAID"
                    },
                    {
                    "time": "2017-01-31T20:50:02Z",
                    "status": "RESOLVED"
                    }
                ],
                "metadata": {},
                "pricing_type": "fixed_price",
                "pricing": {
                    "local": { "amount": "500.00", "currency": "USD" },
                    "bitcoin": { "amount": "1.00", "currency": "BTC" },
                    "ethereum": { "amount": "10.00", "currency": "ETH" }
                },
                "payment_threshold": {
                    "overpayment_absolute_threshold": { "amount": "5.00", "currency": "USD" },
                    "overpayment_relative_threshold": "0.05",
                    "underpayment_absolute_threshold": { "amount": "5.00", "currency": "USD" },
                    "underpayment_relative_threshold": "0.05"
                },
                "applied_threshold": { "amount": "5.00", "currency": "USD" },
                "applied_threshold_type": "RELATIVE",
                "payments": [
                    {
                    "network": "ethereum",
                    "transaction_id": "0xe02fead885c3e4019945428ed54d094247bada2d0ac41b08fce7ce137bf29587",
                    "status": "CONFIRMED",
                    "value": {
                        "local": { "amount": "500.0", "currency": "USD" },
                        "crypto": { "amount": "10.00", "currency": "ETH" }
                    },
                    "block": {
                        "height": 100,
                        "hash": "0xe02fead885c3e4019945428ed54d094247bada2d0ac41b08fce7ce137bf29587",
                        "confirmations_accumulated": 8,
                        "confirmations_required": 2
                    }
                    }
                ],
                "addresses": {
                    "bitcoin": "mymZkiXhQNd6VWWG7VGSVdDX9bKmviti3U",
                    "ethereum": "0x419f91df39951fd4e8acc8f1874b01c0c78ceba6"
                }
                }';
    }
}
