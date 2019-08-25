<?php

Route::group([], function() {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', 'UserManageController@index')->name('index');
    });
});