<?php

class AdminController extends BaseController {
	public function getIndex() {
		if (Auth::check()) return View::make('admins.index');
		return View::make('admins.login');
	}
	public function postIndex(){
		$input = Input::all();
		$validate = Validator::make($input, array('username' => 'required','password' => 'required'));
		if($validate->fails()) return Redirect::route('admins.index')->withFlashMessage($validate)->withInput();
		
		$attempt = Admin::getAuthLogin($input['username'], $input['password']);
		if($attempt){
			$verified = Auth::User()->verified;
			$status  = Auth::User()->status;
			$role = Auth::User()->role;

			$status = Admin::getAuthLoginStatus($verified); //IF STATUS

			return Redirect::intended('/');
		}
		return Redirect::route('admins.index')->withInput()->withFlashMessage('Invalid Credentials!');
	}	
}
