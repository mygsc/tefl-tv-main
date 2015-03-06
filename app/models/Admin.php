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
		$data = array('email'=>$adminInfo->email,'token'=>Crypt::encrypt($adminInfo->email.rand(1,9999)));
		User::where('id', $adminInfo->id)->update(['token' => $data['token']]);
		Mail::send('emails.Auth.resetpassword', $data, function($message) use($data){
			$message->to($data['email'], 'Graphics Studio Central')->subject('Forgot Password! - TEFLTV');
		});
		return true;

	}
	public static function hashCheckPassword($currentpassword, $dbPassword, $user_id, $newpassword){
		if(Hash::check($currentpassword, $dbPassword)){
			User::where('id', $user_id)->update(['password' => Hash::make($newpassword)]);
			return true;
		}
		return false;
	}
	public static function sendCreateAdminLink($data){
		Mail::send('emails.Auth.createadmin', $data, function($message) use($data){
			$message->to($data['email'], 'Graphics Studio Central')->subject('Admin Registration - TEFLTV');
		});
		return true;
	}
}
