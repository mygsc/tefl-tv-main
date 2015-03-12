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

	public function watchVideo($idtitle){
		$id = explode('%',$idtitle);
		if(empty($id[1])){
			return Redirect::to('/');
		}
		$videos = Video::find($id[0]);
		$owner = User::find($videos->user_id);
		$title = preg_replace('/[^A-Za-z0-9\-]/', ' ',$videos->title);
		$description = preg_replace('/[^A-Za-z0-9\-]/', ' ',$videos->description);
		$tags = $videos->tags;
		$relations = DB::select("SELECT DISTINCT  v.id, v.user_id, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,u.channel_name FROM videos v 
						LEFT JOIN users u ON v.user_id = u.id
						WHERE MATCH(v.title,v.description,v.tags) AGAINST ('".$title.','.$description.','.$tags."' IN BOOLEAN MODE)");
		$playlists = DB::select("SELECT DISTINCT  p.id,p.name,p.description,p.user_id,p.privacy,i.video_id FROM playlists p
									LEFT JOIN playlists_items i ON p.id = i.playlist_id
									WHERE p.privacy = '1'
									HAVING i.video_id = '".$id[0]."'
									AND p.user_id = '".Auth::User()->id."';");
		$playlistNotChosens = DB::select("SELECT DISTINCT  p.id,p.name,p.description,p.user_id,p.privacy,i.video_id,p.user_id FROM playlists p
					LEFT JOIN playlists_items i ON p.id = i.playlist_id
					WHERE p.privacy = '1'
					HAVING i.video_id IS NULL
					AND p.user_id = '".Auth::User()->id."';");
		return View::make('homes.watch-video',compact('videos','relations','owner','id','playlists','playlistNotChosens'));
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
				
				return Redirect::intended('/');
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
