<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->settings = Setting::latest()->first();
        
        View::share('settings', $this->settings);
    }

    public function walletTypes(){
        if(isset($this->settings->wallet_types) && !empty($this->settings->wallet_types)){
            $types = explode(",", $this->settings->wallet_types);
        }else{
            $types = [];
        }
        
        return $types;
    }

    public function getRoi($package, $amount)
    {
        // roi is package roi of amount
        return ($package->daily_roi / 100) * $amount;
    }

    public function sendPostRequest($url, $payload = [])
    {
        $headers = [];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, url($url));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $decodedResponse = json_decode($response);
        return $decodedResponse;
    }

    public function sendGetRequest($url){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $decodedResponse = json_decode($response);
        return $decodedResponse;
    }

    public function redirectToGateway($data)
    {
        
        $trx = isset($data['trx']) ? $data['trx'] : app('App\Http\Controllers\FunctionsController')->generateTransactionReference();
        $headers = array(
            "Content-Type: application/json",
            "X-CC-Api-Key: " . $this->setting->api_key,
            "X-CC-Version: 2018-03-22",
        );
      
        $callback_url = isset($data['callback_url']) ? $data['callback_url'] : $this->setting->callback_url . '/' . $trx;
       
        $d = [
            "name" => $data['name'],
            "description" => $data['description'],
            "pricing_type" => 'fixed_price',
            "redirect_url" => $callback_url,
            "local_price" => [
                "amount" => $data['amount'],
                "currency" => $this->setting->currency,
            ],
            "metadata" => [
                'reference' => $trx,
                "customer_id" => auth()->user()->id ?? null,
                "customer_name" => auth()->user()->name ?? null,
                "package_id" => $data['package_id'] ?? null,
            ],
        ];
        
        $charge_url = "https://api.commerce.coinbase.com/charges";

        $curl = curl_init($charge_url);
        curl_setopt($curl, CURLOPT_URL, $charge_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($d));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
       
        if (isset($response) && isset($response->data)) {
            return [
                'code' => $response->data->code ?? null,
                'fee_rate' => $response->data->fee_rate ?? null,
                'rid' => $response->data->id,
                'reference' => $response->data->metadata->reference,
                'package_id' => $response->data->metadata->package_id ?? null,
                'investor_id' => $response->data->metadata->customer_id ?? null,
                'created_at' => date('Y-m-d h:i:s', strtotime($response->data->created_at)),
                'expires_at' => Carbon::parse($response->data->expires_at)->addHour(),
                'amount' => $response->data->pricing->local->amount,
                'currency' => $response->data->pricing->local->currency,
                'url' => $response->data->hosted_url,
                'redirect_url' => $response->data->redirect_url,
            ];
        } else {
            return NULL;
        }
    }
}
