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
		if(Admin::sendResetPasswordMail($adminInfo)) return Redirect::route('admin.index')->withFlashMessage('Done! Please check your email.');
	}

	public function getPwdReset($token){
		if(!isset($token)) return Redirect::route('admin.index')->withFlashMessage('Invalid URL. please try to reset your password again!');
		$adminInfo = User::where('remember_token', $token)->first();
		if(isset($adminInfo)) return View::make('admins.pwdreset', compact('adminInfo'));
		return Redirect::route('get.admin.resetpassword')->withFlashMessage('Invalid URL. please try to reset your password again!'); //else
	}
	public function postPwdReset(){
		$input = Input::all();
		$validate = Validator::make($input, Admin::$pwdResetValidator);
		if($validate->fails()) return Redirect::route('get.admin.pwdreset')->withInput()->withErrors($validate);
		User::where('id', $input['user_id'])->update(['password' => Hash::make(Input::get('password'))]);
		return Redirect::route('admin.index')->withFlashMessage('Password successfully changed!');
	}

	public function getChangePassword(){
		return View::make('admins.changepassword');
	}
	public function postChangePassword(){
		$input = Input::all();
		$validate = Validator::make($input, Admin::$changepassword);
		if($validate->fails()) return Redirect::route('get.admin.changepassword')->withInput()->withErrors($validate);
		$user = User::where('id', Auth::User()->id)->first();
		Admin::hashCheckPassword($input['current_password'], $user->password, Auth::User()->id, $Input::get('password'));
		return Redirect::route('get.admin.changepassword')->withInput()->withFlashMessage('Incorrect current password. Please try again.');
	}

	public function getRecommendedVideos(){
		$videos = Video::all();
		return View::make('admins.recommendedvideos', compact('videos'));
	}
}
