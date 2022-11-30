<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // return Validator::make($data, [
        $request->validate([
            'first_name' => ['required', 'string', 'max:30', 'alpha'],
            'last_name' => ['required', 'string', 'max:30', 'alpha'],
            'email' => ['required', 'string', 'email', 'max:55', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'agreement' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        event(new Registered($user));
        
        Auth::login($user);
        $user->investor()->create();
        return redirect(RouteServiceProvider::HOME);
    }
}
