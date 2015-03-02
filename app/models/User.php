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

	public static function getUserLogin($channel_name, $password) {
		$remember_me = Input::has('remember_me') ? true : false;
		$attempt = Auth::attempt(array('channel_name' => $channel_name, 'password' => $password), $remember_me);
		return $attempt;
	}

	public static $user_rules = array(
		'email' => 'required|email',
		'channel_name' => 'required',
		'password' => 'required',
		'confirm_password' =>'same:password',
		'first_name' => 'required',
		'last_name' => 'required');

	public static $user_login_rules = array('channel_name' => 'required', 'password' => 'required');

	public static function getUserStatus($verified, $status, $role){
		if($role != 1){
			Auth::logout();
			return Redirect::route('homes.signin')->withFlashMessage('Invalid account! Please try again!');
		}

		if($verified == 0){
			Auth::logout();
			return Redirect::route('homes.signin')->withInput()
			->withFlashMessage('Your account is not verified. Check your email address for verification.');
		}
		if($status == 0){
			Auth::logout();
			return Redirect::route('homes.signin')->withInput()
			->withFlashMessage('Your account is deactived! Please contact the TEFLTV Administrator');
		}
		if($status == 2){
			Auth::logout();
			return Redirect::route('homes.signin')->withInput()
			->withFlashMessage('Your account is banned! Please contact the TEFLTV Administrator');
		}	
	}

	public function signup() {
		$user = new User;
		$user->email = Input::get('email');
		$user->channel_name = Input::get('channel_name');
		$user->password = Hash::make(Input::get('password'));
		$user->save();

		$userProfile = new userProfile;

		$userProfile->first_name = Input::get('first_name');
		//$userProfile->user_id = Last's users id
		$userProfile->last_name = Input::get('last_name');
		$userProfile->contact_number = Input::get('contact_number');
		$userProfile->save();

		return Redirect::route('homes.signin')->withFlashMessage("Successfully Registered, Please check your email!");
	}

	public function userprofile() {

		return $this->hasOne('userProfile');
	}
	
	public function getRandomChannels(){
		return User::orderByRaw("RAND()")
		->where('status', '1')
		->where('verified', '1')
		->get(array('id','channel_name'));
	}
}
