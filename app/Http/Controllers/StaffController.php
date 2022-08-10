<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{

    public function index(){
        return view('staff.index', [
            'staffs' => Admin::where('id', '!=', 1)->orderBy('created_at', 'DESC')->get(),
        ]);
    }


    public function edit(Admin $staff)
    {
        return view('staff.edit', [
            'staff' => $staff,
        ]);
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Admin $staff, Request $request){
       
        $data = $this->validate($request, [
            'password' => 'nullable',
            'name' => 'sometimes',
            'email' => 'sometimes|email',
            'phone' => 'sometimes',
            'level' => 'sometimes',
            'profile_picture' => 'sometimes',
        ]);

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);

        }else{
            $data['password'] = Hash::make('9876543');
        }

        $data['email_verified_at'] = now();
        $data['role'] = 'admin';
        $user = User::create($data);
        $data['user_id'] = $user->id;
       
        Admin::create($data);
       
        return redirect(route('staff.index'))->with('message', 'Update successfull');

    }
    public function show(){

    }
    
    public function update(Admin $staff, Request $request){
        $data = $this->validate($request, [
            'password' => 'nullable',
            'name' => 'sometimes',
            'phone' => 'sometimes',
            'level' => 'sometimes',
            'profile_picture' => 'sometimes',
        ]);


        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        } 

        if ($request->has('profile_picture')) {
            $data['profile_picture'] = app('App\Http\Controllers\FunctionsController')->uploadImage($request->profile_picture, 'front-end/images/avatar', 400, 400);
        }

        $staff->update($data);
        $staff->user->update($data);

        return back()->with('message', 'Update Successful!');
    }

    public function destroy(Request $request, Admin $staff){
        if (!empty($staff->profile_picture)) {
            app('App\Http\Controllers\FunctionsController')->deleteImage($staff->profile_picture);
        }

        // Delete investor user
        $staff->user->delete();
        // Delete staff
        $staff->delete();

        return back()->with('message', 'Delete successful');
    }
    
}
