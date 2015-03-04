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
		$validate = Validator::make($input, User::$userLoginRules);
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
		$validate = Validator::make($input, User::$userRules);
		
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

	public function getUsersChannel($id, $subscriberLists = array(), $subscriptionLists = array() ) {

		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(3)->video;
		
		
		$subscribers = Subscribe::where('user_id', Auth::User()->id)->get();
		foreach($subscribers as $a) {
			$subscribed = UserProfile::where('user_id', $a->subscriber)->first();
			$subscriberLists []= $subscribed;
		}
		
		$subscriptions = Subscribe::where('subscriber', Auth::User()->id)->get();
		foreach ($subscriptions as $b) {
			$subscriptioned = UserProfile::where('user_id', $b->user_id)->get();
			$subscriptionLists[] = $subscriptioned;

		}
		

		return View::make('users.channel', compact('usersChannel', 'usersVideos', 'subscriberLists','subscriptionLists'));
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
					return Redirect::route('users.edit.channel', $id)->withFlashMessage('Successfully Updated!');
				}else{
					$file = Input::file('image')->move($path, $newName);
					return Redirect::route('users.edit.channel', $id)->withFlashMessage('Successfully Created New Picture!');
				}
			}else{
				return Redirect::route('users.edit.channel', $id)->withFlashMessage('Error Uploading image must be .jpeg, .jpg, .png');
			}
		}
	}

	public function getEditUsersChannel() {

		$userChannel = UserProfile::find(Auth::User()->id);
		return View::make('users.editchannel', compact('userChannel'));
	}

	public function postEditUsersChannel($channel_name) {

		$input = Input::all();
		$validate = Validator::make($input, User::$userEditRules);

		if($validate->passes()){

		$user = User::find(Auth::User()->id);
		$user->website = Input::get('website');
		$user->organization = Input::get('organization');
		$user->save();

		$userChannel = UserProfile::find(Auth::User()->id);
		$userChannel->first_name = Input::get('first_name');
		$userChannel->last_name = Input::get('last_name');
		$userChannel->contact_number = Input::get('contact_number');
		$userChannel->address = Input::get('address');
		$userChannel->interests = Input::get('interests');
		$userChannel->work = Input::get('work');
		$userChannel->birthdate = Input::get('birthdate');
		$userChannel->city = Input::get('city');
		$userChannel->state = Input::get('state');
		$userChannel->zip_code = Input::get('zip_code');
		$userChannel->save();
		}else{
			return Redirect::route('users.edit.channel', $channel_name)->withErrors($validate);
		}

		return Redirect::route('users.channel', $channel_name)->withFlashMessage('Successfully updated your channel!');

	}

	public function getMyVideos() {

		return View::make('');
	}


	public function getAccountSettings() {

		return View::make('users.accountsettings');
	}

}
