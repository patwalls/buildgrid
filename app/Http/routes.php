<?php


Route::group(['middleware' => 'web'], function () {

    // Site's main page

    Route::get('/',      function () { return view('welcome'); });


    // Auth

    Route::auth();


    // User

    Route::get('/home', 'ProjectController@index');
    Route::get('/create_project', 'ProjectController@create')->name('CreateProject');
    Route::post('/create_project', 'ProjectController@saveNewProject');


    Route::get('/bom/{id}', 'ProjectController@bom')->name('ShowBom');
    Route::get('/addbom', 'ProjectController@bom')->name('AddBom');



    // Admin


});
