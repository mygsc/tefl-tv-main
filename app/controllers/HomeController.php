<?php

class HomeController extends BaseController {


	public function __construct(User $user) {
		$this->User = $user;

	}

	public function getIndex() {
	
		return View::make('homes.index');
	}

	public function getAboutUs() {

		return View::make('homes.aboutus');
	}

	public function getPrivacy() {

		return View::make('homes.privacy');
	}

	public function getTermsAndConditions() {

		return View::make('homes.termsandconditions');
	}

	public function getAdvertisements() {

		return View::make('homes.advertisements');
	}

	public function getCopyright() {

		return View::make('homes.copyright');
	}

	public function getPopular() {

		return View::make('homes.popular');
	}

	public function getLatest() {

		return View::make('homes.latest');
	}

	public function getRandom() {

		return View::make('homes.random');
	}

	public function getChannels() {

		return View::make('homes.channels');
	}
	
	public function getSignIn() {

		return View::make('homes.signin');
	}

	public function watchvideo($idtitle){
		$id = explode('%',$idtitle);
		$video = Video::find($id[0]);
		$titles = explode(' ',$video->title);
		$mergingrelation = array();
			foreach($titles as $title){
				$videorelateds[] = Video::where('title','like','%'.$title.'%')
										->where('id','!=',$id[0])->get()->toArray();
				$merging = array_merge($mergingrelation,$videorelateds);
			}
			$merged = call_user_func_array('array_merge', $merging);
			$result = array_unique($merged, SORT_REGULAR);
		return $result;
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

}
