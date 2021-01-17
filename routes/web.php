<?php

/**
 *
 * FRONT SECTIONS
 *
 */

// Home section
Route::get('/', 'FrontEnd\HomeController@index');

//Resultados 
Route::get('/resultados', 'FrontEnd\SearchController@index');

//Survey
Route::post('/vote', 'FrontEnd\SurveysController@store');

//Newsletter
Route::post('/addNewsletter', 'FrontEnd\NewslettersController@store');

//Meeting
Route::post('/addMeeting', 'FrontEnd\MeetingsController@store');

//Contact
Route::post('/addContact', 'FrontEnd\ContactsController@store');
Route::post('/addFranchise', 'FrontEnd\ContactsController@storeInSession');
Route::post('/clearFranchise', 'FrontEnd\ContactsController@clearInSession');

// Franchise section
Route::get('/franquicias', 'FrontEnd\FranchisesController@listAction');
Route::get('/franquicia/comparar/{slug1?}/{slug2?}/{slug3?}', 'FrontEnd\FranchisesController@compareAction');
Route::get('/franquicia/{slug}', 'FrontEnd\FranchisesController@itemAction');
Route::get('/franquicia/preview/{slug}', 'FrontEnd\FranchisesController@previewAction');
Route::get('/franquicia/lista/comparar', 'FrontEnd\FranchisesController@showCompare');

// Thematics section
Route::get('/tematicas', 'FrontEnd\ThematicsController@listAction');
Route::get('/tematica/{slug}', 'FrontEnd\ThematicsController@itemAction');

Route::get('/rubro/{slug}', 'FrontEnd\SubjectsController@itemAction');

// News section
Route::get('/actualidad', 'FrontEnd\NewsController@listAction');
Route::get('/actualidad/tag/{tag}', 'FrontEnd\NewsController@tagAction');
Route::get('/actualidad/tipo/{type}', 'FrontEnd\NewsController@typeAction');
Route::get('/actualidad/{slug}', 'FrontEnd\NewsController@itemAction');

// Adviser section
Route::get('/tu-asesor', 'FrontEnd\AdviserController@listAction');
Route::post('/addAdviser', 'FrontEnd\AdviserController@store');

// What is Franchise
Route::get('/que-es-fraquiciar', 'FrontEnd\AboutController@listAction');

// Login Logout
Route::post('/login', 'Auth\LoginController@authCheckFront');
Route::get('/logout', 'Auth\LoginController@logOut');

// Franchising
Route::get('/la-franquicia', 'FrontEnd\FranchisingController@franchising');
Route::get('/asociaciones-franquicias', 'FrontEnd\FranchisingController@associations');
Route::get('/ferias-franquicias', 'FrontEnd\FranchisingController@carnival');

// Real Contact
Route::get('/contacto', 'FrontEnd\ContactController@listAction');
Route::post('/addRealContacto', 'FrontEnd\ContactController@store');

// Front User
Route::get('/registrarse', 'FrontEnd\UsersController@create');
Route::get('/perfil', 'FrontEnd\UsersController@item');
Route::post('/addUser', 'FrontEnd\UsersController@store');
Route::put('/editUser', 'FrontEnd\UsersController@update');
Route::post('/addFavorite', 'FrontEnd\UsersController@addDeleteFavorites');

// Front Forgot Password
Route::get('olvide-contrasena', 'FrontEnd\UsersController@forgot');
Route::get('restablecer', 'FrontEnd\ResetPasswordController@showResetForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::post('password/checkWhere', 'Auth\ResetPasswordCustomController@checkWhere');

/**
 *
 * ALL ROUTES FOR ADMIN
 *
 */
Route::group(array('prefix' => Config::get('app.admin_directory'), 'roles' => ['root', 'admin', 'content_manager']), function () {

    // Login Logout
    Route::get('/', 'Auth\LoginController@loginAdmin');
    Route::get('/login', 'Auth\LoginController@loginAdmin');
    Route::post('/login', 'Auth\LoginController@authCheck');
    Route::get('/logout', 'Auth\LoginController@logOutAdmin');

    // Password Reset
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::post('password/checkWhere', 'Auth\ResetPasswordCustomController@checkWhere');

    Route::group(array('middleware' => ['authCustom', 'roles']), function () {
        Route::get('/dashboard', 'Admin\DashboardController@dashboard');

        // Admin
        Route::group(array('prefix' => 'admin'), function () {
            Route::get('/edit/{admin}', 'Admin\AdminController@edit')->where('admin', '[0-9]+');
            Route::put('/edit/{admin}', 'Admin\AdminController@update')->where('admin', '[0-9]+');
        });

        // Franchise
        Route::group(array('prefix' => 'franchises'), function () {
            Route::get('/list', [
                'as' => 'franchises.list',
                'uses' => 'Admin\FranchisesController@index'
            ]);

            Route::get('/edit/{franchise}', 'Admin\FranchisesController@edit')->where('franchise', '[0-9]+');
            Route::put('/edit/{franchise}', 'Admin\FranchisesController@update')->where('franchise', '[0-9]+');

        });

        // Franchise Assets
        Route::group(array('prefix' => 'franchises-assets'), function () {
            Route::get('/list/{franchise}', [
                'as' => 'franchises_assets.list',
                'uses' => 'Admin\FranchisesAssetsController@index'
            ])->where('franchise', '[0-9]+');

            Route::get('/create/{franchise}', 'Admin\FranchisesAssetsController@create')->where('franchise', '[0-9]+');
            Route::post('/create/{franchise}', 'Admin\FranchisesAssetsController@store')->where('franchise', '[0-9]+');
            Route::get('/edit_video/{franchise}', 'Admin\FranchisesAssetsController@editVideo')->where('franchise', '[0-9]+');
            Route::put('/edit_video/{franchise}', 'Admin\FranchisesAssetsController@updateVideo')->where('franchise', '[0-9]+');
            Route::get('/edit/{franchise}/{franchisesAssets}', 'Admin\FranchisesAssetsController@edit')->where('franchise', '[0-9]+')->where('franchisesAssets', '[0-9]+');
            Route::put('/edit/{franchise}/{franchisesAssets}', 'Admin\FranchisesAssetsController@update')->where('franchise', '[0-9]+')->where('franchisesAssets', '[0-9]+');
            Route::get('/delete/{franchise}/{franchisesAssets}', 'Admin\FranchisesAssetsController@delete')->where('franchise', '[0-9]+')->where('franchisesAssets', '[0-9]+');
            Route::delete('/delete/{franchise}/{franchisesAssets}', 'Admin\FranchisesAssetsController@destroy')->where('franchise', '[0-9]+')->where('franchisesAssets', '[0-9]+');
            Route::get('/visibility/{franchise}/{franchisesAssets}', 'Admin\FranchisesAssetsController@changeVisible')->where('franchise', '[0-9]+')->where('franchisesAssets', '[0-9]+');
            Route::post('/sort/{franchise}', 'Admin\FranchisesAssetsController@sort')->where('franchise', '[0-9]+');
        });

        // Franchise Offices
        Route::group(array('prefix' => 'franchises-offices'), function () {
            Route::get('/list/{franchise}', [
                'as' => 'franchises_offices.list',
                'uses' => 'Admin\FranchisesOfficesController@index'
            ])->where('franchise', '[0-9]+');

            Route::get('/create/{franchise}', 'Admin\FranchisesOfficesController@create')->where('franchise', '[0-9]+');
            Route::post('/create/{franchise}', 'Admin\FranchisesOfficesController@store')->where('franchise', '[0-9]+');
            Route::get('/edit/{franchise}/{franchisesOffices}', 'Admin\FranchisesOfficesController@edit')->where('franchise', '[0-9]+')->where('franchisesOffices', '[0-9]+');
            Route::put('/edit/{franchise}/{franchisesOffices}', 'Admin\FranchisesOfficesController@update')->where('franchise', '[0-9]+')->where('franchisesOffices', '[0-9]+');
            Route::get('/delete/{franchise}/{franchisesOffices}', 'Admin\FranchisesOfficesController@delete')->where('franchise', '[0-9]+')->where('franchisesOffices', '[0-9]+');
            Route::delete('/delete/{franchise}/{franchisesOffices}', 'Admin\FranchisesOfficesController@destroy')->where('franchise', '[0-9]+')->where('franchisesOffices', '[0-9]+');
            Route::get('/visibility/{franchise}/{franchisesOffices}', 'Admin\FranchisesOfficesController@changeVisible')->where('franchise', '[0-9]+')->where('franchisesOffices', '[0-9]+');
            Route::post('/sort/{franchise}', 'Admin\FranchisesOfficesController@sort')->where('franchise', '[0-9]+');
        });

        // Franchise Areas
        Route::group(array('prefix' => 'franchises-areas'), function () {
            Route::get('/list/{franchise}', [
                'as' => 'franchises_areas.list',
                'uses' => 'Admin\FranchisesAreasController@index'
            ])->where('franchise', '[0-9]+');

            Route::get('/create/{franchise}', 'Admin\FranchisesAreasController@create')->where('franchise', '[0-9]+');
            Route::post('/create/{franchise}', 'Admin\FranchisesAreasController@store')->where('franchise', '[0-9]+');
            Route::get('/edit/{franchise}/{franchisesAreas}', 'Admin\FranchisesAreasController@edit')->where('franchise', '[0-9]+')->where('franchisesAreas', '[0-9]+');
            Route::put('/edit/{franchise}/{franchisesAreas}', 'Admin\FranchisesAreasController@update')->where('franchise', '[0-9]+')->where('franchisesAreas', '[0-9]+');
            Route::get('/delete/{franchise}/{franchisesAreas}', 'Admin\FranchisesAreasController@delete')->where('franchise', '[0-9]+')->where('franchisesAreas', '[0-9]+');
            Route::delete('/delete/{franchise}/{franchisesAreas}', 'Admin\FranchisesAreasController@destroy')->where('franchise', '[0-9]+')->where('franchisesAreas', '[0-9]+');
            Route::get('/visibility/{franchise}/{franchisesAreas}', 'Admin\FranchisesAreasController@changeVisible')->where('franchise', '[0-9]+')->where('franchisesAreas', '[0-9]+');
            Route::post('/sort/{franchise}', 'Admin\FranchisesAreasController@sort')->where('franchise', '[0-9]+');
        });

    });
});

/**
 *
 * ALL ROUTES FOR ADMIN ONLY ROOT AND ADMIN CAN ACCESS
 *
 */
Route::group(array('prefix' => Config::get('app.admin_directory'), 'roles' => ['root', 'admin']), function () {
    Route::group(array('middleware' => ['authCustom', 'roles']), function () {

        // Admin
        Route::group(array('prefix' => 'admin'), function () {
            Route::get('/list', [
                'as' => 'admin.list',
                'uses' => 'Admin\AdminController@index'
            ]);

            Route::get('/create', 'Admin\AdminController@create');
            Route::post('/create', 'Admin\AdminController@store');
            Route::get('/delete/{admin}', 'Admin\AdminController@delete')->where('admin', '[0-9]+');
            Route::delete('/delete/{admin}', 'Admin\AdminController@destroy')->where('admin', '[0-9]+');;
            Route::get('/visibility/{admin}', 'Admin\AdminController@changeVisible')->where('admin', '[0-9]+');
        });

        // User
        Route::group(array('prefix' => 'user'), function () {
            Route::get('/list', [
                'as' => 'user.list',
                'uses' => 'Admin\UserController@index'
            ]);

            Route::get('/create', 'Admin\UserController@create');
            Route::post('/create', 'Admin\UserController@store');
            Route::get('/edit/{user}', 'Admin\UserController@edit')->where('user', '[0-9]+');
            Route::put('/edit/{user}', 'Admin\UserController@update')->where('user', '[0-9]+');
            Route::get('/delete/{user}', 'Admin\UserController@delete')->where('user', '[0-9]+');
            Route::delete('/delete/{user}', 'Admin\UserController@destroy')->where('user', '[0-9]+');
            Route::get('/visibility/{user}', 'Admin\UserController@changeVisible')->where('user', '[0-9]+');
        });

        // Banners
        Route::group(array('prefix' => 'banners'), function () {
            Route::get('/list', [
                'as' => 'banners.list',
                'uses' => 'Admin\BannersController@index'
            ]);

            Route::get('/create', 'Admin\BannersController@create');
            Route::post('/create', 'Admin\BannersController@store');
            Route::get('/edit/{banner}', 'Admin\BannersController@edit')->where('banner', '[0-9]+');
            Route::put('/edit/{banner}', 'Admin\BannersController@update')->where('banner', '[0-9]+');
            /*Route::get('/delete/{banner}', 'Admin\BannersController@delete')->where('banner', '[0-9]+');
            Route::delete('/delete/{banner}', 'Admin\BannersController@destroy')->where('banner', '[0-9]+');*/
            Route::get('/visibility/{banner}', 'Admin\BannersController@changeVisible')->where('banner', '[0-9]+');
            Route::post('/sort', 'Admin\BannersController@sort');
        });

        // Banners
        Route::group(array('prefix' => 'consultants'), function () {
            Route::get('/list', [
                'as' => 'consultants.list',
                'uses' => 'Admin\ConsultantsController@index'
            ]);

            Route::get('/create', 'Admin\ConsultantsController@create');
            Route::post('/create', 'Admin\ConsultantsController@store');
            Route::get('/edit/{consultants}', 'Admin\ConsultantsController@edit')->where('consultants', '[0-9]+');
            Route::put('/edit/{consultants}', 'Admin\ConsultantsController@update')->where('consultants', '[0-9]+');
            Route::get('/delete/{consultants}', 'Admin\ConsultantsController@delete')->where('consultants', '[0-9]+');
            Route::delete('/delete/{consultants}', 'Admin\ConsultantsController@destroy')->where('consultants', '[0-9]+');
            Route::get('/visibility/{consultants}', 'Admin\ConsultantsController@changeVisible')->where('consultants', '[0-9]+');
            Route::post('/sort', 'Admin\ConsultantsController@sort');
        });

        // Newsletters
        Route::group(array('prefix' => 'newsletters'), function () {
            Route::get('/list', [
                'as' => 'newsletters.list',
                'uses' => 'Admin\NewslettersController@index'
            ]);

            Route::get('/export', 'Admin\NewslettersController@export');
            Route::get('/delete/{newsletter}', 'Admin\NewslettersController@delete')->where('newsletter', '[0-9]+');
            Route::delete('/delete/{newsletter}', 'Admin\NewslettersController@destroy')->where('newsletter', '[0-9]+');
            Route::get('/visibility/{newsletter}', 'Admin\NewslettersController@changeVisible')->where('newsletter', '[0-9]+');
        });

        // News
        Route::group(array('prefix' => 'news'), function () {
            Route::get('/list', [
                'as' => 'news.list',
                'uses' => 'Admin\NewsController@index'
            ]);

            Route::get('/create', 'Admin\NewsController@create');
            Route::post('/create', 'Admin\NewsController@store');
            Route::get('/edit/{news}', 'Admin\NewsController@edit')->where('news', '[0-9]+');
            Route::put('/edit/{news}', 'Admin\NewsController@update')->where('news', '[0-9]+');
            Route::get('/delete/{news}', 'Admin\NewsController@delete')->where('news', '[0-9]+');
            Route::delete('/delete/{news}', 'Admin\NewsController@destroy')->where('news', '[0-9]+');
            Route::get('/visibility/{news}', 'Admin\NewsController@changeVisible')->where('news', '[0-9]+');
            Route::post('/sort', 'Admin\NewsController@sort');
        });

        // Videos
        Route::group(array('prefix' => 'videos'), function () {
            Route::get('/list', [
                'as' => 'videos.list',
                'uses' => 'Admin\VideosController@index'
            ]);

            Route::get('/create', 'Admin\VideosController@create');
            Route::post('/create', 'Admin\VideosController@store');
            Route::get('/edit/{videos}', 'Admin\VideosController@edit')->where('videos', '[0-9]+');
            Route::put('/edit/{videos}', 'Admin\VideosController@update')->where('videos', '[0-9]+');
            Route::get('/delete/{videos}', 'Admin\VideosController@delete')->where('videos', '[0-9]+');
            Route::delete('/delete/{videos}', 'Admin\VideosController@destroy')->where('videos', '[0-9]+');
            Route::get('/visibility/{videos}', 'Admin\VideosController@changeVisible')->where('videos', '[0-9]+');
        });

        // Sponsors
        Route::group(array('prefix' => 'sponsors'), function () {
            Route::get('/list', [
                'as' => 'sponsors.list',
                'uses' => 'Admin\SponsorsController@index'
            ]);

            Route::get('/create', 'Admin\SponsorsController@create');
            Route::post('/create', 'Admin\SponsorsController@store');
            Route::get('/edit/{sponsors}', 'Admin\SponsorsController@edit')->where('sponsors', '[0-9]+');
            Route::put('/edit/{sponsors}', 'Admin\SponsorsController@update')->where('sponsors', '[0-9]+');
            Route::get('/delete/{sponsors}', 'Admin\SponsorsController@delete')->where('sponsors', '[0-9]+');
            Route::delete('/delete/{sponsors}', 'Admin\SponsorsController@destroy')->where('sponsors', '[0-9]+');
            Route::get('/visibility/{sponsors}', 'Admin\SponsorsController@changeVisible')->where('sponsors', '[0-9]+');
        });

        // Thematics
        Route::group(array('prefix' => 'thematics'), function () {
            Route::get('/list', [
                'as' => 'thematics.list',
                'uses' => 'Admin\ThematicsController@index'
            ]);

            Route::get('/create', 'Admin\ThematicsController@create');
            Route::post('/create', 'Admin\ThematicsController@store');
            Route::get('/edit/{thematic}', 'Admin\ThematicsController@edit')->where('thematic', '[0-9]+');
            Route::put('/edit/{thematic}', 'Admin\ThematicsController@update')->where('thematic', '[0-9]+');
            Route::get('/delete/{thematic}', 'Admin\ThematicsController@delete')->where('thematic', '[0-9]+');
            Route::delete('/delete/{thematic}', 'Admin\ThematicsController@destroy')->where('thematic', '[0-9]+');
            Route::get('/highlights/{thematic}', 'Admin\ThematicsController@changeHighlights')->where('thematic', '[0-9]+');
            Route::get('/visibility/{thematic}', 'Admin\ThematicsController@changeVisible')->where('thematic', '[0-9]+');
            Route::post('/sort', 'Admin\ThematicsController@sort');
        });

        // Thematics
        Route::group(array('prefix' => 'subjects'), function () {
            Route::get('/list', [
                'as' => 'subjects.list',
                'uses' => 'Admin\SubjectsController@index'
            ]);

            Route::get('/create', 'Admin\SubjectsController@create');
            Route::post('/create', 'Admin\SubjectsController@store');
            Route::get('/edit/{subjects}', 'Admin\SubjectsController@edit')->where('subjects', '[0-9]+');
            Route::put('/edit/{subjects}', 'Admin\SubjectsController@update')->where('subjects', '[0-9]+');
            Route::get('/delete/{subjects}', 'Admin\SubjectsController@delete')->where('subjects', '[0-9]+');
            Route::delete('/delete/{subjects}', 'Admin\SubjectsController@destroy')->where('subjects', '[0-9]+');
            Route::get('/visibility/{subjects}', 'Admin\SubjectsController@changeVisible')->where('subjects', '[0-9]+');
            Route::post('/sort', 'Admin\SubjectsController@sort');
        });

        // Franchise
        Route::group(array('prefix' => 'franchises'), function () {
            Route::get('/create', 'Admin\FranchisesController@create');
            Route::post('/create', 'Admin\FranchisesController@store');
            Route::get('/highlights/{franchise}', 'Admin\FranchisesController@changeHighlights')->where('franchise', '[0-9]+');
            Route::get('/delete/{franchise}', 'Admin\FranchisesController@delete')->where('franchise', '[0-9]+');
            Route::delete('/delete/{franchise}', 'Admin\FranchisesController@destroy')->where('franchise', '[0-9]+');
            Route::get('/visibility/{franchise}', 'Admin\FranchisesController@changeVisible')->where('franchise', '[0-9]+');
            Route::get('/weekly/{franchise}', 'Admin\FranchisesController@changeWeekly')->where('franchise', '[0-9]+');
            Route::get('/subject_highlights/{franchise}', 'Admin\FranchisesController@changeSubjectHighlights')->where('franchise', '[0-9]+');
            Route::get('/order', 'Admin\FranchisesController@order');
            Route::post('/sort', 'Admin\FranchisesController@sort');
        });

        // Surveys
        Route::group(array('prefix' => 'surveys'), function () {
            Route::get('/list', [
                'as' => 'surveys.list',
                'uses' => 'Admin\SurveysController@index'
            ]);

            Route::get('/create', 'Admin\SurveysController@create');
            Route::post('/create', 'Admin\SurveysController@store');
            Route::get('/edit/{survey}', 'Admin\SurveysController@edit')->where('survey', '[0-9]+');
            Route::put('/edit/{survey}', 'Admin\SurveysController@update')->where('survey', '[0-9]+');
            Route::get('/delete/{survey}', 'Admin\SurveysController@delete')->where('survey', '[0-9]+');
            Route::delete('/delete/{survey}', 'Admin\SurveysController@destroy')->where('survey', '[0-9]+');
            Route::get('/visibility/{survey}', 'Admin\SurveysController@changeVisible')->where('survey', '[0-9]+');
        });

        // Surveys Answers
        Route::group(array('prefix' => 'answers'), function () {
            Route::get('/list/{survey}', [
                'as' => 'answers.list',
                'uses' => 'Admin\AnswersController@index'
            ])->where('survey', '[0-9]+');

            Route::get('/create/{survey}', 'Admin\AnswersController@create')->where('survey', '[0-9]+');
            Route::post('/create/{survey}', 'Admin\AnswersController@store')->where('survey', '[0-9]+');
            Route::get('/edit/{survey}/{answer}', 'Admin\AnswersController@edit')->where('survey', '[0-9]+')->where('answer', '[0-9]+');
            Route::put('/edit/{survey}/{answer}', 'Admin\AnswersController@update')->where('survey', '[0-9]+')->where('answer', '[0-9]+');
            Route::get('/delete/{survey}/{answer}', 'Admin\AnswersController@delete')->where('survey', '[0-9]+')->where('answer', '[0-9]+');
            Route::delete('/delete/{survey}/{answer}', 'Admin\AnswersController@destroy')->where('survey', '[0-9]+')->where('answer', '[0-9]+');
            Route::get('/visibility/{survey}/{answer}', 'Admin\AnswersController@changeVisible')->where('survey', '[0-9]+')->where('answer', '[0-9]+');
            Route::post('/sort/{survey}', 'Admin\AnswersController@sort')->where('survey', '[0-9]+');
        });

    });
});
