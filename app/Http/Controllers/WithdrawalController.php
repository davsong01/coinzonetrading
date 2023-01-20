<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role === 'investor') {
            return view('back.investors.index', [
                'canWithdraw' => (new FunctionsController)->canWithdraw(),
            ]);
        }else{
            return view('back.withdrawals.index', [
                'withdrawals' => Withdrawal::with('requestedBy', 'approvedBy')->orderBy('created_at', 'DESC')->get(),
            ]);
        }

    }

    public function history()
    {
        if (Auth::user()->role === 'investor') {
            return view('back.investors.withdrawal_history');
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
        $settings = Setting::latest()->first();
        $max = (new FunctionsController)->canWithdraw()['max'];
       
        $attributes = $request->validate([
            'amount' => [
                'required',
                `min:{$settings->minimum_withdrawal_amount}`,
                `max:{$max}`
            ],
        ]);
      
        if($request->amount > $max){
            return back()->with('error', 'Withdrawal request was not processed, Invalid amount entered, please try again with correct values!');
        }
        
        $attributes['reference_id'] = app('App\Http\Controllers\FunctionsController')->generateTransactionReference().'_WITHDRAW';

        if((new FunctionsController)->canWithdraw()['eligibility'] == false){
            return back()->with('error', 'Withdrawal request was not processed, please ensure you meet all criteria for withdrawal!');
        }
        $attributes['withdrawal_method'] = $request['withdrawal_method'];
        $attributes['withdrawal_address'] = $request['withdrawal_address'];
        
        request()->user()->withdrawals()->create($attributes);
        
        // Send email to admin //official_email in the settings
        $data = [
            'email' => $settings->official_email,
            'type' => 'withdrawal-notification-to-admin',
            'name' => config('app.name'),
            'requestedBy' => request()->user(),
            'phone' => request()->user()->investor->phone,
            'recipient' => request()->user()->email,
            'amount' => $request->amount,
            'reference' => $attributes['reference_id'],
        ];
        (new FunctionsController)->sendEmails($data);
        return redirect(route('withdrawal.history'))->with('message', 'Withdrawal request successfully created. We will send you an email when your request status is updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function show(Withdrawal $withdrawal)
    {
        //
    }

    public function edit(Withdrawal $withdrawal)
    {
        //
    }

    public function update(Request $request, Withdrawal $withdrawal)
    {
        $request->validate([
            'status' => ['required', 'in:rejected,accepted']
        ]);

        if ($request->status === 'accepted' && !(new FunctionsController)->canWithdraw(floatval($withdrawal->amount), $withdrawal->requestedBy)) {
            return back()->with(
                'error',
                'Looks like the user don\'t have enough fund or exceeded maximum withdrawable amount'
            );
        }

        $withdrawal->status = $request->status;
      
        $withdrawal->approved_by = auth()->user()->id;
        $withdrawal->approved_date = now()->toString();
        $withdrawal->save();
        
        // Send email to investor
        $data = [
            'reference' => $withdrawal->reference_id,
            'email' => $withdrawal->requestedBy->email,
            'type' => 'withdrawal-status-change-to-investor',
            'name' => $withdrawal->requestedBy->name,
            'status' =>  $withdrawal->status,
            'date_requested' =>  $withdrawal->created_at,
        ];
       
        app('App\Http\Controllers\FunctionsController')->sendEmails($data);

        // Todo : Only log into wallet when status == accepted, but send email regardless of status
        if($withdrawal->status == 'accepted'){
            $others = [
                'status'=>'Completed',
                'description'=>'Wallet Withdrawal'
            ];
            app('App\Http\Controllers\FunctionsController')->logWallet('debit', $withdrawal->amount, $withdrawal->user_id, $withdrawal->reference_id,$others);
        }
        // End modify
        return back()->with('message', 'Withdrawal successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdrawal $withdrawal)
    {
        //
    }
}
