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
//Accesssible when you are not logged in
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Laravel 5.1.17 and above
Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay');
Route::post('/qrcodes/show_payment', 'QrcodeController@show_payment')->name('qrcodes.show_payment');
Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
Route::get('/transactions/{id}', 'TransactionController@show')->name('transactions.show');
Route::get('/qrcodes/{id}', 'QrcodeController@show')->name('qrcodes.show');
// Auth::routes();
//can only access when you are logged in

Route::group(['middleware' => 'auth'], function () {
    Route::get('/users/api', function () {
        return  view('users.token');
    })->name('users.api');

    Route::resource('qrcodes', 'QrcodeController')->except('[show]');
    Route::resource('transactions', 'TransactionController')->except('[show]');
    Route::resource('accounts', 'AccountController')->except('[show]');
    Route::get('accounts/show/{id?}', 'AccountController@show')->name('accounts.show');
    Route::resource('accountHistories', 'AccountHistoryController');
    Route::resource('users', 'UserController');

    // admin and moderator can have acccess
    Route::group(['middleware' => 'checkmoderator'], function () {
        Route::get('/users', 'UserController@index')->name('users.index');
    });

    //only admin can have access
    Route::resource('roles', 'RoleController')->middleware('checkadmin');

    Route::post('/accounts/apply_for_payout', 'AccountController@apply_for_payout')->name('accounts.apply_for_payout');
    Route::post('/accounts/mark_as_paid', 'AccountController@mark_as_paid')
                 ->name('accounts.mark_as_paid')
                 ->middleware('checkmoderator');

    Route::get('/accounts', 'AccountController@index')
          ->name('accounts.index')
          ->middleware('checkmoderator');

    Route::get('/accounts/create', 'AccountController@create')
    ->name('accounts.create')
    ->middleware('checkadmin');

    Route::get('/accountHistories', 'AccountHistoryController@index')
          ->name('accountHistories.index')
          ->middleware('checkadmin');

    Route::get('/accountHistories/create', 'AccountHistoryController@create')
    ->name('accountHistories.create')
    ->middleware('checkadmin');
});

// Route::get('/home', 'HomeController@index');

// Route::resource('accounts', 'AccountController');
