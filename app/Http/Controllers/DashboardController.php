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

    public function retryTransaction($reference){
        //Check if transaction has not expired
       
        $transaction = InvestorPackage::whereInvestorId(auth()->user()->investor->id)->whereReference($reference)->first();
        $check = InvestorPackage::where('package_id',$transaction->id)->where('investor_id', auth()->user()->investor->id)->where('status', 'active')->where('end_date', '>', now());
        if (isset($check) && $check->count() > 0) {
            return back()->with('error', 'You already have this package and it is active');
        }
        $package = Package::find($transaction->package_id);
        
        if(isset($transaction)){
            if($transaction->expires_at > now()){
                // Delete transaction and create afresh
                $transaction->delete();
                app('App\Http\Controllers\HomeController')->makePayment($package);
            }else{
                if($transaction->status == 'pending'){
                    $transaction->delete();
                }
                return back()->with('error', 'Transaction window for this package has expired!');
            }
        }else{
            return back()->with('error', 'Transaction not found');
        }

        return back()->with('error', 'Something went wrong');

    }

    public function renewPackage($reference)
    {
        //Check if transaction has not expired

        $transaction = InvestorPackage::whereInvestorId(auth()->user()->investor->id)->whereReference($reference)->first();
        if(!$transaction){
            return back()->with('error', 'Cannot find this transaction anymore');
        }
        $check = InvestorPackage::where('package_id', $transaction->id)->where('investor_id', auth()->user()->investor->id)->where('status', 'active')->where('end_date', '>', now());
        if (isset($check) && $check->count() > 0) {
            return back()->with('error', 'You already have this package and it is active');
        }
        $package = Package::find($transaction->package_id);
        $transaction->delete();
      
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
}
