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
                'canWithdraw' => (new FunctionsController)->canWithdraw()
            ]);
        }else{
            return view('back.withdrawals.index', [
                'withdrawals' => Withdrawal::all()->loadMissing(['requestedBy', 'approvedBy']),
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
       
        if (!(new FunctionsController)->canWithdraw(floatval($request->amount))) {
            return back()->with(
                'error',
                'Looks like you don\'t have enough funds or exceeded maximum withdrawable amount'
            );
        }

        # the user needs to be authenticated,
        # since the ide does understand all laravel facades,
        # and auth facades query the db again,
        # we will work with the request helper method
        request()->user()->withdrawals()->create($attributes);
         
        // Send email to admin //official_email in the settings
      
        return back()->with('success', 'Withdrawal successfully created.');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function edit(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
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
        // Lets log admin that updated this regardless of the status
        // if ($request->status === 'accepted') {
            $withdrawal->approved_by = $request->user()->id;
            $withdrawal->approved_date = now()->toString();
        // }
        // Modify, 
        $withdrawal->update();
        // Send email to investor
        $data = [
            'type' => 'withdrawal-notification-to-investor',
            'name' => $i,// Investor
        ];

        // Todo : Only log into wallet when status == accepted, but send email regardless of status
        $reference = app('App\Http\Controllers\FunctionsController')->generateTransactionReference();
        if($withdrawal->status == 'accepted'){
            app('App\Http\Controllers\FunctionsController')->logWallet('debit', $withdrawal->amount, $withdrawal->user->id, $reference);
        }
        app('App\Http\Controllers\FunctionController')->sendEmails($data);
        // End modify
        return back()->with('success', 'Withdrawal successfully updated.');
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
