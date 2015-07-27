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
	Route::get('/', array('as' => 'homes.index', 'uses' => 'HomeController@getIndex'));
	Route::get('upload',array('before'=>'auth','as' => 'get.upload', 'uses'=>'VideoController@getUpload'));	//uploading
	Route::post('upload',array('before'=>'auth','as' => 'post.upload', 'uses'=>'VideoController@postUpload'));
	Route::get('cancel-upload',array('before'=>'auth','as' => 'user.upload.video.cancel', 'uses'=>'VideoController@getCancelUploadVideo'));
	Route::get('add-description!v={id}',array('before'=>'auth','as' => 'get.addDescription', 'uses'=>'VideoController@getAddDescription'));
	Route::post('addDescription/{id}',array('before'=>'auth','as' => 'post.add.description', 'uses'=>'VideoController@postAddDescription'));
	//Route::patch('addDescription/{id}',array('before'=>'auth','as' => 'post.addDescription', 'uses'=>'VideoController@postAddDescription'));
	Route::get('search-result', array('as' => 'homes.searchresult', 'uses' => 'VideoController@getSearchResult'));
	Route::post('search-videos', array('as' => 'post.search-video', 'uses' => 'VideoController@postSearchVideos'));
	Route::get('aboutus', array('as' => 'homes.aboutus', 'uses' => 'HomeController@getAboutUs'));
	Route::post('aboutus', array('as' => 'post.homes.aboutus', 'uses' => 'HomeController@postContactUs'));
	Route::get('privacy', array('as' => 'homes.privacy', 'uses' => 'HomeController@getPrivacy'));
	Route::get('terms-and-conditions', array('as' => 'homes.termsandconditions', 'uses' => 'HomeController@getTermsAndConditions'));
	Route::get('copyright', array('as' => 'homes.copyright', 'uses' => 'HomeController@getCopyright'));
	Route::get('advertisements', array('as' => 'homes.advertisements', 'uses' => 'HomeController@getAdvertisements'));
	Route::get('popular', array('as' => 'homes.popular', 'uses' => 'HomeController@getPopular'));
	Route::get('latest', array('as' => 'homes.latest', 'uses' => 'HomeController@getLatest'));
	Route::get('playlist', array('as' => 'homes.playlist', 'uses' => 'HomeController@getPlaylist'));
	Route::get('top-channels',array('as' => 'homes.top-channels', 'uses' => 'UserController@getTopChannels'));
	Route::get('more-top-channels',array('as' => 'homes.more-top-channels', 'uses' => 'UserController@getMoreTopChannels'));
	Route::get('signin', array('as' => 'homes.signin', 'uses' => 'UserController@getSignIn'));
	Route::post('signin', array('as' => 'homes.post.signin', 'uses' => 'UserController@postSignIn'));
	Route::post('signup', array('as' => 'homes.post.signup', 'uses' => 'UserController@postSignUp'));
	Route::get('verify/{token?}', array('as' => 'homes.get.verify', 'uses' => 'UserController@getVerify'));
	Route::post('resendverification', array('as' => 'post.resenduserverify', 'uses' => 'UserController@postResendUserVerify'));
	Route::any('watch', array('as' => 'homes.watch-video', 'uses' => 'HomeController@getWatchVideo'));
	Route::post('counter/{id}', array('as' => 'homes.count', 'uses' => 'VideoController@counter'));
	Route::post('addcomment', array('as' => 'post.addcomment', 'uses' => 'HomeController@addComment'));
	Route::post('addreply', array('as' => 'post.addreply', 'uses' => 'HomeController@addReply'));
	Route::get('watchplaylist={videoId}/{playlistId}', array('as'=>'users.watchplaylist', 'uses'=>'HomeController@getWatchPlaylist'));

	//r3mmel
	Route::post('addlikedcomment', array('as' => 'post.addliked', 'uses' => 'HomeController@addLikedComment'));
	Route::post('adddislikedcomment', array('as' => 'post.addliked', 'uses' => 'HomeController@addDisLikedComment'));
	Route::post('addlikedreply', array('as' => 'post.addliked', 'uses' => 'HomeController@addLikedReply'));
	Route::post('adddislikedreply', array('as' => 'post.addliked', 'uses' => 'HomeController@addDisLikedReply'));
	Route::post('deletecomment', array('as' => 'post.deletecomment', 'uses' => 'HomeController@deleteComment'));
	Route::post('deletereply', array('as' => 'post.deletecomment', 'uses' => 'HomeController@deleteReply'));
	Route::post('addreport', array('as' => 'post.addreport', 'uses' => 'HomeController@addReport'));
	Route::any('complaint_form', array('as' => 'get.complaint_form', 'uses' => 'ReportController@getComplaintForm'));
	Route::post('addcomplaint', array('as' => 'post.addreport', 'uses' => 'ReportController@addComplaint'));
	// Route::any('filedispute', array('as' => 'get.filedispute', 'uses' => 'ReportController@getFileDispute'));
	Route::get('filedispute/{id?}', array('before'=>'auth', 'as' => 'get.filedispute', 'uses' => 'ReportController@getFileDispute'));
	Route::get('listofreports/{id?}', array('before'=>'auth', 'as' => 'get.listofreports', 'uses' => 'ReportController@getListOfReportsPerVideos'));
	Route::post('adddispute', array('as' => 'post.adddispute', 'uses' => 'ReportController@addDispute'));
	//r3mmel
	Route::post('forgotpassword', array('as' => 'post.forgotpassword', 'uses' => 'UserController@postForgotPassword'));
	Route::get('resetpassword/{url?}', array('as' => 'homes.resetpassword', 'uses' => 'UserController@getResetPassword'));
	Route::post('resetpassword', array('as' => 'post.resetpassword', 'uses' => 'UserController@postResetPassword'));
	Route::get('category/{category?}', array('as' => 'homes.category', 'uses' => 'HomeController@getCategory'));
	Route::get('changelogs', array('as' => 'homes.changelogs', 'uses' => 'HomeController@getChangeLogs'));
	Route::get('timezone', array('as' => 'homes.timezone', 'uses' => 'HomeController@getTimezone'));
	Route::get('signin/facebook-connect', array('as' => 'homes.facebookconnect', 'uses' => 'FacebookController@getFacebookConnect'));
	Route::get('signin/authorize-facebook', array('as' => 'homes.authorizefacebook', 'uses' => 'FacebookController@getAuthorizeFacebook'));
	Route::get('signin/google-connect', array('as' => 'homes.googleconnect', 'uses' => 'GoogleController@getGoogleConnect'));
	Route::get('signup-with-social-media', array('as' => 'homes.signupwithsocialmedia', 'uses' => 'UserController@getSignupWithSocialMedia'));
	Route::post('signupwithsocialmedia', array('as' => 'post.signupwithsocialmedia', 'uses' => 'UserController@postSignupWithSocialMedia'));
	Route::post('addannotation', array('before'=>'auth','as' => 'post.add.annotation', 'uses' => 'UserController@postAddAnnotation'));
	Route::post('deleteannotation/{id?}', array('before'=>'auth','as' => 'post.delete.annotation', 'uses' => 'UserController@postDeleteAnnotation'));
	Route::post('annotation/retrieve/{id?}', array('before'=>'auth','as' => 'post.delete.annotation', 'uses' => 'UserController@postRetrieveAnnotation'));
	Route::post('annotationupdate/{id?}', array('before'=>'auth','as' => 'post.update.annotation', 'uses' => 'UserController@postUpdateAnnotation'));
	Route::get('annotationlists/{filename?}', array('before'=>'auth','as' => 'post.lists.annotation', 'uses' => 'UserController@postListAnnotation'));
	
	Route::get('videoplayer', array('as' => 'get.view.video', 'uses' => 'HomeController@getViewVideo'));
});


//**********Channels**********//
Route::group(array('prefix' => 'mychannels'), function() {
	// Route::get('/', array('as' => 'users.index', 'uses' => 'UserController@getUsersIndex'));
	Route::get('/', array('as' => 'users.channel', 'uses' => 'UserController@getUsersChannel'));
	Route::get('signout', array('as' => 'users.signout', 'uses' => 'UserController@getSignOut'));
	Route::get('edit-channel', array('as' => 'users.edit.channel', 'uses' => 'UserController@getEditUsersChannel'));
	Route::post('post-edit-channel/{channel_name}', array('as' => 'users.post.edit.channel', 'uses' => 'UserController@postEditUsersChannel'));
	Route::post('change-cover-photo', array('as' => 'users.upload.cover.photo', 'uses' => 'UserController@postUsersUploadCoverPhoto'));
	Route::get('myvideos', array('as' => 'users.myvideos', 'uses' => 'UserController@getMyVideos'));
	Route::get('sortvideos', array('as' => 'sort.videos', 'uses' => 'UserController@getSortVideos'));
	Route::get('myfavorites', array('as' => 'users.myfavorites', 'uses' => 'UserController@getMyFavorites'));
	Route::post('post-my-favorites/{id}', array('as' => 'users.post.favorites', 'uses' => 'UserController@postRemoveFavorites'));
	Route::get('watchlater', array('as' => 'users.watchlater', 'uses' => 'UserController@getWatchLater'));
	Route::post('post-watch-later', array('as' => 'post.users.watch-later', 'uses' => 'UserController@postWatchLater'));
	Route::post('delete-watch-later/{id}', array('as' => 'post.delete.watch-later', 'uses' => 'UserController@postDeleteWatchLater'));
	Route::get('playlists', array('as' => 'users.playlists', 'uses' => 'UserController@getPlaylists'));
	Route::get('about', array('as' => 'users.about', 'uses' => 'UserController@getAbout'));
	Route::get('feedbacks', array('as' => 'users.feedbacks', 'uses' => 'UserController@getFeedbacks'));
	Route::post('post-feedbacks', array('as' => 'post.users.feedbacks', 'uses' => 'UserController@postFeedbacks'));
	Route::get('subscribers', array('as' => 'users.subscribers', 'uses' => 'UserController@getSubscribers'));
	Route::get('change-password', array('as' => 'users.change-password', 'uses' => 'UserController@getUsersChangePassword'));
	Route::post('post-change-password', array('as' => 'users.post.change-password', 'uses' => 'UserController@postUsersChangePassword'));
	Route::get('change-email', array('as' => 'users.change-email', 'uses' => 'UserController@getChangeEmail'));
	Route::post('post-change-email', array('as' => 'users.post.change-email', 'uses' => 'UserController@postChangeEmail'));
	Route::get('subscriber/', array('as' => 'post.addsubscriber', 'uses'=>'UserController@addSubscriber'));
	Route::post('addPlaylist/{id}', array('as'=>'add.playlist','uses'=>'UserController@addPlaylist'));
	Route::post('createPlaylist/{id}', array('as'=>'create.playlist','uses'=>'UserController@createPlaylist'));
	Route::post('removePlaylist/{id}', array('as'=>'remove.playlist','uses'=>'UserController@removePlaylist'));
	Route::post('addChkBoxPlaylist/{id}', array('as'=>'addChkBoxPlaylist.playlist','uses'=>'UserController@addChkBoxPlaylist'));
	Route::post('addToFavorites/{id}', array('as'=>'add.favorites','uses'=>'UserController@addToFavorites'));
	Route::post('removeToFavorites/{id}', array('as'=>'remove.favorites','uses'=>'UserController@removeToFavorites'));	
	Route::post('addToWatchLater/{id}', array('as'=>'add.watchLater','uses'=>'UserController@addToWatchLater'));	
	Route::post('removeToWatchLater/{id}', array('as'=>'remove.watchLater','uses'=>'UserController@removeToWatchLater'));
	Route::post('likeVideo/{id}', array('as'=>'like.video','uses'=>'UserController@likeVideo'));
	Route::post('unlikeVideo/{id}', array('as'=>'unlike.video','uses'=>'UserController@unlikeVideo'));
	Route::post('dislikeVideo/{id}', array('as'=>'dislike.video','uses'=>'UserController@dislikeVideo'));
	Route::post('removeDislikeVideo/{id}', array('as'=>'removeDislikeVideo.video','uses'=>'UserController@removeDislikeVideo'));
	Route::post('total-liked-disliked/{id}', array('as'=>'video.total.like','uses'=>'UserController@postTotalLikedDisliked'));

	Route::post('addsubscriber/', array('as' => 'post.addsubscriber', 'uses'=>'UserController@addSubscriber'));
	Route::get('notifications', array('as' => 'users.notifications', 'uses' => 'UserController@getNotification'));
	Route::post('loadnotifications', array('as' => 'user.loadnotifications', 'uses' => 'UserController@postLoadNotification'));
	Route::get('countnotifications', array('as' => 'user.countnotifications', 'uses' => 'UserController@countNotifcation'));
	Route::get('videoplaylist={id}', array('as'=>'video.playlist', 'uses'=>'UserController@getViewPlaylistVideo'));
	Route::get('edit/v={id}', array('before'=>'auth','as'=>'video.edit.get', 'uses'=>'UserController@getEditVideo'));
	Route::post('edit/{id}', array('as'=>'video.post.edit', 'uses'=>'UserController@postEditVideo'));
	Route::post('edit_tag/{id}', array('as'=>'video.post.editTag', 'uses'=>'UserController@posteditTag'));
	Route::post('removeTag/{id}', array('as'=>'video.post.removetag', 'uses'=>'UserController@removeTag'));
	Route::post('deleteVideo/{id}', array('as'=>'video.post.delete', 'uses'=>'UserController@deleteVideo'));
	Route::post('editTitle/{id}', array('as'=>'playlistTitle.post.edit', 'uses'=>'UserController@editplaylistTitle'));
	Route::post('editDesc/{id}', array('as'=>'playlistDesc.post.edit', 'uses'=>'UserController@editplaylistDesc'));
	Route::post('deleteplaylist/{id}', array('as'=>'playlistdelete.post', 'uses'=>'UserController@deleteplaylist'));
	Route::get('delete-feedback/', array('as' => 'post.users.delete-feedback', 'uses' => 'UserController@getDeleteFeedback'));
	Route::post('addfeedback', array('as' => 'post.addfeedback', 'uses' => 'UserController@addFeedback'));
	Route::get('facebook/', array('as' => 'facebook', 'uses' => 'UserController@getAuthSocial'));
	Route::post('delete-reply-feedback', array('as' => 'post.users.delete-reply-feedback', 'uses' => 'UserController@postDeleteUserFeedbackReply'));
	Route::post('spam-reply-feedback', array('as' => 'post.users.report-reply-feedback', 'uses' => 'UserController@postReportUserFeedbackReply'));
	Route::get('search', array('as' =>'search', 'uses' => 'VideoController@getSearch'));
	Route::get('searchMyFavorites', array('as' => 'searchFavorites', 'uses' => 'VideoController@getSearchFavorites'));
	Route::get('searchWatchLater', array('as' => 'searchWatchLater', 'uses' => 'VideoController@getSearchWatchLater'));
	Route::get('playlists/searchPlaylistsName', array('as' => 'users.search.playlists', 'uses' => 'VideoController@getUserSearchPlaylists'));
	Route::get('testing/', array('as' => 'social', 'uses' => 'UserController@viewSocial'));
	Route::get('social/{action?}', array('as' => 'hybridauth', 'uses' => 'UserController@social'));
	Route::get('logout/{action?}', array('as' => 'logoutHybridauth', 'uses' => 'UserController@logoutSocial'));
	Route::post('upload-image', array('as' => 'users.upload.image', 'uses' => 'UserController@postUploadUsersProfilePicture'));
	Route::get('earnings-settings', array('as' => 'users.earnings.settings', 'uses' => 'UserController@getEarningsSettings'));
	Route::get('deactivate', array('as' => 'users.deactivate', 'uses' => 'UserController@getDeactivate'));
	Route::post('deactivate', array('as' => 'post.users.deactivate', 'uses' => 'UserController@postDeactivate'));
});
//*********End of Channels************//

Route::get('channels/{channel_name}', array('before' => 'auth.channels','as' => 'view.users.channel', 'uses' => 'UserController@getViewUsersChannel'));
Route::get('channels/{channel_name}/feedbacks', array('before' => 'auth.channels', 'as' => 'view.users.feedbacks2', 'uses' => 'UserController@getViewUsersFeedbacks'));
Route::post('channels/post/feedbacks', array('before' => 'auth.channels', 'as' => 'post.view.users.comments', 'uses' => 'UserController@postViewUsersFeedbacks'));
Route::get('channels/{channel_name}/videos', array('before' => 'auth.channels', 'as' => 'view.users.videos2', 'uses' => 'UserController@getViewUsersVideos'));
Route::get('channels/{channel_name}/favorites', array('before' => 'auth.channels', 'as' => 'view.users.favorites2', 'uses' => 'UserController@getViewUsersFavorites'));
Route::get('channels/{channel_name}/watchlater', array('before' => 'auth.channels', 'as' => 'view.users.watchLater2', 'uses' => 'UserController@getViewUsersWatchLater'));
Route::get('channels/{channel_name}/about', array('before' => 'auth.channels', 'as' => 'view.users.about2', 'uses' => 'UserController@getViewUsersAbout'));
Route::get('channels/{channel_name}/playlists', array('before' => 'auth.channels', 'as' => 'view.users.playlists2', 'uses' => 'UserController@getViewUsersPlaylists'));
Route::get('channels/{channel_name}/videoplaylist={playlistid}', array('before' => 'auth.channels', 'as' => 'view.users.videoplaylist', 'uses' => 'UserController@getViewVideoPlaylist'));
Route::get('channels/{channel_name}/subscribers', array('before' => 'auth.channels', 'as' => 'view.users.subscribers2', 'uses' => 'UserController@getViewUsersSubscribers'));
Route::post('channels/feedback-add-liked', array('as' => 'post.viewusers.addliked', 'uses' => 'UserController@postAddLiked'));
Route::post('channels/feedback-add-disliked', array('as' => 'post.viewusers.addliked', 'uses' => 'UserController@postAddDisLiked'));
Route::post('channels/addfeedback', array('as' => 'post.viewusers.addreply-feedback', 'uses' => 'UserController@postAddReplyFeedback'));
Route::post('channels/delete-feedback', array('as' => 'post.viewusers.delete-feedback', 'uses' => 'UserController@getDeleteFeedback'));
Route::post('channels/spam-feedback', array('as' => 'post.view.users.spam-feedback', 'uses' => 'UserController@postSpamFeedback'));
Route::post('channels/delete-reply-feedback', array('as' => 'post.view.users.delete-reply-feedback', 'uses' => 'UserController@postDeleteFeedbackReply'));
Route::post('channels/spam-reply-feedback', array('as' => 'post.view.users.spam-reply-feedback', 'uses' => 'UserController@postSpamFeedbackReply'));
Route::get('channels/search', array('as' => 'channels.search', 'uses' => 'VideoController@getChannelSearch'));
Route::get('channels/{channel_name}/videos/searchVideo', array('as' => 'channels.search', 'uses' => 'VideoController@getChannelSearch'));
Route::get('channels/{channel_name}/searchPlaylistsName', array('as' => 'channels.search.playlists', 'uses' => 'VideoController@getSearchChannelPlaylists'));

//**********ADMIN**********//
Route::group(array('prefix' => 'gsc-admin'), function() {
	Route::get('/', array('as' => 'admin.index', 'uses' => 'AdminController@getIndex'));
	Route::post('/', array('as' => 'post.admin.index', 'uses' => 'AdminController@postIndex'));
	Route::get('logout', array('as' => 'admin.logout', 'uses' => 'AdminController@logout'));
	Route::get('resetpassword', array('before' => 'auth.admin', 'as' => 'get.admin.resetpassword', 'uses' => 'AdminController@getResetPassword'));
	Route::post('resetpassword', array('before' => 'auth.admin', 'as' => 'post.admin.resetpassword', 'uses' => 'AdminController@postResetPassword'));
	Route::get('pwdreset/{id}', array('before' => 'auth.admin', 'as' => 'get.admin.pwdreset', 'uses' => 'AdminController@getPwdReset'));
	Route::post('pwdreset', array('before' => 'auth.admin', 'as' => 'post.admin.pwdreset', 'uses' => 'AdminController@postPwdReset'));
	Route::get('changepassword', array('before' => 'auth.admin', 'as' => 'get.admin.changepassword', 'uses' => 'AdminController@getChangePassword'));
	Route::post('changepassword', array('before' => 'auth.admin', 'as' => 'post.admin.changepassword', 'uses' => 'AdminController@postChangePassword'));
	Route::get('recommendedvideos', array('before' => 'auth.admin', 'as' => 'get.admin.recommendedvideos', 'uses' => 'AdminController@getRecommendedVideos'));
	Route::post('recommendedvideos', array('before' => 'auth.admin', 'as' => 'post.admin.recommendedvideos', 'uses' => 'AdminController@postRecommendedVideos'));
	Route::get('createadminlink', array('before' => 'auth.admin', 'as' => 'get.admin.createadminlink', 'uses' => 'AdminController@getCreateAdminLink'));
	Route::post('createadminlink', array('before' => 'auth.admin', 'as' => 'post.admin.createadminlink', 'uses' => 'AdminController@postCreateAdminLink'));
	Route::get('adminsignup/{id}', array('as' => 'get.admin.adminsignup', 'uses' => 'AdminController@getAdminSignup'));
	Route::post('adminsignup', array('as' => 'post.admin.adminsignup', 'uses' => 'AdminController@postAdminSignup'));
	Route::get('reportedvideos', array('before' => 'auth.admin', 'as' => 'get.admin.reportedvideos', 'uses' => 'AdminController@getReportedVideos'));
	Route::get('users', array('before' => 'auth.admin', 'as' => 'get.admin.users', 'uses' => 'AdminController@getUsers'));
	Route::post('deleteusers/{id}', array('as' => 'post.admin.deleteusers', 'uses' => 'AdminController@postDeleteUser'));
	Route::get('reports', array('before' => 'auth.admin', 'as' => 'get.admin.reports', 'uses' => 'AdminController@getReports'));
	Route::get('reports/sort/{sort}', array('before' => 'auth.admin', 'as' => 'get.admin.sortreports', 'uses' => 'AdminController@getSortReports'));
	Route::post('deletereports/{id}', array('as' => 'post.admin.deletereports', 'uses' => 'AdminController@postDeleteReport'));
	Route::get('viewreports/{id}', array('as' => 'get.admin.viewreports', 'uses' => 'AdminController@viewReports'));
});
//**********ADMIN**********//

//Route::get('watch', array('as'=>'video.player', 'uses'=>'VideoController@getViewVideoPlayer'));
Route::get('embed/{id}', array('as'=>'embed.video', 'uses'=>'VideoController@getEmbedVideo'));
Route::get('publish-video/{id}/{filename}', array('as'=>'publish.video', 'uses'=>'HomeController@getPublishVideo'));
Route::get('testingpage', array('as'=>'testing', 'uses'=>'HomeController@testingpage'));
Route::get('convert-video/{filename?}/{ext?}', array('as'=>'convert.video', 'uses'=>'VideoController@getconvertVideo'));
Route::post('v/increment-view/{filename?}', ['as'=>'increment.view', 'uses'=>'HomeController@postincrementView']);


//**********Partners**********//
Route::group(array('prefix' => 'partners'), function(){
	Route::get('/', array('as' => 'partners.index', 'uses' => 'PartnerController@getIndex'));
	Route::get('learnmore', array('as' => 'partners.learnmore', 'uses' => 'PartnerController@getLearnMore'));
	//Route::get('faqs', array('as' => 'partners.faqs', 'uses' => 'PartnerController@getFaqs'));
	//Route::get('support', array('as' => 'partners.support', 'uses' => 'PartnerController@getSupport'));
	Route::get('privacy', array('as' => 'partners.privacy', 'uses' => 'PartnerController@getPrivacy'));
	Route::get('termsandconditions', array('as' => 'partners.termsandconditions', 'uses' => 'PartnerController@getTermsAndConditions'));
	Route::get('register-adsense', array('as' => 'partners.register-adsense', 'uses' => 'PartnerController@getRegisterAdsense'));
	Route::post('register-adsense', array('as' => 'post.partners.register-adsense', 'uses' => 'PartnerController@postRegisterAdsense'));
	Route::get('success', array('before' => 'partners.success', 'as' => 'partners.success', 'uses' => 'PartnerController@getSuccess'));
	Route::get('verification', array('before' => 'auth', 'as' => 'partners.verification', 'uses' => 'PartnerController@getVerification'));
	Route::post('verification', array('before' => 'auth','as' => 'post.partners.verification', 'uses' => 'PartnerController@postVerification'));
	Route::get('edit-partners', array('as' => 'edit.partners', 'uses' => 'PartnerController@getEditPartner'));
	Route::post('edit-partners', array('as' => 'post.edit.partners', 'uses' => 'PartnerController@postEditPartner'));
	Route::get('cancel-partners', array('as' => 'cancel.partners', 'uses' => 'PartnerController@getCancelPartner'));
	Route::post('cancel-partners', array('as' => 'post.cancel.partners', 'uses' => 'PartnerController@postCancelPartner'));
});

//**********publishers**********//
Route::group(array('prefix' => 'publishers'), function(){
	Route::get('/', array('as' => 'publishers.index', 'uses' => 'PublisherController@getIndex'));
	Route::get('learnmore', array('before' => 'publishers','as' => 'publishers.learnmore', 'uses' => 'PublisherController@getLearnMore'));
	//Route::get('faqs', array('before' => 'publishers','as' => 'publishers.faqs', 'uses' => 'PublisherController@getFaqs'));
	Route::get('support', array('as' => 'publishers.support', 'uses' => 'PublisherController@getSupport'));
	Route::get('privacy', array('as' => 'publishers.privacy', 'uses' => 'PublisherController@getPrivacy'));
	Route::get('termsandconditions', array('as' => 'publishers.termsandconditions', 'uses' => 'PublisherController@getTermsAndConditions'));
	Route::get('register-adsense', array('as' => 'publishers.register-adsense', 'uses' => 'PublisherController@getRegisterAdsense'));
	Route::post('register-adsense', array('as' => 'post.publishers.register-adsense', 'uses' => 'PublisherController@postRegisterAdsense'));
	Route::get('success', array('before' => 'publishers.success', 'as' => 'publishers.success', 'uses' => 'PublisherController@getSuccess'));
	Route::get('verification', array('before' => 'auth', 'as' => 'publishers.verification', 'uses' => 'PublisherController@getVerification'));
	Route::post('verification', array('before' => 'auth','as' => 'post.publishers.verification', 'uses' => 'PublisherController@postVerification'));
	Route::get('edit-publisher', array('as' => 'edit.publishers', 'uses' => 'PublisherController@getEditPublisher'));
	Route::post('edit-publisher', array('as' => 'post.edit.publishers', 'uses' => 'PublisherController@postEditPublisher'));
	Route::get('cancel-publishers', array('as' => 'cancel.publishers', 'uses' => 'PublisherController@getCancelPublisher'));
	Route::post('cancel-publishers', array('as' => 'post.cancel.publishers', 'uses' => 'PublisherController@postCancelPublisher'));
});

Route::get('errors', array('as' =>'error', 'uses' => 'HomeController@error'));
