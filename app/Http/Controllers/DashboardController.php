<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use Illuminate\Http\Request;
use App\Models\InvestorPackage;
use Illuminate\Support\Facades\Auth;

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
        $packages = InvestorPackage::where(['investor_id' => auth()->user()->id])->get();


        dd($packages);
        return view('back.investors.mypackages.index', [
            'packages' => $packages,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role === 'investor'){
            return view('back.investors.index', [
                'canWithdraw' => (new FunctionsController)->canWithdraw()
            ]);
        }
        return view('investors.index', [
            'investors' => Investor::all()->loadMissing(['user']),
        ]);
    }
}
