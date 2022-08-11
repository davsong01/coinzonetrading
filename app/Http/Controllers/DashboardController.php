<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Package;
use App\Models\Investor;
use Illuminate\Http\Request;
use App\Models\InvestorPackage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function adminTransactions(){
        return view('back.transactions.index', [
            'transactions' => InvestorPackage::orderBy('created_at', 'DESC')->get(),
        ]);
    }

    public function investorTransactions()
    {
        $transactions = InvestorPackage::whereInvestorId(auth()->user()->id)->orderBy('created_at', 'DESC')->get();

        return view('back.investors.transactions.index', [
            'transactions' => $transactions,
        ]);
    }

    public function profile(){
        return view('back.general.profile');
    }

    public function storeProfile(Request $request){
        if($request->has('investor_id')){
            $investor = Investor::find($request->investor_id);
            
            $investor->update([
                'phone' => $request->phone ?? $investor->phone,
                'wallet_type' => $request->wallet_type ?? $investor->wallet_type,
                'wallet_addrress' => $request->wallet_address ?? $investor->wallet_address,
            ]);
            // dd($investor->user);
            $this->validate($request, [
                'email' => 'sometimes|unique:users,email,' . $investor->user->id,
            ]);
            
            $investor->user()->update([
                'name' => $request->name ?? $investor->user->name,
                'email' => $request->email ?? $investor->user->email
            ]);

            return redirect(route('investors.edit', ['investor' => $request->investor_id, 'hid' => 'profile']))->with('message', 'Operation successful');
        }

        if ($request->has('password') && !is_null($request->password)) {
            $request->user()->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $request->user()->update([
            'name' => $request->name ?? $request->user()->name,
        ]);

        if(auth()->user()->role == 'admin' || auth()->user()->role == 'staff'){
            
            $request->user()->admin->update([
                'phone' => $request->phone,
            ]);
        }else{
            $request->user()->investor->update([
                'phone' => $request->phone ?? $request->user()->investor->phone,
                'wallet_type' => $request->wallet_type ?? $request->user()->investor->wallet_type,
                'wallet_addrress' => $request->wallet_address ?? $request->user()->investor->wallet_address,
            ]);
        }
       
        return back()->with('message', 'Operation successful');
    }

    public function storeAvatar(Request $request){
        if ($request->has('investor_id')) {
            $investor = Investor::find($request->investor_id);

            $investor->update([
                'phone' => $request->phone ?? $investor->phone,
                'wallet_type' => $request->wallet_type ?? $investor->wallet_type,
                'wallet_address' => $request->wallet_address ?? $investor->wallet_address,
            ]);

            $investor->user()->update([
                'name' => $request->name ?? $investor->user->name,
            ]);

        }
        if($request->has('profile_picture')){
            $profile_picture = app('App\Http\Controllers\FunctionsController')->uploadImage($request->profile_picture, 'front-end/images/avatar', 400, 400);
            if ($request->has('investor_id')) {
                $investor = Investor::find($request->investor_id);
                $investor->profile_picture = $profile_picture;
                $investor->save();

                return back()->with('message', 'Operation successful');
            }
            if($request->user()->role == 'admin' || $request->user()->role == 'staff'){
                $request->user()->admin->profile_picture = $profile_picture;
                $request->user()->admin->save();
            }else{
                $request->user()->investor->profile_picture = $profile_picture;
                $request->user()->investor->save();
            }
           
        }

        return back()->with('message', 'Profile picture changed');
    }

    public function myPackages(){
        $packages = Package::orderBy('created_at', 'DESC')->get();
        $userPackages = InvestorPackage::where(['investor_id' =>request()->user()->id])->orderBy('created_at', 'DESC');
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

        $transaction = InvestorPackage::whereInvestorId(auth()->user()->id)->whereReference($reference)->first();
        $check = InvestorPackage::where('package_id',$transaction->id)->where('investor_id', auth()->user()->id)->where('status', 'active')->where('end_date', '>', now());
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
        $transaction = InvestorPackage::whereInvestorId(auth()->user()->id)->whereReference($reference)->first();
        if(!$transaction){
            return back()->with('error', 'Cannot find this transaction anymore');
        }
        $check = InvestorPackage::where('package_id', $transaction->id)->where('investor_id', auth()->user()->id)->where('status', 'active')->where('end_date', '>', now());
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

    public function index()
    {
        if (Auth::user()->role === 'investor') {
            return redirect(route('investor.packages'));
           
        }else{
            return view('dashboard', [
                'investors' => Investor::all()->loadMissing(['user']),
            ]);
        }
    }

    public function deleteAdminTransactions(InvestorPackage $transaction){
        if($transaction->status == 'active'){
            return back()->with('error', 'You cannot delete this transaction because it is still active!');
        }
        $transaction->delete();

        return back()->with('message', 'Delete succesful');
    }

    public function mywalletHistory(){
        $wallets = Wallet::whereUserId(auth()->user()->id)->orderBy('created_at', 'DESC')->get();

        return view('back.investors.mywallethistory', [
            'wallets' => $wallets,
        ]);
    }
}
