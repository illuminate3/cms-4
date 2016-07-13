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

    Route::post('/', 'AuthController@check');
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

    Route::group(['prefix' => 'rebuttals'], function() {
        Route::get('/all', [
            'as' => 'rebuttals.all',
            'uses' => 'RebuttalController@all'
        ]);

        Route::get('/create', [
            'as' => 'rebuttals.create',
            'uses' => 'RebuttalController@create'
        ]);

        Route::post('/create', 'RebuttalController@store');

        Route::get('/{id}', [
            'as' => 'rebuttals.find',
            'uses' => 'RebuttalController@find'
        ]);

        Route::delete('/{id}', 'RebuttalController@destroy');

        Route::get('/{rebuttal}/edit', [
            'as' => 'rebuttals.edit',
            'uses' => 'RebuttalController@edit'
        ]);

        Route::post('/{rebuttal}/edit', 'RebuttalController@update');
    });

    Route::resource('promos', 'PromoController');
});