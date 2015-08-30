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

/**
 * Home Route
 */
Route::get('/', [
    'uses' => '\Deepbook\Http\Controllers\HomeController@index',
    'as' => 'home',
]);

/**
 * Authentication
 */

Route::get('/signup', [
    'uses' => '\Deepbook\Http\Controllers\AuthController@getSignup',
    'as' => 'auth.signup',
]);

Route::post('/signup', [
    'uses' => '\Deepbook\Http\Controllers\AuthController@postSignup',
]);

Route::get('/signin', [
    'uses' => '\Deepbook\Http\Controllers\AuthController@getSignin',
    'as' => 'auth.signin',
]);

Route::post('/signin', [
    'uses' => '\Deepbook\Http\Controllers\AuthController@postSignin',
]);
Route::get('/signout', [
    'uses' => '\Deepbook\Http\Controllers\AuthController@getSignout',
    'as' => 'auth.signout',
]);
