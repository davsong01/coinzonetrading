<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function about()
    {
        return view('about');
    }

    public function rules()
    {
        return view('rules');
    }

    public function testpage(){
        $i = auth()->user()->investor;
        dd($i);
        return view('test');
    }

    public function makePayment(Package $package){
        $charge = app('App\Http\Controllers\FunctionsController')->createCharge([
            'name' => $package->name, 'description' => '', 'amount' => $package->amount, 'package_id' => $package->id
        ]);

        \DB::table('investors_packages')->insert($charge);

        return redirect()->away($charge['url']);

    }

    public function test(Request $request){

        
        // $packages = app('App\Http\Controllers\FunctionsController')->hasPackages(auth()->user());
        // dd($packages, 'hgj');
        // $uploadimage = app('App\Http\Controllers\FunctionsController')->uploadImage($request->file, 'front-end/images/avatar');
       
        $checkFields = app('App\Http\Controllers\FunctionsController')->checkFilledFields(auth()->user());

        // $queryCharge = app('App\Http\Controllers\FunctionsController')->queryCharge('DELDHC3F');
        
        $charge = app('App\Http\Controllers\FunctionsController')->createCharge(['name' => 'Package 1','description' => 'Package 1','amount'=>10.00, 'package_id' => 1]);
        
        \DB::table('investors_packages')->insert($charge);
        dd($charge);
        $data = [
            'name' => 'David',
            'email' => 'davsong16@gmail.com',
            'type' => 'registration'
        ];
        $sendEmail = app('App\Http\Controllers\FunctionsController')->sendEmails($data);
    }
}
