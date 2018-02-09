<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/referrals','ReferralController@index');
Route::get('/subscription','SubscriptionController@index');
Route::get('/rewards',function(){
    $ranks = App\Rank::all();
    return view('rewards.index', compact('ranks'));
});
Route::get('/payment-history',function(){
    $user = Auth::user();
    $wallet = App\EWallet::where('user_id', $user->id)->get()->first();
    $transactions = App\CreditDebit::where('user_id', $user->id)->get();
    return view('payments.history', compact('transactions', 'wallet'));
});
Route::get('/downline-tree','ReferralController@downline');
Route::get('/gateway','HomeController@gateway');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay'); 
Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
Route::get('/register/{ref}', 'RegisterWithRefController@index')->name('register.ref');

Route::post('/manual-payment','ManualPaymentController@index')->name('manual.payment');
Route::get('/manual-payment/approve/{reference}','ManualPaymentController@approve')->name('manual.payment.approve');