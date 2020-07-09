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

Route::get('/', 'Guest\IndexController@index')->name('index');

Auth::routes();

//UPR/UPRA
Route::prefix('user')
    ->name('user.')
    ->namespace('User')
    ->middleware('auth')
    ->group(function() {
        Route::get('/dashboard', 'ApartmentController@index');
        Route::resource('apartment', 'ApartmentController');
    });


