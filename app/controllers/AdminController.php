<?php

class AdminController extends BaseController {
	public function getIndex() {
		if (Auth::check()) return View::make('admins.index');
		return View::make('admins.login');
	}
	public function postIndex(){
		$input = Input::all();
		$validate = Validator::make($input, array('channel_name' => 'required','password' => 'required'));
		if($validate->fails()) return Redirect::route('admin.index')->withInput()->withErrors($validate);
		$attempt = Admin::getAuthLogin($input['channel_name'], $input['password']);
		if($attempt){
			$verified = Auth::User()->verified;
			$status  = Auth::User()->status;
			$role  = Auth::User()->role;
			Admin::getAuthLoginStatus($verified, $status, $role); //IF STATUS
			return Redirect::intended('gsc-admin/');
		}
		return Redirect::route('admin.index')->withInput()->withFlashMessage('Invalid Credentials!');
	}	
	public function logout(){
		Auth::logout();
		Session::flush();
		return Redirect::route('admin.index');
	}

	public function getResetPassword(){
		return View::make('admins.resetpassword');
	}
	public function postResetPassword(){
		$validate = Validator::make(Input::all(), array('email' => 'required|email'));
		if($validate->fails()) {
		 	return Redirect::route('get.admin.resetpassword')->withErrors($validate)->withInput();
		}
		$adminInfo = User::where('email', Input::get('email'))->firstOrFail();
		//error handler

		if(isset($adminInfo)){
			Mail::send('emails.Auth.resetpassword', array('token' => $adminInfo->remember_token), function($message) {
			 $message->to('r3mmel023@gmail.com', 'Graphics Studio Central')->subject('Forgot Password! - TEFLTV');
			});
			return Redirect::route('admin.index')->withFlashMessage('Done! Please check your email.');
		}

	}

	public function getPwdReset($token){
		if(!isset($token)) return Redirect::route('admin.index')->withFlashMessage('Invalid URL. please try to reset your password again!');
		$adminInfo = User::where('remember_token', Input::get('token'))->firstOrFail();
		if(isset($adminInfo)) return View::make('admins.changepassword');
		return Redirect::route('admin.index')->withFlashMessage('Invalid URL. please try to reset your password again!'); //else
	}
	public function postPwdReset($token){
		
	}

	public function changepassword($token){
		if(!isset($token)) return Redirect::route('admin.index')->withFlashMessage('Invalid URL. please try to reset your password again!');
		$adminInfo = User::where('remember_token', Input::get('token'))->firstOrFail();
		if(isset($adminInfo)) return View::make('get.admins.changepassword');
		return Redirect::route('admin.index')->withFlashMessage('Invalid URL. please try to reset your password again!'); //else
	}
}
