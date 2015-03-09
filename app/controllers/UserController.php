<?php

class UserController extends BaseController {

	public function __construct(User $user){

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
					return Redirect::route('homes.index')->with('flash_message', 'Welcome '.$input['channel_name']);
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
		$topChannels = DB::select('select users.id, users.channel_name, 
			videos.user_id, sum(videos.views) as total
			from videos inner join users on 
			videos.user_id = users.id 
			group by user_id 
			order by total DESC
			LIMIT 10');

		foreach($topChannels as $key => $channels){
			$img = 'img/user/'. $channels->id. '.jpg';
			if(!file_exists('public/'.$img)){
				$img = 'img/user/0.jpg';
			}
			$topChannels[$key]->image_src = $img;
		}

		return View::make('homes.topchannels', compact(array('topChannels')));
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

		return View::make('homes.moretopchannels', compact(array('topChannels')));
	}

	public function getUsersChannel($id, $subscriberLists = array(), $subscriptionLists = array() ) {

		$usersChannel = UserProfile::find(Auth::User()->id);

		$usersVideos = User::find(3)->video;

		$subscribers = User::find(Auth::User()->id)->subscribe;

		$countSubscribers = DB::table('subscribe')->where('user_id', Auth::User()->id)->get();
		
		// $countSubscriptions = DB::table('subscribe')->where('subscriber', Auth::User()->id)->get();
		
		foreach($subscribers as $a){
			$subscriber_id[] = $a->subscriber;
		}

		// return $subscriber_id;

		if(isset($subscriber_id)){
			$subscriberLists = UserProfile::find($subscriber_id);
			$ifNoSubscriber = false;
		} else{
			$subscriberLists = array();
			$ifNoSubscriber = true;
		} 

		// return $subscriberLists;

		foreach($subscriberLists as $key => $listSubscriber){
			$subscriberCount = DB::table('subscribe')->where('subscriber', $listSubscriber->id)->get();
			$subscriberLists[$key]->count = count($subscriberCount);
		}

		// return $subscriberLists;


		
		$subscriptions = Subscribe::where('subscriber', Auth::User()->id)->get();
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
			$subscriptionCount = DB::table('subscribe')->where('user_id', $listSubscription->id)->get();
			$subscriptionLists[$key]->count = count($subscriptionCount);
		}

		// return $subscriptionLists;



		foreach($subscriptionLists as $key => $listSubscription) {
			$subscriptionCount = Db::table('subscribe')->where('user_id', $listSubscription->id)->get();
			$subscriptionLists[$key]->count = count($subscriptionCount);
		}


		return View::make('users.channel', compact('usersChannel', 'usersVideos', 'subscriberLists','subscriptionLists', 'ifNoSubscriber', 'countSubscribers'));
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

		return View::make('');
	}


	public function getUsersChangePassword() {
		
		return View::make('users.changepassword');
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



		$userChannel = User::where('channel_name', $channel_name)->first();


		$usersVideos = User::find(Auth::User()->id)->video;

		$subscribers = User::find(Auth::User()->id)->subscribe;

		foreach($subscribers as $a){
			$subscriber_id[] = $a->subscriber;
		}

		$subscriberLists = UserProfile::find($subscriber_id);



		$subscriberLists = UserProfile::find($subscriber_id);
		
		$subscriptions = Subscribe::where('subscriber', Auth::User()->id)->paginate(15);
		foreach ($subscriptions as $b) {
			$subscriptioned = UserProfile::where('user_id', $b->user_id)->get();
			$subscriptionLists[] = $subscriptioned;

		}

		return View::make('users.viewusers', compact('userChannel', 'usersVideos', 'subscriberLists', 'subscriptionLists'));
	}

}
