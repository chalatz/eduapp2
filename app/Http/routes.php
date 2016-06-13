<?php

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::get('/', ['as' => 'home', 'uses' => 'PagesController@index']);

    Route::get('/home', 'HomeController@index');

    Route::resource('sites', 'SitesController');

    Route::get('verify/{verification_token}', ['as' => 'user.verify', 'uses' => 'UsersController@verify']);
    Route::get('send-verification', ['as' => 'user.send_verification', 'uses' => 'UsersController@send_verification']);
    // Change Password
    Route::get('change-password', ['as' => 'user.change_password', 'uses' => 'UsersController@change_password'])->middleware('auth');
    Route::post('change-password', ['as' => 'user.do_change_password', 'uses' => 'UsersController@do_change_password']);

    Route::get('suggest/{unique_string}', ['as' => 'user.suggest', 'uses' => 'SuggestionsController@handle_suggestion']);
    Route::get('suggest-answer/{answer}/{unique_string}', ['as' => 'user.suggest_answer', 'uses' => 'SuggestionsController@handle_suggestion_answer']);

    Route::get('verified-only', ['as' => 'verified_only', 'middleware' => 'verified', 'uses' => 'PagesController@test']);

    Route::get('choose-grader-type', ['as' => 'choose_grader_type', 'uses' => 'PagesController@choose_grader_type']);
    Route::get('suggest-other-grader', ['as' => 'suggest_other_grader', 'uses' => 'PagesController@suggest_other_grader']);
    Route::get('other-grader-email', ['as' => 'other_grader_email', 'uses' => 'PagesController@other_grader_email']);

    Route::get('send-reminder-to-grader-a-from-site', ['as' => 'send_reminder_to_grader_a_from_site', 'uses' => 'SuggestionsController@send_reminder_to_grader_a_from_site']);
    Route::get('suggest-new-grader-a-email', ['as' => 'suggest_new_grader_a_email', 'uses' => 'SuggestionsController@suggest_new_grader_a_email']);

    Route::post('do-suggest-other-grader', ['as' => 'do_suggest_other_grader', 'uses' => 'SuggestionsController@do_suggest_other_grader']);
    Route::post('store-other-grader', ['as' => 'store_other_grader', 'uses' => 'SuggestionsController@store_other_grader']);
    Route::post('do-other-grader-email/{action}', ['as' => 'do_other_grader_email', 'uses' => 'SuggestionsController@do_other_grader_email']);

    Route::get('graders/create_b', ['as' => 'graders.create_b', 'uses' => 'GradersController@create_b']);
    Route::post('graders/store_b', ['as' => 'graders.store_b', 'uses' => 'GradersController@store_b']);

    Route::get('graders/edit_b/{graders}', ['as' => 'graders.edit_b', 'uses' => 'GradersController@edit_b']);
    Route::put('graders/b/{graders}', ['as' => 'graders.update_b', 'uses' => 'GradersController@update_b']);

    Route::resource('graders', 'GradersController');

    Route::get('graders/{graders}/edit-and-suggest-self', ['as' => 'graders.edit_and_suggest_self', 'uses' => 'GradersController@edit_and_suggest_self']);

    // ----- MEMBERS ------ //
    Route::get('admin/graders/a', ['as' => 'stuff.graders_a', 'uses' => 'MembersController@graders_a']);

});
