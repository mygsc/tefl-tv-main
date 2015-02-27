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
	Route::get('', array('as' => 'homes.index', 'uses' => 'HomeController@getIndex'));


Route::get('/', array('as' => 'get.index', 'uses' => 'HomeController@getIndex'));
//uploading
Route::get('upload',array('as' => 'get.upload', 'uses'=>'VideoController@getUpload'));
Route::post('upload',array('as' => 'post.upload', 'uses'=>'VideoController@postUpload'));
Route::get('addDescription/{id}',array('as' => 'get.addDescription', 'uses'=>'VideoController@getAddDescription'));
Route::patch('addDescription/{id}',array('as' => 'post.addDescription', 'uses'=>'VideoController@postAddDescription'));


	Route::get('aboutus', array('as' => 'homes.aboutus', 'uses' => 'HomeController@getAboutUs'));
	Route::get('privacy', array('as' => 'homes.privacy', 'uses' => 'HomeController@getPrivacy'));
	Route::get('terms-and-conditions', array('as' => 'homes.termsandconditions', 'uses' => 'HomeController@getTermsAndConditions'));
	Route::get('copyright', array('as' => 'homes.copyright', 'uses' => 'HomeController@getCopyright'));
	Route::get('advertisements', array('as' => 'homes.advertisements', 'uses' => 'HomeController@getAdvertisements'));

	Route::get('popular', array('as' => 'homes.popular', 'uses' => 'HomeController@getPopular'));
	Route::get('latest', array('as' => 'homes.latest', 'uses' => 'HomeController@getLatest'));
	Route::get('random', array('as' => 'homes.random', 'uses' => 'HomeController@getRandom'));
	Route::get('channels',array('as' => 'homes.channels', 'uses' => 'HomeController@getChannels'));
	Route::get('signup', array('as' => 'homes.signup', 'uses' => 'HomeController@getSignUp'));
});


Route::group(array('prefix' => 'users'), function() {
	Route::get('/', array('as' => 'users.index', 'uses' => 'UserController@getUsersIndex'));
});




Route::group(array('prefix' => 'admins'), function() {
	Route::get('/', array('as' => 'admins.index', 'uses' => 'AdminController@getAdminsIndex'));

//**********ADMIN**********//
Route::group(array('prefix' => 'gsc-admin'), function() {
	Route::get('/', array('as' => 'get.admins.index', 'uses' => 'AdminController@getIndex'));
});
//**********ADMIN**********//


