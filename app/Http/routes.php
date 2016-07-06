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
    Route::resource('campaign', 'CampaignController');
    Route::resource('rebuttal', 'RebuttalController');
    Route::resource('promo', 'PromoController');
});
