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
    Route::get('delete-suggestion', ['as' => 'delete_suggestion', 'uses' => 'SuggestionsController@delete_suggestion']);

    Route::post('do-suggest-other-grader', ['as' => 'do_suggest_other_grader', 'uses' => 'SuggestionsController@do_suggest_other_grader']);
    Route::post('do-other-grader-email/{action}', ['as' => 'do_other_grader_email', 'uses' => 'SuggestionsController@do_other_grader_email']);    
    Route::post('store-other-grader', ['as' => 'store_other_grader', 'uses' => 'SuggestionsController@store_other_grader']);

    Route::get('graders/create_b', ['as' => 'graders.create_b', 'uses' => 'GradersController@create_b']);
    Route::post('graders/store_b', ['as' => 'graders.store_b', 'uses' => 'GradersController@store_b']);

    Route::get('graders/edit_b/{graders}', ['as' => 'graders.edit_b', 'uses' => 'GradersController@edit_b']);
    Route::put('graders/b/{graders}', ['as' => 'graders.update_b', 'uses' => 'GradersController@update_b']);

    Route::get('grader/cv/{file}',['as' => 'graders.get_cv', 'uses' => 'GradersController@get_cv']);
    Route::get('grader/photo/{file}',['as' => 'graders.get_photo', 'uses' => 'GradersController@get_photo']);

    Route::get('grader/{file}',['as' => 'graders.get_file', 'uses' => 'GradersController@get_file']);

    Route::resource('graders', 'GradersController');

    Route::get('graders/{graders}/edit-and-suggest-self', ['as' => 'graders.edit_and_suggest_self', 'uses' => 'GradersController@edit_and_suggest_self']);

    Route::get('user/account-actions', ['as' => 'user.account_actions', 'uses' => 'UsersController@account_actions'])->middleware('auth');

    // ----- MEMBERS ------ //
    Route::get('admin/sites', ['as' => 'members.sites', 'uses' => 'MembersController@sites']);
    Route::get('admin/sites/print', ['as' => 'members.sites_print', 'uses' => 'MembersController@sites_print']);
    Route::get('admin/graders/a', ['as' => 'members.graders_a', 'uses' => 'MembersController@graders_a']);
    Route::get('admin/graders/a/print', ['as' => 'members.graders_a_print', 'uses' => 'MembersController@graders_a_print']);
    Route::get('admin/graders/b', ['as' => 'members.graders_b', 'uses' => 'MembersController@graders_b']);
    Route::get('admin/graders/b/print', ['as' => 'members.graders_b_print', 'uses' => 'MembersController@graders_b_print']);

    Route::get('admin/approve/grader/{grader_id}', ['as' => 'members.approve', 'uses' => 'MembersController@approve']);

    Route::get('admin/handle-sites/{cat_id}', ['as' => 'admin.handle_sites', 'uses' => 'MembersController@handle_sites']);
    Route::post('admin/post-handle-sites', ['as' => 'admin.post_handle_sites', 'uses' => 'MembersController@post_handle_sites']);
    // Route::post('handle-sites', function(){
    //     if(Request::ajax()){
    //         return Response::json(Request::all());
    //     }
    // });

    // ----- ADMIN ------ //
    Route::get('admin/masquerade/{user_id}', ['as' => 'admin.masquerade', 'uses' => 'AdminController@masquerade']);
    Route::get('admin/switch-back', ['as' => 'admin.switch_back', 'uses' => 'AdminController@switch_back']);

    Route::get('admin/destroy-suggestion-a/{user_id}', ['as' => 'admin.destroy_suggestion_a', 'uses' => 'AdminController@destroy_suggestion_a']);    

    // ----- Statitics ---- //
    Route::get('statistics', ['as' => 'statistics', 'uses' => 'PagesController@statistics']);
    Route::get('grader-statistics/{grader_type}', ['as' => 'grader_statistics', 'uses' => 'PagesController@grader_statistics']);
    Route::get('submissions', ['as' => 'submissions', 'uses' => 'PagesController@submissions']);

    // ----- Modals in statitics ---- //
    Route::get('get-sites-stats/{type}/{id}', ['as' => 'get_sites_stats', 'uses' => 'PagesController@get_sites_stats']);
    Route::get('get-graders-stats/{grader_type}/{type}/{id}', ['as' => 'get_graders_stats', 'uses' => 'PagesController@get_graders_stats']);

    // ----- Send Emails ---- //
    Route::get('admin/send-to-past-graders', ['as' => 'admin.send_to_past_graders', 'uses' => 'EmailsController@send_to_past_graders']);
    Route::get('admin/send-to-graders-a-without-sites', ['as' => 'admin.send_to_graders_a_without_sites', 'uses' => 'EmailsController@send_to_graders_a_without_sites']);

    // ---- ASSIGNMENTS --- //
    Route::get('assign-tables/{type}', ['as' => 'assigns-tables', 'uses' => 'AssignmentsController@assigns_tables']);
    Route::get('assigns_a/{type}', ['as' => 'assigns_a', 'uses' => 'AssignmentsController@assigns_a']);

    Route::get('panel/assignments/a/sites/{cat}', ['as' => 'assignments_panel_a_sites', 'uses' => 'AssignmentsController@assignments_panel_a_sites']);
    Route::get('assign/site/a/{site_id}', ['as' => 'assign_site_a', 'uses' => 'AssignmentsController@assign_site_a']);

    Route::get('assignment/a/delete/{assignment_id}/site/{site_id}', ['as' => 'assign_delete_a', 'uses' => 'AssignmentsController@assign_delete_a']);
    Route::post('assigns/store-manual-a', ['as' => 'assignments.store_manual_a', 'uses' => 'AssignmentsController@store_manual_a']);

    Route::get('evals/init', ['as' => 'evals_init', 'uses' => 'EvaluationsController@init']);

    // ---- EVALUATIONS --- //
    Route::get('evaluate/a/show', ['as' => 'evaluation_a.show', 'uses' => 'EvaluationsController@show']);

    Route::put('can_evaluate/{id}', ['as' => 'can_evaluate_submit', 'uses' => 'EvaluationsController@can_evaluate_submit']);
    Route::put('is_educational/{id}', ['as' => 'is_educational_submit', 'uses' => 'EvaluationsController@is_educational_submit']);
    Route::put('site_comment_submit/{id}', ['as' => 'site_comment_submit', 'uses' => 'EvaluationsController@site_comment_submit']);

    Route::get('evaluate/a/user/{user_id}/criterion/{criterion}/grader/{grader_id}/site/{site_id}', ['as' =>'evaluate_a_edit', 'uses' => 'EvaluationsController@edit']);

    Route::patch('evaluation/a/update/{id}', ['as' => 'evaluation.update', 'uses' => 'EvaluationsController@update']);

    Route::get('evaluate/a/finalize/{id}', ['as' => 'evaluation_a.finalize', 'uses' => 'EvaluationsController@evaluation_a_finalize']);

    Route::get('create-summary-a', ['as' => 'create_summary_a', 'uses' => 'AdminController@create_summary_a']);

    // ----- TESTING ----- //
    Route::get('ajax-test', ['as' => 'ajax_test', 'uses' => 'TestController@ajax_test']);
    Route::get('ajax-url/{district_id}', ['as' => 'ajax_url', 'uses' => 'TestController@ajax_url']);
    Route::get('panormighty', ['as' => 'ajax_url', 'uses' => 'TestController@panormighty']);

});
