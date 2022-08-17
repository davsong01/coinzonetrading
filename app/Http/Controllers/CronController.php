<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\InvestorPackage;

class CronController extends Controller
{
    public function creditWalletCron($count = 1500){
        $activeInvestors = InvestorPackage::where('end_date',  '>=' ,  Carbon::now())->where('start_date',  '<',  Carbon::today())->where(function($query){
            $query->whereBetween('last_cron_date', [Carbon::yesterday(), Carbon::today()])
               ->orWhereNULL('last_cron_date');
        })->take($count)->get();
        
        $credited = 0;
        foreach($activeInvestors as $investor){
            try {
                $amount = $investor->daily_roi;

                $updateWallet = app('App\Http\Controllers\FunctionsController')->logWallet('credit', $amount, $investor->investor_id, $investor->reference);

                if (!is_null($updateWallet)) {
                    $investor->update(['last_cron_date' => now()]);
                    $credited += 1;
                }
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
            
        }
        
        return response()->json([
            'Picked' => $activeInvestors->count(),
            'Credited' => $credited,
        ], 200);
 
    }
}
