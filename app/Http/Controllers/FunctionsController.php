<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Wallet;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Mail\NotificationMail;
use App\Models\InvestorPackage;
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
        // dd($image);
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
        $packages = InvestorPackage::where('investor_id', $user->id)->get();

        if(isset($packages) && $packages->count() > 0){
            return $packages;
        }
        return NULL;
       
    }

    public function createCharge($data){
        // Delete expired pending charges
        \DB::table('investors_packages')->whereStatus('pending')->where('expires_at', '>', now())->delete();

        $trx = date('Y') . '-' . date('m') . '-' . rand(1111111, 9999999);
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
                'expires_at' => date('Y-m-d h:i:s', strtotime($response->data->expires_at)),
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

    public function updateTransaction($reference, $middleware = 'no'){
        //Check payment status and deliver value accordingly
        $transaction = InvestorPackage::whereReference($reference)->whereStatus('pending')->first();
        if(isset($transaction) && $transaction->count() > 0){
            if(env('ENT') == 'demo'){
                $data = [
                    'payments' => [
                        [
                            'status' => 'CONFIRMED',
                        ],
                        [
                            'amount' => 'amoun'
                        ]
                    ],
                    'confirmed_at' => '2022-07-24 11:09:45',
                ];

            }else{
                $data  = $this->queryCharge($transaction->code);
            }
            
            if (isset($data)) {
                if ($data['payments'][0]['status'] == 'CONFIRMED') {
                    $transaction->update([
                        'status' => 'active',
                        'start_date' => $data['confirmed_at'],
                        'end_date' => Carbon::parse($data['confirmed_at'])->addMonth(1),
                        'last_cron_date' => NULL
                    ]);
                }
            }
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

    // public function getTransaction($reference)
    // {
    //     $year = explode("-", $reference);
    //     $year = $year[0];
    //     if ($year[0] === date('Y')) {
    //         $transaction = Transaction::whereReference($reference)->first();
    //     } else {
    //         $transaction = \DB::table('transactions_2021')->where('reference', $reference)->first();
    //     }
    //     return $transaction;
    // }

    // public function updateTransaction($reference, $status)
    // {
    //     $years = explode("-", $reference);
    //     $year = $years[0];
    //     try {
    //         if ($year === date('Y')) {
    //             $transaction = Transaction::whereReference($reference)->first()->update(['status' => $status]);
    //         } else {
    //             $transaction = \DB::table('transactions_2021')->where('reference', $reference)->update(['status' => $status]);
    //         }
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }

    //     return;
    // }

    public function logWallet($type, $amount, $investor_id, $reference = null){
       
        try {
            $rec = Wallet::create([
                'type' => $type,
                'amount' => $amount,
                'investor_id' => $investor_id,
                'reference' => $reference,
            ]);
            //code...
        } catch (\Throwable $th) {
            $rec = null;
        }
      
        return $rec;
    }
}
