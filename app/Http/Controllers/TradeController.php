<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function adminTradeHistory(){
        $histories = Trade::orderByRaw(DB::raw("FIELD(status, 'Initiated', 'In Progress', 'Complete','Closed') ASC"))->get();
      
        $histories = $histories->map(function($query){
            if($query->status == 'Complete'){
               $query->bonus = app('App\Http\Controllers\FunctionsController')->getTradeBonusType($query);
            }
            return $query;
        });
       
        return view('back.trades.index', compact('histories'));
     }
    public function adminApproveTradeProcess($id)
    {
        $trade = Trade::find($id);
        $investor = Investor::find($trade->investor_id);
        $wallet_balance = $investor->user->walletBalance();
        
        if($wallet_balance < $trade->amount){
            $trade->update([
                'admin_id' => auth()->user()->admin->id,
                'status' => 'Closed',
                'approved_date' => null,
            ]);
            return back()->with('error', 'Investor does not have up to '. '$'.number_format($trade->amount, 2). ' in wallet. Request has been closed');
        }
        
        $walletLog = app('App\Http\Controllers\FunctionsController')->logWallet('debit', $trade->amount, $trade->investor->user->id, $trade->trade_id);
        
        $trade->update([
            'admin_id' => auth()->user()->admin->id,
            'status' => 'In Progress',
            'approved_date' => now(),
        ]);
        
        return back()->with('message','Operation successful');
    }

    public function adminCompleteTradeProcess(Request $request, $id)
    {
        $data = $this->validate($request,[
            'type' => 'required',
            'percent' => 'required'
        ]);

        $trade = Trade::find($id);
        $percentAmount = $request->percent*$trade->amount/100;
        if($request->type == 'profit'){
            $bonus = $percentAmount + $trade->amount;
        }else{
            $bonus = $trade->amount - $percentAmount;
        }
       
        $others = [
            'status' => 'Completed',
            'description'=>'Trade'
        ]; 

        app('App\Http\Controllers\FunctionsController')->logWallet('credit',$bonus, $trade->investor->user->id, $trade->trade_id, $others);
        
        $trade->update([
            'admin_id' => auth()->user()->admin->id,
            'status' => 'Complete',
            'approved_date' => now(),
            'type' => $request->type,
            'percent' => $request->percent,
        ]);

        return back()->with('message','Operation successful');
    }

    public function adminCloseTradeProcess($id)
    {
        $trade = Trade::find($id);
        $trade->update([
            'admin_id' => auth()->user()->admin->id,
            'status' => 'Closed',
            'approved_date' => null,
        ]);

        return back()->with('message','Operation successful');
    }


    public function index()
    {
        //
    }

    public function closeTrade(Trade $trade){
        if($trade->status == 'Initiated'){
            $trade->status = 'Closed';
            $trade->save();
            return back()->with('message', 'Operation succesfull');
        }else{
            return back()->with('error','Not allowed');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function show(Trade $trade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function edit(Trade $trade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trade $trade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trade $trade)
    {
        //
    }
}
