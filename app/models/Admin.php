<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Admin extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;
	protected $table = 'users';
	protected $hidden = array('password');


	public static function getAuthLogin($username, $password){
		$attempt = Auth::attempt(['username' => $username,'password' => $password]);
		return $attempt;
	}
	public static function getAuthLoginStatus($verified, $status, $role){
		if($role != 2){
			Auth::logout();
			return Redirect::route('admin.index')->withFlashMessage('Invalid account! Please try again!');
		}
		if($verified == 0){
			Auth::logout();
			return Redirect::route('admin.index')->withInput()
			->withFlashMessage('Your account is not verified. Check your email address for verification.');
		}
		if($status == 0){
			Auth::logout();
			return Redirect::route('admin.index')->withInput()
			->withFlashMessage('Your account is deactived! Please contact the TEFLTV Administrator');
		}
		if($status == 2){
			Auth::logout();
			return Redirect::route('admin.index')->withInput()
			->withFlashMessage('Your account is banned! Please contact the TEFLTV Administrator');
		}
	}

}
