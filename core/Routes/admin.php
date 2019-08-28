<?php

Route::group([], function() {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::group(['prefix' => 'json', 'as' => 'json.'], function() {
            Route::get('allUser', 'UserManageController@userJson')->name('allUser');
            Route::post('deleteUser', 'UserManageController@delete')->name('deleteUser');
        });

        Route::get('/', 'UserManageController@index')->name('index');
        Route::get('view/{id}', 'UserManageController@view')->name('view');
        Route::match(['get', 'post'], 'edit/{id}', 'UserManageController@edit')->name('edit');
        Route::match(['get', 'post'], 'create', 'UserManageController@create')->name('create');
        Route::post('changePassword/{id}', 'UserManageController@changePassword')->name('changePassword');
    });
});