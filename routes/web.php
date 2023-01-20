<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\DashboardController;
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
Route::get('/testrequest', function(){
    $authentication = "kadoshkonnect@gmail.com:Kadosh6385462222";
    // $headers = [
    //     "Authorization:" . $authentication,
    //     "Content-Type" => "application/json",
    // ];
    
    // // $authentication = env('AIRTIME_USERNAME') . ':' . env('AIRTIME_PASSWORD');
    // $postData = [
    //     "billersCode" => "1212121212",
    //     "serviceID" => "dstv",
    // ];

    // $url = 'https://sandbox.vtpass.com/api/merchant-verify';
    // $curl = curl_init();

    // curl_setopt_array($curl, array(
    //     CURLOPT_URL => $url,
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_ENCODING => '',
    //     CURLOPT_MAXREDIRS => 10,
    //     CURLOPT_TIMEOUT => 0,
    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     CURLOPT_CUSTOMREQUEST => 'POST',
    //     CURLOPT_POSTFIELDS => ($postData),
    //     // CURLOPT_HTTPHEADER => array($headers),
    //     CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    //     CURLOPT_USERPWD => $authentication,
    // ));

    // $response = curl_exec($curl);
    // curl_close($curl);

    // dd($response, $postData);


    $phone="08066532759";
    $network="MTN";
    $amount=105;
    $date = new DateTime("now", new DateTimeZone('Africa/Lagos') );
    $request_id = $date->format('YmdHisi').'OGBO'.rand(1000000, 9999999);
   
    $host = 'https://sandbox.vtpass.com/api/pay';
    $data = array(
        'serviceID'=> $network, //integer e.g airtel
        'phone'=> $phone, // e.g phoneno
        'amount'=> $amount, // e.g dstv1, dstv2,prepaid,(optional for somes services)
        'request_id' => $request_id // unique for every transaction from your platform
    );
   
    //Confirm the GET values are not empty before sending to VTPass

    //cURL begins
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $host,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_USERPWD => $authentication,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
    ));
    $response=curl_exec($curl);
    echo $response;
    curl_close($curl);
});

Route::get( '/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get( '/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/faq', [ App\Http\Controllers\HomeController::class, 'faq'])->name('faq');
Route::get('/privacy-policy', [App\Http\Controllers\HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get( '/rules', [App\Http\Controllers\HomeController::class, 'rules'])->name('rules');

Route::post( '/sendcontact', [App\Http\Controllers\HomeController::class, 'sendContact'])->name('contact.send');
Route::get( '/credit-wallet-cron/{count?}', [App\Http\Controllers\CronController::class, 'creditWalletCron']);
Route::get('/delete-expired-wallet-transactions', [App\Http\Controllers\CronController::class, 'deleteExpiredWalletTransactions']);

Route::group(['middleware' => ['auth']], function () {
    Route::post('/package/select', [App\Http\Controllers\HomeController::class, 'makePayment'])->name('package.select');
    Route::get('/dashboard',[App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
    Route::get('profile', [App\Http\Controllers\DashboardController::class, 'profile'])->name('profile');
    Route::POST('profile', [App\Http\Controllers\DashboardController::class, 'storeProfile'])->name('profile.store');
    Route::POST('replaceavatar', [App\Http\Controllers\DashboardController::class, 'storeAvatar'])->name('replaceavatar');
    Route::POST('replaceid', [App\Http\Controllers\DashboardController::class, 'storeId'])->name('replaceid');
});

Route::get('/pull-trade-instruments', [App\Http\Controllers\DashboardController::class, 'pullTradeInstruments'])->name('instruments.pull');
// Admin
Route::middleware(['auth','isAdmin:admin,staff'])->group(function(){
    Route::patch('packages/{package}/restore', [PackageController::class, 'restore'])->name('packages.restore');
    Route::get('/clear-cache', [App\Http\Controllers\SettingController::class, 'clearCache'])->name('cache.clear');

    Route::delete('packages/{package}/delete', [PackageController::class, 'delete'])->name('packages.delete');
    Route::get('packages/trashed', [PackageController::class, 'trashed'])->name('packages.trashed');
    Route::resource('packages', PackageController::class);

    Route::resource('investors', InvestorController::class)->except('edit');
    Route::get('investors/{investor}/edit/{hid?}', [App\Http\Controllers\InvestorController::class, 'edit'])->name('investors.edit');
    Route::post('investor_packages_add', [App\Http\Controllers\InvestorController::class, 'investorPackagesAdd'])->name('investorpackages.add');

    Route::get('alltransactions', [App\Http\Controllers\DashboardController::class, 'adminTransactions'])->name('alltransactions');
    Route::get('settings', [App\Http\Controllers\SettingController::class, 'settings'])->name('settings');
    Route::post('settings-one', [App\Http\Controllers\SettingController::class, 'settings1'])->name('setting1.store');
    Route::post('settings-two', [App\Http\Controllers\SettingController::class, 'settings2'])->name('setting2.store');
    Route::post('settings-three', [App\Http\Controllers\SettingController::class, 'settings3'])->name('setting3.store');
    Route::post('settings-four', [App\Http\Controllers\SettingController::class, 'settings4'])->name('setting4.store');
    Route::post('settings-five', [App\Http\Controllers\SettingController::class, 'settings5'])->name('setting5.store');

    Route::post('investor_packages', [App\Http\Controllers\InvestorController::class, 'investorPackagesUpdate'])->name('investorpackages.edit');
    Route::post('approve-id/{investor_id}', [App\Http\Controllers\InvestorController::class, 'approveId'])->name('approveid');

    Route::get('resolve-wallet-backlog', [App\Http\Controllers\CronController::class, 'runCronBacklog'])->name('wallet.resolve');
    
    Route::get('admin-trade-history', [App\Http\Controllers\TradeController::class, 'adminTradeHistory'])->name('admin.trade.history');

    Route::get('admin-approve-trade-request/{id}', [App\Http\Controllers\TradeController::class, 'adminApproveTradeProcess'])->name('admin.approve.request');
    Route::get('admin-close-trade-request/{id}', [App\Http\Controllers\TradeController::class, 'adminCloseTradeProcess'])->name('admin.close.request');
    Route::post('admin-complete-request/{id}', [App\Http\Controllers\TradeController::class, 'adminCompleteTradeProcess'])->name('admin.complete.request');
    
    Route::middleware(['isAdmin:admin'])->group(function(){
        Route::resource('staff', App\Http\Controllers\StaffController::class);
        Route::post('investor_packages', [App\Http\Controllers\InvestorController::class, 'investorPackagesUpdate'])->name('investorpackages.edit');
        Route::post('investor_packages_delete/{id}', [App\Http\Controllers\InvestorController::class, 'investorPackagesDelete'])->name('investorpackages.delete');
        Route::post('alltransactionsdelete/{transaction}', [App\Http\Controllers\DashboardController::class, 'deleteAdminTransactions'])->name('alltransactions.delete');
        Route::post('change-investor-password/{id}', [App\Http\Controllers\DashboardController::class, 'changePassword'])->name('admin.password');

        Route::resource('withdrawal', WithdrawalController::class, [
            'only' => ['update']
        ]);
    });
});

// Investor
Route::middleware(['auth', 'verified','pendingTransactions'])->group(function () {
    Route::get('my-packages', [App\Http\Controllers\DashboardController::class, 'myPackages'])->name('investor.packages');
    Route::get('/my-wallethistory/{user_id?}', [App\Http\Controllers\DashboardController::class, 'myWalletHistory'])->name('mywallet.history');

    Route::get('mytransactions', [App\Http\Controllers\DashboardController::class, 'investorTransactions'])->name('mytransactions')->middleware('hasPackage');
    Route::get('/payment/callback/{reference}/{middleware?}', [App\Http\Controllers\FunctionsController::class, 'updateTransaction'])->name('payment.process');
    
    Route::get('/payment-retry/{reference}', [App\Http\Controllers\DashboardController::class, 'retryTransaction'])->name('payment.retry');
    Route::get('/payment-renew/{reference}', [App\Http\Controllers\DashboardController::class, 'renewPackage'])->name('package.renew');
    Route::get('withdrawal-history', [App\Http\Controllers\WithdrawalController::class, 'history'])->name('withdrawal.history');
    Route::get('investor-trade', [App\Http\Controllers\DashboardController::class, 'trade'])->name('trade');
    Route::get('market-data', [App\Http\Controllers\DashboardController::class, 'marketData'])->name('market.data');
    Route::get('select-instrument', [App\Http\Controllers\DashboardController::class, 'selectInstrument'])->name('select.instrument');
    Route::get('trade-overview', [App\Http\Controllers\DashboardController::class, 'trade'])->name('trade.overview');
    Route::get('trade-crypto', [App\Http\Controllers\DashboardController::class, 'crypto'])->name('trade.crypto');
    Route::get('trade-history', [App\Http\Controllers\DashboardController::class, 'tradeHistory'])->name('trade.history');
    Route::post('investor-trade', [App\Http\Controllers\DashboardController::class, 'investorTrade'])->name('investor.trade');
    Route::get('/close-trade/{trade}', [App\Http\Controllers\TradeController::class, 'closeTrade'])->name('trade.close');
    Route::get('/top-wallet', [WalletController::class, 'topUpWallet'])->name('wallet.topup');
    Route::post('/top-wallet', [App\Http\Controllers\WalletController::class, 'processTopUpWallet'])->name('wallet.topup.process');

    Route::resource('withdrawal', WithdrawalController::class, [
        'only' => ['index','store','history']
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/wallet-topup-verify/{reference}/{middleware?}/{admin?}', [App\Http\Controllers\WalletController::class, 'updateWalletTopUp'])->name('wallet.topup.verify');
});

require __DIR__.'/auth.php';
