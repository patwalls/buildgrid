<?php


Route::group(['middleware' => 'web'], function () {

    // Site's main page

    Route::get('/',      function () { return view('welcome'); });


    // Auth

    Route::auth();
    Route::get('signup', 'Auth\AuthController@showRegistrationForm');
    
    //User profile
    Route::get('profile', ['uses' => 'UserController@edit', 'as' => 'edit.profile']);
    Route::put('profile', ['uses' => 'UserController@update', 'as' => 'update.profile']);
    Route::put('profile/updatePassword/{id}', ['uses' => 'UserController@updatePassword', 'as'=>'update.password']);
    
    //LinkedIn Login
    Route::get('login/linkedin', ['uses' => 'Auth\SocialLoginController@redirectToLinkedIn', 'as' => 'login.linkedin'] );
    Route::get('linkedin/callback', 'Auth\SocialLoginController@handleLinkedInCallback');
    
    //Google+ Login
    Route::get('login/google', ['uses' => 'Auth\SocialLoginController@redirectToGoogle', 'as' => 'login.google'] );
    Route::get('google/callback', 'Auth\SocialLoginController@handleGoogleCallback');
    
    // User

    Route::get('/home', ['uses' => 'ProjectController@index', 'as' => 'home']);
    Route::get('/create_project', 'ProjectController@create')->name('getCreateProject');
    Route::post('/create_project', 'ProjectController@store')->name('postCreateProject');


    Route::get('/bom/{id}', 'ProjectController@bom')->name('getShowBom');
    Route::get('/add_bom', 'ProjectController@bom')->name('getAddBom');

    Route::post('/bom_file_upload', 'BomController@bomFileUpload')->name('postBomUploadFile');


    // Admin


});
