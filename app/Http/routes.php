<?php


Route::group(['middleware' => 'web'], function () {

    // Site's main page
    Route::get('/',      function () { return view('welcome'); });

    // Contact Form
    Route::post('/contact_request', 'ContactRequestController@addContactRequest')->name('addContactRequest');

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


    Route::get('/bom/{id}', 'ProjectController@showBom')->name('getShowBom');

    // Add BOM to existing project 
    Route::get('/bom/add', 'ProjectController@addBomToProject')->name('addBomToProject');

    Route::post('/bom_file_upload', 'BomController@bomFileUpload')->name('postBomUploadFile');

    Route::get('/bom_supplier_view/{hashid}', 'BomController@displayBomForSupplier' )->name('supplierBomView');


    Route::get('/bom/{bom_id}/bom_download/{attach?}', 'BomController@BomDownload')->name('bomDownload');
    Route::get('/bom/{hashid}/supplier_bom_download/{attach?}', 'BomController@supplierBomDownload')->name('supplierBomDownload');

    Route::get('/bom/{response_id}/response_download', 'BomController@bomResponseDownload')->name('bomResponseDownload');

    Route::get('/bom/sendSupplierReminder/{invited_supplier_id}', 'InvitedSuppliersController@sendReminderEmail')->name('sendSupplierReminder');

    Route::post('/bom/addNewSuppliers/{id}', 'BomController@addNewSupplierToBom')->name('addNewSuppliers');

    Route::post('/bom_response_upload', 'BomController@bomResponseUpload')->name('postBomUploadResponse');


    // Admin


});
