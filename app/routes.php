<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'get.index', 'uses' => 'HomeController@getIndex'));


Route::group(array('prefix' => 'users'), function() {
	Route::get('/', array('as' => 'get.index', 'uses' => 'UserController@getIndex'));
});


Route::group(array('prefix' => 'admins'), function() {
	Route::get('/', array('as' => 'get.index', 'uses' => 'AdminController@getIndex'));
});



