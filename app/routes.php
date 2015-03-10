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
	Route::get('upload',array('before'=>'auth','as' => 'get.upload', 'uses'=>'VideoController@getUpload'));	//uploading
	Route::post('upload',array('before'=>'auth','as' => 'post.upload', 'uses'=>'VideoController@postUpload'));
	Route::get('addDescription/{id}',array('before'=>'auth','as' => 'get.addDescription', 'uses'=>'VideoController@getAddDescription'));
	Route::patch('addDescription/{id}',array('before'=>'auth','as' => 'post.addDescription', 'uses'=>'VideoController@postAddDescription'));
	Route::get('/', array('as' => 'homes.index', 'uses' => 'HomeController@getIndex'));
	Route::get('search-result/{type?}/{search?}', array('as' => 'homes.searchresult', 'uses' => 'VideoController@getSearchResult'));
	Route::post('search-videos', array('as' => 'post.search-video', 'uses' => 'VideoController@postSearchVideos'));
	Route::get('aboutus', array('as' => 'homes.aboutus', 'uses' => 'HomeController@getAboutUs'));
	Route::get('privacy', array('as' => 'homes.privacy', 'uses' => 'HomeController@getPrivacy'));
	Route::get('terms-and-conditions', array('as' => 'homes.termsandconditions', 'uses' => 'HomeController@getTermsAndConditions'));
	Route::get('copyright', array('as' => 'homes.copyright', 'uses' => 'HomeController@getCopyright'));
	Route::get('advertisements', array('as' => 'homes.advertisements', 'uses' => 'HomeController@getAdvertisements'));
	Route::get('popular', array('as' => 'homes.popular', 'uses' => 'HomeController@getPopular'));
	Route::get('latest', array('as' => 'homes.latest', 'uses' => 'HomeController@getLatest'));
	Route::get('random/{category?}', array('as' => 'homes.random', 'uses' => 'VideoController@getRandom'));
	Route::post('random', array('as' => 'homes.post.random', 'uses' => 'VideoController@postRandom'));
	Route::get('top-channels',array('as' => 'homes.top-channels', 'uses' => 'UserController@getTopChannels'));
	Route::get('more-top-channels',array('as' => 'homes.more-top-channels', 'uses' => 'UserController@getMoreTopChannels'));
	Route::get('signin', array('as' => 'homes.signin', 'uses' => 'UserController@getSignIn'));
	Route::post('signin', array('as' => 'homes.post.signin', 'uses' => 'UserController@postSignIn'));
	Route::post('signup', array('as' => 'homes.post.signup', 'uses' => 'UserController@postSignUp'));
	Route::get('verify/{token?}', array('as' => 'homes.get.verify', 'uses' => 'UserController@getVerify'));
	Route::post('/resendverification', array('as' => 'post.resenduserverify', 'uses' => 'UserController@postResendUserVerify'));
	//delete or update this if needed - Cess
	Route::any('watch={idtitle}', array('as' => 'homes.watch-video', 'uses' => 'HomeController@watchVideo'));
});

//**********Channels**********//
Route::group(array('prefix' => 'channels'), function() {
	Route::get('/', array('as' => 'users.index', 'uses' => 'UserController@getUsersIndex'));
	Route::get('signout', array('as' => 'users.signout', 'uses' => 'UserController@getSignOut'));
	Route::get('myprofile/{channel_name}', array('as' => 'users.channel', 'uses' => 'UserController@getUsersChannel'));
	Route::get('edit-channel/{channel_name}', array('as' => 'users.edit.channel', 'uses' => 'UserController@getEditUsersChannel'));
	Route::post('post-edit-channel/{channel_name}', array('as' => 'users.post.edit.channel', 'uses' => 'UserController@postEditUsersChannel'));
	Route::get('/myvideos', array('as' => 'users.myvideos', 'uses' => 'UserController@getMyVideos'));

	Route::get('change-password', array('as' => 'users.change-password', 'uses' => 'UserController@getUsersChangePassword'));
	Route::post('post-change-password', array('as' => 'users.post.change-password', 'uses' => 'UserController@postUsersChangePassword'));
	Route::get('change-email', array('as' => 'users.change-email', 'uses' => 'UserController@getChangeEmail'));
	Route::post('post-change-email', array('as' => 'users.post.change-email', 'uses' => 'UserController@postChangeEmail'));
	
	Route::post('addsubscriber/', array('as' => 'post.addsubscriber', 'uses'=>'UserController@addSubscriber'));
});
//*********End of Channels************//
Route::get('channel/{channel_name}', array('as' => 'view.users.channel', 'uses' => 'UserController@getViewUsersChannel'));

//**********ADMIN**********//
Route::group(array('prefix' => 'gsc-admin'), function() {
	Route::get('/', array('as' => 'get.admins.index', 'uses' => 'AdminController@getIndex'));
	Route::post('/', array('as' => 'get.admins.index', 'uses' => 'AdminController@postIndex'));

	Route::post('upload-image/{channel_name}', array('as' => 'users.upload.image', 'uses' => 'UserController@postUsersUploadImage'));

});



//**********ADMIN**********//

Route::group(array('prefix' => 'gsc-admin'), function() {
	Route::get('/', array('as' => 'admin.index', 'uses' => 'AdminController@getIndex'));
	Route::post('/', array('as' => 'post.admin.index', 'uses' => 'AdminController@postIndex'));
	Route::get('logout', array('as' => 'admin.logout', 'uses' => 'AdminController@logout'));
	Route::get('resetpassword', array('as' => 'get.admin.resetpassword', 'uses' => 'AdminController@getResetPassword'));
	Route::post('resetpassword', array('as' => 'post.admin.resetpassword', 'uses' => 'AdminController@postResetPassword'));
	Route::get('pwdreset/{id}', array('as' => 'get.admin.pwdreset', 'uses' => 'AdminController@getPwdReset'));
	Route::post('pwdreset', array('as' => 'post.admin.pwdreset', 'uses' => 'AdminController@postPwdReset'));
	Route::get('changepassword', array('as' => 'get.admin.changepassword', 'uses' => 'AdminController@getChangePassword'));
	Route::post('changepassword', array('as' => 'post.admin.changepassword', 'uses' => 'AdminController@postChangePassword'));
	Route::get('recommendedvideos', array('as' => 'get.admin.recommendedvideos', 'uses' => 'AdminController@getRecommendedVideos'));
	Route::post('recommendedvideos', array('as' => 'post.admin.recommendedvideos', 'uses' => 'AdminController@postRecommendedVideos'));
	Route::get('createadminlink', array('as' => 'get.admin.createadminlink', 'uses' => 'AdminController@getCreateAdminLink'));
	Route::post('createadminlink', array('as' => 'post.admin.createadminlink', 'uses' => 'AdminController@postCreateAdminLink'));
	Route::get('adminsignup/{id}', array('as' => 'get.admin.adminsignup', 'uses' => 'AdminController@getAdminSignup'));
	Route::post('adminsignup', array('as' => 'post.admin.adminsignup', 'uses' => 'AdminController@postAdminSignup'));
	Route::get('reportedvideos', array('as' => 'get.admin.reportedvideos', 'uses' => 'AdminController@getReportedVideos'));
	Route::get('users', array('as' => 'get.admin.users', 'uses' => 'AdminController@getUsers'));
});
//**********ADMIN**********//

Route::get('videoplayer', array('as'=>'video.player', 'uses'=>'VideoController@getViewVideoPlayer'));

