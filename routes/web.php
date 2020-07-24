<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Guest\ApartmentController@index')->name('index');
Route::resource('message', 'MessageController');

//Guest
Route::prefix('guest')
    ->namespace('Guest')
    ->name('guest.')
    ->group(function () {
        Route::resource('apartment', 'ApartmentController');
        Route::post('search', 'ApartmentController@searchApartment')->name('search');
        Route::post('city', 'ApartmentController@searchCity')->name('city');
});

Auth::routes();

//UPR/UPRA
Route::prefix('user')
    ->name('user.')
    ->namespace('User')
    ->middleware('auth')
    ->group(function() {
        Route::get('dashboard', 'ApartmentController@index')->name('dashboard');
        Route::resource('apartment', 'ApartmentController');
        Route::get('message', 'ApartmentController@messageIndex')->name('message');
        Route::get('/payment/process', 'PaymentsController@process')->name('payment.process');
        Route::post('/store_sponsorship', 'PaymentController@store_sponsorship');
});


