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
            // dd((new FunctionsController)->canWithdraw());
            return view('back.investors.index', [
                'canWithdraw' => (new FunctionsController)->canWithdraw()
            ]);
        }else{
            return view('back.withdrawals.index', [
                'withdrawals' => Withdrawal::with('requestedBy', 'approvedBy')->orderBy('created_at', 'DESC')->get(),
            ]);
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

        $attributes = $request->validate([
            'amount' => [
                'required',
                `min:{$settings->minimum_withdrawal_amount}`,
                `max:{$settings->minimum_withdrawal_amount}`,
            ],
        ]);

        $attributes['reference_id'] = app('App\Http\Controllers\FunctionsController')->generateTransactionReference();
        if((new FunctionsController)->canWithdraw()['eligibility'] == false){
            return back()->with('error', 'Withdrawal request was not processed, please ensure you meet all criteria for withdrawal!');
        }
        
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
        return back()->with('message', 'Withdrawal request successfully created. You will get an email when request status is updated');
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
            'reference' => $withdrawal->reference,
            'email' => request()->user()->email,
            'type' => 'withdrawal-status-change-to-investor',
            'name' => request()->user()->name,
            'status' =>  $withdrawal->status,
        ];
      
        app('App\Http\Controllers\FunctionsController')->sendEmails($data);

        // Todo : Only log into wallet when status == accepted, but send email regardless of status
        if($withdrawal->status == 'accepted'){
            app('App\Http\Controllers\FunctionsController')->logWallet('debit', $withdrawal->amount, $withdrawal->user_id, $withdrawal->reference);
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
