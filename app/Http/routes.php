<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'guest'], function() {
    Route::get('/', [
        'as' => 'login',
        'uses' => 'AuthController@login'
    ]);

    Route::post('/', [
        'as' => 'login.post',
        'uses' => 'AuthController@check'
    ]);
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', [
        'as' => 'dashboard',
        'uses' => 'PagesController@dashboard'
    ]);

    Route::get('/logout', [
        'as' => 'logout',
        'uses' => 'AuthController@destroy'
    ]);

    Route::group(['prefix' => 'campaigns'], function() {
        Route::get('/all', [
            'as' => 'campaigns.all',
            'uses' => 'CampaignController@all'
        ]);

        Route::get('/{campaign}', [
            'as' => 'campaign.view',
            'uses' => 'CampaignController@show'
        ]);
    });

    Route::group(['prefix' => 'rebuttals'], function() {
        Route::get('/all', [
            'as' => 'rebuttals.all',
            'uses' => 'RebuttalController@all'
        ]);

        Route::get('/create', [
            'as' => 'rebuttals.create',
            'uses' => 'RebuttalController@create'
        ]);

        Route::post('/create', [
            'as' => 'rebuttals.create.post',
            'uses' => 'RebuttalController@store'
        ]);

        Route::get('/{campaign}', [
            'as' => 'rebuttals.campaign',
            'uses' => 'RebuttalController@campaign'
        ]);

        Route::get('/{rebuttal}/edit', [
            'as' => 'rebuttals.edit',
            'uses' => 'RebuttalController@edit'
        ]);

        Route::post('/{rebuttal}/edit', [
            'as' => 'rebuttals.edit.post',
            'uses' => 'RebuttalController@update'
        ]);
    });

    Route::group(['prefix' => 'promos'], function() {
        Route::get('/all', [
            'as' => 'promos.all',
            'uses' => 'PromoController@all'
        ]);

        Route::get('/{campaign}', [
            'as' => 'promos.campaign',
            'uses' => 'PromoController@campaign'
        ]);
    });
});