<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'users';

	protected $hidden = array('password', 'remember_token');

	public function videos(){
		return $this->hasMany('Video');
	}

	public function notifications(){
		return $this->hasMany('Notification');
	}

	public function userprofile() {

		return $this->hasOne('UserProfile');
	}

	public function video() {

		return $this->hasMany('Video');
	}

	public function subscribe() {

		return $this->hasMany('Subscribe');
	}

	public function UserFavorite() {

		return $this->hasMany('UserFavorite');
	}

	public function watchlater() {

		return $this->hasMany('UserWatchLater');
	}

	public function website() {

		return $this->hasOne('Website');
	}

	public static function getUserLogin($channel_name1, $password) {
		$remember_me = Input::has('remember_me') ? true : false;
		$attempt = Auth::attempt(array('channel_name' => $channel_name1, 'password' => $password), $remember_me);
		return $attempt;
	}

	public static $userEditRules = array(
		'first_name' => 'required|regex:/(^[A-Za-z]+$)+/',
		'last_name' => 'required|regex:/(^[A-Za-z]+$)+/',
		'contact_number' => 'regex:/(^[0-9]+$)+/'
		);

	public static $userRules = array(
		'email' => 'required|email|unique:users,email',
		'channel_name' => 'required|unique:users,channel_name|regex:/(^[A-Za-z0-9 ]+$)+/',
		'password' => 'required',
		'confirm_password' =>'same:password|required',
		'first_name' => 'required|regex:/(^[A-Za-z_ -]+$)+/',
		'last_name' => 'required|regex:/(^[A-Za-z_ -]+$)+/',
		'contact_number' => 'regex:/(^[+0-9]+$)+/');

	public static $userPasswordRules = array(
		'currentPassword' => 'required',
		'newPassword' => 'required|min: 6',
		'confirmPassword' => 'required|same:newPassword');

	public static $userEmailRules = array(
		'email' => 'required|email',
		'newEmail' => 'required|email|unique:users,email',
		'password' => 'required',
		'confirmPassword' => 'required|same:password');

	public static $userLoginRules = array('channel_name1' => 'required', 'password' => 'required');

	/**
	*Save a users information to users database
	*@param $input 				array of information to be save in database
	*		$social_media_type	indicate whether your using facebook or gooole as sign up(null means you didnt use any)
	*		$social_media_id	provide the social media id that is used to connect here
	*@return bolean true
	*@throws app::error('message')
	*/
	public function signup($input,$social_media_type = null, $social_media_id = null) {

		if(!isset($input)){
			App::abort('Something went wrong please try again later');
		}

		$contact_number = null;
		if(!empty($input['contact_number'])){
			$contact_number = $input['contact_number'];
		}

		$token = null;
		if(isset($input['token'])){
			$token = $input['token'];
		}

		$account_status = 0;
		if(!empty($social_media_type)){
			$account_status = 1;
		}

		$facebook_account = null;
		$google_account = null;
		if($social_media_type == 'facebook'){
			$facebook_account = $social_media_id;
		}

		if($social_media_type == 'google'){
			$google_account = $social_media_id;
		}

		$user = new User;
		$user->email = $input['email'];
		$user->channel_name = $input['channel_name'];
		$user->password = Hash::make($input['password']);
		$user->token = $token;
		$user->verified = $account_status;
		$user->status = $account_status;
		$user->role = 1;
		$user->save();


		$userProfile = new UserProfile;
		$userProfile->first_name = $input['first_name'];
		$userProfile->user_id = $user->id;
		$userProfile->last_name = $input['last_name'];
		$userProfile->contact_number = $contact_number;
		$userProfile->save();

		$website = new Website;
		$website->user_id = $user->id;
		$website->google = $google_account;
		$website->facebook = $facebook_account;
		$website->save();

		return true;
	}

	/**
	*@param $social_media_id 		Contains the social media use by the user to sign in
	*@return $user 					Contains informations of the user who signed in
	*@throws boolean false
	*/
	public function signInWithSocialMedia($social_media_id){
		$find_social_media_account = Website::where('google', $social_media_id)->orWhere('facebook', $social_media_id)->get();
		if($find_social_media_account->isEmpty()){
			return false;
		}

		$user = User::find($find_social_media_account->first()->user_id);
		Auth::login($user);

		return $user;
	}

	public function getTopChannels($limit = null){
		$userData = User::select(
			'users.id',
			'channel_name',
			'organization',
			'interests',
			DB::raw('(SELECT SUM(videos.views) AS views FROM videos WHERE videos.user_id = users.id) AS views'),
			DB::raw('(Select count(subscribes.user_id) from subscribes where subscribes.user_id = users.id) as subscribers'))
		->take($limit)
		->join('users_profile', 'users_profile.user_id', '=', 'users.id')
		->orderBy('views', 'DESC')
		->get();

		foreach($userData as $key => $user){
			$userData[$key]->profile_picture = $this->addProfilePicture($user->id);

			if(Auth::check()){
				$userData[$key]->ifsubscribe = $this->checkSubscription(Auth::user()->id, $user->id);
			}

			$subscribe = new Subscribe();
			$userData[$key]->subscribers = $subscribe->getSubscribers($user->channel_name, 5);
		}
		return $userData;
	}

	public function addProfilePicture($user_id){
		$img = '/img/user/'. $user_id. '.jpg';
		if(!file_exists(public_path($img))){
			$img = '/img/user/0.jpg';
		}
		return $img;
	}

	/** getUsersImages
	*
	*@param $users_id		Contains the social media use by the user to sign in
	*		$cover_photo	Specify true if you want to include in the search and return
	*@return $Images 		Contains informations of the user who signed in
	*@throws boolean false
	*/
	public function getUsersImages($user_id = null, $cover_photo = false){
		if(empty($user_id)){
			return false;
		}

		if($cover_photo === true){
			$default_cover_photo_path = 'img/user/cover.jpg';

			$cover_photo_path = 'img/user/'.$user_id.'/cover_photo.jpg';
			$original_cover_photo_path = 'img/user/'.$user_id.'/cover_photo_original.jpg';
			$image['cover_photo'] = $default_cover_photo_path;
			$image['cover_photo_original'] = $default_cover_photo_path. '?'. rand(0,100);
			if(file_exists(public_path($cover_photo_path)) && file_exists(public_path($original_cover_photo_path))){
				$image['cover_photo'] = $cover_photo_path . '?'. rand(0,100);
				$image['cover_photo_original'] = $original_cover_photo_path. '?'. rand(0,100);
			}
		}

		$default_profile_picture_path = 'img/user/0.jpg';
		$profile_picture_path = 'img/user/'.$user_id.'/profile_picture.jpg';
		$image['profile_picture'] = $default_profile_picture_path. '?'. rand(0,100);
		if(file_exists(public_path($profile_picture_path))){
			$image['profile_picture'] = $profile_picture_path. '?'. rand(0,100);
		}

		return $image;
		
	}

	public function checkSubscription($subscriber_id, $subscription_id){
		$ifsubscribe = Subscribe::where('user_id', $subscription_id)->where('subscriber_id', $subscriber_id)->first();
		$data = 'No';
		if(isset($ifsubscribe)){
			$data = 'Yes';
		}
		return $data;
	}

	public function setVerifyStatus($verify_status, $user_id){
		$user = User::find($user_id);
		$user->verified = '1';
		$user->status = '1';
		$user->token = '';
		$user->save();

		return true;
	}

	/**
	*@param $password    	contains new password
	*       $user_id 		contains the id of the user you want to change the password
	*@return boolean true
	*@throws App::abort('message')
	*/
	public function renewPassword($password = null, $user_id = null){
		if(empty($password) || empty($user_id)){
			app::abort('Something went wrong please try again later');
		}

		$generateToken = null;
		$user = User::find($user_id);
		if($user->verified == '0'){
			$generateToken = Crypt::encrypt($password + rand(10,100));
		}

		$user = User::find($user_id);
		$user->password = Hash::make($password);
		$user->token = $generateToken;
		$user->save();

		return true;
	}
}