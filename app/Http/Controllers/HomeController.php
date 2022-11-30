<?php

namespace App\Http\Controllers;

use auth;
use Carbon\Carbon;
use App\Models\Package;
use App\Models\Setting;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use App\Models\InvestorPackage;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        $packages = Package::where('status', 'published')->get();
       
        return view('welcome')->with('packages', $packages);
    }

    public function about()
    {
        return view('about');
    }

    public function faq()
    {
        return view('faq');
    }

    public function rules()
    {
        return view('rules');
    }

    public function sendContact(Request $request)
    {
        $settings = Setting::latest()->first();

        $data = [
            'email' => $settings->official_email,
            'type' => 'contact-mail-to-admin',
            'name' => 'Admin',
            'messageDetails' => [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
            ],
        ];

        app('App\Http\Controllers\FunctionsController')->sendEmails($data);

        // Log to DB
        ContactForm::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        return back()->with('message', 'Your message has been sent');
    }

    public function testpage()
    {
        $i = auth()->user()->investor;
        $a = app('App\Http\Controllers\FunctionsController')->getInvestorPacakgeValidity(1, 7);
        dd($a);
        return view('test');
    }

    public function makePayment(Request $request)
    {
        $package = Package::find($request->package);
        $settings = Setting::latest()->first();

        if($request->amount < $package->amount || $request->amount > $package->max_amount){
            return back()->with('error', 'Amount entered not within range');
        }

        // dd($request->all());
        // $check = InvestorPackage::where('package_id', $package->id)->where('investor_id', auth()->user()->id)->where('status', 'active')->where('end_date', '>', now());
        // if (isset($check) && $check->count() > 0) {
        //     return back()->with('error', 'You already have this package and it is active');
        // }
        if($request->payment_method == 'Wallet'){
            \DB::table('investors_packages')->whereStatus('pending')->where('expires_at', '>', now())->delete();

            if($request->amount > auth()->user()->walletBalance()){
                return back()->with('error', 'You do not have up to '.$request->amount. ' in your wallet, kindly use a different payment method');
            }
            $validity = $package->validity_period;

            app('App\Http\Controllers\FunctionsController')->logWallet('debit', $request->amount, auth()->user()->id, app('App\Http\Controllers\FunctionsController')->generateTransactionReference());
            
            $charge = [
                'reference' => app('App\Http\Controllers\FunctionsController')->generateTransactionReference(),
                'status' => 'active',
                'investor_id' => auth()->user()->id,
                'package_id' => $package->id,
                'code' => 'WALLET_BUY',
                'payment_method' => $request->payment_method,
                'url' => '',
                'rid' => app('App\Http\Controllers\FunctionsController')->generateTransactionReference().'_WALLET',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDay($validity),
                'amount' => $request->amount,
                'daily_roi' => $this->getRoi($package, $request->amount),
                'currency' => $settings->currency,
                'expires_at' => Carbon::now()->addHour(),
            ];
           
            \DB::table('investors_packages')->insert($charge);

            return back()->with('message', 'Package Purchase successful');

        }else if($request->payment_method == 'Crypto'){
            $charge = app('App\Http\Controllers\FunctionsController')->createCharge([
                'name' => $package->name, 'description' => '', 'amount' => $request->amount, 'package_id' => $package->id
            ]);

            if (!is_null($charge)) {
                $charge['daily_roi'] = $this->getRoi($package, $charge['amount']);
                \DB::table('investors_packages')->insert($charge);
                return redirect()->away($charge['url']);
            } else {
                return back()->with('error', 'There was an error, please refresh and try again');
            }
        }
    }

    
}
