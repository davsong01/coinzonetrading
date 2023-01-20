<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\InvestorPackage;

class CronController extends Controller
{
    public function creditWalletCron($count = 1500){
        $activeInvestors = InvestorPackage::where('end_date',  '>=' ,  Carbon::now())->where('start_date',  '<',  Carbon::today())->where(function($query){
            $query->whereBetween('last_cron_date', [Carbon::yesterday(), Carbon::today()])
               ->orWhereNULL('last_cron_date');
        })->take($count)->get();
       
        $others = [
            'status'=>'Completed',
            'description' => 'ROI'
        ];
        $credited = 0;
        foreach($activeInvestors as $investor){
            try {
                $amount = $investor->daily_roi;
                $updateWallet = app('App\Http\Controllers\FunctionsController')->logWallet('credit', $amount, $investor->investor_id, $investor->reference, $others);

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

    public function runCronBacklog($count = 500){
        $backlog = InvestorPackage::where('end_date',  '>=',  Carbon::now())->where('start_date',  '<',  Carbon::today())->where(function ($query) {
            $query->where('last_cron_date', '<', Carbon::now()->subDays(2))
                ->orWhereNULL('last_cron_date');
        })->take($count)->get();

        // get records where start date is more than 1 day already and last cron date is still null

        // get records where 
        $picked = $backlog->count();
        $credited = [];
        $finalCredited = 0;
        foreach($backlog as $bl){
            $lc = $bl->last_cron_date == null ? Carbon::parse($bl->start_date) : Carbon::parse($bl->last_cron_date);
            
            $diff = $lc->diffInDays(Carbon::now());
           
            if($diff > 0){
                $credited[] = [
                    'id' => $bl->id,
                    'diff' => $diff,
                    'last_cron' => $lc,
                ];
                
                $others = [
                    'status' => 'Completed',
                    'description' => 'ROI'
                ];
                // run for loop with difference and add 1 day to last cron and update
                for ($i=0; $i < $diff; $i++) {
                   
                    try {

                        $updateWallet = app('App\Http\Controllers\FunctionsController')->logWallet('credit', $bl->daily_roi, $bl->investor_id, $bl->reference,$others);
                        
                        if (!is_null($updateWallet)) {
                            $bl->update(['last_cron_date' => $lc->addDays(1)]);
                            $finalCredited += 1;
                        }
                    } catch (\Throwable $th) {
                        echo $th->getMessage();
                    }
                }
            }
        }

        return [
            'Picked' => $picked,
            'New wallet rows' => $finalCredited,
            'Investors credited' => count($credited)
        ];
        // dd($backlog, $picked, $finalCredited);
    }
    
    public function deleteExpiredWalletTransactions()
    {
        $expired = Wallet::whereStatus('pending')->whereNotNull('expires_at')->where('expires_at',  '<',  Carbon::now())->get();

        if ($expired->count() > 0) {
            foreach ($expired as $ex) {
                $ex->delete();
            }
        }
        return;
    }
}
