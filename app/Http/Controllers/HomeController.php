<?php

namespace App\Http\Controllers;

use auth;
use Illuminate\Http\Request;

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

    public function test(Request $request){
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
