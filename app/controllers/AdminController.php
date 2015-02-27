<?php

class AdminController extends BaseController {
	public function getIndex() {
		if (Auth::check()) return View::make('admins.index');
		return View::make('admins.login'); //else Auth::check()
	}
	public function postIndex(){
		$input = Input::all();
		$validate = Validator::make($input, array('username' => 'required','password' => 'required'));
		if($validate->fails()) {
			return Redirect::route('admins.index')->withFlashMessage($validate)->withInput();
		}
		
		$attempt = Admin::getAuthLogin($input['username'], $input['password']);
		if($attempt){
			$verified = Auth::User()->verified;
			$status  = Auth::User()->status;
			$role = Auth::User()->role;
			if($verified == 0){
				Auth::logout();
				return Redirect::route('admins.index')
				->withInput()
				->withFlashMessage('Your account is not verified. Check your email address for verification.');
			}
			if($status == 0){
				Auth::logout();
				return Redirect::route('admins.index')
				->withInput()
				->withFlashMessage('Your account is deactived! Please contact the TEFLTV Administrator');
			}
			if($status == 2){
				Auth::logout();
				return Redirect::route('admins.index')
				->withInput()
				->withFlashMessage('Your account is banned! Please contact the TEFLTV Administrator');
			}
			return Redirect::intended('/');
		}
		return Redirect::route('admins.index')
		->withInput()
		->withFlashMessage('Invalid Credentials!');
	}	
}
