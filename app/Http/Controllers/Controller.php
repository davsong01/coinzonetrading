<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;

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
}
