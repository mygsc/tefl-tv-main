<?php

class HomeController extends BaseController {


	public function __construct(User $user, Video $video,Notification $notification) {
		$this->User = $user;
		$this->Video = $video;
		$this->Notification = $notification;
	}

	public function getIndex() {
		$recommendeds = $this->Video->getVideoByCategory('recommended', '6');
		$populars = $this->Video->getVideoByCategory('popular', '4');
		$latests = $this->Video->getVideoByCategory('latest', '4');
		$randoms = $this->Video->getVideoByCategory('random', '4');

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
		$popularVideos = $this->Video->getVideoByCategory('popular');

		if($popularVideos === false){
			app::abort(404, 'Unauthorized Action'); 
		}

		return View::make('homes.popular', compact('popularVideos'));
	}

	public function getLatest() {
		$latestVideos =  $this->Video->getVideoByCategory('latest');

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

		if(empty($id[1])){
			return Redirect::to('/');
		}
		$videoId = $id[0];
		$videos = Video::find($videoId);
		$owner = User::find($videos->user_id);
		$title = preg_replace('/[^A-Za-z0-9\-]/', ' ',$videos->title);
		if(empty($id[1])){
			return Redirect::to('/');
		}
		if(empty($id[0])){
			return Redirect::to('/');
		}
		if(preg_replace('/[^A-Za-z\-]/', '',$id[1]) != preg_replace('/[^A-Za-z\-]/', '',$videos->title)){
			return Redirect::to('/');
		}
		$description = preg_replace('/[^A-Za-z0-9\-]/', ' ',$videos->description);
		$tags = $videos->tags;
		$relations = DB::select("SELECT DISTINCT  v.id, v.user_id, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,u.channel_name FROM videos v 
						LEFT JOIN users u ON v.user_id = u.id
						WHERE MATCH(v.title,v.description,v.tags) AGAINST ('".$title.','.$description.','.$tags."' IN BOOLEAN MODE)");
		if(isset(Auth::User()->id)){
		$playlists = DB::select("SELECT DISTINCT  p.id,p.name,p.description,p.user_id,p.privacy,i.video_id FROM playlists p
									LEFT JOIN playlists_items i ON p.id = i.playlist_id
									WHERE i.video_id = '".$id[0]."'
									HAVING p.user_id = '".Auth::User()->id."';");
		$playlistNotChosens = DB::select("SELECT * FROM playlists AS p
									WHERE NOT EXISTS
									(SELECT * FROM playlists_items AS i
									   WHERE i.playlist_id = p.id
									   AND
									   i.video_id = '".$id[0]."'
									   AND
									   p.user_id = '".Auth::User()->id."')");
		$favorites = Favorite::where('video_id','=',$id[0])
								->where('user_id','=',Auth::User()->id)->first();
		$watchLater = WatchLater::where('video_id','=',$id[0])
								->where('user_id','=',Auth::User()->id)->first();
		$like = Like::where('video_id','=',$id[0])
								->where('user_id','=',Auth::User()->id)->first();
		$likeCounter =	Like::where('video_id','=',$id[0])
								->where('user_id','=',Auth::User()->id)->count();					
		}
		else{
			$playlists = null;
			$playlistNotChosens = null;
			$favorites = null;
			$watchLater = null;
			$like = null;
			$likeCounter = null;
		}

		$getVideoComments = DB::table('comments')
							->join('users', 'users.id', '=', 'comments.user_id')
							->where('comments.video_id', $videoId)
							->get();

		return View::make('homes.watch-video',compact('videos','relations','owner','id','playlists','playlistNotChosens','favorites', 'getVideoComments', 'videoId','like','likeCounter'));
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

	public function addComment(){
		$comment = trim(Input::get('comment'));
		$video_id = Input::get('video_id');
		$user_id = Input::get('user_id');

		if(empty($comment)){
			return Response::json(array('status'=>'error','label' => 'The comment field is required.'));
		}
		if(!empty(trim($comment))){
        	$comments = new Comment;
			$comments->video_id = $video_id;
			$comments->user_id = $user_id;
			$comments->comment = $comment;
			$comments->save();
			return Response::json(array(
                'status' => 'success',
                'comment' => $comment,
                'video_id' => $video_id,
                'user_id' => $user_id
            ));
        }
    }

	public function testingpage(){
		$routes = route('view.users.channel', array('gil'));
		return $this->Notification->constructNotificationMessage('3','1','replied');
	}
}
