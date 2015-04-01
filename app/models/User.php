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

		return $this->hasOne('userProfile');
	}

	public function video() {

		return $this->hasMany('Video');
	}

	public function subscribe() {

		return $this->hasMany('Subscribe');
	}

	public function favorite() {

		return $this->hasMany('Favorite');
	}

	public function watchlater() {

		return $this->hasMany('WatchLater');
	}

	public function website() {

		return $this->hasOne('Website');
	}

	public static function getUserLogin($channel_name, $password) {
		$remember_me = Input::has('remember_me') ? true : false;
		$attempt = Auth::attempt(array('channel_name' => $channel_name, 'password' => $password), $remember_me);
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
		'confirm_password' =>'same:password',
		'first_name' => 'required|regex:/(^[A-Za-z]+$)+/',
		'last_name' => 'required|regex:/(^[A-Za-z]+$)+/',
		'contact_number' => 'regex:/(^[+0-9]+$)+/');

	public static $userPasswordRules = array(
		'currentPassword' => 'required',
		'newPassword' => 'required|min: 6',
		'confirmPassword' => 'same:newPassword');

	public static $userEmailRules = array(
		'email' => 'required|email',
		'newEmail' => 'required|email',
		'password' => 'required',
		'confirmPassword' => 'same:password');

	public static $userLoginRules = array('channel_name' => 'required', 'password' => 'required');

	public function signup($token) {
		$user = new User;
		$user->email = Input::get('email');
		$user->channel_name = Input::get('channel_name');
		$user->password = Hash::make(Input::get('password'));
		$user->token = $token;
		$user->save();

		$userProfile = new UserProfile;
		$userProfile->first_name = Input::get('first_name');
		$userProfile->user_id = $user->id;
		$userProfile->last_name = Input::get('last_name');
		$userProfile->contact_number = Input::get('contact_number');
		$userProfile->save();

		return true;
	}
	
	public function getRandomChannels(){
		return db::select('SELECT users.id, users.channel_name, users.organization, users_profile.interests, 
	videos.user_id, SUM(videos.views) AS total
			FROM videos INNER JOIN users ON 
			videos.user_id = users.id
			INNER JOIN users_profile ON
			videos.user_id = users_profile.user_id 
			GROUP BY videos.user_id 
			ORDER BY RAND()
			LIMIT 16
			');
	}

	public function getTopChannels($limit = null){
		return DB::select('SELECT users.id, users.channel_name, users.organization, users_profile.interests, 
			videos.user_id, SUM(videos.views) AS total, (Select count(subscribes.user_id) from subscribes where subscribes.user_id = users.id) as subscribers
			FROM videos INNER JOIN users ON 
			videos.user_id = users.id
			INNER JOIN users_profile ON
			videos.user_id = users_profile.user_id 
			GROUP BY videos.user_id 
			ORDER BY subscribers DESC
			LIMIT '.$limit.'
			');
	}

	public function setVerifyStatus($verify_status, $user_id){
		$user = User::find($user_id);
		$user->verified = '1';
		$user->status = '1';
		$user->token = '';
		$user->save();

		return true;
	}

	public function renewPassword($password = null, $user_id = null){
		if(!empty($password) && !empty($user_id)){
			$user = User::find($user_id);
			$user->password = Hash::make($password);

			if($user->verified == '0'){
				$generateToken = Crypt::encrypt($user->email + rand(10,100));
				$user->token = $generateToken;
			}else{
				$user->token = null;
			}

			$user->save();
			return true;
		}
		return false;
	}
}
