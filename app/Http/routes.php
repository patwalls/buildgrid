<?php

Route::group(['middleware' => 'web'], function () {


    // Site's main page
    Route::get('/',      function () { return view('welcome'); });

    // Contact Form
    Route::post('/contact_request', 'ContactRequestController@addContactRequest')->name('addContactRequest');

    // Auth
    // Route::auth();

    // Authentication Routes...
    // Route::get('login', 'Auth\AuthController@showLoginForm');
    Route::post('login', 'Auth\AuthController@login');
    Route::get('logout', 'Auth\AuthController@logout');

    // Registration Routes...
    // Route::get('register', 'Auth\AuthController@showRegistrationForm');
    Route::post('register', 'Auth\AuthController@register');

    // Password Reset Routes...
    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');
    
    // Route::get('signup', 'Auth\AuthController@showRegistrationForm');
    
    // User profile
    Route::get('profile', ['uses' => 'UserController@edit', 'as' => 'edit.profile']);

    Route::put('profile', ['uses' => 'UserController@update', 'as' => 'update.profile']);

    Route::put('profile/updatePassword/{id}', ['uses' => 'UserController@updatePassword', 'as'=>'update.password']);

    Route::post('/user/upload_profile_picture/{user}', 'UserController@uploadProfilePicture')->name('postUploadProfilePicture');

    Route::get('/user/{user}/get_profile_picture/{size}', 'UserController@getProfilePicture')->name('getProfilePicture');
    
    // LinkedIn Login
    Route::get('login/linkedin', ['uses' => 'Auth\SocialLoginController@redirectToLinkedIn', 'as' => 'login.linkedin'] );

    Route::get('linkedin/callback', 'Auth\SocialLoginController@handleLinkedInCallback');
    
    // Google+ Login
    Route::get('login/google', ['uses' => 'Auth\SocialLoginController@redirectToGoogle', 'as' => 'login.google'] );

    Route::get('google/callback', 'Auth\SocialLoginController@handleGoogleCallback');
    

    // User

    Route::get('/home', 'ProjectController@index')->name('home');

    Route::get('/create_project', 'ProjectController@create')->name('getCreateProject');

    Route::get('/project/{project}/add_bom', 'ProjectController@create')->name('getAddBomToProject');

    Route::post('/create_project', 'ProjectController@store')->name('postCreateProject');

    Route::post('/project/{project}/add_bom', 'ProjectController@store')->name('postAddBomToProject');

    Route::get('/bom/{id}', 'ProjectController@showBom')->name('getShowBom');

    Route::post('/bom_file_upload', 'BomController@bomFileUpload')->name('postBomUploadFile');

    Route::get('/bom_supplier_view/{hashid}', 'BomController@displayBomForSupplier' )->name('supplierBomView');
    
    Route::get('/bom/{bom_id}/bom_download/{attach?}', 'BomController@BomDownload')->name('bomDownload');

    Route::get('/bom/{hashid}/supplier_bom_download/{attach?}', 'BomController@supplierBomDownload')->name('supplierBomDownload');

    Route::get('/bom/{response_id}/response_download', 'BomController@bomResponseDownload')->name('bomResponseDownload');

    Route::get('/bom/sendSupplierReminder/{invited_supplier_id}', 'InvitedSuppliersController@sendReminderEmail')->name('sendSupplierReminder');

    Route::post('/bom/addNewSuppliers/{id}', 'BomController@addNewSupplierToBom')->name('addNewSuppliers');

    Route::post('/bom_response_upload', 'BomController@bomResponseUpload')->name('postBomUploadResponse');

    Route::get('/bom_response/accepted/{id}', 'BomResponseController@responseAccepted')->name('setResponseAccepted');

    Route::get('/bom_response/rejected/{id}', 'BomResponseController@responseRejected')->name('setResponseRejected');

    Route::get('/bom_response/pending/{id}', 'BomResponseController@responsePending')->name('setResponsePending');

    Route::get('/bom/archive/{id}', 'BomController@archiveBom')->name('setArchiveBom');

    Route::get('/bom/{bom}/preview', 'BomController@getBomPreview')->name('getBomPreview');
    
    Route::get('/bom_response/{id}/preview', 'BomResponseController@getBomResponsePreview')->name('getBomResponsePreview');


    /*
     *  Routes for generate Bom previews with FilePreviews.io
     */
    Route::get('/downloadFileForFilePreviews.io/{bom_id}', 'BomController@BomDownload')->name('bomDownloadFilePreviews.io');
    Route::post('/receivePreviewFile/webhook', '\FilePreviews\Laravel\WebhookController@handleWebhook');


    /*
     *   Admin Routes
     */

    Route::group(['middleware' => 'BuildGrid\Http\Middleware\AdminMiddleware'], function()
    {
        Route::group(['prefix' => 'admin'], function () {

            Route::get('/', 'AdminController@index')->name('admin.dashboard');

            Route::bind('user', function($id){
                return \BuildGrid\User::withTrashed()->find($id);
            });

            Route::bind('bom', function($id){
                return \BuildGrid\Bom::withTrashed()->find($id);
            });

            Route::resource('users', 'AdminUserController', ['parameters' => 'singular']);
            Route::resource('boms', 'AdminBomController',   ['parameters' => 'singular']);

        });

    });


});
