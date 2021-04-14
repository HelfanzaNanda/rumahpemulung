<?php

use Illuminate\Support\Facades\Route;;
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
// route tak ber auth
Route::get('logout', 'AuthController@logout');
Route::view('blogs', 'blog');
Route::get('maps', 'GuestController@maps');

Route::group(['middleware' => 'guest:client,superadmin,lapak,pemulung'], function () {
    Route::view('/', 'index')->name('login');
    Route::view('register', 'auth.register')->name('register');
    Route::post('register', 'AuthController@registerstore');
    Route::post('login', 'AuthController@index');

    Route::get('auth/google', 'AuthController@redirectToGoogle')->name('google.login');
    Route::get('auth/google/callback', 'AuthController@handleGoogleCallback')->name('google.callback');

    Route::get('verifikasi/{email}/{token}', 'AuthController@verifikasi')->name('client.verifikasi.email');
    //Route::get('/password/reset', 'Kasir\ForgotPasswordController@showLinkRequestForm')->name('kasir.password.request');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('client.password.email');
    Route::get('/password/reset/{email}/{token}', 'ResetPasswordController@showResetForm')->name('client.password.reset');
    Route::post('/password/reset', 'ResetPasswordController@reset')->name('client.password.update');

    Route::view('superadmin/login', 'auth/loginadmin');
    Route::post('superadmin/login', 'AuthController@loginadmin');

    Route::view('lapak/login', 'auth/loginlapak');
    Route::post('lapak/login', 'AuthController@loginlapak');

    Route::view('pemulung/login', 'auth/login');
    Route::post('pemulung/login', 'AuthController@loginpemulung');

    Route::get('verifikasi/{code}', 'AuthController@verifikasi');
});

Route::group(['middleware' => 'auth:client'], function () {
    Route::get('client','Client\ClientController@index');
    Route::get('client/edit','Client\ClientController@edit');
	Route::get('client/request', 'Client\SalesController@create');    //CLIENT > REQUEST > FIRST LOAD
    Route::get('client/input/{id}', 'Client\SalesController@create'); //
	Route::get('client/history', 'Client\SalesController@index')->name('client.history');
    Route::get('client/get-data', 'Client\SalesController@getData');
    Route::resource('client/', 'Client\SalesController'); //CLIENT > REQUEST > ENTRY SAMPAH > SUBMIT
	
	Route::get('client/get-dataaddresshistory', 'Client\SalesController@getDataAddressHistory');

    Route::get('profile', 'Client\ProfileController@index')->name('client.profile');
    Route::get('edit-profile', 'Client\ProfileController@edit')->name('client.profile.edit');
    Route::post('edit-profile', 'Client\ProfileController@update')->name('client.profile.update');
    Route::get('edit-password', 'Client\ProfileController@editPassword')->name('client.password.edit');
    Route::post('edit-password', 'Client\ProfileController@updatePassword')->name('client.password.update');
});


Route::group(['middleware' => 'auth:superadmin'], function () {
    Route::view('superadmin', 'admin/index');
    Route::resource('superadmin/lapak', 'Superadmin\LapakController');
    Route::resource('superadmin/lapak/myMaps', 'Superadmin\LapakController@maps');
    Route::resource('superadmin/factory', 'Superadmin\FactoryController');
});


Route::group(['middleware' => 'auth:lapak'], function () {
    Route::get('lapak', 'Lapak\DashboardController@index');
    Route::get('lapak/pemulung/{id}/delete', 'Lapak\PemulungController@destroy')->name('pemulung.delete');
    Route::resource('lapak/pemulung', 'Lapak\PemulungController');
    Route::resource('lapak/client', 'Lapak\ClientController');

    //Route::resource('lapak/sales', 'Lapak\SalesController'); //GAK DIPAKAI?

    Route::get('lapak/sales/deliver/{so}', 'Lapak\SalesController@deliver');
    Route::post('lapak/sales/deliver/{so}', 'Lapak\SalesController@storedeliver');
    //Route::resource('lapak/porequest', 'Lapak\SalesController'); //LAPAK > LEFT MENU > GARBAGE IN > REQUEST
    Route::get('lapak/porequest', 'Lapak\SalesController@porequest'); //LAPAK > LEFT MENU > GARBAGE IN > REQUEST
    Route::get('lapak/pobook', 'Lapak\SalesController@pobook'); //LAPAK > LEFT MENU > GARBAGE IN > BOOK
    Route::get('lapak/popick', 'Lapak\SalesController@popick'); //LAPAK > LEFT MENU > GARBAGE IN > PICK
    Route::get('lapak/poreceiving', 'Lapak\SalesController@poreceiving'); //LAPAK > LEFT MENU > GARBAGE IN > RECEIVING
    Route::get('lapak/update/{id}/{status}', 'Lapak\SalesController@updatestatus')->name('lapak.update.status');
    Route::get('lapak/so/{id}', 'Lapak\SalesController@get')->name('lapak.get');

    Route::get('lapak/factory', 'Lapak\FactoryController@index')->name('lapak.factory.index');
    

    Route::get('lapak/factory/{id}/get', 'Lapak\FactoryController@get')->name('lapak.factory.get');

    Route::get('lapak/garbage-out/sales-order', 'Lapak\GarbageOut\SalesOrderController@index')->name('lapak.sales.order');
    Route::get('lapak/garbage-out/sales-order/create', 'Lapak\GarbageOut\SalesOrderController@create')->name('lapak.sales.order.create');
    Route::post('lapak/garbage-out/sales-order/store', 'Lapak\GarbageOut\SalesOrderController@store')->name('lapak.sales.order.store');
    Route::get('lapak/garbage-out/sales-order/factory/get', 'Lapak\GarbageOut\SalesOrderController@getFactory')->name('lapak.sales.factory.get');
    
    Route::get('lapak/garbage-out/good-issue', 'Lapak\GarbageOutController@goodIssue')->name('lapak.good.issue');
    Route::get('lapak/garbage-out/invoice', 'Lapak\GarbageOutController@invoice')->name('lapak.invoice');
});

Route::group(['middleware' => ['auth:pemulung']], function () {
    Route::get('pemulung','Pemulung\PemulungController@index');
    Route::get('pemulung/salesreq','Pemulung\PickupController@index');
    Route::get('pemulung/salesreq/{so}','Pemulung\PickupController@show');
    Route::get('pemulung/salesreq/pickup/{so}','Pemulung\PickupController@book');
    Route::get('pemulung/mybook','Pemulung\PickupController@indexbook');
    Route::get('pemulung/mybook/{so}','Pemulung\PickupController@showbook');
    Route::post('pemulung/mybook/{so}','Pemulung\PickupController@storebook');
    Route::get('pemulung/hargarubbish','Pemulung\PickupController@sampah')->name('hargarubbish');
    Route::get('pemulung/mypick','Pemulung\PickupController@indexpick');
    Route::get('pemulung/mypick/{so}','Pemulung\PickupController@showpick');
    //Route::resource('pemulung/salesreq', 'Pemulung\PickupController'); //PEMULUNG > REQUEST > VIEW > BOOK
    Route::post('pemulung/dobook', 'Pemulung\PickupController@dobook'); //PEMULUNG > REQUEST > VIEW > BOOK
});
