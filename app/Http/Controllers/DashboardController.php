<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\InvestorPackage;

class DashboardController extends Controller
{
    public function adminTransactions(){
        return view('back.transactions.index', [
            'transactions' => InvestorPackage::all(),
        ]);
    }

    public function investorTransactions()
    {
        $transactions = InvestorPackage::whereInvestorId(auth()->user()->investor->id)->get();
       
        return view('back.investors.transactions.index', [
            'transactions' => $transactions,
        ]);
    }

    public function profile(){
        return view('back.general.profile');
    }

    public function storeProfile(Request $request){
        auth()->user()->update([
            'name' => $request->name ?? auth()->user()->name,
        ]);

        auth()->user()->investor->update([
            'phone' => $request->phone ?? auth()->user()->investor->phone,
            'wallet_type' => $request->wallet_type ?? auth()->user()->investor->wallet_type,
            'wallet_address' => $request->wallet_address ?? auth()->user()->investor->wallet_address,
        ]);

        return back()->with('message', 'Operation successful');
    }

    public function storeAvatar(Request $request){
        if($request->has('profile_picture')){
            $profile_picture = app('App\Http\Controllers\FunctionsController')->uploadImage($request->profile_picture, 'front-end/images/avatar', 400, 400);

            auth()->user()->investor->profile_picture = $profile_picture;
            auth()->user()->investor->save();
        }

        return back()->with('message', 'Profile picture changed');
    }

    public function myPackages(){
        $packages = Package::all();
        $userPackages = InvestorPackage::where(['investor_id' => auth()->user()->investor->id]);
        $mypackages = $userPackages->get();
        
        $otherpackages = array_column($userPackages->get('package_id')->toArray(), 'package_id');
        $otherpackages = $packages->whereNotIn('id', $otherpackages);
        
        return view('back.investors.mypackages', [
            'packages' => $packages,
            'mypackages' => $mypackages,
            'otherpackages' => $otherpackages,
        ]);
    }
}
