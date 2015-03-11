<?php

class HomeController extends BaseController {


	public function __construct(User $user, Video $video) {
		$this->User = $user;
		$this->Video = $video;
	}

	public function getIndex() {
		$recommendeds = $this->getVideoCategory('recommended', '6');
		$populars = $this->getVideoCategory('popular', '4');
		$latests = $this->getVideoCategory('latest', '4');
		$randoms = $this->Video->getRandomVideos('4');

		if($recommendeds === false || $populars === false || $latests === false){
			app::abort(404, 'Unauthorized Action'); 
		}
		return View::make('homes.index', compact(array('recommendeds', 'populars', 'latests', 'randoms')));
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
		$popularVideos = $this->getVideoCategory('popular');

		if($popularVideos === false){
			app::abort(404, 'Unauthorized Action'); 
		}

		return View::make('homes.popular', compact('popularVideos'));
	}

	public function getLatest() {
		$latestVideos =  $this->getVideoCategory('latest');

		if($latestVideos === false){
			app::abort(404, 'Unauthorized Action'); 
		}

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

	public function getVideoCategory($type = null, $limit = null){
		if(empty($type)){
			return false;
		}

		if(!empty($limit)){
			$limit = 'LIMIT '. $limit;
		}

		if($type == 'recommended'){
			$additionaQuery = 
				'AND recommended = "1"
				ORDER BY (v.views + v.likes) DESC';
		}elseif($type == 'popular'){
			$additionaQuery = 
				'ORDER BY (v.views + v.likes) DESC';
		}elseif($type == 'latest'){
			$additionaQuery = 
				'ORDER BY v.created_at DESC';
		}else{
			return false;
		}

		$returnData = DB::select(
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
				publish = "1"'.
				$additionaQuery.
				' '.
				$limit. '');

		return $returnData;
	}

}
