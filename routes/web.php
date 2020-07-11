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

//Guest
Route::namespace('guest')
->name('guest.')
->prefix('guest')
->group(function () {
        Route::resource('apartment', 'ApartmentController');
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
});


