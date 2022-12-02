<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    public function settings()
    {
        $settings = Setting::first();
        return view('back.settings.update')->with('settings', $settings);
    }

    public function clearCache(){
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');

        return back()->with('message', 'Cache cleared!');
    }

    public function settings1(Request $request)
    {
        $settings = Setting::first();

        $settings->update([
            'official_email' => $request->official_email,
            'wallet_types' => $request->wallet_types,
            'currency_sign' => $request->currency_sign,
            'allow_wallet_buy' => $request->allow_wallet_buy
            
        ]);
       
        return back()->with('message', 'Operation successful');
    }

    public function settings2(Request $request)
    {
        $settings = Setting::first();
        
        $settings->update([
            'api_key' => $request->api_key,
            'currency' => $request->currency,
            'callback_url' => $request->callback_url
        ]);

        return back()->with('message', 'Operation successful');
    }

    public function settings3(Request $request)
    {
        $settings = Setting::first();
        if ($request->has('favicon')) {
            $favicon = app('App\Http\Controllers\FunctionsController')->uploadImage($request->favicon, 'front-end/images');
            $settings->favicon = $favicon;
        }

        if($request->has('light_logo')){
            $light_logo = app('App\Http\Controllers\FunctionsController')->uploadImage($request->light_logo, 'front-end/images');
            $settings->light_logo = $light_logo;
        }

        if ($request->has('dark_logo')) {
            $dark_logo = app('App\Http\Controllers\FunctionsController')->uploadImage($request->dark_logo, 'front-end/images');
            $settings->dark_logo = $dark_logo;
        }

        if ($request->has('page_banner')) {
            $page_banner = app('App\Http\Controllers\FunctionsController')->uploadImage($request->page_banner, 'front-end/images');
            $settings->page_banner = $page_banner;
        }

        $settings->save();
        
        return back()->with('message', 'Operation successful');
    }

    public function settings4(Request $request)
    {
        $this->settings->update($request->all());
        return back()->with('message', 'Operation successful');
    }
    
    public function settings5(Request $request){
        $settings = Setting::first();

        $settings->update($request->all());

        return back()->with('message','Update successful');
    }
    
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
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
