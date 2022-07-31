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
            'amount' => ['required',
            `min:{$settings->minimum_withdrawal_amount}`,
             `max:{$settings->minimum_withdrawal_amount}`,
             ]
        ]);

        if(!(new FunctionsController)->canWithdraw(floatval($request->amount))){
            return back()->with('error',
            'Looks like you don\'t have enough fund or exceeded maximum withdrawable amount');
        }

        # the user needs to be authenticated,
        # since the ide does understand all laravel facades,
        # and auth facades query the db again,
        # we will work with the request helper method
        request()->user()->withdrawals()->create($attributes);
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
        //
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
