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
use App\User;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/plain-page', function () {
    return view('auth/participant/plain-page');
})->name('plain-page');




Route::group(array('prefix'=> '/admin'), function()
{


Route::get('/user-management', function () {
    return view('auth/admin/user-management');
})->name('user-management');





});




//participant menus


Route::group(array('prefix'=> '/participant'), function()
{


Route::get('/participant-dashboard', function () {
    return view('auth/participant/user-dashboard');
})->name('participant-dashboard');





			Route::get('/profile', function () {
			    return view('auth/participant/profile');
			})->name('participant-profile');



			Route::get('/change-password', function () {
			    return view('auth/participant/change-password');
			})->name('participant-change-password');



			Route::get('/balance', function () {
			    return view('auth/participant/e-wallet');
			})->name('participant-balance');


			Route::get('/funds-withdrawal', function () {
			    return view('auth/participant/funds-withdrawal');
			})->name('participant-funds-withdrawal');

			   
Route::get('/payment-history', function () {
			    return view('auth/participant/payment-history');
			})->name('participant-payment-history');

			   
Route::get('/withdrawal-history', function () {
			    return view('auth/participant/withdrawal-history');
			})->name('participant-withdrawal-history');
	   
Route::get('/security-settings', function () {
			    return view('auth/participant/security-settings');
			})->name('participant-security-settings');

Route::get('/admin-messages', function () {
			    return view('auth/participant/admin-messages');
			})->name('participant-admin-messages');

			});



//participant menus

Route::get('/admin-dashboard', function () {
    return view('auth/admin/admin-dashboard');
})->name('admin-dashboard');




















Route::get('/verify-email/{email}', 'LoginController@verify_email')->name('verify-email');
Route::get('/verify-phone/{phone}', 'LoginController@verify_phone')->name('verify-phone');
Route::post('/custom-login', 'LoginController@custom_login')->name('login.custom');


/*user send meessage route*/
Route::post('/admin-messages/send-message', 'AdminMessagingController@message_admin')->name('message-admin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



/*admin_routes*/

Route::get('/testrole', 'HomeController@testrole')->name('testrole')->middleware('checkrole');
;

