<?php

class UserController extends BaseController {


	public function getSignIn() {

		return View::make('homes.signin');
	}

	public function postSignIn() {

	$input = Input::all();
	$validate = Validator::make($input, User::$user_login_rules);
		if($validate->fails()) {
			return Redirect::route('homes.signin')->withFlashMessage("Wrong Channel name or password")->withInput();
		}else{
			$attempt = User::getUserLogin($input['channel_name'], $input['password']);
			if($attempt){
				$verified = Auth::User()->verified;
				$status = Auth::User()->status;
				$role = Auth::User()->role;
				User::getUserStatus($verified, $status, $role);

				return Redirect::route('homes.index');
			}

		}
			return Redirect::route('homes.signin')->withFlashMessage('Invalid Credentials!')->withInput();
	}

	public function postSignUp() {

	$input = Input::all();
	$validate = Validator::make($input, User::$user_rules);
	
	if($validate->passes()){
			return $this->User->signup();
	}else{
		return Redirect::route('homes.signin')->withErrors($validate)->withInput();
	}

	}

	public function getUsersIndex() {

		return View::make('users.index');
	}

	public function getSignOut() {
		Auth::logout();
		Session::flush();
		return Redirect::route('homes.index')->withFlashMessage('Logout!');
	}

	public function getUsersProfile($channel_name) {

		$user_channel = UserProfile::find(Auth::User()->id);
		// return $user_channel;
		return View::make('users.channel', compact('user_channel'));
	}
	
	public function postUsersUploadImage() {

		If(Input::hasFile('image')) {
			$validate = Validator::make(array('image' => Input::get('image')), array('image|mimes:jpg,jpeg,png'));

			if($validate->passes()) {
				$filename = Input::file('image')->getClientOriginalName();

				return $filename;
			}
		}
	}

}
