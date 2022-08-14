<?php

namespace App\Http\Controllers;

use App\Http\Requests\PackageStoreRequest;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::withCount('users')->orderBy('created_at', 'DESC')->get();

        return view('packages.index',[
            'packages' => $packages,
            'setting' => $this->settings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PackageStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageStoreRequest $request)
    {
        Package::create($request->validated());

        return redirect()->route('packages.index')->with('message', 'Package created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        return view('packages.edit', [
            'package' => $package
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PackageStoreRequest  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(PackageStoreRequest $request, Package $package)
    {
        $package->update($request->validated());
        return redirect()->route('packages.index')->with('message', 'Package updated successfully');
    }

    /**
     * Soft delete the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        if($package->users->count() > 0){
            return back()->with('error', 'You cannot delete this package because it is being used by one or more investors');
        }

        $package->delete();
        return back()->with('message', 'Trash Successful!');
    }

    /**
     * Display a listing of trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        return view('packages.trashed', [
            'trashes' => Package::onlyTrashed()->orderBy('deleted_at', 'DESC')->get(),
        ]);
    }

    /**
     * Restore deleted specified resource from storage.
     *
     * @param  $package
     * @return \Illuminate\Http\Response
     */
    public function restore($package)
    {
        Package::withTrashed()->findOrFail($package)->restore();
        return back()->with('message', 'Restore Successful!');
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param  $package
     * @return \Illuminate\Http\Response
     */
    public function delete($package)
    {
        Package::withTrashed()->findOrFail($package)->forceDelete();
        return back()->with('message', 'Permanent Delete Successful!');
    }
}
