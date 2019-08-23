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
})->name('home');

Route::get('/test1', function() {
    echo "Test 1";
})->name('admin.user.index');


Route::get('/test2', function() {
    echo "Test 1";
})->name('admin.menu.index');


Route::get('/test3', function() {
    echo "Test 1";
})->name('admin.role.index');