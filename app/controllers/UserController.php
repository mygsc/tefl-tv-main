<?php

class UserController extends BaseController {

	public function __construct(User $user, Subscribe $subscribes){
		$this->Subscribe = $subscribes;
		$this->User = $user;
	}

	public function getSignIn() {

		return View::make('homes.signin');
	}

	public function postSignIn() {

		$input = Input::all();
		$validate = Validator::make($input, User::$userLoginRules);

		if($validate->fails()) {
			return Redirect::route('homes.signin')->withFlashMessage("Wrong Channel name or password")->withInput();
		}else{
			$attempt = User::getUserLogin($input['channel_name'], $input['password']);
			if($attempt){
				$verified = Auth::User()->verified;
				$status = Auth::User()->status;
				$role = Auth::User()->role;
				
				if($role == '1' && $verified == '1' && $status != '2'){
					return Redirect::intended('/')->with('flash_message', 'Welcome '.$input['channel_name']);
				}elseif($verified == '0'){
					Auth::logout();
					return Redirect::route('homes.signin')->with('flash_verify', array('message' => 'Your account is not yet verified. Check your email address for verification', 'channel_name' => $input['channel_name']));
				}elseif($status == '2'){
					Auth::logout();
					return Redirect::route('homes.signin')->with('flash_message','Your account is banned! Please contact the TEFLTV Administrator');
				}else{
					Auth::logout();
					return Redirect::route('homes.signin')->withFlashMessage('Invalid Credentials!')->withInput();
				}
			}

		}
		return Redirect::route('homes.signin')->withFlashMessage('Invalid Credentials!')->withInput();
	}

	public function postResendUserVerify(){
		$channel_name = Input::get('channel_name');
		$getUserInfo = User::where('channel_name', $channel_name)->first();

		//--------------Email Start-----------------//
		$generateToken = Crypt::encrypt($getUserInfo->email + rand(10,100));
		$data = array(
			'url' => route('homes.get.verify', $generateToken),
			'first_name' => $getUserInfo->first_name
			);

		Mail::send('emails.users.verify', $data, function($message) {
			$getUserInfo = User::where('channel_name', Input::get('channel_name'))->first();
			$message->to($getUserInfo->email)->subject('TEFL-TV account verification');
		});

		$user = User::find($getUserInfo->id);
		$user->token = $generateToken;
		$user->save();

		return Redirect::route('homes.signin')->withFlashMessage("Mail was Successfully sent, Please check your email!");
			//--------------Email Done----------------------//
	}

	public function postSignUp() {

		$input = Input::all();
		$validate = Validator::make($input, User::$userRules);

		if($validate->passes()){
			//--------------Email Start-----------------//
			$generateToken = Crypt::encrypt($input['email'] + rand(10,100));
			$data = array(
				'url' => route('homes.get.verify', $generateToken),
				'first_name' => $input['first_name']
				);

			Mail::send('emails.users.verify', $data, function($message) {
				$message->to(Input::get('email'))->subject('TEFL-TV account verification');
			});
			//--------------Email Done----------------------//

			$this->User->signup($generateToken); //save

			return Redirect::route('homes.signin')->withFlashMessage("Successfully Registered, Please check your email!");
		}else{
			return Redirect::route('homes.signin')->withErrors($validate)->withInput();
		}

	}

	public function getVerify($token = null){
		if(!empty($token)){
			$findUser = User::where('token', $token)->get();
			if(!$findUser->isEmpty()){
				$this->User->setVerifyStatus(1, $findUser->first()->id);

				return Redirect::route('homes.signin')->with('flash_message', 'Your account has been verfied. You may now sign in your account');
			}
		}
		return Redirect::route('homes.index')->with('flash_message', 'Invalid request');
	}

	public function getUsersIndex() {

		return View::make('users.index');
	}

	public function getSignOut() {
		Auth::logout();
		Session::flush();
		return Redirect::route('homes.index')->withFlashMessage('Logout!');
	}


	public function getTopChannels(){
		$auth = Auth::user();
		$topChannels = DB::select('select users.id, users.channel_name, 
			videos.user_id, sum(videos.views) as total
			from videos inner join users on 
			videos.user_id = users.id 
			group by user_id 
			order by total DESC
			LIMIT 10');

		foreach($topChannels as $key => $channels){
			$img = 'img/user/'. $channels->id. '.jpg';
			if(!empty($auth)){
				$topChannels[$key]->ifsubscribe = Subscribe::where(array('user_id' => $auth->id, 'subscriber_id' => $channels->id))->first();
			}
			if(!file_exists('public/'.$img)){
				$img = 'img/user/0.jpg';
			}
			$topChannels[$key]->image_src = $img;
			$topChannels[$key]->subscribers = $this->Subscribe->getSubscribers($channels->channel_name);
		}

		return View::make('homes.topchannels', compact(array('topChannels','auth')));
	}

	public function getMoreTopChannels(){
		$topChannels = DB::select('select users.id, users.channel_name, 
			videos.user_id, sum(videos.views) as total
			from videos inner join users on 
			videos.user_id = users.id 
			group by user_id 
			order by total DESC
			LIMIT 50');

		foreach($topChannels as $key => $channels){
			$img = 'img/user/'. $channels->id. '.jpg';
			if(!file_exists('public/'.$img)){
				$img = 'img/user/0.jpg';
			}
			$topChannels[$key]->image_src = $img;
		}

		$usersChannel = UserProfile::find(Auth::User()->id);

		return View::make('homes.moretopchannels', compact(array('topChannels')));
	}

	public function getUsersChannel($subscriberLists = array(), $subscriptionLists = array() ) {

		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video;
		$subscribers = User::find(Auth::User()->id)->subscribe;



		$countSubscribers = DB::table('subscribes')->where('user_id', Auth::User()->id)->get();
		// $countSubscriptions = DB::table('subscribe')->where('subscriber', Auth::User()->id)->get();

		foreach($subscribers as $a){
			$subscriber_id[] = $a->subscriber_id;
		}

		

		if(isset($subscriber_id)){
			$subscriberLists = UserProfile::find($subscriber_id);
			$ifNoSubscriber = false;

		} else{
			$subscriberLists = array();
			$ifNoSubscriber = true;
			
		} 

		// return $subscriberLists;

		foreach($subscriberLists as $key => $listSubscriber){

			$subscriberCount = DB::table('subscribes')->where('subscriber_id', $listSubscriber->id)->get();

			$subscriberLists[$key]->count = count($subscriberCount);
		}


		

		$increment = 0;

		$subscriptions = Subscribe::where('subscriber_id', Auth::User()->id)->get();
		// return $subscriptions;
		foreach ($subscriptions as $b) {
			$subscription_id[] = $b->user_id;
			// $subscriptioned = UserProfile::where('user_id', $b->user_id)->get();
			// $subscriptionLists[] = $subscriptioned;

		}

		$subscriptionLists = UserProfile::find($subscription_id);
		// return $subscriptioned;
		// return $subscriptionLists;
		foreach($subscriptionLists as $key => $listSubscription) {
			$subscriptionCount = DB::table('subscribes')->where('user_id', $listSubscription->id)->get();
			$subscriptionLists[$key]->count = count($subscriptionCount);
		}

		// return $subscriptionLists;

		// return $subscribers;
		$findUsersVideo = User::find(Auth::User()->id)->favorite;
		

		foreach($findUsersVideo as $findVideo){
			$videoFavorites[] = $findVideo->video_id;
		}
		// return $videoFavorites;
		$showFavoriteVideos = Video::find($videoFavorites);

		

		foreach($subscriptionLists as $key => $listSubscription) {
			$subscriptionCount = Db::table('subscribes')->where('user_id', $listSubscription->id)->get();
			$subscriptionLists[$key]->count = count($subscriptionCount);
		}


	

		return View::make('users.channel', compact('usersChannel', 'usersVideos', 'subscriberLists','subscriptionLists', 'ifNoSubscriber', 'countSubscribers', 'increment', 'showFavoriteVideos'));
	}
	
	public function postUsersUploadImage($id) {


		If(Input::hasFile('image')) {

			$validate = Validator::make(array('image' => Input::file('image')), array('image' => 'image|mimes:jpg,jpeg,png'));

			if($validate->passes()) {
				$filename = Input::file('image')->getClientOriginalName();

				$picture = public_path('img/user/') . Auth::User()->id . '.jpg';

				$newName = Auth::User()->id.'.jpg';

				$path = public_path('img/user/');


				if(file_exists($picture))
				{
					File::delete($picture);
					$file = Input::file('image')->move($path, $newName);
					return Redirect::route('users.edit.channel', $id)->withFlashMessage('Successfully Updated!');
				}else{
					$file = Input::file('image')->move($path, $newName);
					return Redirect::route('users.edit.channel', $id)->withFlashMessage('Successfully Created New Picture!');
				}
			}else{
				return Redirect::route('users.edit.channel', $id)->withFlashMessage('Error Uploading image must be .jpeg, .jpg, .png');
			}
		}
	}

	public function getEditUsersChannel() {

		$userChannel = UserProfile::find(Auth::User()->id);
		return View::make('users.editchannel', compact('userChannel'));
	}

	public function postEditUsersChannel($channel_name) {

		$input = Input::all();
		$validate = Validator::make($input, User::$userEditRules);

		if($validate->passes()){

			$user = User::find(Auth::User()->id);
			$user->website = Input::get('website');
			$user->organization = Input::get('organization');
			$user->save();

			$userChannel = UserProfile::find(Auth::User()->id);
			$userChannel->first_name = Input::get('first_name');
			$userChannel->last_name = Input::get('last_name');
			$userChannel->contact_number = Input::get('contact_number');
			$userChannel->address = Input::get('address');
			$userChannel->interests = Input::get('interests');
			$userChannel->work = Input::get('work');
			$userChannel->birthdate = Input::get('birthdate');
			$userChannel->city = Input::get('city');
			$userChannel->state = Input::get('state');
			$userChannel->zip_code = Input::get('zip_code');
			$userChannel->save();
		}else{
			return Redirect::route('users.edit.channel', $channel_name)->withErrors($validate);
		}

		return Redirect::route('users.channel', $channel_name)->withFlashMessage('Successfully updated your channel!');

	}

	public function getMyVideos() {

		$countSubscribers = DB::table('subscribes')->where('user_id', Auth::User()->id)->get();
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video;

		return View::make('users.videos', compact('countSubscribers','usersChannel','usersVideos'));
	}

	public function getMyFavorites() {

		$countSubscribers = DB::table('subscribes')->where('user_id', Auth::User()->id)->get();
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video;

		$findUsersVideo = User::find(Auth::User()->id)->favorite;
		
	

		foreach($findUsersVideo as $findVideo){
			$videoFavorites[] = $findVideo->video_id;
		}
		// echo $videoFavorites;
		// return $videoFavorites;
		$showFavoriteVideos = Video::find($videoFavorites);

		return View::make('users.favorites', compact('countSubscribers','usersChannel','usersVideos', 'showFavoriteVideos'));
	}

	public function postRemoveFavorites($id) {

		$deleteFavorite = Favorite::where('video_id', $id)->first();
		$deleteFavorite->delete();
		return Redirect::route('users.channel')->withFlashMessage('Selected video deleted');
	}

	public function getUsersChangePassword() {
		
		return View::make('users.changepassword');
	}

	public function getWatchLater() {
		$countSubscribers = DB::table('subscribes')->where('user_id', Auth::User()->id)->get();
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video;

		$findUsersWatchLaters = User::find(Auth::User()->id)->watchlater;


		foreach($findUsersWatchLaters as $findUsersWatchLater){
			$videoWatchLater[] = $findUsersWatchLater->video_id;
		}


		$videosWatchLater = Video::find($videoWatchLater);

		return View::make('users.watchlater', compact('countSubscribers','usersChannel','usersVideos', 'videosWatchLater', 'watch'));
	}

	public function postWatchLater() {

		return 'asdasdasd';
	
	}

	public function getPlaylists() {

		$countSubscribers = DB::table('subscribes')->where('user_id', Auth::User()->id)->get();
		$usersChannel = UserProfile::find(Auth::User()->id);
	

		$playlists = Playlist::where('user_id', Auth::User()->id)->get();
		return View::make('users.playlists', compact('countSubscribers','usersChannel','usersVideos', 'playlists'));
	}

	public function getFeedbacks() {

		$countSubscribers = DB::table('subscribes')->where('user_id', Auth::User()->id)->get();
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video;

		return View::make('users.feedbacks', compact('countSubscribers','usersChannel','usersVideos'));
	}

	public function getSubscribers() {

		$countSubscribers = DB::table('subscribes')->where('user_id', Auth::User()->id)->get();
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video;

		$subscribers = User::find(Auth::User()->id)->subscribe;

		foreach($subscribers as $a){
			$subscriber_id[] = $a->subscriber_id;
		}

		if(isset($subscriber_id)){
			$subscriberLists = UserProfile::find($subscriber_id);
			$ifNoSubscriber = false;
		} else{
			$subscriberLists = array();
			$ifNoSubscriber = true;
		}

		foreach($subscriberLists as $key => $listSubscriber){

			$subscriberCount = DB::table('subscribes')->where('subscriber_id', $listSubscriber->id)->get();

			$subscriberLists[$key]->count = count($subscriberCount);
		}


	
		$increment = 0;

		$subscriptions = Subscribe::where('subscriber_id', Auth::User()->id)->get();
		// return $subscriptions;
		foreach ($subscriptions as $b) {
			$subscription_id[] = $b->user_id;
			// $subscriptioned = UserProfile::where('user_id', $b->user_id)->get();
			// $subscriptionLists[] = $subscriptioned;

		}

		$subscriptionLists = UserProfile::find($subscription_id);
		// return $subscriptioned;
		// return $subscriptionLists;
		foreach($subscriptionLists as $key => $listSubscription) {
			$subscriptionCount = DB::table('subscribes')->where('user_id', $listSubscription->id)->get();
			$subscriptionLists[$key]->count = count($subscriptionCount);
		}

		return View::make('users.subscribers', compact('countSubscribers','usersChannel','usersVideos', 'subscriberLists', 'subscriptionLists'));
	}

	public function postUsersChangePassword() {
		$input = Input::all();
		$validate = Validator::make($input, User::$userPasswordRules);

		if($validate->fails()){
			return Redirect::route('users.change-password')->withErrors($validate)->withFlashMessage('Error changes in your Password');
		}else{
			$loggedUser = Auth::User()->password;
			$currentPassword = Hash::check(Input::get('currentPassword'), $loggedUser);
			$newPassword = Input::get('newPassword');
			$inputNewPassword = Input::get('currentPassword');

			
			if($currentPassword == $loggedUser){
				if($newPassword != $inputNewPassword){
					$user = User::where('id', Auth::User()->id)->update(['password' => Hash::make(Input::get('newPassword'))]);
					Auth::logout();
					return Redirect::route('users.signout');
				}else{
					return Redirect::route('users.change-password')->withFlashMessage('Current Password and New Password must not match');
				}
			}else{
				return Redirect::route('users.change-password')->withFlashMessage('Current password must match!');
			}
		}
	}

	public function getChangeEmail() {

		return View::make('users.changeemail');
	}

	public function postChangeEmail() {

		$input = Input::all();

		$validate = Validator::make($input, User::$userEmailRules);

		if($validate->fails()){
			return Redirect::route('users.change-email')->withErrors($validate)->withFlashMessage('Error changes in your Email');
		}else{
			$currentEmail = Auth::User()->email;
			$newEmail = Input::get('newEmail');
			
			$checkPassword = Hash::check(Input::get('password'), Auth::User()->password);
			$currentPassword = Input::get('password');

			if($currentEmail != $newEmail){
				if($checkPassword != $currentPassword) {
					return Redirect::route('users.change-email')->withFlashMessage('Password must match with your existing password');
				}
			}else{
				return Redirect::route('users.change-email')->withFlashMessage('Current Email and New Email must not match')->withErrors($validate);
			}
			return Redirect::route('users.channel')->withFlashMessage('Successful, Please open your email');
		}
	}

	public function getViewUsersChannel($channel_name) {
		$user_id = 0;
		$userChannel = User::where('channel_name', $channel_name)->first();
		if(Auth::check()) $user_id = Auth::User()->id;
		if(!Auth::check()) Session::put('url.intended', URL::full());

		if(empty($userChannel)) return View::make('users.channelnotexist');

		$usersVideos = User::where('channel_name',$channel_name)->first();
		
		if(empty($usersVideos)) {
			return Redirect::route('users.viewusers.channel', compact('usersVideos'))->withFlashMessage('Channel does not exist');
		}
		$findVideos = $usersVideos->video;
	

		$userSubscribe = User::where('channel_name', $channel_name)->first();
		$subscribers = $userSubscribe->subscribe;

	
		foreach($subscribers as $a){
			$subscriber_id[] = $a->subscriber;
		}

		$subscriberLists = UserProfile::find($subscriber_id);

		$subscriptions = Subscribe::where('subscriber_id', $usersVideos->id)->paginate(15);
		foreach ($subscriptions as $b) {
			$subscriptioned = UserProfile::where('user_id', $b->user_id)->get();
			$subscriptionLists[] = $subscriptioned;

		}

		$ifAlreadySubscribe = Subscribe::where(array('user_id' => $user_id, 'subscriber_id' => $subscriber_id));
		
		return View::make('users.viewusers', compact('userChannel', 'findVideos', 'subscriberLists', 'subscriptionLists', 'user_id', 'ifAlreadySubscribe'));
	}
	public function addSubscriber() {
        $user_id = Input::get('user_id');
        $subscriber_id = Input::get('subscriber_id');
        $status = Input::get('status');

        if($status == 'subscribeOn'){
        	$subscribe = new Subscribe;
			$subscribe->user_id = $user_id;
			$subscribe->subscriber_id = $subscriber_id;
			$subscribe->save();
			return Response::json(array(
                'status' => 'subscribeOff',
                'label' => 'Unsubscribe'
            ));
        }
        if($status == 'subscribeOff'){
        	$deleteRows = Subscribe::where(array('user_id' => $user_id, 'subscriber_id' => $subscriber_id))->delete();
        	return Response::json(array(
                'status' => 'subscribeOn',
                'label' => 'Subscribe'
        	));
        }
    }
    public function addPlaylist($id){
    	$name = Input::get('name');
    	$description = Input::get('description');
    	$privacy = Input::get('privacy');
    	$user_id = Auth::User()->id;
    	$duplicateValidator = Playlist::where('name','=',$name);
    	$duplicate = Playlist::where('name','=',$name)->first();	
    	if($duplicateValidator->count()){
    		$playlistDuplicate = PlaylistItem::where('playlist_id','=',$duplicate->id)
    										->where('video_id','=',$id);
    		if(!$playlistDuplicate->count()){
    			PlaylistItem::create(array('playlist_id'=>$duplicate->id,'video_id'=>$id));
    		}
    	}else{
	    	$createPlaylist = Playlist::create(array('user_id'=>$user_id,'name'=>$name,'description'=>$description,'privacy'=>$privacy));
	    	$playlistID = $createPlaylist->id;
	    	PlaylistItem::create(array('playlist_id'=>$playlistID,'video_id'=>$id));
    	}
    }
    public function addChkBoxPlaylist($id){
    	$playlistId = Crypt::decrypt(Input::get('value'));
    	PlaylistItem::create(array('playlist_id'=>$playlistId,'video_id'=>$id));
    }
    public function removePlaylist($id){
    	$playlistId = Crypt::decrypt(Input::get('value'));
    	$playlistItem = PlaylistItem::where('video_id','=',$id)
    									->where('playlist_id','=',$playlistId)->first();
    	$playlistItem->delete();

    }
    public function addToFavorites($id){
		Favorite::create(array('user_id'=>Auth::User()->id,'video_id'=>$id));
	}
	public function removeToFavorites($id){
		$favorite = Favorite::where('user_id','=',Auth::User()->id)
							->where('video_id','=',$id)->first();
		$favorite->delete();					
	}


}
