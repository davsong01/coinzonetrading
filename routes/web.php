<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\WithdrawalController;

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
Route::get('/faq', [App\Http\Controllers\HomeController::class, 'faq'])->name('faq');
Route::get( '/rules', [App\Http\Controllers\HomeController::class, 'rules'])->name('rules');

Route::get('/test', [App\Http\Controllers\HomeController::class, 'testpage'])->name( 'test');
Route::get('/t', [App\Http\Controllers\Controller::class, 'walletTypes'])->name('trest');
Route::post( '/test', [App\Http\Controllers\HomeController::class, 'test'])->name('testsubmit')->middleware('hasPackage');
Route::post( '/sendcontact', [App\Http\Controllers\HomeController::class, 'sendContact'])->name('contact.send');
Route::get('/credit-wallet-cron/{count?}', [App\Http\Controllers\CronController::class, 'creditWalletCron']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/package/select/{package}', [App\Http\Controllers\HomeController::class, 'makePayment'])->name('package.select');
    Route::get('/dashboard',[App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
});

// Admin
Route::middleware(['auth','isAdmin:admin,staff'])->group(function(){
    Route::resource('packages', PackageController::class);
    Route::resource('investors', InvestorController::class);
    Route::get('alltransactions', [App\Http\Controllers\DashboardController::class, 'adminTransactions'])->name('alltransactions');
    Route::get('profile', [App\Http\Controllers\DashboardController::class, 'profile'])->name('profile')->middleware('pendingTransactions');
    Route::POST('profile', [App\Http\Controllers\DashboardController::class, 'storeProfile'])->name('profile.store');
    Route::POST('replaceavatar', [App\Http\Controllers\DashboardController::class, 'storeAvatar'])->name('replaceavatar');
    Route::get('settings', [App\Http\Controllers\SettingController::class, 'settings'])->name('settings');
    Route::post('settings-one', [App\Http\Controllers\SettingController::class, 'settings1'])->name('setting1.store');
    Route::post('settings-two', [App\Http\Controllers\SettingController::class, 'settings2'])->name('setting2.store');
    Route::post('settings-three', [App\Http\Controllers\SettingController::class, 'settings3'])->name('setting3.store');
    Route::get('investors-packages/{investor}', [App\Http\Controllers\InvestorController::class, 'investorPackages'])->name('investors.packages');
    Route::get('edit-packages/{id}', [App\Http\Controllers\InvestorController::class, 'investorPackagesUpdate'])->name('investorpackages.edit');

    Route::middleware(['isAdmin:admin'])->group(function(){
        Route::resource('withdrawal', WithdrawalController::class, [
            'only' => ['update']
        ]);
    });

});

// Investor
Route::middleware(['auth'])->group(function () {
    Route::get('my-packages', [App\Http\Controllers\DashboardController::class, 'myPackages'])->name('investor.packages');
    Route::get('mytransactions', [App\Http\Controllers\DashboardController::class, 'investorTransactions'])->name('mytransactions');
    Route::get( '/payment/callback/{reference}', [App\Http\Controllers\FunctionsController::class, 'updateTransaction'])->name('payment.process');
    Route::get('/payment-retry/{reference}', [App\Http\Controllers\DashboardController::class, 'retryTransaction'])->name('payment.retry');
    Route::get('/payment-renew/{reference}', [App\Http\Controllers\DashboardController::class, 'renewPackage'])->name('package.renew');
    Route::resource('withdrawal', WithdrawalController::class, [
        'only' => ['index','store']
    ]);
});

require __DIR__.'/auth.php';
