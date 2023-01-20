<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Package;
use App\Models\Setting;
use App\Models\Investor;
use Illuminate\Http\Request;
use App\Models\InvestorPackage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\InvestorStoreRequest;

class InvestorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('investors.index', [
            'investors' => Investor::with('user')->orderBy('created_at', 'DESC')->get(),
        ]);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function investorPackages($investor){
        $packages = InvestorPackage::whereInvestorId($investor)->get();
        $investor = Investor::find($investor);

        return view('investors.show_packages', [
            'packages' => $packages,
            'investor' =>$investor,
        ]);

    }

    public function investorPackagesAdd(Request $request){
        $data = $this->validate($request, [
            'investor_id' => 'required|numeric',
            'package_id' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required',
            'order_number' => 'required',
            'amount' => 'required',
        ]);

        // Check if package price correspondds
        $package = Package::find($data['package_id']);

        if($request->amount < $package->amount || $request->amount > $package->max_amount ){
            return back()->with('error', $this->settings->currency_sign . number_format($request->amount, 2) . ' is not in range of Package: '. $package->name);
        }

        //Set status according to start and end date
        if($request->end_date < $request->start_date){
            return back()->with('error', 'End date cannot be lower than start date');
        }else{
            if ($request->end_date < now()) {
                $status = 'expired';
            } else {
                $status = 'active';
            }
        }
        $reference = app('App\Http\Controllers\FunctionsController')->generateTransactionReference(). '-' . auth()->user()->id;
        $data['reference'] = $reference;
        $data['created_by'] = auth()->user()->id;
        $data['expires_at'] = now(); 
        $data['code'] = $request->order_number;
        $data['status'] = $status;
        $data['url'] = 'none';
        $data['currency'] = $this->settings->currency;
        $data['rid'] = $reference . '_ADMIN_ADD';
        $data['daily_roi'] = $this->getRoi($package, $request->amount);
        unset($data['order_number']);
       
        InvestorPackage::create($data);

        return back()->with('message', 'Package Added successfully');
    }

    public function investorPackagesUpdate(Request $request){
       
        $package = InvestorPackage::find($request->id);
        if($request->end_date < now()){
            $status = 'expired';
        }else{
            $status = 'active';
        }
        $package->update([
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "status" => $status,
        ]);
       
        return redirect(route('investors.edit', ['investor' => $request->user_id, 'hid' => 'packages' ]))->with('message', 'Operation successful');
    }

    public function approveId(Request $request, $investor_id){
        $investor = Investor::where('id', $investor_id)->first();
       
        if($request->status == 'approve'){
            if (!empty($investor->means_of_identification)) {
                $investor->update([
                    'approved_identification' =>  $investor->means_of_identification,
                    'approved_identification_by' =>  auth()->user()->id,
                ]);
            }

            $data = [
                'email' => $investor->user->email,
                'type' => 'id-approval-by-admin',
                'name' => $investor->user->name,
            ];
        
        }else{
            if (!empty($investor->means_of_identification)) {
                $investor->update([
                    'means_of_identification' => null,
                ]);
            }

            $data = [
                'email' => $investor->user->email,
                'type' => 'id-rejected-by-admin',
                'name' => $investor->user->name,
            ];
        
        }
       
        $email = (new FunctionsController)->sendEmails($data);
       
        return redirect(route('investors.edit', ['investor' => $investor->id, 'hid' => 'profile']))->with('message', 'Operation successful');

    }

    public function investorPackagesDelete($id, Request $request){
        $package = InvestorPackage::find($id);
        $package->delete();
        return redirect(route('investors.edit', ['investor' => $request->user_id, 'hid' => 'packages']))->with('message', 'Package deleted!');
    }

    public function create()
    {
        return view('investors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\InvestorStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( InvestorStoreRequest $request)
    {
        $data = $request->validated();
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = Hash::make('12345678');
        }

        $data['email_verified_at'] = now();
        
        $user = User::create($data);
        $data['user_id'] = $user->id;
        $data['created_by'] = auth()->user()->id;

        Investor::create($data);

        return redirect()->route('investors.index')->with('message', 'Investor created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Investor $investor, $hid = null)
    {
        // $investor = $investor->loadMissing(['user']);
       
        // $investor->map(function ( $investor) {
        //     if (isset( $investor->response) && !empty( $investor->response)) {
        //         $response = json_decode( $investor->response);

        //         $payments = $response->payments[0] ?? null;
        //          $investor->payment_id = $payments->payment_id ?? null;
        //          $investor->network = $payments->network ?? null;
        //          $investor->raw_status = $payments->status ?? null;
        //          $investor->detected_at =
        //             date("M jS, Y", strtotime($payments->detected_at)) ?? null;
        //     }

        //     return $investor;
        // });

        // dd($investor);

        return view('investors.edit', [
            'investor' => $investor->loadMissing(['user']),
            'hid' => $hid
        ]);

        

       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investor $investor)
    {
        if(app('App\Http\Controllers\FunctionsController')->hasPackages($investor->user)->count() > 0){
            return back()->with('error', 'You cannot delete this user because they have an active package!');
        }
        // Delete investor image
        if(!empty($investor->profile_picture)){
            app('App\Http\Controllers\FunctionsController')->deleteImage($investor->profile_picture);
        }
        
        // Delete investor user
        $investor->user->delete();
        // Delete investor
        $investor->delete();

        return back()->with('message', 'Delete successful');
      
    }
}
