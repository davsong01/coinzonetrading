<?php

namespace App\Http\Middleware;

use App\Models\InvestorPackage;
use Closure;
use Illuminate\Http\Request;

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
       $pendingtransactions =  InvestorPackage::where('investor_id', auth()->user()->investor->id)->where('status', 'pending')->where('expires_at', '>', now())->get();
        
       if(isset($pendingtransactions) && $pendingtransactions->count() > 0){
            // Attempt to update pending transactions
            foreach($pendingtransactions as $transaction){
                app('App\Http\Controllers\FunctionsController')->updateTransaction($transaction->reference, 'yes');
            }
       }
        

        return $next($request);
    }
}
