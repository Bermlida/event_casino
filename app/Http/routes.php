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

Route::get('/', function () {
    return view('index');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group([
    'namespace' => 'Account',
    'middleware' => 'auth'
], function() {
    Route::get('/account/info', 'InfoController@index');
    Route::post('/account/info', 'InfoController@save');

    Route::get('/organise/activities', 'OrganiseController@index');
    Route::get('/organise/activity/{activity?}', 'OrganiseController@edit');
    Route::post('/organise/activity', 'OrganiseController@create');
    Route::put('/organise/activity', 'OrganiseController@update');
});