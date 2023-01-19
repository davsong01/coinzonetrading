<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        //
    }

    public function topUpWallet()
    {
        return view('back.investors.wallet_topup');
    }

    public function processTopUpWallet(Request $request)
    {
        $trx = app('App\Http\Controllers\FunctionsController')->generateTopUpReference();
        $data = [
            "name" => 'Wallet top Up for '. auth()->user()->name. ' on '.config('app.name'),
            "description" => 'Wallet top Up for ' . auth()->user()->name . ' ' . config('app.name'),
            "pricing_type" => 'fixed_price',
            "amount" => $request->amount,
            "trx" => $trx,
            "callback_url"=>url('/wallet-topup-verify') . '/' . $trx,
        ];

        $charge = app('App\Http\Controllers\FunctionsController')->createCharge($data);
       
        if (!is_null($charge)) {
            $others = [
                'description' => 'Wallet Top Up',
                'code' => $charge['code'] ?? null,
                'fee_rate' => $charge['fee_rate'],
                'url' => $charge['url'],
                'currency' => $charge['currency'],
                'expires_at' => $charge['expires_at'],
                'status' => 'pending',
                'response' => json_encode($charge),
            ];

            $wallet = app('App\Http\Controllers\FunctionsController')->logWallet('credit',$charge['amount'],$charge['investor_id'], $charge['reference'],$others);
            
            return redirect()->away($charge['url']);
        } else {
            return back()->with('error', 'There was an error, please refresh and try again');
        }
        
    }

    public function updateWalletTopUp($reference,$middleware='no',$admin="no")
    {
        //Check payment status and deliver value accordingly
        $transaction = Wallet::whereReference($reference)->whereStatus('pending')->whereDescription('Wallet Top Up')->first();
        // dd($transaction,$reference, $middleware);
        if (isset($transaction) && $transaction->count() > 0) {
            // if(env('ENT') == 'demo'){
            //    $data = json_decode(app('App\Http\Controllers\FunctionsController')->dummyCoinbaseCharge());
            // }else{
                $data = app('App\Http\Controllers\FunctionsController')->queryCharge($transaction->code);
            // }
            // dd($data, $transaction);
            if (isset($data) && !empty($data->payments)) {
                if ($data->payments[0]->status == 'CONFIRMED' && $data->code == $transaction->code) {
                    $transaction->update([
                        'status' => 'Completed',
                        'response' => json_encode($data),
                    ]);
                    $message_type = 'message';
                    $message = 'Wallet Top Up of: ' . $this->settings->currency_sign . $transaction->amount . ' is successful!';
                }else{
                    $message_type = 'error';
                    $message = 'Wallet Top Up of: ' . $this->settings->currency_sign . $transaction->amount . ' is stil ' . $transaction->status;
                }
            }else{
                $message_type = 'error';
                $message = 'Wallet Top Up of: ' . $this->settings->currency_sign . $transaction->amount . ' is stil ' . $transaction->status;
            }

        }
       
        if(isset($admin) && $admin == 'yes'){
            return redirect(route('investors.edit', ['investor' => $transaction->user->investor->id, 'hid' => 'wallet']))->with($message_type, $message);
        }else{
            return back()->with($message_type, $message);
        }
        if ($middleware == 'yes') {
            return redirect(route('mywallet.history', $transaction->user_id))->with($message_type,$message);
        } else {
            return;
        }
    }
}
