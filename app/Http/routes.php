<?php

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::get('/', ['as' => 'home', 'uses' => 'PagesController@index']);

    Route::get('/home', 'HomeController@index');

    Route::get('verify/{verification_token}', ['as' => 'user.verify', 'uses' => 'UsersController@verify']);
    Route::get('send-verification', ['as' => 'user.send_verification', 'uses' => 'UsersController@send_verification']);

    Route::get('verified-only', ['as' => 'verified_only', 'middleware' => 'verified', 'uses' => 'PagesController@test']);

    Route::resource('sites', 'SitesController');

});
