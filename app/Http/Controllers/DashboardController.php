<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trade;
use App\Models\Wallet;
use App\Models\Package;
use App\Models\Setting;
use App\Models\Investor;
use App\Models\Instruments;
use Illuminate\Http\Request;
use App\Models\InvestorPackage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function adminTransactions(){
        $transactions = InvestorPackage::orderBy('created_at', 'DESC')->get();
        $transactions->map(function($transaction){
            if(isset($transaction->test) && !empty($transaction->test)){
                $test = json_decode($transaction->test);
                
                $payments = $test->payments[0] ?? null;
                $transaction->payment_id = $payments->payment_id ?? null;
                $transaction->network = $payments->network ?? null;
                $transaction->raw_status = $payments->status ?? null;
                $transaction->detected_at =
                date("M jS, Y", strtotime($payments->detected_at))?? null;
            }
            
            return $transaction;
        });

        return view('back.transactions.index', [
            'transactions' => $transactions,
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
                'country' => $request->country ?? $investor->country,
                'zip_code' => $request->zip_code ?? $investor->zip_code,
                'address' => $request->address ?? $investor->address,
                'state' => $request->state ?? $investor->state,
                'wallet_withdrawal_limit'=>$request->wallet_withdrawal_limit,
            ]);
           
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
                'country' => $request->country ?? $request->user()->investor->country,
                'zip_code' => $request->zip_code ?? $request->user()->investor->zip_code,
                'address' => $request->address ?? $request->user()->investor->address,
                'state' => $request->state ?? $request->user()->investor->state,
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

    public function storeId(Request $request)
    {
        $settings = Setting::latest()->first();
        if ($request->has('means_of_identification')) {
            $means_of_identification = app('App\Http\Controllers\FunctionsController')->uploadImage($request->means_of_identification, 'front-end/images/ids', 700, 700);
            
            auth()->user()->investor->update([
                'means_of_identification' => $means_of_identification,
            ]);

            $data = [
                'email' => $settings->official_email,
                'type' => 'upload-means-of-identification',
                'investor_name' => auth()->user()->name,
                'investor_email' => auth()->user()->email,
                'name' => 'Administrator',
            ];

            $email = (new FunctionsController)->sendEmails($data);
        }

        return back()->with('message', 'Means of Identification successfully uploaded');
    }

    public function myPackages(){
        $packages = Package::orderBy('created_at', 'DESC')->where('status', 'published')->get();
        
        $userPackages = InvestorPackage::where(['investor_id' =>request()->user()->id])->orderBy('created_at', 'DESC');
        $mypackages = $userPackages->take(5)->get();
      
        $otherpackages = array_column($userPackages->get('package_id')->toArray(), 'package_id');
        $otherpackages = $packages->whereNotIn('id', $otherpackages);

        return view('back.investors.mypackages', [
            'packages' => $packages,
            'mypackages' => $mypackages,
            'otherpackages' => $otherpackages,
        ]);
    }

    public function changePassword(Request $request, $id){
        $this->validate($request, ['password'=>'required']);
        $user = User::find($id);
        
        if ($request->has('password')) {
            $password = Hash::make($request->password);
            $user->update(['password'=>$password]);
        } 

        return back()->with('message', 'Password Changed successfully');
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
    
    public function trade(){
        $active = 'overview';
        $instruments = $this->sendGetRequest('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&sparkline=false');
        return view('back.investors.trade.overview', compact('instruments','active'));
    }

    public function crypto()
    {
        $active = 'crypto';
        $instruments = Instruments::all();
       
        if(empty($instruments)){
            $instruments = $this->sendGetRequest('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&sparkline=false');
        }

        $instruments = $instruments->map(function ($query) {
            $query['real_id'] = $query->i_id ?? $query->id;
            return $query;
        });
       
        return view('back.investors.trade.crypto', compact('instruments', 'active'));
    }

    public function pullTradeInstruments(){
        $instruments = $this->sendGetRequest('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&sparkline=false');
       
        foreach($instruments as $instrument){
            Instruments::updateOrCreate(['i_id'=>$instrument->id], ['symbol' => $instrument->symbol, 'name'=>$instrument->name]);
        }

        return response()->json(['All instruments pulled']);
    }

    public function marketData(){
        return view('back.investors.market_data');
    }

    public function selectInstrument(Request $request){
        $instrument = $request->instrument ?? null;
       
        $active = 'crypto';
        return view('back.investors.trade.crypto', compact('instrument', 'active'));
    }

    public function investorTrade(Request $request){
        $instrument = Instruments::where('i_id',$request->instrument)->first();
        
        if(empty($instrument)){
            $instrument = $this->sendGetRequest('https://api.coingecko.com/api/v3/coins/bitcoin?tickers=false&market_data=false&community_data=false&developer_data=false&sparkline=false');

        }
     
        // Save in table
        $trade = Trade::create([
            'investor_id' => auth()->user()->investor->id,
            'amount' => $request->amount,
            'instrument' => $instrument->name,
            'status' => 'Initiated',
            'trade_id' => app('App\Http\Controllers\FunctionsController')->generateTradeReference(),
        ]);


        // Send email to admin to make the trade
        $settings = Setting::latest()->first();

        $data = [
            'type' => 'admin-trade-notify',
            'name' => auth()->user()->name,
            'email' =>  $settings->official_email,
            'amount' => $request->amount,
            'instrument' => $instrument->name,
            'status' => 'Initiated',
            'trade_id' =>  $trade->trade_id,
        ];
       
        (new FunctionsController)->sendEmails($data);

        \Session::flash('message','Order successful');
        return redirect(route('trade.history'))->with('message', 'Order successful');

    }

    public function tradeHistory(){
        $active = 'history';
        $historys = Trade::where('investor_id', auth()->user()->investor->id)->orderBy('created_at', 'DESC')->get();
        $historys  =  $historys ->map(function ($query) {
            if ($query->status == 'Complete') {
                $query->bonus = app('App\Http\Controllers\FunctionsController')->getTradeBonusType($query);
            }
            return $query;
        });

        return view('back.investors.trade.crypto', compact('active','historys'));
    }
}
