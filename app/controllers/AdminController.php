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
		$adminInfo = User::where('email', trim(Input::get('email')))->get();
		if(!$adminInfo->isEmpty()){
			Mail::send('emails.Auth.resetpassword', array('token' => $adminInfo->remember_token), function($message) {
		 $message->to('r3mmel023@gmail.com', 'Graphics Studio Central')->subject('Demo!');
		});
		}

		
		
	 	return Redirect::to('admin/login')->with('global','Please check your Email');	
	}
}
