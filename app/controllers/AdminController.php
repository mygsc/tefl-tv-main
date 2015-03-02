<?php

class AdminController extends BaseController {
	public function getIndex() {
		if (Auth::check()) return View::make('admins.index');
		return View::make('admins.login');
	}
	public function postIndex(){
		$input = Input::all();
		$validate = Validator::make($input, array('username' => 'required','password' => 'required'));
		if($validate->fails()) return Redirect::route('admin.index')->withInput()->withErrors($validate);
		$attempt = Admin::getAuthLogin($input['username'], $input['password']);
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

	public function resetpassword(){
		Mail::send('emails.auth.userNotification', ['userlink' => $verification_link, 'fname'=> ucfirst(Input::get('first_name')) ], function($message) use ($user)
		{
			$message->to($user->email, 'Mailusmail')->subject('Mailusmail Account Confirmation');
		});
	}
}
