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
	Route::get('random/{category?}', array('as' => 'homes.random', 'uses' => 'VideoController@getRandom'));
	Route::post('random', array('as' => 'homes.post.random', 'uses' => 'VideoController@postRandom'));
	Route::get('channels',array('as' => 'homes.channels', 'uses' => 'HomeController@getChannels'));

	Route::get('signin', array('as' => 'homes.signin', 'uses' => 'UserController@getSignIn'));
	Route::post('signin', array('as' => 'homes.post.signin', 'uses' => 'UserController@postSignIn'));
	Route::post('signup', array('as' => 'homes.post.signup', 'uses' => 'UserController@postSignUp'));
});

//**********USERS**********//
Route::group(array('prefix' => 'users'), function() {
	Route::get('/', array('as' => 'users.index', 'uses' => 'UserController@getUsersIndex'));
	Route::get('signout', array('as' => 'users.signout', 'uses' => 'UserController@getSignOut'));
	Route::get('channel/{channel_name}', array('as' => 'users.channel', 'uses' => 'UserController@getUsersChannel'));
	Route::get('edit-channel/{channel_name}', array('as' => 'users.edit.channel', 'uses' => 'UserController@getEditUsersChannel'));
	Route::post('channel/{channel_name}', array('as' => 'users.post.edit.channel', 'uses' => 'UserController@postEditUsersChannel'));

	Route::post('upload-image/{channel_name}', array('as' => 'users.upload.image', 'uses' => 'UserController@postUsersUploadImage'));

	
});
//*********End of User************//



Route::group(array('prefix' => 'admins'), function() {
	Route::get('/', array('as' => 'admins.index', 'uses' => 'AdminController@getAdminsIndex'));

//**********ADMIN**********//
Route::group(array('prefix' => 'gsc-admin'), function() {
	Route::get('/', array('as' => 'admin.index', 'uses' => 'AdminController@getIndex'));
	Route::post('/', array('as' => 'post.admin.index', 'uses' => 'AdminController@postIndex'));
	Route::get('logout', array('as' => 'admin.logout', 'uses' => 'AdminController@logout'));
	Route::get('resetpassword', array('as' => 'get.admin.resetpassword', 'uses' => 'AdminController@getResetPassword'));
	Route::post('resetpassword', array('as' => 'post.admin.resetpassword', 'uses' => 'AdminController@postResetPassword'));
});

Route::get('video-player', array('as'=>'video.player', 'uses'=>'VideoController@getViewVideoPlayer'));


});
