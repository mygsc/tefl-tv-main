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
		$adminInfo = User::where('email', Input::get('email'))->first();
		if(!isset($adminInfo)) return Redirect::route('get.admin.resetpassword')->withInput()->withFlashMessage('Invalid email address. Please try again!');
		if(Admin::sendResetPasswordMail($adminInfo)) return Redirect::route('admin.index')->withFlashMessage('Done! Please check your email.');
	}

	public function getPwdReset($token){
		if(!isset($token)) return Redirect::route('admin.index')->withFlashMessage('Invalid URL. please try to reset your password again!');
		$adminInfo = User::where('token', $token)->first();
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
		$videos = Video::where('publish', 1)->get();
		return View::make('admins.recommendedvideos', compact('videos'));
	}
	public function postRecommendedVideos(){
		$input = Input::all();
		$recommendedCounts = count($input['recommended']);
		if($recommendedCounts > 6){
			return View::make('admins.recommendedvideos')->withFlashMessage('Up to 6 videos only. Please try again.');
		}
		DB::table('videos')->update(array('recommended' => 0));
		foreach($input['recommended'] as $recommendedVideos){
			DB::table('videos')->where('id', $recommendedVideos)->update(array('recommended' => 1));
		}
		return Redirect::route('get.admin.recommendedvideos')->withInput()->withFlashMessage('Successfully updated!');
	}

	public function getCreateAdminLink(){
		return View::make('admins.createadminlink');
	}
	public function postCreateAdminLink(){
		$validate = Validator::make(Input::all(), array('email' => 'required|email|unique:users,email'));
		if($validate->fails()) {
		 	return Redirect::route('get.admin.createadminlink')->withErrors($validate)->withInput();
		}
		$encrypt = Crypt::encrypt(Input::get('email') . rand(1,9999));
		$data = array('code' => $encrypt, 'email' => Input::get('email'));

		$id = DB::table('users_code')->insert(array('code' => $data['code'], 'email' => $data['email'], 'used' => 0));

		if(Admin::sendCreateAdminLink($data)) return Redirect::route('admin.index')->withFlashMessage('Done! Please check your email.');
	}
	public function getAdminSignup($code){
		if(!isset($code)) return Redirect::route('admin.index')->withFlashMessage('Invalid URL. please try again!');
		
		$userCode = DB::table('users_code')->where('code', $code)->first();
		if(!isset($userCode)) return Redirect::route('admin.index')->withFlashMessage('Invalid link. Please contact the TEFLTV administrator.');

		if($userCode->used == 1) return Redirect::route('admin.index')->withFlashMessage('The registration link is already used.');

		if(isset($userCode)) return View::make('admins.adminsignup', compact('userCode'));
	}
	public function postAdminSignup(){
		$input = Input::all();
		$validate = Validator::make($input, array('username' => 'required|unique:users,channel_name', 'password' => 'required|confirmed|min:6','password_confirmation' => 'required'));
		if($validate->fails()) return Redirect::route('get.admin.adminsignup')->withInput()->withErrors($validate);

		DB::table('users')->insert(array('email' => $input['email'], 'channel_name' => $input['username'], 'password' => Hash::make($input['password'])));
		DB::table('users_code')->where('code', $input['code'])->update(array('used' => 1));
		return Redirect::route('admin.index')->withInput()->withFlashMessage('Successfully registered!');
	}
}
