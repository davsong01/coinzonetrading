<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\InvestorPackage;
use Illuminate\Support\Facades\Route;

class checkPendingTransaction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

       $pendingtransactions = InvestorPackage::where('investor_id', auth()->user()->id)->where('status', 'pending')->where('expires_at', '>', now())->get();
        
       if(isset($pendingtransactions) && $pendingtransactions->count() > 0){
            // Attempt to update pending transactions
            foreach($pendingtransactions as $transaction){
                app('App\Http\Controllers\FunctionsController')->updateTransaction($transaction->reference, 'yes');
            }
       }

        $pendingWallet = Wallet::where('user_id', auth()->user()->id)->where('status', 'pending')->where('description', 'Wallet Top Up')->get();
       
        
        if(Route::is('mywallet.history')){
            $param = 'yes';
        }else{
            $param = 'no';
        }
        
        if (isset($pendingWallet) && $pendingWallet->count() > 0) {
            // Attempt to update pending transactions
            // $request = new \Illuminate\Http\Request();
            // $request->replace(['admin' => 'no']);
           
            foreach ($pendingWallet as $transaction) {
                app('App\Http\Controllers\WalletController')->updateWalletTopUp($transaction->reference, $param);
            }
        }

        return $next($request);
    }
}
