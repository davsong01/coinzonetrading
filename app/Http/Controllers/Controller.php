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
}
