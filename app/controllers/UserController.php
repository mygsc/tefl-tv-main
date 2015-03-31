<?php

class UserController extends BaseController {

	public function __construct(User $user, Subscribe $subscribes, Notification $notification, Video $video, WatchLater $watchLater){
		$this->Notification = $notification;
		$this->Video = $video;
		$this->Subscribe = $subscribes;
		$this->User = $user;
		define('DS', DIRECTORY_SEPARATOR); 
		$this->Auth = Auth::User();
		$this->WatchLater = $watchLater;
	}

	public function getSignIn() { 
		if(Auth::check()) return Redirect::route('homes.index');
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

	public function postForgotPassword(){
		$generateToken = Crypt::encrypt(Input::get('email') + rand(10,100));

		$validator = Validator::make(
			array('email' => Input::get('email')),
			array('email' => 'required|email'));	

		$findUser = User::where('email', Input::get('email'))->get();
		if($validator->fails() || $findUser->isEmpty()){
			return Redirect::route('homes.signin')->with('flash_message', 'Please enter a valid E-mail address');
		}

		$data = array(
			'url' => route('homes.resetpassword', $generateToken),
			'first_name' => Input::get('first_name'));

		Mail::send('emails.users.forgotpassword', $data, function($message) {
			$getUserInfo = User::where('email', Input::get('email'))->first();
			$message->to($getUserInfo->email)->subject('TEFL-TV forgot password');
		});

		$user = User::find($findUser->first()->id);
		$user->token = $generateToken;
		$user->save();

		return Redirect::route('homes.signin')->with('flash_message', 'An email was sent to your email address '. Input::get('email'). '. Please check both your Inbox and Spam.');

	}

	public function getResetPassword($token = null){
		$findUser = User::where('token', $token)->get();

		if($findUser->isEmpty()){
			return app::abort(404, 'Page not available');
		}
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
				return Redirect::route('homes.signin')->with('flash_message', 'Password has been renewed');
			}
		}
		return Redirect::route('homes.resetpassword', $input['token'])->withErrors($validator)->withInput();
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

		$datas = $this->User->getTopChannels(10);

		//Insert additional data to $datas
		foreach($datas as $key => $channels){
			$img = 'img/user/'. $channels->id. '.jpg';
			if(!empty($auth)){
				$datas[$key]->ifsubscribe = Subscribe::where(array('user_id' => $auth->id, 'subscriber_id' => $channels->id))->first();
			}
			if(!file_exists('public/'.$img)){
				$img = 'img/user/0.jpg';
			}
			$datas[$key]->image_src = $img;
			$datas[$key]->subscribers = $this->Subscribe->getSubscribers($channels->channel_name, 10);
		}
		//End of insert

		return View::make('homes.topchannels', compact(array('datas','auth')));
	}

	public function getMoreTopChannels(){
		$datas = $datas = $this->User->getTopChannels('50');
		$auth = Auth::user();

		foreach($datas as $key => $channels){
			$profilePicture = 'img/user/'. $channels->id. '.jpg';
			if(!empty($auth)){
				$datas[$key]->ifsubscribe = Subscribe::where(array('user_id' => $auth->id, 'subscriber_id' => $channels->id))->first();
			}
			if(!file_exists(public_path($profilePicture))){
				$profilePicture = 'img/user/0.jpg';
			}
			$datas[$key]->image_src = $profilePicture;
			$datas[$key]->subscribers = $this->Subscribe->getSubscribers($channels->channel_name, 10);
		}

		$usersChannel = UserProfile::find(Auth::User()->id);

		return View::make('homes.moretopchannels', compact(array('datas','auth')));
	}

	public function getUsersChannel($subscriberLists = array(), $subscriptionLists = array() ) {

		$usersChannel = UserProfile::where('user_id',Auth::User()->id)->first();
		
		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);
		$usersWebsite = Website::where('user_id', Auth::User()->id)->first();


		$subscriberProfile = DB::select('SELECT *,(SELECT COUNT(s2.id) FROM subscribes s2 WHERE s2.user_id = s.subscriber_id) 
			AS numberOfSubscribers FROM subscribes AS s 
			INNER JOIN users AS u ON s.subscriber_id = u.id WHERE s.user_id = "'.Auth::User()->id.'"LIMIT 5');

		$subscriptionProfile = DB::select('SELECT *,(SELECT COUNT(s2.id) FROM subscribes s2 WHERE s2.user_id = s.user_id) 
		AS numberOfSubscribers from subscribes AS s 
		INNER JOIN users AS u ON s.user_id = u.id WHERE s.subscriber_id = "'.Auth::User()->id.'"LIMIT 5');


		$usersVideos = Video::where('user_id', Auth::User()->id)->paginate(6);
		$usersPlaylists = Playlist::where('user_id', Auth::User()->id)->paginate(6);
		foreach($usersPlaylists as $playlist){
				$thumbnail_playlists[] = DB::select("SELECT DISTINCT v.*,u.channel_name,p.id,p.name as playlist_id FROM playlists p
			LEFT JOIN playlists_items i ON p.id = i.playlist_id
			INNER JOIN videos v ON i.video_id = v.id
			INNER JOIN users u ON v.user_id = u.id
			WHERE i.playlist_id = '".$playlist->id."'
			and v.deleted_at IS NULL
			or v.report_count > 5
			and v.publish = 1");
			}
		$increment = 0;
		$recentUpload = DB::table('videos')->where('user_id', Auth::User()->id)->orderBy('created_at','desc')->first();
		return View::make('users.channel', compact('usersChannel', 'usersVideos','recentUpload', 'countSubscribers', 'increment', 'countVideos', 'countAllViews','usersPlaylists', 'subscriberProfile','subscriptionProfile','subscriberCount','usersWebsite','subscriptionCount','thumbnail_playlists')); 

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
					return Redirect::route('users.edit.channel')->withFlashMessage('Successfully Updated!');
				}else{
					$file = Input::file('image')->move($path, $newName);
					return Redirect::route('users.edit.channel')->withFlashMessage('Successfully Created New Picture!');
				}
			}else{
				return Redirect::route('users.edit.channel')->withFlashMessage('Error Uploading image must be .jpeg, .jpg, .png');
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


				if(file_exists($coverPhoto))
				{
					File::delete($coverPhoto);
					$file = Input::file('coverPhoto')->move($path, $newName);
					return Redirect::route('users.channel')->withFlashMessage('Successfully Updated!');
				}else{
					$file = Input::file('coverPhoto')->move($path, $newName);
					return Redirect::route('users.channel')->withFlashMessage('Successfully Created New Picture!');
				}
			}else{
				return Redirect::route('users.channel')->withFlashMessage('Error Uploading image must be .jpeg, .jpg, .png');
			}
		}
	}

	public function getEditUsersChannel() {

		$userChannel = UserProfile::where('user_id',Auth::User()->id)->first();
		$userWebsite = Website::where('user_id', Auth::User()->id)->first();
		$picture = public_path('img/user/') . Auth::User()->id . '.jpg';

		return View::make('users.editchannel', compact('userChannel','userWebsite', 'picture'));
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
				$userWebsite = new Website;
				$userWebsite->user_id = Auth::User()->id;
				$userWebsite->facebook = Input::get('facebook');
				$userWebsite->twitter = Input::get('twitter');
				$userWebsite->instagram = Input::get('instagram');
				$userWebsite->gmail = Input::get('gmail');
				$userWebsite->others = Input::get('others');
				$userWebsite->save();
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
			return Redirect::route('users.edit.channel')->withErrors($validate);
		}

		return Redirect::route('users.channel')->withFlashMessage('Successfully updated your channel!');

	}

	public function getMyVideos() {

		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video()->where('uploaded',1)->get();
		$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);

		return View::make('users.videos', compact('countSubscribers','usersChannel','usersVideos', 'countVideos', 'countAllViews'));
	}

	public function getMyFavorites() {

		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video;
		$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);

		$findUsersVideos = DB::select("SELECT uf.id, uf.user_id, uf.video_id, uf.created_at, uf.updated_at, v.title, v.likes, v.views, v.file_name, v.description, u.channel_name FROM users_favorite AS uf
			INNER JOIN videos as v ON uf.video_id = v.id
			INNER JOIN users as u ON uf.user_id = u.id WHERE uf.user_id = '".$this->Auth->id."'");
// return $findUsersVideos;
		return View::make('users.favorites', compact('countSubscribers','usersChannel','usersVideos', 'findUsersVideos','countAllViews', 'countVideos'));
	}

	public function postRemoveFavorites($id) {

		$deleteFavorite = Favorite::find($id);
		$deleteFavorite->delete();
		return Redirect::route('users.channel')->withFlashMessage('Selected video deleted');
	}

	public function getedit($id){
		$id = Crypt::decrypt($id);
		$video = Video::find($id);
		$owner = User::find($video->user_id);
		if($video->user_id != Auth::User()->id){
			return Redirect::route('users.channel');
		}
		$tags = explode(',',$video->tags);
		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video;
		$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);
		$findUsersVideos = Favorite::where('user_id', Auth::User()->id)->get();
		
		return View::make('users.updatevideos', compact('countSubscribers','usersChannel','usersVideos', 'findUsersVideos','countAllViews', 'countVideos','video','tags','owner'));
	}
	public function postedit($id){
		$input = Input::all();
		$poster = Input::file('poster');
		$fileName = Input::get('filename');
		$userFolderName = $this->Auth->id .'-'.$this->Auth->channel_name;
		$destinationPath =  public_path('videos'.DS. $userFolderName.DS.$fileName.DS);
		$validator = Validator::make($input,Video::$video_edit_rules);
		if($validator->passes()){
			if(Input::hasFile('poster')){
				if(file_exists($destinationPath.$fileName.'.jpg')){
					File::delete($destinationPath.$fileName.'.jpg'); 
				}
				$resizeImage = Image::make($poster->getRealPath())->resize(1280,720)->save($destinationPath.$fileName.'.jpg');
			}
		$id = Crypt::decrypt($id);
		$video = Video::find($id);
		$video->title = Input::get('title');
		$video->description = Input::get('description');
		$video->publish = Input::get('publish');
		if(Input::get('new_tags') != null){
			$video_tag = Video::where('id',$id)->first()->toArray();
			$new_tags = explode(',',Input::get('new_tags'));
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
		return Redirect::route('video.edit.get',Crypt::encrypt($id))->withFlashMessage('Successfully updated');
		}

		return Redirect::route('video.edit.get',$id)->withErrors($validator)->withFlashMessage('Fill up the required fields');
		
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
		
		return View::make('users.changepassword');
	}

	public function getWatchLater() {
		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video;
		$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);
		$usersWatchLater = $this->WatchLater->getWatchLater($this->Auth->id);

		return View::make('users.watchlater', compact('countSubscribers','usersChannel','usersVideos', 'videosWatchLater', 'watch','countAllViews', 'countVideos','findUsersWatchLaters', 'usersWatchLater'));
	}

	public function postDeleteWatchLater($id) {
		return 'ANG GANDA MO CESS :D PAAYOS PO TONG BUHHTTTOON';
	}

	public function postWatchLater() {
		$user_id = Input::get('user_id');
		$video_id = Input::get('video_id');
		$database_userid = WatchLater::where('user_id', $user_id)->first();
		$database_videoid = WatchLater::where('video_id', $video_id)->first();

		if($user_id == $database_userid->user_id && $video_id == $database_videoid->video_id){

			$watchlater = WatchLater::where(array('user_id' => $database_userid->user_id, 'video_id' => $database_videoid->video_id))->update(['status' => 1]);
		}

	}

	public function getPlaylists() {

		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$usersChannel = UserProfile::find(Auth::User()->id);
		$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);

		$playlists = Playlist::where('user_id', Auth::User()->id)->get();
			foreach($playlists as $playlist){
				$thumbnail_playlists[] = DB::select("SELECT DISTINCT v.*,u.channel_name,p.id,p.name as playlist_id FROM playlists p
			LEFT JOIN playlists_items i ON p.id = i.playlist_id
			INNER JOIN videos v ON i.video_id = v.id
			INNER JOIN users u ON v.user_id = u.id
			WHERE i.playlist_id = '".$playlist->id."'
			and v.deleted_at IS NULL
			or v.report_count > 5
			and v.publish = 1");
			}
		return View::make('users.playlists', compact('countSubscribers','usersChannel','usersVideos', 'playlists','countAllViews', 'countVideos','thumbnail_playlists'));
	}
	public function getViewPlaylistVideo($id){
		$id = Crypt::decrypt($id);
		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$usersChannel = UserProfile::find(Auth::User()->id);
		$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);

		$videos = DB::select("SELECT DISTINCT v.*,u.channel_name,p.id as playlist_id FROM playlists p
			LEFT JOIN playlists_items i ON p.id = i.playlist_id
			INNER JOIN videos v ON i.video_id = v.id
			INNER JOIN users u ON v.user_id = u.id
			WHERE i.playlist_id = '".$id."'
			and v.deleted_at IS NULL
			or v.report_count > 5
			and v.publish = 1");
		$playlist = Playlist::where('id',$id)->first();
		return View::make('users.viewplaylistvideo', compact('playlist','countSubscribers','usersChannel','usersVideos', 'playlists','countAllViews', 'countVideos','videos'));

	}

	public function getFeedbacks() {
		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video;
		$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);

		$userComments = DB::select("SELECT c.id, c.video_id, c.user_id, c.comment, c.likes, c.dislikes, 
			c.spam_count, c.created_at, c.updated_at, u.channel_name FROM comments AS c 
			INNER JOIN users as u ON u.id = c.user_id 
			WHERE c.user_id = '" .Auth::User()->id."'");
		// return $userComments;
		return View::make('users.feedbacks', compact('countSubscribers','usersChannel','usersVideos','countAllViews', 'countVideos','userComments'));
	}

	public function editplaylistTitle($id){
		$id = Crypt::decrypt($id);
		$name = Input::get('name');
		$playlist = Playlist::find($id);
		$playlist->name = $name;
		$playlist->save();
		//return Response::json($id);
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

		$subscribers = User::find(Auth::User()->id)->subscribe;
		$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);

		$subscribers = Subscribe::where('user_id', Auth::User()->id)->get();

		foreach ($subscribers as $subscriber) {
			$subscriberProfile[] = UserProfile::where('user_id',$subscriber->subscriber_id)->first();
			$subscriberCount = DB::table('subscribes')->where('user_id', $subscriber->subscriber_id)->get();			
		}

		$subscriptions = Subscribe::where('subscriber_id', Auth::User()->id)->get();

		foreach($subscriptions as $subscription) {
			$subscriptionProfile[] = UserProfile::where('user_id', $subscription->user_id)->first();
		}
		return View::make('users.subscribers', compact('countSubscribers','usersChannel','usersVideos', 'subscriberProfile', 'subscriptionProfile','countAllViews', 'countVideos', 'subscriberCount'));
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
		// if(empty($usersVideos)) {
		// 	return Redirect::route('users.viewusers.channel', compact('usersVideos'))->withFlashMessage('Channel does not exist');
		// }
		$videosChannelName = User::where('channel_name', $channel_name)->first();
		$findVideos = Video::where('user_id', $videosChannelName->id)->paginate(6);
		$userSubscribe = User::where('channel_name', $channel_name)->first();


		$subscribers = DB::select('SELECT *,(SELECT COUNT(s2.id) FROM subscribes s2 WHERE s2.user_id = s.subscriber_id) 
			AS numberOfSubscribers FROM subscribes AS s 
			INNER JOIN users AS u ON s.subscriber_id = u.id WHERE s.user_id = "'.$userChannel->id.'"ORDER BY DESC LIMIT 5');

		$subscriptions = DB::select('SELECT *,(SELECT COUNT(s2.id) FROM subscribes s2 WHERE s2.user_id = s.user_id) 
		AS numberOfSubscribers from subscribes AS s 
		INNER JOIN users AS u ON s.user_id = u.id WHERE s.subscriber_id = "'.$userChannel->id.'"ORDER BY DESC LIMIT 5');

		$recentUpload = Video::where('user_id', $userChannel->id)->orderBy('created_at', 'desc')->first();
		// return $recentUpload;

		$usersPlaylists = Playlist::where('user_id', $userChannel->id)->paginate(6);
		// $ifAlreadySubscribe = Subscribe::where(array('user_id' => $user_id, 'subscriber_id' => $subscriber_id));

		return View::make('users.viewusers', compact('userChannel', 'findVideos', 'subscribers', 'subscriptions', 'user_id', 'ifAlreadySubscribe','recentUpload', 'usersPlaylists', 'usersVideos'));
	}
	public function addSubscriber() {
		$user_id = Input::get('user_id');
		$subscriber_id = Input::get('subscriber_id');
		$status = Input::get('status');

		if($status == 'subscribeOn'){
			$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $user_id, 'subscriber_id' => $subscriber_id))->count();
			if(!$ifAlreadySubscribe){
				$subscribe = new Subscribe;
				$subscribe->user_id = $user_id;
				$subscribe->subscriber_id = $subscriber_id;
				$subscribe->save();

				//Notif() here

				return Response::json(array(
					'status' => 'subscribeOff',
					'label' => 'Unsubscribe'
				));
			}
		}
		if($status == 'subscribeOff'){
			$deleteRows = Subscribe::where(array('user_id' => $user_id, 'subscriber_id' => $subscriber_id))->delete();
			return Response::json(array(
				'status' => 'subscribeOn',
				'label' => 'Subscribe'
			));
		}
	}
	public function createPlaylist($id){
		$id = Crypt::decrypt($id);
		$name = Input::get('name');
		$description = Input::get('description');
		$privacy = Input::get('privacy');
		$user_id = Auth::User()->id;
		$createPlaylist = Playlist::create(array('user_id'=>$user_id,'name'=>$name,'description'=>$description,'privacy'=>$privacy));
	}

	public function addPlaylist($id){
		$id = Crypt::decrypt($id);
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
		}else{
			$createPlaylist = Playlist::create(array('user_id'=>$user_id,'name'=>$name,'description'=>$description,'privacy'=>$privacy));
			$playlistID = $createPlaylist->id;
			PlaylistItem::create(array('playlist_id'=>$playlistID,'video_id'=>$id));
		}
	}
	public function addChkBoxPlaylist($id){
		$id = Crypt::decrypt($id);
		$playlistId = Crypt::decrypt(Input::get('value'));
		PlaylistItem::create(array('playlist_id'=>$playlistId,'video_id'=>$id));
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
		$counter = Favorite::where('user_id','=',Auth::User()->id)
		->where('video_id','=',$id);
		if(!$counter->count()){
			Favorite::create(array('user_id'=>Auth::User()->id,'video_id'=>$id));
		}
	}
	public function removeToFavorites($id){
		$id = Crypt::decrypt($id);
		$counter = Favorite::where('user_id','=',Auth::User()->id)
		->where('video_id','=',$id);
		if($counter->count()){
			$favorite = Favorite::where('user_id','=',Auth::User()->id)
			->where('video_id','=',$id)->first();
			$favorite->delete();
		}					
	}
	public function addToWatchLater($id){
		$id = Crypt::decrypt($id);
		$counter = WatchLater::where('user_id','=',Auth::User()->id)
		->where('video_id','=',$id);
		if(!$counter->count()){
			$watchLater = WatchLater::create(array('user_id'=>Auth::User()->id,'video_id'=>$id,'status'=>0));
		}
	}
	public function removeToWatchLater($id){
		$id = Crypt::decrypt($id);
		$counter = WatchLater::where('user_id','=',Auth::User()->id)
		->where('video_id','=',$id);
		if($counter->count()){					
			$favorite = WatchLater::where('user_id','=',Auth::User()->id)
			->where('video_id','=',$id)->first();
			$favorite->delete();
		}			
	}
	public function likeVideo($id){
		$id = Crypt::decrypt($id);
		$counter = Like::where('user_id','=',Auth::User()->id)
		->where('video_id','=',$id);
		if(!$counter->count()){
			$like = Like::create(array('user_id'=>Auth::User()->id,'video_id'=>$id));
		}
	}

	public function unlikeVideo($id){
		$id = Crypt::decrypt($id);
		$counter = Like::where('user_id','=',Auth::User()->id)
		->where('video_id','=',$id);
		if($counter->count()){
			$unlike = Like::where('user_id','=',Auth::User()->id)
			->where('video_id','=',$id)->first();
			$unlike->delete();
		}
	}

	public function getNotification(){
		$notifications =  $this->Notification->getNotifications(Auth::user()->id, null, '20');
		
		if($this->Notification->getTimePosted($notifications) === false){
			app::abort(404, 'Error');
		}

		$notifications = $this->Notification->getTimePosted($notifications);
		return View::make('users.notifications', compact('notifications'));
	}

	public function postLoadNotification(){
		$user_id = Crypt::decrypt(Input::get('uid'));
		$notifications =  $this->Notification->getNotifications($user_id, null , null, 8);
		$this->Notification->setStatus();
		return $notifications;
	}

	public function postCountNotification(){
		$user_id = Crypt::decrypt(Input::get('uid'));
		$notifications =  $this->Notification->getNotifications($user_id, 0);

		return $notifications;
	}

	public function postFeedbacks() {

		$channelName = Input::get('term');
		$name = str_replace('@', '', $channelName);
		$query = DB::select("SELECT * FROM users WHERE channel_name LIKE '%".$name."%'");
		// $query = DB::table('users')->where('channel_name', 'LIKE', '%' .$channelName. '%')->get();
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
		$auth = Auth::User()->id;

		if($order == 'Likes'){
			$results = DB::select("SELECT id, user_id, title, description, publish, file_name, views, likes,created_at, updated_at FROM videos WHERE user_id ='" .$auth. "'ORDER BY likes DESC");

		}else{

			$results = DB::select("SELECT id, user_id, title, description, publish, file_name, views, likes,created_at, updated_at FROM videos WHERE user_id ='" .$auth. "'ORDER BY created_at DESC");
		}
		$var = '';

		foreach ($results as $result){
				if(file_exists(public_path('/videos/'.Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$result->file_name.'/'.$result->file_name.'.jpg'))){
					$thumbnail ="<video poster='/videos/'".Auth::User()->id."'-'".Auth::User()->channel_name."'/'".$result->file_name."'/'".$result->file_name."'.jpg'  width='100%'/>
										<source src='/videos/'".Auth::User()->id."'-'".Auth::User()->channel_name."'/'".$result->file_name."'/'".$result->file_name."'.mp4' type='video/mp4'/>
								</video>";
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
			</div>";
			}
			return $var;
		}

	public function getAbout() {

		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video()->where('uploaded',1)->get();
		$countVideos = DB::table('videos')->where('user_id', Auth::User()->id)->get();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->countViews($allViews);

		return View::make('users.about', compact('countSubscribers','usersChannel','usersVideos', 'countVideos', 'countAllViews'));

	}
	public function addFeedback() {

		$var = 'l';

	}
}
