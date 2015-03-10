<?php

class HomeController extends BaseController {


	public function __construct(User $user) {
		$this->User = $user;

	}

	public function getIndex() {
		$recommendeds = DB::select(
			'SELECT v.id,v.user_id, v.title, v.description, v.publish, 
			v.views, v.likes, v.tags, v.report_count,v.recommended, v.created_at,
			v.deleted_at,u.channel_name,u.status FROM videos v
			INNER JOIN users u ON
			v.user_id = u.id
			WHERE
			v.deleted_at IS NULL
			AND
			v.report_count < 5
			AND
			NOT(u.status = "0")
			AND
			publish = "1"
			AND
			recommended = "1"
			ORDER BY
			(v.views + v.likes) DESC
			LIMIT 5');

		return View::make('homes.index', compact('recommendeds'));
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
		$latestVideos = DB::select(
			'SELECT v.id,v.user_id, v.title, v.description, v.publish, 
			v.views, v.likes, v.tags, v.report_count,v.created_at,
			v.deleted_at,u.channel_name,u.status FROM videos v
			INNER JOIN users u ON
			v.user_id = u.id
			WHERE
			v.deleted_at IS NULL
			AND
			v.report_count < 5
			AND
			NOT(u.status = "0")
			AND
			publish = "1"
			ORDER BY
			(v.views + v.likes) DESC');

		return View::make('homes.popular', compact('latestVideos'));
	}

	public function getLatest() {
		$latestVideos = DB::select(
			'SELECT v.id,v.user_id, v.title, v.description, v.publish, 
			v.views, v.likes, v.tags, v.report_count,v.created_at,
			v.deleted_at,u.channel_name,u.status FROM videos v
			INNER JOIN users u ON
			v.user_id = u.id
			WHERE
			v.deleted_at IS NULL
			AND
			v.report_count < 5
			AND
			NOT(u.status = "0")
			AND
			publish = "1"
			ORDER BY
			v.created_at DESC');

		return View::make('homes.latest', compact('latestVideos'));
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
		$videos = Video::find($id[0]);
		$owner = User::find($videos->user_id);
		$title = preg_replace('/[^A-Za-z0-9\-]/', ' ',$videos->title);
		$description = preg_replace('/[^A-Za-z0-9\-]/', ' ',$videos->description);
		$tags = $videos->tags;
		$relations = DB::select("SELECT DISTINCT  v.id, v.user_id, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,u.channel_name FROM videos v 
						LEFT JOIN users u ON v.user_id = u.id
						WHERE MATCH(v.title,v.description,v.tags) AGAINST ('".$title.','.$description.','.$tags."' IN BOOLEAN MODE)");
		return View::make('homes.watch-video',compact('videos','relations','owner','id'));
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
