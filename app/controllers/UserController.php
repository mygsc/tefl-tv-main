<?php

class UserController extends BaseController {

	public function __construct(User $user){

		$this->User = $user;
	}

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

	public function getUsersChannel($channel_name) {

		$user_channel = UserProfile::find(Auth::User()->id);
		
		return View::make('users.channel', compact('user_channel'));
	}
	
	public function postUsersUploadImage($id) {


		If(Input::hasFile('image')) {

			$validate = Validator::make(array('image' => Input::file('image')), array('image' => 'image|mimes:jpg,jpeg,png'));

			if($validate->passes()) {
				$filename = Input::file('image')->getClientOriginalName();

				$picture = public_path('img/user/') . Auth::User()->id . '.jpg';

				$newName = Auth::User()->id.'.jpg';

				$path = public_path('img/user/');


				if(file_exists($picture))
				{
					File::delete($picture);
					$file = Input::file('image')->move($path, $newName);
					return Redirect::route('users.channel', $channel_name)->withFlashMessage('Successfully Updated!');
				}else{
					$file = Input::file('image')->move($path, $newName);
					return Redirect::route('users.channel', $channel_name)->withFlashMessage('Successfully Created New Picture!');
				}
			}else{
				return Redirect::route('users.channel', $channel_name)->withFlashMessage('Error Uploading image must be .jpeg, .jpg, .png');
			}
		}
	}

	public function getEditUsersChannel() {

		$user_channel = UserProfile::find(Auth::User()->id);
		return View::make('users.editchannel', compact('user_channel'));
	}

	public function postEditUsersChannel($id) {

		$user = User::find($id);
		$user->website = Input::get('website');
		$user->organization = Input::get('organization');
		$user->save();

		$user_channel = UserProfile::find(Auth::User()->id);
		$user_channel->first_name = Input::get('first_name');
		$user_channel->last_name = Input::get('last_name');
		$user_channel->contact_number = Input::get('contact_number');
		$user_channel->address = Input::get('address');
		$user_channel->interests = Input::get('interests');
		$user_channel->work = Input::get('work');
		$user_channel->birthdate = Input::get('birthdate');
		$user_channel->city = Input::get('city');
		$user_channel->state = Input::get('state');
		$user_channel->zip_code = Input::get('zip_code');
		$user_channel->save();

		return Redirect::route('users.channel', $id)->withFlashMessage('Successfully updated your channel!');

	}

}
