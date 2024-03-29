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

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('home', 'HomeController@index')->name('home');
    
    Route::group(['prefix' => 'profile'], function() {
        Route::get('/', 'HomeController@profile')->name('profile');

        Route::post('changePassword', 'HomeController@changePassword')->name('change-password');
        Route::post('changeProfile', 'HomeController@changeProfile')->name('change-profile');
    });
});
