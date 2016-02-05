<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//use Mail;

Route::get('/', function () {
    return view('welcome');
});

Route::get('email/send', function(){

    $user = App\User::find(1);

    Mail::send('emails.test', ['user' => $user], function ($message) use ($user) {
        $message->from('info@eduwebawards.gr', 'ΔΕΕΙ');

        $message->to($user->email, 'chalatz')->subject('Γεια σου!');
    });

    return "Email probably sent";

});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
