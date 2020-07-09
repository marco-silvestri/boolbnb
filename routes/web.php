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

Route::get('/', 'Guest\IndexController@index')->name('guest.index');

Auth::routes();

//UPR/UPRA
Route::prefix('user')
    ->namespace('User')
    ->middleware('auth')
    ->group(function() {



        //prova
        Route::get('/home', 'HomeController@index')->name('user.index');
});


