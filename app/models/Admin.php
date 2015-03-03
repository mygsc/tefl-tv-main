<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Admin extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;
	protected $table = 'users';
	protected $hidden = array('password');

	public static $pwdResetValidator = array('password' => 'required|confirmed|min:6','password_confirmation' => 'required');
	public static $pwdResetValidator = array('password' => 'required|confirmed|min:6','password_confirmation' => 'required');
	public static $changepassword = array('current_password' => 'required', 'password' => 'required|confirmed|min:6','password_confirmation' => 'required');

	public static function getAuthLogin($username, $password){
		$attempt = Auth::attempt(['channel_name' => $username,'password' => $password]);
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
	public static function sendResetPasswordMail($adminInfo){
		if(isset($adminInfo)){
			Mail::send('emails.Auth.resetpassword', array('token' => $adminInfo->remember_token), function($message) {
			 $message->to('r3mmel023@gmail.com', 'Graphics Studio Central')->subject('Forgot Password! - TEFLTV');
			});
			return Redirect::route('admin.index')->withFlashMessage('Done! Please check your email.');
		}
	}
	public static function hashCheckPassword($currentpassword, $dbPassword, $user_id, $newpassword){
		if(Hash::check($current_password, $dbPassword)){
			User::where('id', $user_id)->update(['password' => Hash::make($newpassword)]);
			return Redirect::route('admin.index')->withFlashMessage('Password successfully changed!');
			
		}
	}

}
