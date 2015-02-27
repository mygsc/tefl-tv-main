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
Route::group(array('prefix' => '/'), function() {
	Route::get('', array('as' => 'get.index', 'uses' => 'HomeController@getIndex'));
	Route::get('aboutus', array('as' => 'get.aboutus', 'uses' => 'HomeController@getAboutUs'));
	Route::get('privacy', array('as' => 'get.privacy', 'uses' => 'HomeController@getPrivacy'));
	Route::get('termsandconditions', array('as' => 'get.termsandconditions', 'uses' => 'HomeController@getTermsAndConditions'));
	Route::get('copyright', array('as' => 'get.copyright', 'uses' => 'HomeController@getCopyright'));
	Route::get('advertisements', array('as' => 'get.advertisements', 'uses' => 'HomeController@getAdvertisements'));
});


Route::group(array('prefix' => 'users'), function() {
	Route::get('/', array('as' => 'get.users.index', 'uses' => 'UserController@getUsersIndex'));
});


Route::group(array('prefix' => 'admins'), function() {
	Route::get('/', array('as' => 'get.admins.index', 'uses' => 'AdminController@getAdminsIndex'));
});

Route::get('video-player', array('as'=>'video.player', 'uses'=>'VideoController@getViewVideoPlayer'));



