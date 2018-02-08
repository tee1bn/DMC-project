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








//participant menus


Route::get('/admin-dashboard', function () {
    return view('auth/admin/admin-dashboard');
})->name('admin-dashboard');




//participant menus

Route::get('/admin-dashboard', function () {
    return view('auth/admin/admin-dashboard');
})->name('admin-dashboard');


Route::get('/participant-dashboard', function () {
    return view('auth/participant/user-dashboard');
})->name('participant-dashboard');






















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

