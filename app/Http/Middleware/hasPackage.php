<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Package;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\FunctionsController;

class hasPackage extends FunctionsController
{

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // if user == admin
            if(Auth::user()->role == 'admin'){
                return $next($request);
            }
           
            //check if user has no plan
            $packages = app('App\Http\Controllers\FunctionsController')->hasPackages(auth()->user());
            
            if (isset($packages) && $packages->count() < 1) {
                return redirect(url('/my-packages'));
            }
            
        }

        return $next($request);
    }
}
