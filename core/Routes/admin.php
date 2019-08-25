<?php

Route::group([], function() {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('getJson', 'UserManageController@userJson')->name('getJson');
        Route::get('/', 'UserManageController@index')->name('index');
    });
});