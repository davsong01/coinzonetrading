<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get( '/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get( '/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get( '/rules', [App\Http\Controllers\HomeController::class, 'rules'])->name('rules');

Route::get('/test', [App\Http\Controllers\HomeController::class, 'testpage'])->name('test');
Route::post( '/test', [App\Http\Controllers\HomeController::class, 'test'])->name('testsubmit')->middleware('hasPackage');
Route::post('/sendcontact', [App\Http\Controllers\HomeController::class, 'sendContact'])->name('contact.send');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/package/select/{package}', [App\Http\Controllers\HomeController::class, 'makePayment'])->name('package.select');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');
});

// Admin
Route::middleware(['auth'])->group(function(){
    Route::resource('packages', PackageController::class);
    Route::get('alltransactions', [App\Http\Controllers\DashboardController::class, 'adminTransactions'])->name('alltransactions');
});

require __DIR__.'/auth.php';
