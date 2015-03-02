<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'users';

	protected $hidden = array('password', 'remember_token');

	public static function getUserLogin($username, $password) {
		$attempt = Auth::attempt(array('username' => $username, 'password' => $password));
		return $attempt;
	}

	public static $user_rules = array(
		'email' => 'required|email',
		'username' => 'required',
		'password' => 'required',
		'confirm_password' =>'same:password',
		'first_name' => 'required',
		'last_name' => 'required');

	public static $user_login_rules = array('username' => 'required', 'password' => 'required');

	public function getUserStatus($verified, $status){
		if($verified == 0){
			Auth::logout();
			return Redirect::route('admins.index')->withInput()
			->withFlashMessage('Your account is not verified. Check your email address for verification.');
		}
		if($status == 0){
			Auth::logout();
			return Redirect::route('admins.index')->withInput()
			->withFlashMessage('Your account is deactived! Please contact the TEFLTV Administrator');
		}
		if($status == 2){
			Auth::logout();
			return Redirect::route('admins.index')->withInput()
			->withFlashMessage('Your account is banned! Please contact the TEFLTV Administrator');
		}	
	}

	public function signin() {

	}

	public function signup() {
		$user = new User;
		$user->email = Input::get('email');
		$user->username = Input::get('username');
		$user->password = Hash::make(Input::get('password'));
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->save();
	}
	

}
