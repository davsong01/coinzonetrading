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
            $message = 0;
            dd($th->getMessage());
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

    public function generateTradeReference()
    {
        return 'TRD-'.date('Y') . '-' . date('m') . '-' . rand(1111111, 9999999);
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

        if(isset($response) && isset($response->data)){
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
        }else{
            return NULL;
        }

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
       
        $user ??= auth()->user();

        $data['eligibility'] = true;
        $data['min'] = $this->getMinimumWithdrawalAmount();
        $data['max'] = $this->getMaximumWithdrawalAmount($user);
        $data['reasons'] = [];

        // Minimum withdrawal amount
        if (empty(auth()->user()->investor->approved_identification)) {
            $data['eligibility'] = false;
            $data['reasons'][] = 'Your account is unverified. Visit your profile to upload a valid proof of identification';
        }

        // Minimum withdrawal amount
        if($user->walletBalance() < $this->getMinimumWithdrawalAmount()){
            $data['eligibility'] = false;
            $data['reasons'][] = 'Wallet balance is less than minimum withdrawal amount of: '. $this->setting->currency_sign.$data['min'];
        }

        // Must fill details
        // dd(is_null($user->investor()->whereNotNull($this->investorMustFillBeForeWithdrawal())->first()));
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
        // check 
        $max = $user->walletBalance() < $this->setting->maximum_withdrawal_amount  ? $user->walletBalance() : $this->setting->maximum_withdrawal_amount;

        if(isset($user->investor->wallet_withdrawal_limit) && !empty($user->investor->wallet_withdrawal_limit)){
            $max = $user->investor->wallet_withdrawal_limit;
        }
        
        return $max;
  
    }

    public function investorMustFillBeForeWithdrawal()
    {
        return ['phone', 'wallet_type', 'wallet_addrress', 'profile_picture','id'];
    }

    public function updateTransaction($reference, $middleware = 'no')
    {
        //Check payment status and deliver value accordingly
        $transaction = InvestorPackage::with('user')->whereReference($reference)->whereStatus('pending')->first();

        if (isset($transaction) && $transaction->count() > 0) {
            // if(env('ENT') == 'demo'){
            //    $data = json_decode($this->dummyCoinbaseCharge());
            // }else{
            $data  = $this->queryCharge($transaction->code);
            // }
          
            if (isset($data) && !empty($data->payments)) {
                if ($data->payments[0]->status == 'CONFIRMED' && $data->code == $transaction->code) {
                    $status = $transaction->status;
                    
                    if (Carbon::parse($data->payments[0]->detected_at)->addMonth(1) < now()) {
                        $status = 'expired';
                    } else {
                        $status = 'active';
                    }
                    // dd($status,$data);
                    $transaction->update([
                        'status' => $status,
                        'start_date' => Carbon::parse($data->payments[0]->detected_at),
                        'end_date' => Carbon::parse($data->payments[0]->detected_at)->addMonth(1),
                        'last_cron_date' => NULL,
                        'test' => json_encode($data),
                    ]);
                }
            }
        }

        if ($middleware == 'none') {
            if ($transaction->status == 'pending') {
                return back()->with('error', 'Status is: ' . $transaction->status);
            } else {
                return back()->with('message', 'Status is: ' . $transaction->status);
            }
        }

        if ($middleware == 'admin') {
            return redirect(route('investors.edit', ['investor' => $transaction->user->investor->id, 'hid' => 'packages']))->with('message', 'Status is: ' . $transaction->status);
        }
        if ($middleware == 'yes') {
            return;
        } else {
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
        return '{"addresses":{"ethereum":"0x8d9b02ba407b0cf79c7df30f1890e4b145e13070","usdc":"0x8d9b02ba407b0cf79c7df30f1890e4b145e13070","dai":"0x8d9b02ba407b0cf79c7df30f1890e4b145e13070","apecoin":"0x8d9b02ba407b0cf79c7df30f1890e4b145e13070","shibainu":"0x8d9b02ba407b0cf79c7df30f1890e4b145e13070","tether":"0x8d9b02ba407b0cf79c7df30f1890e4b145e13070","bitcoincash":"qz35vxgg3k2dz9an9kw28e3d73mupmtcvyee8nm736","dogecoin":"DSK6ces54BQ73xq1AFHX9EJNfcsKZcnHzH","litecoin":"MAmqbWHXL3iN8VHxkDkh6Pyf8mZsgpCMFt","bitcoin":"36J8Ga4KGUiH4gKpAegwNNyXQ2RWp9kAZN"},"applied_threshold":{"amount":"2.50","currency":"USD"},"applied_threshold_type":"RELATIVE","brand_color":"#122332","brand_logo_url":"","code":"YHEELT3Q","created_at":"2022-10-16T11:27:49Z","description":"","exchange_rates":{"APE-USD":"4.4955","BCH-USD":"110.005","BTC-USD":"19139.465","DAI-USD":"1.00025","ETH-USD":"1282.445","LTC-USD":"50.905","DOGE-USD":"0.058955","SHIB-USD":"0.000010235","USDC-USD":"1.0","USDT-USD":"1.000045"},"expires_at":"2022-10-16T12:27:49Z","fee_rate":0.01,"fees_settled":true,"hosted_url":"https:\/\/commerce.coinbase.com\/charges\/YHEELT3Q","id":"0a8b7f3a-e7c0-4f09-a651-6bfedb8f4de3","local_exchange_rates":{"APE-USD":"4.4955","BCH-USD":"110.005","BTC-USD":"19139.465","DAI-USD":"1.00025","ETH-USD":"1282.445","LTC-USD":"50.905","DOGE-USD":"0.058955","SHIB-USD":"0.000010235","USDC-USD":"1.0","USDT-USD":"1.000045"},"logo_url":"","metadata":{"reference":"2022-10-1279876","package_id":"1","customer_id":"22","customer_name":"Arwa"},"name":"Coinzonetrading Flexible One-Stop Investment","offchain_eligible":false,"organization_name":"","payment_threshold":{"overpayment_absolute_threshold":{"amount":"5.00","currency":"USD"},"overpayment_relative_threshold":"0.005","underpayment_absolute_threshold":{"amount":"5.00","currency":"USD"},"underpayment_relative_threshold":"0.005"},"payments":[{"payment_id":"e840e585-6ff5-46cb-a340-9f228abd605a","network":"bitcoin","transaction_id":"7cf1bdc3fc1b4fe73eecc7d661957bd1de89d7b72f6042162d8aa69b8c0b55d6","status":"CONFIRMED","detected_at":"2022-10-16T11:47:35Z","value":{"local":{"amount":"503.01","currency":"USD"},"crypto":{"amount":"0.02628155","currency":"BTC"}},"block":{"height":758932,"hash":"0000000000000000000601650c37cd170736f581efeff78699d4c74703e1cd39","confirmations":50,"confirmations_required":1},"deposited":{"autoconversion_enabled":false,"autoconversion_status":"PENDING","status":"COMPLETED","destination":"coinzonetrading@gmail.com","exchange_rate":null,"amount":{"gross":{"local":null,"crypto":{"amount":"0.02628155","currency":"BTC"}},"net":{"local":null,"crypto":{"amount":"0.02601873","currency":"BTC"}},"coinbase_fee":{"local":null,"crypto":{"amount":"0.00026282","currency":"BTC"}}}},"coinbase_processing_fee":{"local":{"amount":"5.03","currency":"USD"},"crypto":{"amount":"0.00026282","currency":"BTC"}},"net":{"local":{"amount":"497.98","currency":"USD"},"crypto":{"amount":"0.02601873","currency":"BTC"}}}],"pricing":{"local":{"amount":"500.00","currency":"USD"},"ethereum":{"amount":"0.389880000","currency":"ETH"},"usdc":{"amount":"500.000000","currency":"USDC"},"dai":{"amount":"499.875031242189452637","currency":"DAI"},"apecoin":{"amount":"111.222333444555666778","currency":"APE"},"shibainu":{"amount":"48851978.505129500000000000","currency":"SHIB"},"tether":{"amount":"499.977501","currency":"USDT"},"bitcoincash":{"amount":"4.54524794","currency":"BCH"},"dogecoin":{"amount":"8481.04486450","currency":"DOGE"},"litecoin":{"amount":"9.82221786","currency":"LTC"},"bitcoin":{"amount":"0.02612403","currency":"BTC"}},"pricing_type":"fixed_price","pwcb_only":false,"redirect_url":"https:\/\/coinzonetrading.com\/payment\/callback\/2022-10-1279876","resource":"charge","support_email":"coinzonetrading@gmail.com","timeline":[{"status":"NEW","time":"2022-10-16T11:27:49Z"},{"status":"PENDING","time":"2022-10-16T11:47:35Z","payment":{"network":"bitcoin","transaction_id":"7cf1bdc3fc1b4fe73eecc7d661957bd1de89d7b72f6042162d8aa69b8c0b55d6","value":{"amount":"0.02628155","currency":"BTC"}}},{"status":"UNRESOLVED","context":"OVERPAID","time":"2022-10-16T11:51:54Z","payment":{"network":"bitcoin","transaction_id":"7cf1bdc3fc1b4fe73eecc7d661957bd1de89d7b72f6042162d8aa69b8c0b55d6","value":{"amount":"0.02628155","currency":"BTC"}}},{"status":"RESOLVED","time":"2022-10-16T16:32:34Z"}],"utxo":true}';
    }
}
