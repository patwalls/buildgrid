<?php


Route::group(['middleware' => 'web'], function () {

    // Site's main page

    Route::get('/',      function () { return view('welcome'); });


    // Auth

    Route::auth();
    Route::get('/login', function () { return view('welcome'); });



    // User

    Route::get('/home', 'ProjectController@index');
    Route::get('/create_project', 'ProjectController@create');
    Route::post('/create_project', 'ProjectController@saveNewProject');



    // Admin


});
