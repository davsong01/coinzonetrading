<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Mail\NotificationMail;
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
        } catch (\Exception $th) {
            //throw $th;
            \Log::error($th->getMessage());
        }
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

    public function createCharge($data){
        $trx = date("Ymd") .'-'. rand(1000000, 9999999);
        $headers = array(
            "Content-Type: application/json",
            "X-CC-Api-Key: ". $this->setting->api_key,
            "X-CC-Version: 2018-03-22",
        );

        $d = [
            "name" => $data['name'],
            "description" => $data['description'],
            "pricing_type" => 'fixed_price',
            "redirect_url" => $this->setting->callback_url,
            "local_price" => [
                "amount" => $data['amount'],
                "currency" => $this->setting->currency,
            ],
            "metadata" => [
                'reference' => $trx,
                "customer_id" => auth()->user()->id,
                "customer_name" => auth()->user()->name,
            ],
        ];
        // dd(json_encode($d));
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
                'investor_id ' => $response->data->metadata->customer_id,
                'created_at' => $response->data->created_at,
                'expires_at' => $response->data->expires_at,
                'amount' => $response->data->pricing->local->amount,
                'currency' => $response->data->pricing->local->currency,
                'url' => $response->data->hosted_url
            ];
        }
        
        return 'There was a problem initiating the charge';
    }

    public function queryCharge($data){
        
    }
}
