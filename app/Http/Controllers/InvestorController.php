<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestorStoreRequest;
use App\Models\Investor;
use App\Models\InvestorPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'investors' => Investor::all()->loadMissing(['user']),
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

    public function investorPackagesUpdate(InvestorPackage $id){
        dd($id);
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
        Auth::user()->investor()->create($request->validated());
        return redirect()->route('investors.index')->with('success', 'Investor created successfully');
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
    public function edit(Investor $investor)
    {
        // dd();
        return view('investors.edit', [
            'investor' => $investor->loadMissing(['user']),
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
    public function destroy($id)
    {
        //
    }
}
