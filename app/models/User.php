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

	public function userprofile() {

		return $this->hasOne('userProfile');
	}

	public function video() {

		return $this->hasMany('Video');
	}

	public function subscribe() {

		return $this->hasMany('Subscribe');
	}

	public static function getUserLogin($channel_name, $password) {
		$remember_me = Input::has('remember_me') ? true : false;
		$attempt = Auth::attempt(array('channel_name' => $channel_name, 'password' => $password), $remember_me);
		return $attempt;
	}

	public static $userEditRules = array(
		'organization' => 'required',
		'first_name' => 'required|regex:/(^[A-Za-z]+$)+/',
		'last_name' => 'required|regex:/(^[A-Za-z]+$)+/',
		'contact_number' => 'required|regex:/(^[0-9]+$)+/',
		'address' => 'required',
		'birthdate' => 'required');

	public static $userRules = array(
		'email' => 'required|email|unique:users',
		'channel_name' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
		'password' => 'required',
		'confirm_password' =>'same:password',
		'first_name' => 'required|regex:/(^[A-Za-z]+$)+/',
		'last_name' => 'required|regex:/(^[A-Za-z]+$)+/',
		'contact_number' => 'regex:/(^[0-9]+$)+/');

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

		$userProfile = new userProfile;
		$userProfile->first_name = Input::get('first_name');
		$userProfile->user_id = $user->id;
		$userProfile->last_name = Input::get('last_name');
		$userProfile->contact_number = Input::get('contact_number');
		$userProfile->save();

		return true;
	}
	
	public function getRandomChannels(){
		return User::orderByRaw("RAND()")
		->where('status', '1')
		->where('verified', '1')
		->get(array('id','channel_name'));
	}

	public function setVerifyStatus($verify_status, $user_id){
		$user = User::find($user_id);
		$user->verified = '1';
		$user->status = '1';
		$user->token = '';
		$user->save();

		return true;
	}
}
