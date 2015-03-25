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

	
	Route::get('cancel-upload',array('before'=>'auth','as' => 'user.upload.video.cancel', 'uses'=>'VideoController@getCancelUploadVideo'));
	Route::get('add-description/{id}',array('before'=>'auth','as' => 'get.addDescription', 'uses'=>'VideoController@getAddDescription'));
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
	Route::post('resendverification', array('as' => 'post.resenduserverify', 'uses' => 'UserController@postResendUserVerify'));
	Route::any('watch={idtitle}', array('as' => 'homes.watch-video', 'uses' => 'HomeController@watchVideo'));
	Route::post('counter/{id}', array('as' => 'homes.count', 'uses' => 'VideoController@counter'));
	
	Route::post('addcomment', array('as' => 'post.addcomment', 'uses' => 'HomeController@addComment'));
	Route::post('addreply', array('as' => 'post.addreply', 'uses' => 'HomeController@addReply'));
	Route::get('watchplaylist={videoId}/{playlistId}', array('as'=>'users.watchplaylist', 'uses'=>'HomeController@getWatchPlaylist'));
	Route::post('addliked', array('as' => 'post.addliked', 'uses' => 'HomeController@addLiked'));

	Route::get('watch', array('as'=>'public.watch.video', 'uses'=>'HomeController@getWatchVideo'));
	Route::post('forgotpassword', array('as' => 'post.forgotpassword', 'uses' => 'UserController@postForgotPassword'));
	Route::get('resetpassword/{url?}', array('as' => 'homes.resetpassword', 'uses' => 'UserController@getResetPassword'));
	Route::post('resetpassword', array('as' => 'post.resetpassword', 'uses' => 'UserController@postResetPassword'));

});


//**********Channels**********//
Route::group(array('prefix' => 'mychannels'), function() {
	// Route::get('/', array('as' => 'users.index', 'uses' => 'UserController@getUsersIndex'));
	Route::get('/', array('as' => 'users.channel', 'uses' => 'UserController@getUsersChannel'));
	Route::get('signout', array('as' => 'users.signout', 'uses' => 'UserController@getSignOut'));
	
	Route::get('edit-channel/{channel_name}', array('as' => 'users.edit.channel', 'uses' => 'UserController@getEditUsersChannel'));
	Route::post('post-edit-channel/{channel_name}', array('as' => 'users.post.edit.channel', 'uses' => 'UserController@postEditUsersChannel'));
	Route::post('change-cover-photo', array('as' => 'users.upload.cover.photo', 'uses' => 'UserController@postUsersUploadCoverPhoto'));
	Route::get('myvideos', array('as' => 'users.myvideos', 'uses' => 'UserController@getMyVideos'));
	Route::get('myfavorites', array('as' => 'users.myfavorites', 'uses' => 'UserController@getMyFavorites'));
	Route::post('post-my-favorites/{id}', array('as' => 'users.post.favorites', 'uses' => 'UserController@postRemoveFavorites'));
	Route::get('watchlater', array('as' => 'users.watchlater', 'uses' => 'UserController@getWatchLater'));
	Route::post('post-watch-later', array('as' => 'post.users.watch-later', 'uses' => 'UserController@postWatchLater'));
	Route::get('playlists', array('as' => 'users.playlists', 'uses' => 'UserController@getPlaylists'));
	Route::get('feedbacks', array('as' => 'users.feedbacks', 'uses' => 'UserController@getFeedbacks'));
	Route::get('post-feedbacks', array('as' => 'post.users.feedbacks', 'uses' => 'UserController@postFeedbacks'));
	Route::get('subscribers', array('as' => 'users.subscribers', 'uses' => 'UserController@getSubscribers'));
	Route::get('change-password', array('as' => 'users.change-password', 'uses' => 'UserController@getUsersChangePassword'));
	Route::post('post-change-password', array('as' => 'users.post.change-password', 'uses' => 'UserController@postUsersChangePassword'));
	Route::get('change-email', array('as' => 'users.change-email', 'uses' => 'UserController@getChangeEmail'));
	Route::post('post-change-email', array('as' => 'users.post.change-email', 'uses' => 'UserController@postChangeEmail'));
	Route::get('subscriber/', array('as' => 'post.addsubscriber', 'uses'=>'UserController@addSubscriber'));
	Route::post('addPlaylist/{id}', array('as'=>'add.playlist','uses'=>'UserController@addPlaylist'));
	Route::post('removePlaylist/{id}', array('as'=>'remove.playlist','uses'=>'UserController@removePlaylist'));
	Route::post('addChkBoxPlaylist/{id}', array('as'=>'addChkBoxPlaylist.playlist','uses'=>'UserController@addChkBoxPlaylist'));
	Route::post('addToFavorites/{id}', array('as'=>'add.favorites','uses'=>'UserController@addToFavorites'));
	Route::post('removeToFavorites/{id}', array('as'=>'remove.favorites','uses'=>'UserController@removeToFavorites'));	
	Route::post('addToWatchLater/{id}', array('as'=>'add.watchLater','uses'=>'UserController@addToWatchLater'));	
	Route::post('removeToWatchLater/{id}', array('as'=>'remove.watchLater','uses'=>'UserController@removeToWatchLater'));
	Route::post('likeVideo/{id}', array('as'=>'like.video','uses'=>'UserController@likeVideo'));
	Route::post('unlikeVideo/{id}', array('as'=>'unlike.video','uses'=>'UserController@unlikeVideo'));
	Route::post('addsubscriber/', array('as' => 'post.addsubscriber', 'uses'=>'UserController@addSubscriber'));
	Route::get('notifications', array('as' => 'users.notifications', 'uses' => 'UserController@getNotification'));
	Route::post('loadnotifications', array('as' => 'user.loadnotifications', 'uses' => 'UserController@postLoadNotification'));
	Route::post('countnotifications', array('as' => 'user.countnotifications', 'uses' => 'UserController@postCountNotification'));
	Route::get('videoplaylist/{id}', array('as'=>'video.playlist', 'uses'=>'UserController@getViewPlaylistVideo'));
	Route::get('edit/{id}', array('as'=>'video.edit.get', 'uses'=>'UserController@getedit'));
	Route::post('edit/{id}', array('as'=>'video.post.edit', 'uses'=>'UserController@postedit'));
	Route::post('edit_tag/{id}', array('as'=>'video.post.editTag', 'uses'=>'UserController@posteditTag'));
	Route::post('removeTag/{id}', array('as'=>'video.post.removetag', 'uses'=>'UserController@removeTag'));
	Route::post('deleteVideo/{id}', array('as'=>'video.post.delete', 'uses'=>'UserController@deleteVideo'));


});
//*********End of Channels************//

Route::get('channels/{channel_name}', array('before' => 'auth.channels','as' => 'view.users.channel', 'uses' => 'UserController@getViewUsersChannel'));

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
	Route::post('addsubscriber/', array('as' => 'post.addsubscriber', 'uses'=>'UserController@addSubscriber'));

	Route::post('upload-image/{channel_name}', array('as' => 'users.upload.image', 'uses' => 'UserController@postUsersUploadImage'));

});
//**********ADMIN**********//

Route::get('videoplayer', array('as'=>'video.player', 'uses'=>'VideoController@getViewVideoPlayer'));

Route::get('testingpage', array('as'=>'testing', 'uses'=>'HomeController@testingpage'));
