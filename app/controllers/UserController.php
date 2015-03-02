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

	public function getTopChannels(){
		$topChannels = DB::select('select users.id, users.channel_name, 
			videos.user_id, sum(videos.views) as total
			from videos inner join users on 
			videos.user_id = users.id 
			group by user_id 
			order by total DESC
			LIMIT 10');

		foreach($topChannels as $key => $channels){
			$img = 'img/user/'. $channels->id. '.jpg';
			if(!file_exists('public/'.$img)){
				$img = 'img/user/0.jpg';
			}
			$topChannels[$key]->image_src = $img;
		}

		return View::make('homes.topchannels', compact(array('topChannels')));
	}

	public function getMoreTopChannels(){
		$topChannels = DB::select('select users.id, users.channel_name, 
			videos.user_id, sum(videos.views) as total
			from videos inner join users on 
			videos.user_id = users.id 
			group by user_id 
			order by total DESC
			LIMIT 50');

		foreach($topChannels as $key => $channels){
			$img = 'img/user/'. $channels->id. '.jpg';
			if(!file_exists('public/'.$img)){
				$img = 'img/user/0.jpg';
			}
			$topChannels[$key]->image_src = $img;
		}

		return View::make('homes.moretopchannels', compact(array('topChannels')));
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
