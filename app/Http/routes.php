<?php

Route::group(['middleware' => 'guest'], function() {
    Route::get('/', [
        'as' => 'login',
        'uses' => 'AuthController@login'
    ]);

    Route::post('/', 'AuthController@check');
});

/*
|--------------------------------------------------------------------------
| Web Authenticated Routes
|--------------------------------------------------------------------------
|
| Below are some of the routes that required authenticated from the web
| application, there are others but those will have controller middleware.
|
*/
Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', [
        'as' => 'dashboard',
        'uses' => 'PagesController@dashboard'
    ]);

    Route::get('/logout', [
        'as' => 'logout',
        'uses' => 'AuthController@destroy'
    ]);
});

Route::group(['prefix' => 'campaigns'], function() {
    Route::get('/all', [
        'as' => 'campaigns.all',
        'uses' => 'CampaignController@all'
    ]);

    Route::get('/create', [
        'as' => 'campaign.create',
        'uses' => 'CampaignController@create'
    ]);

    Route::post('/create', 'CampaignController@store');

    Route::get('/{id}', [
        'as' => 'campaigns.find',
        'uses' => 'CampaignController@find'
    ]);

    Route::get('/dashboard/{id}', [
        'as' => 'campaigns.view',
        'uses' => 'CampaignController@show'
    ]);
});

/*
|--------------------------------------------------------------------------
| Application resource routes
|--------------------------------------------------------------------------
|
| These are the applications resource routes, the middleware is defined
| in the controller on specific methods. To view the routes below run
| php artisan route:list in your root directory.
|
*/
Route::resource('rebuttals', 'RebuttalController');
Route::resource('sections', 'SectionController');
Route::resource('promos', 'PromoController');
Route::resource('terms', 'TermsController');