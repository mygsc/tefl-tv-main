<?php

class UserController extends BaseController {

	public function __construct(User $user, Subscribe $subscribes, Notification $notification, 
		Video $video, UserWatchLater $watchLater, UserFavorite $favorite, Feedback $feedback,Playlist $playlist,
		ReportedFeedback $reportedFeedback){
		$this->Notification = $notification;
		$this->Video = $video;
		$this->Subscribe = $subscribes;
		$this->User = $user;
		define('DS', DIRECTORY_SEPARATOR); 
		$this->Auth = Auth::User();
		$this->WatchLater = $watchLater;
		$this->Favorite = $favorite;
		$this->Feedback = $feedback;
		$this->Playlist = $playlist;
		$this->ReportedFeedback = $reportedFeedback;
	}	

	public function getSignIn() { 
		//return Session::all();
		if(Auth::check()) return Redirect::route('homes.index');
		return View::make('homes.signin');
	}

	public function postSignIn() {
		$input = Input::all();
		$validate = Validator::make($input, User::$userLoginRules);

		if($validate->fails()) {
			return Redirect::route('homes.signin')->withFlashBad("Wrong Channel name or password")->withInput();
		}else{
			$attempt = User::getUserLogin($input['channel_name1'], $input['password']);
			if($attempt){
				$verified = Auth::User()->verified; $status = Auth::User()->status; $role = Auth::User()->role; //VARIABLES		
				if($role == '1' && $verified == '1' && $status != '2'){
					return Redirect::intended('/')->withFlashGood('Welcome '.$input['channel_name1']);
				}elseif($verified == '0'){
					Auth::logout();
					return Redirect::route('homes.signin')->with('flash_verify', array('message' => 'Your account is not yet verified. Check your email address for verification', 'channel_name' => $input['channel_name1']));
				}elseif($status == '2'){
					Auth::logout();
					return Redirect::route('homes.signin')->with('flash_bad','Your account was banned! Please contact the TEFLTV Administrator');
				}else{
					Auth::logout();
					return Redirect::route('homes.signin')->withFlashBad('Invalid Credentials!')->withInput();
				}
			}
		}
		return Redirect::route('homes.signin')->withFlashBad('Invalid Credentials!')->withInput();
	}

	public function postResendUserVerify(){
		$channel_name = Input::get('channel_name');
		$getUserInfo = User::where('channel_name', $channel_name)->first();
		//--------------Email Start-----------------//
		$generateToken = Crypt::encrypt($getUserInfo->email + rand(10,100));
		$data = array('url' => route('homes.get.verify', $generateToken), 'first_name' => $getUserInfo->first_name);
		Mail::send('emails.users.verify', $data, function($message) {
			$getUserInfo = User::where('channel_name', Input::get('channel_name'))->first();
			$message->to($getUserInfo->email)->subject('TEFL-TV account verification');
		});
		$user = User::find($getUserInfo->id);
		$user->token = $generateToken;
		$user->save();
		//--------------Email Done----------------------//
		return Redirect::route('homes.signin')->withFlashGood("Mail was Successfully sent, Please check your email!");

	}

	public function postSignUp() {
		$input = Input::all();
		$validate = Validator::make($input, User::$userRules);
		if($validate->passes()){
			//--------------Email Start-----------------//
			$generateToken = Crypt::encrypt($input['email'] + rand(10,100));
			$data = array('url' => route('homes.get.verify', $generateToken),'first_name' => $input['first_name']);
			Mail::send('emails.users.verify', $data, function($message) {
				$message->to(Input::get('email'))->subject('TEFL-TV account verification');
			});
			//--------------Email Done----------------------//
			$this->User->signup($generateToken); //save
			return Redirect::route('homes.signin')->withFlashGood("Successfully Registered, Please check your email!");
		}else{
			return Redirect::route('homes.signin')->withErrors($validate)->withInput();
		}
	}

	public function postForgotPassword(){
		$generateToken = Crypt::encrypt(Input::get('email') + rand(10,100));
		$validator = Validator::make(array('email' => Input::get('email')),array('email' => 'required|email'));	
		$findUser = User::where('email', Input::get('email'))->get();

		if($validator->fails() || $findUser->isEmpty()){
			return Redirect::route('homes.signin')->with('flash_bad', 'Please enter a valid E-mail address');
		}
		$data = array('url' => route('homes.resetpassword', $generateToken),'first_name' => Input::get('first_name'));
		Mail::send('emails.users.forgotpassword', $data, function($message) {
			$getUserInfo = User::where('email', Input::get('email'))->first();
			$message->to($getUserInfo->email)->subject('TEFL-TV forgot password');
		});

		$user = User::find($findUser->first()->id);
		$user->token = $generateToken;
		$user->save();

		return Redirect::route('homes.signin')->with('flash_good', 'An email was sent to your email address '. Input::get('email'). '. Please check both your Inbox and Spam.');
	}

	public function getResetPassword($token = null){
		$findUser = User::where('token', $token)->get();
		if($findUser->isEmpty()) return app::abort(404, 'Page not available');
		$userInfo = $findUser->first();
		return View::make('homes.resetpassword', compact(array('userInfo','token')));
	}

	public function postResetPassword(){
		$input = Input::all();
		$user_id = Crypt::decrypt($input['uid']);
		$validator = Validator::make(
			array('password' => $input['password'],
				'password_confirmation' => $input['password_confirmation']),
			array('password' => 'required|min:6', 'password_confirmation' => 'same:password'));
		if(!$validator->fails()){
			if($this->User->renewPassword($input['password'], $user_id) === true){
				return Redirect::route('homes.signin')->with('flash_good', 'Password has been renewed');
			}
		}
		return Redirect::route('homes.resetpassword', $input['token'])->withErrors($validator)->withInput();
	}

	public function getVerify($token = null){
		if(!empty($token)){
			$findUser = User::where('token', $token)->get();
			if(!$findUser->isEmpty()){
				$this->User->setVerifyStatus(1, $findUser->first()->id);
				return Redirect::route('homes.signin')->with('flash_good', 'Your account has been verfied. You may now sign in your account');
			}
		}
		return Redirect::route('homes.index')->with('flash_warning', 'Invalid request');
	}

	public function getUsersIndex() {
		return View::make('users.index');
	}

	public function getSignOut() {
		Auth::logout();
		Session::flush();
		return Redirect::route('homes.index')->withFlashGood('Logout!');
	}
	public function getTopChannels(){
		$datas = $this->User->getTopChannels(10);
		
		return View::make('homes.topchannels', compact(array('datas')));
	}

	public function getMoreTopChannels(){
		//Insert additional data to $datas
		$datas = $this->User->getTopChannels(50);
		foreach($datas as $key => $channel){
			$img = 'img/user/'. $channel->id. '.jpg';
			if(Auth::check()){
				$ifsubscribe = Subscribe::where('user_id', $channel->id)->where('subscriber_id', Auth::user()->id)->get();
				$datas[$key]->ifsubscribe = 'No';
				if(!$ifsubscribe->isEmpty()){
					$datas[$key]->ifsubscribe = 'Yes';
				}
			}
			if(!file_exists(public_path($img))){
				$img = '/img/user/0.jpg';
			}
			$datas[$key]->image_src = $img;
			$datas[$key]->subscribers = $this->Subscribe->getSubscribers($channel->channel_name, 10);
		}
		return View::make('homes.moretopchannels', compact(array('datas')));
	}

	public function getUsersChannel($subscriberLists = array(), $subscriptionLists = array() ) {
		if(!Auth::check()){
			return Redirect::route('homes.post.signin')->with('flash_warning','Please Sign-in to view your channel');
		} else{
			$usersChannel = UserProfile::where('user_id',Auth::User()->id)->first();
			$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
			$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
			$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
			$countAllViews = $this->Video->countViews($allViews);
			$usersWebsite = Website::where('user_id', Auth::User()->id)->first();
			$picture = public_path('img/user/') . Auth::User()->id . '.jpg';
			$subscriberProfile = $this->Subscribe->Subscribers($this->Auth->id, 6);
			$subscriptionProfile = $this->Subscribe->Subscriptions($this->Auth->id, 6);
			$usersVideos = $this->Video->getVideos($this->Auth->id, null,8);
			// return $usersVideos;
			$usersPlaylists = Playlist::where('user_id', $this->Auth->id)->paginate(8);

			foreach($usersPlaylists as $playlist){
				$thumbnail_playlists[] = $this->Playlist->playlistControl(NULL,$playlist->id,NULL,NULL);
			}
			$increment = 0;
			$recentUpload = $this->Video->getVideos($this->Auth->id,'videos.created_at',1);

			return View::make('users.mychannels.channel', compact('usersChannel', 'usersVideos','recentUpload', 'countSubscribers', 'increment', 'countVideos', 'countAllViews','usersPlaylists', 'subscriberProfile','subscriptionProfile','subscriberCount','usersWebsite','subscriptionCount','thumbnail_playlists','picture')); 
		}
	}
	
	public function postUsersUploadImage($id) {
		If(Input::hasFile('image')) {
			$validate = Validator::make(array('image' => Input::file('image')), array('image' => 'image|mimes:jpg,jpeg,png'));
			if($validate->passes()) {
				$filename = Input::file('image')->getClientOriginalName();
				$picture = public_path('img/user/') . Auth::User()->id . '.jpg';
				$newName = Auth::User()->id.'.jpg';
				$path = public_path('img/user/');
				if(file_exists($picture)){
					File::delete($picture);
					$file = Input::file('image')->move($path, $newName);
					return Redirect::route('users.channel')->withFlashGood('Successfully Updated!');
				} else{
					$file = Input::file('image')->move($path, $newName);
					return Redirect::route('users.channel')->withFlashGood('Successfully Created New Picture!');
				}
			} else{
				return Redirect::route('users.channel')->withFlashBad('Error Uploading image must be .jpeg, .jpg, .png');
			}
		}
	}

	public function postUsersUploadCoverPhoto() {
		If(Input::hasFile('coverPhoto')) {
			$validate = Validator::make(array('image' => Input::file('coverPhoto')), array('image' => 'image|mimes:jpg,jpeg,png'));
			if($validate->passes()) {
				$filename = Input::file('coverPhoto')->getClientOriginalName();
				$coverPhoto = public_path('img/user/cover_photo') . Auth::User()->id . '.jpg';
				$newName = Auth::User()->id.'.jpg';
				$path = public_path('img/user/cover_photo');

				if(file_exists($coverPhoto)){
					File::delete($coverPhoto);
					$file = Input::file('coverPhoto')->move($path, $newName);
					return Redirect::route('users.channel')->withFlashGood('Successfully Updated!');
				} else{
					$file = Input::file('coverPhoto')->move($path, $newName);
					return Redirect::route('users.channel')->withFlashGood('Successfully Created New Picture!');
				}
			} else{
				return Redirect::route('users.channel')->withFlashBad('Error Uploading image must be .jpeg, .jpg, .png');
			}
		}
	}

	public function getEditUsersChannel() {
		$userChannel = UserProfile::where('user_id',Auth::User()->id)->first();
		$userWebsite = Website::where('user_id', Auth::User()->id)->first();
		$picture = public_path('img/user/') . Auth::User()->id . '.jpg';
		return View::make('users.mychannels.editchannel', compact('userChannel','userWebsite', 'picture'));
	}

	public function postEditUsersChannel($channel_name) {
		$input = Input::all();
		$validate = Validator::make($input, User::$userEditRules);
		if($validate->passes()){
			$user = User::find(Auth::User()->id);
			$user->website = Input::get('website');
			$user->organization = Input::get('organization');
			$user->save();

			$userChannel = UserProfile::where('user_id',Auth::User()->id)->first();
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

			$findUserWebsite = Website::where('user_id',9)->first();

			if(isset($findUserWebsite)){
				DB::table('websites')->insert(array('user_id' => Auth::User()->id, 'facebook' => Input::get('facebook'), 'twitter' => Input::get('twitter'), 'instagram' => Input::get('instagram'), 'gmail' => Input::get('gmail'), 'others' => Input::get('others')));
			}else{
				$userWebsite = Website::where('user_id',Auth::User()->id)->first();
				$userWebsite->facebook = Input::get('facebook');
				$userWebsite->twitter = Input::get('twitter');
				$userWebsite->instagram = Input::get('instagram');
				$userWebsite->gmail = Input::get('gmail');
				$userWebsite->others = Input::get('others');
				$userWebsite->save();
			}
		}else{
			return Redirect::route('users.editchannel')->withErrors($validate);
		}
		return Redirect::route('users.channel')->withFlashGood('Successfully updated your channel!');

	}

	public function getMyVideos() {
		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = $this->Video->getVideos($this->Auth->id,'videos.created_at');
		$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$picture = public_path('img/user/') . Auth::User()->id . '.jpg';
		$countAllViews = $this->Video->countViews($allViews);
		
		return View::make('users.mychannels.videos', compact('countSubscribers','usersChannel','usersVideos', 'countVideos', 'countAllViews','picture'));
	}

	public function getMyFavorites() {
		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video;
		$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);
		$picture = public_path('img/user/') . Auth::User()->id . '.jpg';
		$findUsersVideos = $this->Favorite->getUserFavoriteVideos($this->Auth->id);

		return View::make('users.mychannels.favorites', compact('countSubscribers','usersChannel','usersVideos', 'findUsersVideos','countAllViews', 'countVideos','picture'));
	}

	public function postRemoveFavorites($id) {
		$deleteFavorite = UserFavorite::find($id);
		$deleteFavorite->delete();
		return Redirect::route('users.channel')->withFlashBad('Selected video deleted');
	}

	public function getedit($id){
		$file_name = Video::where('file_name',$id)->first();
		$id = $file_name->id;
		$video = Video::find($id);
		$owner = User::find($video->user_id);
		if($video->user_id != Auth::User()->id){
			return Redirect::route('users.channel');
		}
		if($video->tags == ""){
			$tags = null;
		}else{
			$tags = explode(',',$video->tags);
		}
		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video;
		$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);
		$findUsersVideos = UserFavorite::where('user_id', Auth::User()->id)->get();
		$picture = public_path('img/user/') . Auth::User()->id . '.jpg';
		return View::make('users.updatevideos', compact('countSubscribers','usersChannel','usersVideos', 'findUsersVideos','countAllViews', 'countVideos','video','tags','owner','picture'));
	}
	public function postedit($id){
		$input = Input::all();
		$poster = $input['poster'];
		$fileName = Input::get('filename');
		$userFolderName = $this->Auth->id .'-'.$this->Auth->channel_name;
		$destinationPath =  public_path('videos'.DS. $userFolderName.DS.$fileName.DS);
		$validator = Validator::make($input,Video::$video_edit_rules);
		if($validator->passes()){
			if($input['poster']){
				if(file_exists($destinationPath.$fileName.'.jpg')){
					File::delete($destinationPath.$fileName.'.jpg'); 
				}
				$resizeImage = Image::make($poster->getRealPath())->fit(600,339)->save($destinationPath.$fileName.'.jpg');
			}
			$id = Crypt::decrypt($id);
			$video = Video::find($id);
			$video->title = $input['title'];
			$video->description = $input['description'];
			$video->publish = $input['publish'];
			if($input['new_tags'] != null){
				$video_tag = Video::where('id',$id)->first()->toArray();
				$new_tags = explode(',',$input['new_tags']);
				foreach($new_tags as $new_tag){
					if($new_tag != null){
						$tag_result[] = strtolower($new_tag);
					}
				}
				$explode_existing_tag = explode(',',$video_tag['tags']);
				$mergingTag = array_merge($tag_result,$explode_existing_tag);
				$unique_tag = array_unique($mergingTag);
				$final_tag = implode(',',$unique_tag);
				$video->tags = $final_tag;
			}
			$video->save();
			return Redirect::route('video.edit.get',Crypt::encrypt($id))->withFlashGood('Successfully updated');
		}
		return Redirect::route('video.edit.get',$id)->withErrors($validator)->withFlashWarning('Fill up the required fields');
		
	}
	public function posteditTag($id){
		$id = Crypt::decrypt($id);
		$name = Input::get('name');
		$array_key = Crypt::decrypt(Input::get('encrypt'));
		$video = Video::find($id);
		$tags = explode(',',$video->tags);
		$tags[$array_key] = $name;
		$new_tags = implode(',',$tags);
		$video->tags = $new_tags;
		$video->save();
	}
	public function removeTag($id){
		$id = Crypt::decrypt($id);
		$array_key = Crypt::decrypt(Input::get('encrypt'));
		$video = Video::find($id);
		$tags = explode(',',$video->tags);
		unset($tags[$array_key]);
		$imploded_tag = implode(',',$tags);
		$video->tags = $imploded_tag;
		$video->save();
	}
	public function deleteVideo($id){
		$id = Crypt::decrypt($id);
		$video = Video::find($id);
		if($video->user_id == Auth::User()->id){
			$video->delete();
			return Redirect::route('users.myvideos');
		}
		return Redirect::route('users.channel');
	}

	public function getUsersChangePassword() {
		return View::make('users.mychannels.accountsettings.changepassword');
	}

	public function getWatchLater() {
		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video;
		$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);
		$usersWatchLater = $this->WatchLater->getWatchLater($this->Auth->id);
		$picture = public_path('img/user/') . Auth::User()->id . '.jpg';

		return View::make('users.mychannels.watchlater', compact('countSubscribers','usersChannel','usersVideos', 'videosWatchLater', 'watch','countAllViews', 'countVideos','findUsersWatchLaters', 'usersWatchLater','picture'));
	}

	public function postDeleteWatchLater($id) {
		$deleteWatchLater = UserWatchLater::find($id);
		$deleteWatchLater->delete();
		return Redirect::route('users.watchlater')->withFlashGood('Successfully deleted');
	}

	public function postWatchLater() {
		$user_id = Input::get('user_id');
		$video_id = Input::get('video_id');
		$database_userid = UserWatchLater::where('user_id', $user_id)->first();
		$database_videoid = UserWatchLater::where('video_id', $video_id)->first();
		if($user_id == $database_userid->user_id && $video_id == $database_videoid->video_id){
			$watchlater = UserWatchLater::where(array('user_id' => $database_userid->user_id, 'video_id' => $database_videoid->video_id))->update(['status' => 1]);
		}
	}

	public function getPlaylists() {
		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$userChannel = UserProfile::find(Auth::User()->id);
		$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);
		$picture = public_path('img/user/') . Auth::User()->id . '.jpg';
		$playlists = Playlist::where('user_id', Auth::User()->id)
		->where('deleted_at','=',NULL)->get();

		foreach($playlists as $playlist){
			$thumbnail_playlists[] = $this->Playlist->playlistControl(NULL,$playlist->id,NULL,NULL);
		}
		return View::make('users.mychannels.playlists', compact('countSubscribers','usersChannel','usersVideos', 'playlists','countAllViews', 'countVideos','thumbnail_playlists','picture'));
	}
	public function getViewPlaylistVideo($id){
		$randID = Playlist::where('randID',$id)->first();
		$id = $randID->id;
		$owner = User::find($randID->user_id);
		if(Auth::check()){
			$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
			$usersChannel = UserProfile::find(Auth::User()->id);
			$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
			$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
			$countAllViews = $this->Video->countViews($allViews);
			$picture = public_path('img/user/') . Auth::User()->id . '.jpg';
			$user_id = Auth::User()->id;
		}else{
			$countSubscribers = $this->Subscribe->getSubscribers($owner->channel_name);
			$usersChannel = UserProfile::find($owner->id);
			$countVideos = DB::table('videos')->where('user_id', $owner->id)->get();
			$allViews = DB::table('videos')->where('user_id', $owner->id)->sum('views');
			$countAllViews = $this->Video->countViews($allViews);
			$picture = public_path('img/user/') . $owner->id . '.jpg';
			$user_id = 0;
		}
		$userChannel = User::find($owner->id);
		$ifAlreadySubscribe =  DB::table('subscribes')->where(array('user_id' => $userChannel->id, 'subscriber_id' => $user_id))->first();
		$videos =$this->Playlist->playlistControl(NULL,$id,NULL,NULL);
		$playlist = Playlist::where('id',$id)->first();
		return View::make('users.viewplaylistvideo', compact('playlist','countSubscribers','usersChannel','usersVideos', 'playlists','countAllViews', 'countVideos','videos','picture','userChannel','user_id','ifAlreadySubscribe'));

	}
	public function deleteplaylist($id){
		$id = Crypt::decrypt($id);
		$playlist = Playlist::find($id);
		$playlistItems = PlaylistItem::where('playlist_id','=',$id)->get();
		$playlist->delete();
		if(!empty($playlistItems)){
			foreach($playlistItems as $playlistItem){
				$playlistItem->delete();
			}
		}
		return Redirect::route('users.playlists')->withFlashGood('Playlist successfully removed');
	}

	public function getFeedbacks() {
		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video;
		$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);
		$picture = public_path('img/user/') . Auth::User()->id . '.jpg';
		$userFeedbacks = $this->Feedback->getFeedbacks($this->Auth->id);
		// return $userFeedbacks;
		return View::make('users.mychannels.feedbacks', compact('countSubscribers','usersChannel','usersVideos','countAllViews', 'countVideos','userComments','picture','userFeedbacks'));
	}

	public function editplaylistTitle($id){
		$id = Crypt::decrypt($id);
		$name = Input::get('name');
		$playlist = Playlist::find($id);
		$playlist->name = $name;
		$playlist->save();
	}
	public function editplaylistDesc($id){
		$id = Crypt::decrypt($id);
		$description = Input::get('description');
		$playlist = Playlist::find($id);
		$playlist->description = $description;
		$playlist->save();	
	}

	public function getSubscribers() {
		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video;
		$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);
		$picture = public_path('img/user/') . Auth::User()->id . '.jpg';
		$subscriberProfile = $this->Subscribe->Subscribers($this->Auth->id);
		$subscriptionProfile = $this->Subscribe->Subscriptions($this->Auth->id);

		return View::make('users.mychannels.subscribers', compact('countSubscribers','usersChannel','usersVideos', 'subscriberProfile', 'subscriptionProfile','countAllViews', 'countVideos', 'subscriberCount','picture'));
	}

	public function postUsersChangePassword() {
		$input = Input::all();
		$validate = Validator::make($input, User::$userPasswordRules);

		if($validate->fails()){
			return Redirect::route('users.change-password')->withErrors($validate)->withFlashBad('Error changes in your Password');
		} else{
			$loggedUser = Auth::User()->password;
			$currentPassword = Hash::check(Input::get('currentPassword'), $loggedUser);
			$newPassword = Input::get('newPassword');
			$inputNewPassword = Input::get('currentPassword');
			if($currentPassword == $loggedUser){
				if($newPassword != $inputNewPassword){
					$user = User::where('id', Auth::User()->id)->update(['password' => Hash::make(Input::get('newPassword'))]);
					Auth::logout();
					return Redirect::route('homes.index')->withFlashGood('Successfully changed the password.');
				}else{
					return Redirect::route('users.change-password')->with('flash_warning','Current Password and New Password must not match')->withErrors($validate);
				}
			} else{
				return Redirect::route('users.change-password')->withFlashBad('Current password must match!');
			}
		}
	}

	public function getChangeEmail() {
		return View::make('users.mychannels.accountsettings.changeemail');
	}

	public function postChangeEmail() {
		$input = Input::all();
		$validate = Validator::make($input, User::$userEmailRules);
		if($validate->fails()){
			return Redirect::route('users.change-email')->withErrors($validate);
		} else{
			$currentEmail = Auth::User()->email;
			$newEmail = Input::get('newEmail');
			$checkPassword = Hash::check(Input::get('password'), Auth::User()->password);
			$currentPassword = Input::get('password');

			if($currentEmail != $newEmail){
				if($checkPassword != $currentPassword) {
					return Redirect::route('users.change-email')->withFlashBad('Password must match with your existing password');
				}
			} else{
				return Redirect::route('users.change-email')->with('flash_warning','Current Email and New Email must not match')->withErrors($validate);
			}
			$user = User::where('email', Auth::User()->email)->update(['email' => $newEmail]);
			return Redirect::route('users.channel')->withFlashGood('Successful, Please open your email');
		}
	}

	public function getViewUsersChannel($channel_name) {
		$user_id = 0;
		$userChannel = User::where('channel_name', $channel_name)->first();
		if(Auth::check()) $user_id = Auth::User()->id;
		if(!Auth::check()) Session::put('url.intended', URL::full());
		if(empty($userChannel)) return View::make('users.channelnotexist');
		$usersVideos = User::where('channel_name',$channel_name)->first();
		$findVideos = $this->Video->getVideos($userChannel->id, 'videos.created_at',6);
		$userSubscribe = User::where('channel_name', $channel_name)->first();
		$picture = public_path('img/user/') . $userChannel->id . '.jpg';
		$subscribers = $this->Subscribe->Subscribers($userChannel->id);
		$recentUpload = $this->Video->getVideos($userChannel->id, 'videos.created_at',1);
		$usersPlaylists = Playlist::where('user_id', $userChannel->id)->paginate(6);
		foreach($usersPlaylists as $playlist){
			$thumbnail_playlists[] = $this->Playlist->playlistControl(NULL,$playlist->id,NULL,NULL);
		}
		//r3mmel
		$allViews = DB::table('videos')->where('user_id', $userChannel->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);
		$countVideos = Video::where('user_id', $userChannel->id)->get();

		$countSubscribers = $this->Subscribe->getSubscribers($userChannel->channel_name);
		$ifAlreadySubscribe =  DB::table('subscribes')->where(array('user_id' => $userChannel->id, 'subscriber_id' => $user_id))->first();
		//r3mmel
		return View::make('users.channels.viewusers', compact('userChannel', 'findVideos', 'subscribers', 'subscriptions', 'user_id', 'ifAlreadySubscribe','recentUpload', 'usersPlaylists', 'usersVideos','picture', 'countVideos', 'countSubscribers', 'countAllViews'));
	}

	public function getViewUsersFeedbacks($channel_name) {
		$user_id = 0;
		$userChannel = User::where('channel_name', $channel_name)->first();
		$userFeedbacks = $this->Feedback->getFeedbacks($userChannel->id);

		foreach ($userFeedbacks as $key => $userFeedback) {
			$userFeedbacks[$key]->img = $this->User->addProfilePicture($userFeedback->user_id);
			$userFeedbacks[$key]->likesCount = DB::table('feedbacks_likesdislikes')->where(array('feedback_id' => $userFeedback->id, 'status' => 'liked'))->count();
			$userFeedbacks[$key]->dislikeCount = DB::table('feedbacks_likesdislikes')->where(array('feedback_id' => $userFeedback->id, 'status' => 'disliked'))->count();
			if(Auth::check()){
			$userFeedbacks[$key]->ifAlreadyLiked = DB::table('feedbacks_likesdislikes')->where(array(
				'feedback_id' => $userFeedback->id, 
				'user_id' => Auth::User()->id,
				'status' => 'liked'
				))->first();
			$userFeedbacks[$key]->ifAlreadyDisliked = DB::table('feedbacks_likesdislikes')->where(array(
				'feedback_id' => $userFeedback->id, 
				'user_id' => Auth::User()->id,
				'status' => 'disliked'
				))->first();
			}
			$userFeedbacks[$key]->countFeedbackReplies = DB::table('feedback_replies')
			->join('users', 'users.id', '=', 'feedback_replies.user_id')
			->where('feedback_id', $userFeedback->id)->count();

			$userFeedbacks[$key]->getFeedbackReplies = FeedbackReply::select('feedback_replies.id', 'user_id', 'reply', 'feedback_id',
			 'feedback_replies.created_at', 'feedback_replies.updated_at', 'channel_name')
			->join('users', 'users.id', '=', 'feedback_replies.user_id')
			->get();	
			
			$userFeedbacks[$key]->spamCounts = DB::table('reported_feedbacks')->where('feedback_id', $userFeedback->id)->count();
		}

		// return $userFeedbacks;


		$allViews = DB::table('videos')->where('user_id', $userChannel->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);
		$countVideos = Video::where('user_id', $userChannel->id)->count();
		$countSubscribers = $this->Subscribe->getSubscribers($userChannel->channel_name);
		$picture = public_path('img/user/') . $userChannel->id . '.jpg';

		return View::make('users.channels.feedbacks', compact('picture','userChannel','userFeedbacks','countAllViews','countVideos','countSubscribers','user_id','var'));
	}

	public function postViewUsersFeedbacks() {
		$feedback = trim(Input::get('feedback'));
		$user_id = Input::get('user_id');
		$channel_id = Input::get('channel_id');
		if(empty($feedback)){
			return Response::json(array('status'=>'error','label' => 'The feedback field is required.'));
		}
		if(!empty($feedback)){
			$feedbacks = new Feedback;
			$feedbacks->user_id = $user_id;
			$feedbacks->channel_id = $channel_id;
			$feedbacks->feedback = $feedback;
			$feedbacks->save();

			$likesCount = DB::table('feedbacks_likesdislikes')->where(array('feedback_id' => $feedbacks->id, 'status' => 'liked'))->count();
			$dislikeCount = DB::table('feedbacks_likesdislikes')->where(array('feedback_id' => $feedbacks->id, 'status' => 'disliked'))->count();

			$ifAlreadyLiked = DB::table('feedbacks_likesdislikes')->where(array(
				'feedback_id' => $feedbacks->id, 'user_id' => $user_id,'status' => 'liked'))->first();
			$ifAlreadyDisliked = DB::table('feedbacks_likesdislikes')->where(array(
				'feedback_id' => $feedbacks->id, 'user_id' => $user_id,'status' => 'disliked'))->first();

			$userInfo = User::find($user_id);

			if(file_exists(public_path('img/user/'. $userInfo->id . '.jpg'))){
				$temp = 'img/user/'.$userInfo->id . '.jpg';
			} else{
				$temp = 'img/user/0.jpg';
			}
			$newFeedback =  
			'<div class="feedbacksarea row">
			<div class="feedbackProfilePic col-md-1">'. 
				HTML::image($temp, "alt", array("class" => "img-responsive", "height" => "48px", 'width' => '48px')).'
			</div>
			<div class="col-md-11">
				<div class="row">'.
					link_to_route("view.users.channel", $userInfo->channel_name, $parameters = array($userInfo->channel_name), $attributes = array("id" => "channel_name")) .'
					| &nbsp;<small> just now. </small> 
					<br/>
					<p class="text-justify">
						'. $feedbacks->feedback . '
					</p>
					<div class="fa fa-thumbs-up likedup">
						<input type="hidden" value="'.$feedbacks->id.'" name="likeFeedbackId">
						<input type="hidden" value='.Auth::User()->id.'" name="likeUserId">
						<input type="hidden" value="liked" name="status">
						<span class="likescount" id="likescount">'.$likesCount.'</span>
					</div>
					|&nbsp;
					<div class="fa fa-thumbs-down dislikedup">
						<input type="hidden" value="'.$feedbacks->id.'" name="dislikeFeedbackId">
						<input type="hidden" value="'.$userInfo->user_id.'" name="dislikeUserId">
						<input type="hidden" value="disliked" name="status">
						<span class="dislikescount" id="dislikescounts">'.$dislikeCount.'</span> &nbsp;
					</div>
					|&nbsp;
					<span class="repLink hand">0<i class="fa fa-reply"></i></span>
					<div id="replysection" class="panelReply"> '.
						Form::open(array("route"=>"post.viewusers.addreply-feedback", "class" => "inline")).'
						<input type="hidden" name="feedback_id" value="'.$feedbacks->id.'">
						<input type="hidden" name="user_id" value="'.$userInfo->id.'">>
						<textarea name="txtreply" id="txtreply" class="form-control txtreply"></textarea>
						<input class="btn btn-primary pull-right" id="replybutton" type="submit" value="Reply">
					</form>
				</div>
			</div>
		</div>
	</div>
	<hr/>
	';
	return Response::json(array(
		'status' => 'success',
		'feedback' => $feedback,
		'user_id' => $user_id,
		'feedback' => $newFeedback
		));
}
}


public function postAddReplyFeedback(){
	$reply = trim(Input::get('txtreply'));
	$feedback_id = Input::get('feedback_id');
	$user_id = Input::get('user_id');

	if(empty($reply)){
		return Response::json(array('status'=>'error','label' => 'The reply field is required.'));
	}
	if(!empty($reply)){
		$replies = new FeedbackReply;
		$replies->feedback_id = $feedback_id;
		$replies->user_id = $user_id;
		$replies->reply = $reply;
		$replies->save();

		$userInfo = User::find($user_id);
		if(file_exists(public_path('img/user/'. $user_id . '.jpg'))){
			$temp = 'img/user/'. $user_id . '.jpg';
		} else{
			$temp = 'img/user/0.jpg';
		}

		$newReply = 
		'<div class="commentProfilePic col-md-1">' .
		HTML::image($temp, "alt", array("class" => "img-responsive", "height" => "48px", "width" => "48px")) . 
		'</div>
		<div class="col-md-11">
			<div class="row">' .
				link_to_route("view.users.channel", $userInfo->channel_name, $parameters = array($userInfo->channel_name), $attributes = array("id" => "channel_name")) . '&nbsp|&nbsp;' .
				'<small>just now.</small><br/>
				<p style="text-align:justify;">' . $reply . '<br/>' . '</p></hr>
			</div>
		</div>	
		';
	}
	return Response::json(array('status' => 'success', 'reply' => $newReply));
}

public function postAddLiked(){
	$likeFeedbackId = Input::get('likeFeedbackId');
	$likeUserId = Input::get('likeUserId');
	$statuss = Input::get('status');

	if($statuss == 'liked'){
		DB::table('feedbacks_likesdislikes')->insert(
			array('feedback_id' => $likeFeedbackId,
				'user_id'    => $likeUserId,
				'status' 	   => 'liked'
				)
			);
		$likesCount = DB::table('feedbacks_likesdislikes')->where(array('feedback_id' => $likeFeedbackId, 'status' => 'liked'))->count();

		return Response::json(array('status' => 'success', 'likescount' => $likesCount, 'label' => 'unliked'));

	} elseif($statuss == 'unliked'){
		DB::table('feedbacks_likesdislikes')->where(array('feedback_id' => $likeFeedbackId, 'user_id' => $likeUserId, 'status' => 'liked'))->delete();
		$likesCount = DB::table('feedbacks_likesdislikes')->where(array('feedback_id' => $likeFeedbackId, 'status' => 'liked'))->count();
		return Response::json(array('status' => 'success', 'likescount' => $likesCount, 'label' => 'liked'));
	}
}

public function postAddDisLiked(){
	$dislikeFeedbackId = Input::get('dislikeFeedbackId');
	$dislikeUserId = Input::get('dislikeUserId');
	$statuss = Input::get('status');

	if($statuss == 'disliked'){
		DB::table('feedbacks_likesdislikes')->insert(
			array('feedback_id' => $dislikeFeedbackId,
				'user_id'    => $dislikeUserId,
				'status' 	   => 'disliked'
				)
			);
		$dislikesCount = DB::table('feedbacks_likesdislikes')->where(array('feedback_id' => $dislikeFeedbackId, 'status' => 'disliked'))->count();
		return Response::json(array('status' => 'success', 'dislikescount' => $dislikesCount, 'label' => 'undisliked'));
	} elseif($statuss == 'undisliked'){
		DB::table('feedbacks_likesdislikes')->where(array('feedback_id' => $dislikeFeedbackId, 'user_id' => $dislikeUserId, 'status' => 'disliked'))->delete();
		$dislikesCount = DB::table('feedbacks_likesdislikes')->where(array('feedback_id' => $dislikeFeedbackId, 'status' => 'disliked'))->count();
		return Response::json(array('status' => 'success', 'dislikescount' => $dislikesCount, 'label' => 'disliked'));
	}
}

public function getDeleteFeedback() {

	$channelId = Input::get('channel_id');
	$userId = Input::get('user_id');
	$feedback_id = Input::get('feedback_id');
	$id = Input::get('id');
	$deleteFeedback = DB::table('feedbacks')->where(array('channel_id' => $channelId, 'user_id' => $userId, 'id' => $feedback_id))->delete();
	return Response::json($deleteFeedback);
}

public function postDeleteFeedbackReply() {
	$feedbackId = Input::get('feedback_id');
	$userId = Input::get('user_id');
	$id = Input::get('id');

	$a = FeedbackReply::find($id)->delete();
	return Response::json($a);

}

public function postSpamFeedback() {

	$channelId = Input::get('channel_id');
	$userId = Input::get('user_id');
	$spamId = Input::get('spamID');
	$a = $this->ReportedFeedback->getReportCount($spamId, $channelId, $userId);

	
	return Response::json($a);
}

public function postSpamFeedbackReply() {

	$id = Input::get('reportID');
	$user_id = Input::get('user_id');
	$created_at = date('Y-m-d H:i:s');
	$updated_at = date('Y-m-d H:i:s');
	$a = DB::table('reported_replies')->insert(array('reply_id' => $id, 'user_id' => $user_id, 'created_at' => $created_at, 'updated_at' => $updated_at));

	return Response::json($a);
}

public function getViewUsersVideos($channel_name) {
	$user_id = 0;
	$userChannel = User::where('channel_name', $channel_name)->first();
	$userFeedbacks = Feedback::where('channel_id', $userChannel->id)->get();
	$usersVideos = $this->Video->getVideos($this->Auth->id);
	$allViews = DB::table('videos')->where('user_id', $userChannel->id)->sum('views');
	$countAllViews = $this->Video->countViews($allViews);
	$countVideos = Video::where('user_id', $userChannel->id)->count();
	$countSubscribers = $this->Subscribe->getSubscribers($userChannel->channel_name);
	$picture = public_path('img/user/') . $userChannel->id . '.jpg';
	return View::make('users.channels.videos', compact('userChannel', 'countSubscribers','usersChannel','usersVideos','countVideos','countAllViews','picture','user_id'));
}

public function getViewUsersFavorites($channel_name) {
	$user_id = 0;
	$userChannel = User::where('channel_name', $channel_name)->first();
	$countSubscribers = $this->Subscribe->getSubscribers($userChannel->channel_name);
	$usersChannel = UserProfile::where('user_id',$userChannel->id)->first();
	$usersVideos = User::find($userChannel->id)->video;
	$countVideos = DB::table('videos')->where('user_id', $userChannel->id)->get();
	$allViews = DB::table('videos')->where('user_id', $userChannel->id)->sum('views');
	$countAllViews = $this->Video->countViews($allViews);
	$picture = public_path('img/user/') . $userChannel->id . '.jpg';
	$findUsersVideos = $this->Favorite->getUserFavoriteVideos($userChannel->id);
	return View::make('users.channels.favorites', compact('userChannel','countSubscribers','usersChannel','usersVideos','countVideos','allViews','countAllViews','picture','findUsersVideos','user_id'));
}

public function getViewUsersWatchLater($channel_name) {
	$user_id = 0;
	$userChannel = User::where('channel_name', $channel_name)->first();
	$countSubscribers = $this->Subscribe->getSubscribers($userChannel->channel_name);
	$usersChannel = UserProfile::where('user_id',$userChannel->id)->get();
	$usersVideos = User::find($userChannel->id)->video;
	$countVideos = DB::table('videos')->where('user_id', $userChannel->id)->get();
	$allViews = DB::table('videos')->where('user_id', $userChannel->id)->sum('views');
	$countAllViews = $this->Video->countViews($allViews);
	$usersWatchLater = $this->WatchLater->getWatchLater($userChannel->id);
	$picture = public_path('img/user/') . $userChannel->id . '.jpg';
	return View::make('users.channels.watchlater', compact('userChannel','countSubscribers','usersChannel','usersVideos','countVideos','countAllViews','usersWatchLater','picture','user_id'));
}

public function getViewUsersAbout($channel_name) {
	$user_id = 0;
	$userChannel = User::where('channel_name', $channel_name)->first();
	$countSubscribers = $this->Subscribe->getSubscribers($userChannel->channel_name);
	$usersChannel = UserProfile::where('user_id',$userChannel->id)->first();
	$usersVideos = User::find($userChannel->id)->video()->where('uploaded',1)->get();
	$countVideos = DB::table('videos')->where('user_id', $userChannel->id)->get();
	$allViews = DB::table('videos')->where('user_id', $userChannel->id)->sum('views');
	$picture = public_path('img/user/') . $userChannel->id . '.jpg';
	$countAllViews = $this->Video->countViews($allViews);
	return View::make('users.channels.about', compact('userChannel','countSubscribers','usersChannel','usersVideos', 'countVideos', 'countAllViews','picture','user_id'));
}

public function getViewUsersPlaylists($channel_name) {
	$user_id = 0;
	$userChannel = User::where('channel_name', $channel_name)->first();
	$countSubscribers = $this->Subscribe->getSubscribers($userChannel->channel_name);
	$usersChannel = UserProfile::find($userChannel->id);
	$countVideos = DB::table('videos')->where('user_id', $userChannel->id)->get();
	$allViews = DB::table('videos')->where('user_id', $userChannel->id)->sum('views');
	$countAllViews = $this->Video->countViews($allViews);
	$picture = public_path('img/user/') . $userChannel->id . '.jpg';
	$playlists = Playlist::where('user_id', $userChannel->id)->where('deleted_at','=',NULL)->get();
	foreach($playlists as $playlist){
		$thumbnail_playlists[] = $this->Playlist->playlistControl(null,$playlist->id,null,null);
	}
	return View::make('users.channels.playlists', compact('userChannel','countSubscribers','usersChannel','usersVideos', 'playlists','countAllViews', 'countVideos','thumbnail_playlists','picture','user_id'));
}

public function getViewUsersSubscribers($channel_name) {
	$user_id = 0;
	$userChannel = User::where('channel_name', $channel_name)->first();
	$countSubscribers = $this->Subscribe->getSubscribers($userChannel->channel_name);
	$usersChannel = UserProfile::where('user_id',$userChannel->id)->first();
	$usersVideos = User::find($userChannel->id)->video;
	$countVideos = DB::table('videos')->where('user_id', $userChannel->id)->get();
	$allViews = DB::table('videos')->where('user_id',$userChannel->id)->sum('views');
	$countAllViews = $this->Video->countViews($allViews);
	$picture = public_path('img/user/') . $userChannel->id . '.jpg';
	$subscriberProfile = $this->Subscribe->Subscribers($userChannel->id);
	$subscriptionProfile = $this->Subscribe->Subscriptions($userChannel->id);

	return View::make('users.channels.subscribers', compact('userChannel','countSubscribers','usersChannel','usersVideos', 'subscriberProfile', 'subscriptionProfile','countAllViews', 'countVideos', 'subscriberCount','picture','user_id'));
}


public function addSubscriber() {
	$user_id = Input::get('user_id');
	$subscriber_id = Input::get('subscriber_id');
	$status = Input::get('status');
	if($status == 'subscribeOn'){
		$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $user_id, 'subscriber_id' => $subscriber_id))->count();
		if(!$ifAlreadySubscribe){
			DB::table('subscribes')->insert(array('user_id' => $user_id, 'subscriber_id' => $subscriber_id));
				//Notification
					// $this->Notification->constructNotificationMessage($user_id,$subscriber_id,'subscribed');
				//
			return Response::json(array('status' => 'subscribeOff','label' => 'Unsubscribe'));
		}
	}
	if($status == 'subscribeOff'){
		$deleteRows = Subscribe::where(array('user_id' => $user_id, 'subscriber_id' => $subscriber_id))->delete();
		return Response::json(array('status' => 'subscribeOn','label' => 'Subscribe'));
	}
}
public function createPlaylist($id,$randomNo = 11){
	$id = Crypt::decrypt($id);
	$playlistNo = str_random($randomNo);
	$checkPlaylistExist = Playlist::where('randID', '=', $playlistNo);
	if($checkPlaylistExist->count()){
		$playlistNo = str_random($randomNo+1);
	}
	$name = Input::get('name');
	$description = Input::get('description');
	$privacy = Input::get('privacy');
	$user_id = Auth::User()->id;
	$createPlaylist = Playlist::create(array('user_id'=>$user_id,'name'=>$name,'description'=>$description,'randID'=>$playlistNo,'privacy'=>$privacy));
}

public function addPlaylist($id,$randomNo = 11){
	$id = Crypt::decrypt($id);
	$playlistNo = str_random($randomNo);
	$checkPlaylistExist = Playlist::where('randID', '=', $playlistNo);
	if($checkPlaylistExist->count()){
		$playlistNo = str_random($randomNo+1);
	}
	$name = Input::get('name');
	$description = Input::get('description');
	$privacy = Input::get('privacy');
	$user_id = Auth::User()->id;
	$duplicateValidator = Playlist::where('name','=',$name)
	->where('user_id','=',Auth::User()->id);
	$duplicate = Playlist::where('name','=',$name)
	->where('user_id','=',Auth::User()->id)->first();	
	if($duplicateValidator->count()){
		$playlistDuplicate = PlaylistItem::where('playlist_id','=',$duplicate->id)
		->where('video_id','=',$id);
		if(!$playlistDuplicate->count()){
			PlaylistItem::create(array('playlist_id'=>$duplicate->id,'video_id'=>$id));
		}
	} else{
		$createPlaylist = Playlist::create(array('user_id'=>$user_id,'name'=>$name,'description'=>$description,'randID'=>$playlistNo,'privacy'=>$privacy));
		$playlistID = $createPlaylist->id;
		PlaylistItem::create(array('playlist_id'=>$playlistID,'video_id'=>$id));
	}
}
public function addChkBoxPlaylist($id){
	$id = Crypt::decrypt($id);
	$playlistId = Crypt::decrypt(Input::get('value'));
	$counter = PlaylistItem::where('video_id','=',$id)
	->where('playlist_id','=',$playlistId);
	if(!$counter->count()){
		PlaylistItem::create(array('playlist_id'=>$playlistId,'video_id'=>$id));
	}
}
public function removePlaylist($id){
	$id = Crypt::decrypt($id);
	$playlistId = Crypt::decrypt(Input::get('value'));
	$counter = PlaylistItem::where('video_id','=',$id)
	->where('playlist_id','=',$playlistId);
	if($counter->count()){
		$playlistItem = PlaylistItem::where('video_id','=',$id)
		->where('playlist_id','=',$playlistId)->first();
		$playlistItem->delete();
	}
}
public function addToFavorites($id){
	$id = Crypt::decrypt($id);
	$counter = UserFavorite::where('user_id','=',Auth::User()->id)
	->where('video_id','=',$id);
	if(!$counter->count()){
		UserFavorite::create(array('user_id'=>Auth::User()->id,'video_id'=>$id));
	}
}
public function removeToFavorites($id){
	$id = Crypt::decrypt($id);
	$counter = UserFavorite::where('user_id','=',Auth::User()->id)
	->where('video_id','=',$id);
	if($counter->count()){
		$favorite = UserFavorite::where('user_id','=',Auth::User()->id)
		->where('video_id','=',$id)->first();
		$favorite->delete();
	}					
}
public function addToWatchLater($id){
	$id = Crypt::decrypt($id);
	$counter = UserWatchLater::where('user_id','=',Auth::User()->id)
	->where('video_id','=',$id);
	if(!$counter->count()){
		$watchLater = UserWatchLater::create(array('user_id'=>Auth::User()->id,'video_id'=>$id,'status'=>0));
	}
}
public function removeToWatchLater($id){
	$id = Crypt::decrypt($id);
	$counter = UserWatchLater::where('user_id','=',Auth::User()->id)
	->where('video_id','=',$id);
	if($counter->count()){					
		$favorite = UserWatchLater::where('user_id','=',Auth::User()->id)
		->where('video_id','=',$id)->first();
		$favorite->delete();
	}			
}
public function likeVideo($id){
	$id = Crypt::decrypt($id);
	$counter = UserLike::where('user_id','=',Auth::User()->id)
	->where('video_id','=',$id);
	if(!$counter->count()){
		$like = UserLike::create(array('user_id'=>Auth::User()->id,'video_id'=>$id));
		$likeResult = UserLike::where('video_id',$id)->count();
		$dislikeResult = UserDislike::where('video_id',$id)->count();
		return Response::json(array('likeResult'=>$likeResult,'dislikeResult'=>$dislikeResult));

	}
}

public function dislikeVideo($id){
	$id = Crypt::decrypt($id);
	$counter = UserDislike::where('user_id','=',Auth::User()->id)
	->where('video_id','=',$id);
	if(!$counter->count()){
		$dislike = UserDislike::create(array('user_id'=>Auth::User()->id,'video_id'=>$id));
		$dislikeResult = UserDislike::where('video_id',$id)->count();
		$likeResult = UserLike::where('video_id',$id)->count();
		return Response::json(array('likeResult'=>$likeResult,'dislikeResult'=>$dislikeResult));

	}
}

public function unlikeVideo($id){
	$id = Crypt::decrypt($id);
	$counter = UserLike::where('user_id','=',Auth::User()->id)
	->where('video_id','=',$id);
	if($counter->count()){
		$unlike = UserLike::where('user_id','=',Auth::User()->id)
		->where('video_id','=',$id)->first();
		$unlike->delete();
		$likeResult = UserLike::where('video_id',$id)->count();
		if(empty($likeResult)){
			$likeResult = 0;
		}
		return Response::json(array('likeResult'=>$likeResult));
	}
}

public function removeDislikeVideo($id){
	$id = Crypt::decrypt($id);
	$counter = UserDislike::where('user_id','=',Auth::User()->id)
	->where('video_id','=',$id);
	if($counter->count()){
		$dislike = UserDislike::where('user_id','=',Auth::User()->id)
		->where('video_id','=',$id)->first();
		$dislike->delete();
		$dislikeResult = UserDislike::where('video_id',$id)->count();
		if(empty($dislikeResult)){
			$dislikeResult = 0;
		}
		return Response::json(array('dislikeResult'=>$dislikeResult));
	}
}

public function getNotification(){
	if(Auth::check()){
		$notifications =  $this->Notification->getNotifications(Auth::user()->id, null, '20');
		if($this->Notification->getTimePosted($notifications) === false){
			app::abort(404, 'Error');
		}
		$notifications = $this->Notification->getTimePosted($notifications);
		return View::make('users.notifications', compact('notifications'));
	}
	app::abort(404, 'Internal Server Error please contact Kevin');	
}

public function postLoadNotification(){
	$user_id = Crypt::decrypt(Input::get('uid'));
	$notifications =  $this->Notification->getNotifications($user_id, null , null, 8);
	$this->Notification->setStatus();
	return $notifications;
}

public function countNotifcation(){
	$user_id = Crypt::decrypt(Input::get('uid'));
	$notifications =  $this->Notification->getNotifications($user_id, 0);
	return Response::json($notifications);
}

public function postFeedbacks() {
	$channelName = Input::get('term');
	$name = str_replace('@', '', $channelName);
	$query = DB::select("SELECT * FROM users WHERE channel_name LIKE '%".$name."%'");
	foreach($query as $q) {
		$channelNames[] = array(
			'id' => $q->id,
			'label' => $q->channel_name
			);
	}
	return Response::json($channelNames);
}

public function getSortVideos() {

	$order = Input::get('ch');
	$user_id = Input::get('userid');
	if(Auth::check()){
		if($order == 'Likes'){
			$results = DB::select("SELECT v.id, v.user_id, v.title, v.description, v.publish, v.file_name, v.views, (SELECT COUNT(ul.video_id) FROM user_likes ul WHERE ul.user_id = v.user_id) AS likes, v.created_at, v.updated_at FROM videos v WHERE v.user_id ='" .$this->Auth->id. "'ORDER BY likes DESC");
		}elseif($order == 'Views') {
			$results = DB::select("SELECT v.id, v.user_id, v.title, v.description, v.publish, v.file_name, v.views, (SELECT COUNT(ul.video_id) FROM user_likes ul WHERE ul.user_id = v.user_id) AS likes, v.created_at, v.updated_at FROM videos v WHERE v.user_id ='" .$this->Auth->id. "'ORDER BY v.views DESC");
		}elseif($order == 'Recent'){
			$results = DB::select("SELECT v.id, v.user_id, v.title, v.description, v.publish, v.file_name, v.views, (SELECT COUNT(ul.video_id) FROM user_likes ul WHERE ul.user_id = v.user_id) AS likes, v.created_at, v.updated_at FROM videos v WHERE v.user_id ='" .$this->Auth->id. "'ORDER BY v.created_at DESC");

		}else{
			$results = DB::select("SELECT v.id, v.user_id, v.title, v.description, v.publish, v.file_name, v.views, (SELECT COUNT(ul.video_id) FROM user_likes ul WHERE ul.user_id = v.user_id) AS likes, v.created_at, v.updated_at FROM videos v WHERE v.user_id ='" .$this->Auth->id. "'AND v. publish = 0 ORDER BY v.publish DESC");
		}
		$var = '';
		foreach ($results as $result){
			if(file_exists(public_path('/videos/'.Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$result->file_name.'/'.$result->file_name.'.jpg'))){
				$thumbnail ='<img src=/videos/'.Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$result->file_name.'/'.$result->file_name.'.jpg width=100%/>';
			} else{
				$thumbnail = HTML::image('img/thumbnails/video.png');
			}

			$var = $var . 
			"<div id='list' class='col-md-3'>
			<div class='inlineVid'>		
				<span class='btn-sq'>
					<span class='dropdown'>
						<span class='dropdown-menu drop pull-right White snBg text-left' style='padding:5px 5px;text-align:center;width:auto;'>
							<li>gge</li>
							<li>gfrhgte</li>
						</span>
					</span>

					<a href=edit/".Crypt::encrypt($result->id).">
						<span title='Update Video'><button class='btn-ico btn-default'><i class='fa fa-pencil'></i></button></span>
					</a>

				</span>
				<a href=".route('homes.watch-video', array($result->file_name))." target=_blank'>		
					".$thumbnail."
				</div>

				<div class='inlineInfo'>
					<div class='v-Info'>
						".$result->title."
					</div>
				</a>
				<div class='text-justify desc hide'>
					<p>".$result->description."</p>
					<br/>
				</div>
				<div class='count'>
					<i class='fa fa-eye'></i> ".$result->views." | <i class='fa fa-thumbs-up'></i> ".$result->likes." | <i class='fa fa-calendar'></i> ".$result->created_at."
				</div>
			</div>
		</div>
		";
	}
	return $var;
}
if($order == 'Likes'){
	$results = DB::select("SELECT v.id, v.user_id, v.title, v.description, v.publish, v.file_name, v.views, (SELECT COUNT(ul.video_id) FROM user_likes ul WHERE ul.user_id = v.user_id) AS likes, v.created_at, v.updated_at FROM videos v WHERE v.user_id ='" .$user_id. "'ORDER BY likes DESC");
}elseif($order == 'Views') {
	$results = DB::select("SELECT v.id, v.user_id, v.title, v.description, v.publish, v.file_name, v.views, (SELECT COUNT(ul.video_id) FROM user_likes ul WHERE ul.user_id = v.user_id) AS likes, v.created_at, v.updated_at FROM videos v WHERE v.user_id ='" .$user_id. "'ORDER BY v.views DESC");
}elseif($order == 'Recent'){
	$results = DB::select("SELECT v.id, v.user_id, v.title, v.description, v.publish, v.file_name, v.views, (SELECT COUNT(ul.video_id) FROM user_likes ul WHERE ul.user_id = v.user_id) AS likes, v.created_at, v.updated_at FROM videos v WHERE v.user_id ='" .$user_id. "'ORDER BY v.created_at DESC");

}else{
	$results = DB::select("SELECT v.id, v.user_id, v.title, v.description, v.publish, v.file_name, v.views, (SELECT COUNT(ul.video_id) FROM user_likes ul WHERE ul.user_id = v.user_id) AS likes, v.created_at, v.updated_at FROM videos v WHERE v.user_id ='" .$user_id. "'AND v. publish = 0 ORDER BY v.publish DESC");
}

$var = '';
foreach ($results as $result){
	if(file_exists(public_path('/videos/'.$result->user_id.'-'.$result->channel_name.'/'.$result->file_name.'/'.$result->file_name.'.jpg'))){
		$thumbnail ='<img src=/videos/'.$result->user_id.'-'.$result->channel_name.'/'.$result->file_name.'/'.$result->file_name.'.jpg width=100%/>';
	}else{
		$thumbnail = HTML::image('img/thumbnails/video.png');
	}
	
	$var = $var . 
	"<div id='list' class='col-md-3'>
	<div class='inlineVid'>		
		<span class='btn-sq'>
			<span class='dropdown'>
				<span class='dropdown-menu drop pull-right White snBg text-left' style='padding:5px 5px;text-align:center;width:auto;'>
					<li>gge</li>
					<li>gfrhgte</li>
				</span>
			</span>

			<a href='#'>
				<span title='Update Video'><button class='btn-ico btn-default'><i class='fa fa-pencil'></i></button></span>
			</a>

		</span>		
		".$thumbnail."
	</div>
	
	<div class='inlineInfo'>
		<div class='v-Info'>
			".$result->title."
		</div>
		<div class='text-justify desc hide'>
			<p>".$result->description."</p>
			<br/>
		</div>
		<div class='count'>
			<i class='fa fa-eye'></i> ".$result->views." | <i class='fa fa-thumbs-up'></i> ".$result->likes." | <i class='fa fa-calendar'></i> ".$result->created_at."
		</div>
	</div>
</div>
";
}
return $var;
}

public function getAbout() {
	$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
	$usersChannel = UserProfile::find(Auth::User()->id);
	$usersVideos = User::find(Auth::User()->id)->video()->where('uploaded',1)->get();
	$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
	$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
	$picture = public_path('img/user/') . Auth::User()->id . '.jpg';
	$countAllViews = $this->Video->countViews($allViews);
	return View::make('users.mychannels.about', compact('countSubscribers','usersChannel','usersVideos', 'countVideos', 'countAllViews','picture'));
}
public function addFeedback() {
	$var = 'l';
}

public function viewSocial() {
		// $web = 'facebook';
		// return DB::table('websites')->where('user_id', $this->Auth->id)->pluck($web);
	return View::make('testing');
}

public function social($action) {

	if($action == 'auth') {
		try{
			Hybrid_Endpoint::process();
		}
		catch(Exception $e) {
			return Redirect::route('hybridauth');
		}
	}
	try{
		$socialAuth = New Hybrid_Auth(app_path(). '/config/hybridauth.php');
		$provider = $socialAuth->authenticate($action);
		$userProfile = $provider->getUserProfile();
	}
	catch (Exception $e) {
		return $e->getMessage();
	}

	$user = Website::where('user_id',$this->Auth->id)->first();
	$user->$action = $userProfile->profileURL;
	$user->save();

	return Redirect::route('users.edit.channel')->withFlashGood('Connected with'.$social.'!');
		// echo 'ID: '.$userProfile->identifier.'<br/>';
		// echo 'profileURL: '.$userProfile->profileURL.'<br/>';
		// echo 'Email: '.$userProfile->email.'<br/>';
		// echo 'displayName: '.$userProfile->displayName.'<br/>';
}
}
