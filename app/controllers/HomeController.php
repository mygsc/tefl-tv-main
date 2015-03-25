<?php

class HomeController extends BaseController {


	public function __construct(User $user, Video $video,Notification $notification) {
		$this->User = $user;
		$this->Video = $video;
		$this->Notification = $notification;
		$this->Auth = Auth::User();
	}

	public function getIndex() {
		$recommendeds = $this->Video->getVideoByCategory('recommended', '6');
		$populars = $this->Video->getVideoByCategory('popular', '4');
		$latests = $this->Video->getVideoByCategory('latest', '4');
		$randoms = $this->Video->getVideoByCategory('random', '4');

		//return $randoms;
		//dd(file_exists('public\videos\4-Cess\Js0zCnwX7XY\Js0zCnwX7XY.jpg'));
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
		$popularVideos = $this->Video->getVideoByCategory('popular', 16);

		if($popularVideos === false){
			app::abort(404, 'Unauthorized Action'); 
		}

		return View::make('homes.popular', compact('popularVideos'));
	}

	public function getLatest() {
		$latestVideos =  $this->Video->getVideoByCategory('latest', 16);

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
	public function getWatchVideo() {
		return View::make('homes.advertisements');
	}

	public function watchVideo($idtitle){
		$token_id = Video::where('file_name','=',$idtitle)->first();
		$id = $token_id->id;
		$videoId = $id;
		$videos = Video::find($videoId);
		$owner = User::find($videos->user_id);
		$title = preg_replace('/[^A-Za-z0-9\-]/', ' ',$videos->title);
		$description = preg_replace('/[^A-Za-z0-9\-]/', ' ',$videos->description);
		$tags = $videos->tags;
		$relations = DB::select("SELECT DISTINCT  v.id, v.user_id, v.title,v.description,v.tags,UNIX_TIMESTAMP(v.created_at) AS created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name FROM videos v 
			LEFT JOIN users u ON v.user_id = u.id
			WHERE MATCH(v.title,v.description,v.tags) AGAINST ('".$title.','.$description.','.$tags."' IN BOOLEAN MODE)
			HAVING v.id!='".$id."'
			AND v.report_count < 5
			OR v.report_count IS NULL
			AND v.publish = 1
			AND v.deleted_at IS NULL;
			");
		$relationCounter = count($relations);
		if(isset(Auth::User()->id)){
			$playlists = DB::select("SELECT DISTINCT  p.id,p.name,p.description,p.user_id,p.privacy,i.video_id FROM playlists p
				LEFT JOIN playlists_items i ON p.id = i.playlist_id
				WHERE i.video_id = '".$id."'
				HAVING p.user_id = '".Auth::User()->id."';");
			$playlistNotChosens = DB::select("SELECT * FROM playlists AS p
				WHERE NOT EXISTS
				(SELECT * FROM playlists_items AS i
					WHERE i.playlist_id = p.id
					AND
					i.video_id = '".$id."')
				AND p.user_id = '".Auth::User()->id."'");
			$favorites = Favorite::where('video_id','=',$id)
			->where('user_id','=',Auth::User()->id)->first();
			$watchLater = WatchLater::where('video_id','=',$id)
			->where('user_id','=',Auth::User()->id)->first();
			$like = Like::where('video_id','=',$id)
			->where('user_id','=',Auth::User()->id)->first();
		//return $playlists;

		}
		else{
			$playlists = null;
			$playlistNotChosens = null;
			$favorites = null;
			$watchLater = null;
			$like = null;
		}
		$likeCounter = Like::where('video_id','=',$id)->count();
		$video_path =  DB::Select("SELECT DISTINCT  v.id, v.user_id, v.title,v.description,v.tags,UNIX_TIMESTAMP(v.created_at) AS created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name FROM videos v 
			LEFT JOIN users u ON v.user_id = u.id
			WHERE v.id = '".$id."';");
		
		$getVideoComments = DB::table('users')->join('comments', 'users.id', '=', 'comments.user_id')
				->where('comments.video_id', $videoId)->get();

		return View::make('homes.watch-video',compact('videos','relations','owner','id','playlists','playlistNotChosens','favorites', 'getVideoComments', 'videoId','like','likeCounter','watchLater','video_path','relationCounter'));
	}
	public function getWatchPlaylist($videoId,$playlistId){
		$playlistId = Crypt::decrypt($playlistId);
		$video = Video::where('file_name',$videoId)->first();
		$owner = User::find($video->user_id);
		$itemId = PlaylistItem::where('video_id',$video->id)
								->where('playlist_id',$playlistId)->first();
		$nextA = DB::select("SELECT DISTINCT v.*,UNIX_TIMESTAMP(v.created_at) AS created,u.channel_name,p.id AS playlist_id FROM playlists p
			LEFT JOIN playlists_items i ON p.id = i.playlist_id
			INNER JOIN videos v ON i.video_id = v.id
			INNER JOIN users u ON v.user_id = u.id
			AND i.playlist_id = '".$playlistId."'
			AND i.id > '".$itemId->id."'
			ORDER BY i.id asc
			LIMIT 1;");
		$previousA = DB::select("SELECT DISTINCT v.*,UNIX_TIMESTAMP(v.created_at) AS created,u.channel_name,p.id AS playlist_id FROM playlists p
			LEFT JOIN playlists_items i ON p.id = i.playlist_id
			INNER JOIN videos v ON i.video_id = v.id
			INNER JOIN users u ON v.user_id = u.id
			AND i.playlist_id = '".$playlistId."'
			AND i.id < '".$itemId->id."'
			ORDER BY i.id desc
			LIMIT 1;");
		$playlistVideos = DB::select("SELECT DISTINCT v.*,UNIX_TIMESTAMP(v.created_at) AS created,u.channel_name,p.id as playlist_id FROM playlists p
			LEFT JOIN playlists_items i ON p.id = i.playlist_id
			INNER JOIN videos v ON i.video_id = v.id
			INNER JOIN users u ON v.user_id = u.id
			WHERE i.playlist_id = '".$playlistId."'
			");
		return View::make('users.watchplaylist',compact('video','playlistVideos','owner','nextA','previousA'));
	}

	public function postSignIn() {
		$input = Input::all();
		$validate = Validator::make($input, User::$user_login_rules);
		if($validate->fails()) {
			return Redirect::route('homes.signin')->withFlashMessage("Wrong Channel name or password")->withInput();
		} else{
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

    public function addReply(){
		$reply = trim(Input::get('txtreply'));
		$comment_id = Input::get('comment_id');
		$user_id = Input::get('user_id');
		$video_id = Input::get('video_id');
		// return Response::json(array('status' => $reply));

		if(empty($reply)){
			return Response::json(array('status'=>'error','label' => 'The reply field is required.'));
		}
		if(!empty(trim($reply))){
        	$replies = new CommentReply;
			$replies->comment_id = $comment_id;
			$replies->user_id = $user_id;
			$replies->reply = $reply;
			$replies->save();
			return Response::json(array('status' => 'success'));
        }
    }
    public function addLiked(){
		$likeCommentId = trim(Input::get('likeCommentId'));
		$likeUserId = Input::get('likeUserId');
		$statuss = Input::get('status');
		

		if($statuss == 'liked'){
			DB::table('comments_likesdislikes')->insert(
			    array('comment_id' => $likeCommentId,
			    	  'user_id'    => $likeUserId,
			    	  'status' 	   => 'liked'
			   	)
			);
			$likesCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $likeCommentId, 'status' => 'liked'))->count();
			return Response::json(array('status' => 'success', 'likescount' => $likesCount, 'label' => 'unliked'));

		} elseif($statuss == 'unliked'){
			DB::table('comments_likesdislikes')->where(array('comment_id' => $likeCommentId, 'user_id' => $likeUserId, 'status' => 'liked'))->delete();
			$likesCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $likeCommentId, 'status' => 'liked'))->count();
			return Response::json(array('status' => 'success', 'likescount' => $likesCount, 'label' => 'liked'));
		}
    }
    public function addDisliked(){
		$dislikeCommentId = trim(Input::get('likeCommentId'));
		$likeUserId = Input::get('likeUserId');
		$statuss = Input::get('status');
		

		if($statuss == 'liked'){
			DB::table('comments_likesdislikes')->insert(
			    array('comment_id' => $dislikeCommentId,
			    	  'user_id'    => $likeUserId,
			    	  'status' 	   => 'disliked'
			   	)
			);
			$dislikesCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $dislikeCommentId, 'status' => 'disliked'))->count();
			return Response::json(array('status' => 'success', 'dislikescount' => $dislikesCount, 'label' => 'undisliked'));

		} elseif($statuss == 'unliked'){
			DB::table('comments_likesdislikes')->where(array('comment_id' => $dislikeCommentId, 'user_id' => $likeUserId, 'status' => 'liked'))->delete();
			$dislikescount = DB::table('comments_likesdislikes')->where(array('comment_id' => $dislikeCommentId, 'status' => 'disliked'))->count();
			return Response::json(array('status' => 'success', 'dislikescount' => $dislikesCount, 'label' => 'disliked'));
		}
    }

	public function testingpage(){ 
		define('DS', DIRECTORY_SEPARATOR);
		$userFolderName = Auth::User()->id. '-'. Auth::User()->channel_name;
		//return asset('videos/'. $userFolderName);
		if(!file_exists('public'. DS. 'videos'.DS. $userFolderName)){
			mkdir('public'. DS. 'videos'. DS. $userFolderName);
		}
	}
}
