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
		$videos = Video::find($id[0]);
		$owner = User::find($videos->user_id);
		$title =$videos->title;
		$description = $videos->description;
		$tagVideos = TagVideo::where('video_id','=',$videos->id)->get();
		$mergingTag = [];
		foreach($tagVideos as $TagVideo){
			$tag[] = Tag::where('id','=',$TagVideo->tag_id)->get()->toArray();
			$merging = array_merge($mergingTag,$tag);	
		}
		$mergedTags = call_user_func_array('array_merge', $merging);
		foreach($mergedTags as $mergedTag){
			$tagName[] = $mergedTag['tags'];
		}
		$implodedTags = implode(',',$tagName);
		$relations = DB::select("SELECT DISTINCT v.id, v.user_id, v.title,v.description, t.tags, u.channel_name,v.created_at,v.deleted_at  FROM tag_video vt
			INNER JOIN tags t ON vt.tag_id = t.id 
			INNER JOIN videos v ON vt.video_id = v.id
			LEFT JOIN users u ON v.user_id = u.id
			WHERE MATCH(v.title,v.description)
			AGAINST ('".$title.$description."')
			OR
			MATCH(t.tags)
			AGAINST('".$implodedTags."')
			GROUP BY id
			ORDER BY MATCH(v.title,v.description)
			AGAINST ('".$title.$description."')
			OR
			MATCH(t.tags)
			AGAINST('".$implodedTags."');");
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
