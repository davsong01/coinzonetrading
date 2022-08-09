<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Package;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use App\Models\InvestorPackage;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
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
        $data = [
            'email' => $this->setting->official_email,
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

    public function makePayment(Package $package)
    {
        $check = InvestorPackage::where('package_id', $package->id)->where('investor_id', auth()->user()->id)->where('status', 'active')->where('end_date', '>', now());
        if (isset($check) && $check->count() > 0) {
            return back()->with('error', 'You already have this package and it is active');
        }

        $charge = app('App\Http\Controllers\FunctionsController')->createCharge([
            'name' => $package->name, 'description' => '', 'amount' => $package->amount, 'package_id' => $package->id
        ]);

        if (!is_null($charge)) {
            \DB::table('investors_packages')->insert($charge);
            return redirect()->away($charge['url']);
        } else {
            return back()->with('error', 'There was an error, please refresh and try again');
        }
    }

    public function test(Request $request)
    {


        // $packages = app('App\Http\Controllers\FunctionsController')->hasPackages(auth()->user());
        // dd($packages, 'hgj');
        // $uploadimage = app('App\Http\Controllers\FunctionsController')->uploadImage($request->file, 'front-end/images/avatar');

        $checkFields = app('App\Http\Controllers\FunctionsController')->checkFilledFields(auth()->user());

        // $queryCharge = app('App\Http\Controllers\FunctionsController')->queryCharge('DELDHC3F');

        // $charge = app('App\Http\Controllers\FunctionsController')->createCharge(['name' => 'Package 1', 'description' => 'Package 1', 'amount' => 10.00, 'package_id' => 1]);

        // \DB::table('investors_packages')->insert($charge);
        // dd($charge);
        $data = [
            'name' => 'David',
            'email' => 'davsong16@gmail.com',
            'type' => 'registration'
        ];
        $sendEmail = app('App\Http\Controllers\FunctionsController')->sendEmails($data);
    }
}
