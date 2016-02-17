<?php


Route::group(['middleware' => 'web'], function () {

    // Site's main page

    Route::get('/',      function () { return view('welcome'); });


    // Auth

    Route::auth();
    
    //LinkedIn Login
    Route::get('login/linkedin', ['uses' => 'Auth\SocialLoginController@redirectToLinkedIn', 'as' => 'login.linkedin'] );
    Route::get('linkedin/callback', 'Auth\SocialLoginController@handleLinkedInCallback');
    
    // User

    Route::get('/home', ['uses' => 'ProjectController@index', 'as' => 'home']);
    Route::get('/create_project', 'ProjectController@create')->name('CreateProject');
    Route::post('/create_project', 'ProjectController@saveNewProject');


    Route::get('/bom/{id}', 'ProjectController@bom')->name('ShowBom');
    Route::get('/addbom', 'ProjectController@bom')->name('AddBom');



    // Admin


});
