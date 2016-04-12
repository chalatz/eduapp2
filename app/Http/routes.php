<?php

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::get('/', ['as' => 'home', 'uses' => 'PagesController@index']);

    Route::get('/home', 'HomeController@index');

    Route::resource('sites', 'SitesController');

    Route::get('verify/{verification_token}', ['as' => 'user.verify', 'uses' => 'UsersController@verify']);
    Route::get('send-verification', ['as' => 'user.send_verification', 'uses' => 'UsersController@send_verification']);

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
    Route::post('do-other-grader-email/{actio}', ['as' => 'do_other_grader_email', 'uses' => 'SuggestionsController@do_other_grader_email']);

    Route::resource('graders', 'GradersController');

    Route::get('graders/{graders}/edit-and-suggest-self', ['as' => 'graders.edit_and_suggest_self', 'uses' => 'GradersController@edit_and_suggest_self']);

});
