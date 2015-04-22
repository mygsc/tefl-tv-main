<?php

class HomeController extends BaseController {


	public function __construct(User $user, Video $video,Notification $notification, Subscribe $subscribes) {
		$this->User = $user;
		$this->Video = $video;
		$this->Notification = $notification;
		$this->Auth = Auth::User();
		$this->Subscribe = $subscribes;
	}

	public function getIndex() {
		$recommendeds = $this->Video->getVideoByCategory('recommended', '6');
		$populars = $this->Video->getVideoByCategory('popular', '6');
		$latests = $this->Video->getVideoByCategory('latest', '6');
		$randoms = $this->Video->getVideoByCategory('random', '6');
		$categories = $this->Video->getCategory();

		//dd(file_exists('public\videos\4-Cess\Js0zCnwX7XY\Js0zCnwX7XY.jpg'));
		if($recommendeds === false || $populars === false || $latests === false){
			app::abort(404, 'Unauthorized Action'); 
		}
		//return $recommendeds;
		return View::make('homes.index', compact(array('recommendeds', 'populars', 'latests', 'randoms', 'categories')));
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

	public function watchVideo($idtitle=null){
		$token_id = Video::where('file_name','=',$idtitle)->first();
		if(!isset($token_id)) return Redirect::route('homes.index')->with('flash_bad','This video is not found.');
		$id = $token_id->id;
		$videoId = $id;
		$videos = Video::find($videoId);
		$owner = User::find($videos->user_id);
		if($owner->verified == '0') return Redirect::route('homes.index')->with('flash_bad','This video is not published.');
		if($owner->status != '1') return Redirect::route('homes.index')->with('flash_bad','The owner of this video is deactivated.');
		$title = preg_replace('/[^A-Za-z0-9\-]/', ' ',$videos->title);
		$description = preg_replace('/[^A-Za-z0-9\-]/', ' ',$videos->description);
		$tags = $videos->tags;
		$relations = DB::select("SELECT DISTINCT  v.id, v.user_id as uid, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name,u.verified,u.status FROM videos v 
			LEFT JOIN users u ON v.user_id = u.id
			WHERE MATCH(v.title,v.description,v.tags) AGAINST ('".$title.','.$description.','.$tags."' IN BOOLEAN MODE)
			HAVING v.id!='".$id."'
			AND v.publish = '1'
			AND u.verified = '1'
			AND u.status = '1'
			AND v.deleted_at IS NULL
			AND v.report_count < 5
			OR v.report_count IS NULL;");
		$counter = count($relations);
		$ownerVideos = Video::where('user_id',$videos->user_id)
									->where('publish','1')
									->where('report_count','<','5')
									->where('id','!=',$videos->id)
									->orderBy('id','desc')
									->take(3)->get();
		$likeownerVideosCounter = 0;
		foreach($ownerVideos as $ownerVideo){
			$likeownerVideos[] = Like::where('video_id',$ownerVideo->id)->count();
		}

		$newRelation = $this->Video->relations($videos->id,$counter,$title,$description,$tags,$relations);
		
		$relationCounter = count($relations);
		if(isset(Auth::User()->id)){
			$playlists = DB::select("SELECT DISTINCT  p.id,p.name,p.description,p.user_id,p.privacy,i.video_id,p.deleted_at FROM playlists p
				LEFT JOIN playlists_items i ON p.id = i.playlist_id
				WHERE i.video_id = '".$id."'
				HAVING p.user_id = '".Auth::User()->id."'
				AND p.deleted_at IS NULL;");
			$playlistNotChosens = DB::select("SELECT * FROM playlists AS p
				WHERE NOT EXISTS
				(SELECT * FROM playlists_items AS i
					WHERE i.playlist_id = p.id
					AND
					i.video_id = '".$id."')
			AND p.user_id = '".Auth::User()->id."'
			AND p.deleted_at IS NULL");
			$favorites = Favorite::where('video_id','=',$id)
			->where('user_id','=',Auth::User()->id)->first();
			$watchLater = WatchLater::where('video_id','=',$id)
			->where('user_id','=',Auth::User()->id)->first();
			$like = Like::where('video_id','=',$id)
			->where('user_id','=',Auth::User()->id)->first();
			$dislike = Dislike::where('video_id','=',$id)
			->where('user_id','=',Auth::User()->id)->first();
		//return $playlists;

		}
		else{
			$playlists = null;
			$playlistNotChosens = null;
			$favorites = null;
			$watchLater = null;
			$like = null;
			$dislike = null;
		}
		$likeCounter = Like::where('video_id','=',$id)->count();
		$dislikeCounter = Dislike::where('video_id','=',$id)->count();
		$video_path =  DB::Select("SELECT DISTINCT  v.id, v.user_id, v.title,v.description,v.tags,UNIX_TIMESTAMP(v.created_at) AS created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name FROM videos v 
			LEFT JOIN users u ON v.user_id = u.id
			WHERE v.id = '".$id."';");
		
		//r3mmel
		$getVideoComments = DB::table('users')->join('comments', 'users.id', '=', 'comments.user_id')
		->where('comments.video_id', $videoId)->get();
		$countSubscribers = $this->Subscribe->getSubscribers($owner->channel_name);
		$ifAlreadySubscribe = 0;
		if(isset(Auth::User()->id)) {
			$ifAlreadySubscribe =  DB::table('subscribes')->where(array('user_id' => $owner->id,'subscriber_id' => Auth::User()->id))->first();
		}
		//r3mmel

		$datas = $this->User->getTopChannels(4);
  		//Insert additional data to $datas
  		foreach($datas as $key => $channel){
		   	$img = 'img/user/'. $channel->id. '.jpg';
		   	if(Auth::check()){
			    $ifsubscribe = Subscribe::where('user_id', $channel->id)->where('subscriber_id', Auth::user()->id)->get();
			    $datas[$key]->ifsubscribe = 'No';
			    if(!$ifsubscribe->isEmpty()){
			     	$datas[$key]->ifsubscribe = 'Yes';
			    }
		   	}
		   	if(!file_exists(public_path($img))){
		    	$img = '/img/user/0.jpg';
		   	}
			$datas[$key]->image_src = $img;
			$datas[$key]->subscribers = $this->Subscribe->getSubscribers($channel->channel_name, 10);

		}
		return View::make('homes.watch-video',compact('videos','owner','id','playlists','playlistNotChosens','favorites', 'getVideoComments', 'videoId','like','likeCounter','watchLater','video_path','relationCounter','newRelation','countSubscribers','ownerVideos','likeownerVideos','likeownerVideosCounter','datas', 'ifAlreadySubscribe','dislikeCounter','dislike'));

	}
	public function getWatchPlaylist($videoId,$playlistId){
		$randID = Playlist::where('randID',$playlistId)->first();
		$playlistId = $randID->id;
		$playlist = Playlist::find($playlistId);
		if(!isset(Auth::User()->id)){
			if($playlist->privacy == '0') return Redirect::route('homes.index');
		}
		$video = Video::where('file_name','=',$videoId)->first();
		//return $video;
		$owner = User::find($video->user_id);
		$itemId = PlaylistItem::where('video_id',$video->id)
		->where('playlist_id',$playlistId)->first();
		$nextA = DB::select("SELECT DISTINCT v.*,UNIX_TIMESTAMP(v.created_at) AS created,u.channel_name,p.randID,p.id AS playlist_id FROM playlists p
			LEFT JOIN playlists_items i ON p.id = i.playlist_id
			INNER JOIN videos v ON i.video_id = v.id
			INNER JOIN users u ON v.user_id = u.id
			AND i.playlist_id = '".$playlistId."'
			and v.id != '".$video->id."'
			and v.publish = '1'
			AND i.id > '".$itemId->id."'
			and v.deleted_at IS NULL
			or v.report_count > 5
			ORDER BY i.id asc
			LIMIT 1;");
		$previousA = DB::select("SELECT DISTINCT v.*,UNIX_TIMESTAMP(v.created_at) AS created,u.channel_name,p.randID,p.id AS playlist_id FROM playlists p
			LEFT JOIN playlists_items i ON p.id = i.playlist_id
			INNER JOIN videos v ON i.video_id = v.id
			INNER JOIN users u ON v.user_id = u.id
			AND i.playlist_id = '".$playlistId."'
			and v.id != '".$video->id."'
			AND i.id < '".$itemId->id."'
			and v.deleted_at IS NULL
			or v.report_count > 5
			and v.publish = 1
			ORDER BY i.id desc
			LIMIT 1;");
		$playlistVideos = DB::select("SELECT DISTINCT v.*,UNIX_TIMESTAMP(v.created_at) AS created,u.channel_name,p.randID,p.id as playlist_id FROM playlists p
			LEFT JOIN playlists_items i ON p.id = i.playlist_id
			INNER JOIN videos v ON i.video_id = v.id
			INNER JOIN users u ON v.user_id = u.id
			WHERE i.playlist_id = '".$playlistId."'
			and v.deleted_at IS NULL
			or v.report_count > 5
			and v.publish = 1
			");
		//return $nextA;
		if(isset(Auth::User()->id)){
			$like = Like::where('video_id','=',$video->id)
			->where('user_id','=',Auth::User()->id)->first();
			$favorites = Favorite::where('video_id','=',$video->id)
			->where('user_id','=',Auth::User()->id)->first();
			$watchLater = WatchLater::where('video_id','=',$video->id)
			->where('user_id','=',Auth::User()->id)->first();
			$dislike = Dislike::where('video_id','=',$video->id)
			->where('user_id','=',Auth::User()->id)->first();
		}
		else{
			$like = null;
			$favorites = null;
			$watchLater = null;
			$dislike = null;
		}
		$countSubscribers = $this->Subscribe->getSubscribers($owner->channel_name);
		$likeCounter = Like::where('video_id','=',$video->id)->count();
		$dislikeCounter = Dislike::where('video_id','=',$video->id)->count();
		return View::make('users.watchplaylist',compact('video','playlistVideos','owner','nextA','previousA','like','likeCounter','favorites','watchLater','countSubscribers','dislikeCounter','dislike'));
	}

	public function postSignIn() {
		$input = Input::all();
		$validate = Validator::make($input, User::$user_login_rules);
		if($validate->fails()) {
			return Redirect::route('homes.signin')->with('flash_bad',"Wrong Channel name or password")->withInput();
		} else{
			$attempt = User::getUserLogin($input['channel_name'], $input['password']);
			if($attempt){
				$verified = Auth::User()->verified;
				$status = Auth::User()->status;
				return Redirect::intended('/');
			}
		}
		return Redirect::route('homes.signin')->withFlashMessage('flash_warning','Invalid Credentials!')->withInput();
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
		if(!empty($comment)){
			$comments = new Comment;
			$comments->video_id = $video_id;
			$comments->user_id = $user_id;
			$comments->comment = $comment;
			$comments->save();

			/*Notification Start*/
			$videoData = Video::find($video_id);
			if($this->Auth->id != $videoData->user_id){
				$channel_id = $videoData->user_id;
				$notifier_id = $user_id;
				$routes = route('homes.watch-video', $videoData->file_name);
				$type = 'comment';
				$this->Notification->constructNotificationMessage($channel_id, $notifier_id, $type, $routes); //Creates the notifcation
			}
			/*Notification End*/


			$likesCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $comments->id, 'status' => 'liked'))->count();
			$dislikeCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $comments->id, 'status' => 'disliked'))->count();

			$ifAlreadyLiked = DB::table('comments_likesdislikes')->where(array(
				'comment_id' => $comments->id, 'user_id' => $user_id,'status' => 'liked'))->first();
			$ifAlreadyDisliked = DB::table('comments_likesdislikes')->where(array(
				'comment_id' => $comments->id, 'user_id' => $user_id,'status' => 'disliked'))->first();

			$userInfo = User::find($user_id);

			if(file_exists(public_path('img/user/'. $userInfo->id . '.jpg'))){
				$temp = 'img/user/'.$userInfo->id . '.jpg';
			} else{
				$temp = 'img/user/0.jpg';
			}
			$newComment =  
			'<div class="commentsarea row">
				<div class="commentProfilePic col-md-1">'. 
					HTML::image($temp, "alt", array("class" => "img-responsive", "height" => "48px", 'width' => '48px')).'
				</div>
				<div class="col-md-11">
					<div class="row">'.
						link_to_route("view.users.channel", $userInfo->channel_name, $parameters = array($userInfo->channel_name), $attributes = array("id" => "channel_name")) .'
						| &nbsp;<small> just now. </small> 
						<br/>
						<p class="text-justify">
							'. $comments->comment . '
						</p>
						<div class="fa fa-thumbs-up likedup">
							<input type="hidden" value="'.$comments->id.'" name="likeCommentId">
							<input type="hidden" value='.Auth::User()->id.'" name="likeUserId">
							<input type="hidden" value="'.$video_id.'" name="video_id">
							<input type="hidden" value="liked" name="status">
							<span class="likescount" id="likescount">'.$likesCount.'</span>
						</div>
						|&nbsp;
						<div class="fa fa-thumbs-down dislikedup">
							<input type="hidden" value="'.$comments->id.'" name="dislikeCommentId">
							<input type="hidden" value="'.$userInfo->user_id.'" name="dislikeUserId">
							<input type="hidden" value="'.$video_id.'" name="video_id">
							<input type="hidden" value="disliked" name="status">
							<span class="dislikescount" id="dislikescounts">'.$dislikeCount.'</span> &nbsp;
						</div>
						|&nbsp;
						<span class="repLink hand">0<i class="fa fa-reply"></i></span>

						<div id="replysection" class="panelReply"> '.
							Form::open(array("route"=>"post.addreply", "id" =>"video-addReply", "class" => "inline")).'
								<input type="hidden" name="comment_id" value="'.$comments->id.'">
								<input type="hidden" name="user_id" value="'.$userInfo->id.'">
								<input type="hidden" name="video_id" value="'.$video_id.'">
								<textarea name="txtreply" id="txtreply" class="form-control txtreply"></textarea>
								<input class="btn btn-primary pull-right" id="replybutton" type="submit" value="Reply">

								<span class="replyError inputError"></span>
							</form>
						</div>
					</div>
				</div>
			</div>
			<hr/>
			';

	return Response::json(array(
		'status' => 'success',
		'comment' => $comment,
		'video_id' => $video_id,
		'user_id' => $user_id,
		'comment' => $newComment
		));
	}
}

public function addReply(){
	$reply = trim(Input::get('txtreply'));
	$comment_id = Input::get('comment_id');
	$user_id = Input::get('user_id');
	$video_id = Input::get('video_id');

	if(empty($reply)){
		return Response::json(array('status'=>'error','label' => 'The reply field is required.'));
	}
	if(!empty($reply)){
		$replies = new CommentReply;
		$replies->comment_id = $comment_id;
		$replies->user_id = $user_id;
		$replies->reply = $reply;
		$replies->save();

		$userInfo = User::find($user_id);
		if(file_exists(public_path('img/user/'. $user_id . '.jpg'))){
			$temp = 'img/user/'. $user_id . '.jpg';
		} else{
			$temp = 'img/user/0.jpg';
		}

		$newReply = 
		'<div class="commentProfilePic col-md-1">' .
		HTML::image($temp, "alt", array("class" => "img-responsive", "height" => "48px", "width" => "48px")) . 
		'</div>
		<div class="col-md-11">
			<div class="row">' .
				link_to_route("view.users.channel", $userInfo->channel_name, $parameters = array($userInfo->channel_name), $attributes = array("id" => "channel_name")) . '&nbsp|&nbsp;' .
				'<small>just now.</small><br/>
				<p style="text-align:justify;">' . $reply . '<br/>' . '</p></hr>
			</div>
		</div>	
		';

		/*Notification Start*/
		$videoData = Video::find($video_id);
		if($this->Auth->id != $videoData->user_id){
			$channel_id = Comment::find($comment_id)->user_id;
			$notifier_id = $user_id;
			$routes = route('homes.watch-video', $videoData->file_name);
			$type = 'replied';
				$this->Notification->constructNotificationMessage($channel_id, $notifier_id, $type, $routes); //Creates the notifcation
				/*Notification End*/
			}
			return Response::json(array('status' => 'success', 'reply' => $newReply));
		}
	}

	public function addLiked(){
		$likeCommentId = Input::get('likeCommentId');
		$likeUserId = Input::get('likeUserId');
		$statuss = Input::get('status');
		$video_id = Input::get('video_id');

		if($statuss == 'liked'){
			DB::table('comments_likesdislikes')->insert(
				array('comment_id' => $likeCommentId,
					'user_id'    => $likeUserId,
					'status' 	   => 'liked'
					)
				);
			$likesCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $likeCommentId, 'status' => 'liked'))->count();

			/*Notification Start*/
			$videoData = Video::find($video_id);
			if($this->Auth->id != $videoData->user_id){
				$channel_id = Comment::find($comment_id)->user_id;
				$notifier_id = $user_id;
				$routes = route('homes.watch-video', $videoData->file_name);
				$type = 'liked';
				$this->Notification->constructNotificationMessage($channel_id, $notifier_id, $type, $routes); //Creates the notifcation
			}
			/*Notification End*/
			return Response::json(array('status' => 'success', 'likescount' => $likesCount, 'label' => 'unliked'));

		} elseif($statuss == 'unliked'){
			DB::table('comments_likesdislikes')->where(array('comment_id' => $likeCommentId, 'user_id' => $likeUserId, 'status' => 'liked'))->delete();
			$likesCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $likeCommentId, 'status' => 'liked'))->count();
			return Response::json(array('status' => 'success', 'likescount' => $likesCount, 'label' => 'liked'));
		}
	}

	public function addDisliked(){
		$dislikeCommentId = Input::get('dislikeCommentId');
		$dislikeUserId = Input::get('dislikeUserId');
		$statuss = Input::get('status');

		if($statuss == 'disliked'){
			DB::table('comments_likesdislikes')->insert(
				array('comment_id' => $dislikeCommentId,
					'user_id'    => $dislikeUserId,
					'status' 	   => 'disliked'
					)
				);
			$dislikesCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $dislikeCommentId, 'status' => 'disliked'))->count();
			return Response::json(array('status' => 'success', 'dislikescount' => $dislikesCount, 'label' => 'undisliked'));
		} elseif($statuss == 'undisliked'){
			DB::table('comments_likesdislikes')->where(array('comment_id' => $dislikeCommentId, 'user_id' => $dislikeUserId, 'status' => 'disliked'))->delete();
			$dislikesCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $dislikeCommentId, 'status' => 'disliked'))->count();
			return Response::json(array('status' => 'success', 'dislikescount' => $dislikesCount, 'label' => 'disliked'));
		}
	}

	public function getCategory($category = null){
		if(!empty($category)){
			$videos = Video::select('videos.id',
				'videos.user_id',
				'videos.title',
				'videos.description',
				'users.channel_name',
				'videos.tags',
				'videos.file_name',
				'videos.views',
				'videos.created_at',
				DB::raw('(SELECT count(ul.video_id) from users_likes ul where ul.video_id = videos.id) as likes'))
			->where('category', 'LIKE', '%'.$category.'%')
			->where('deleted_at', NULL)
			->where('publish', 1)
			->where('report_count', '<', 5)
			->orderBy(DB::raw('(views + likes)'))
			->join('users', 'user_id', '=', 'users.id')
			->paginate( 16);

			foreach($videos as $key => $video){
			//Thumbnails
				$folderName = $video->user_id. '-'. $video->channel_name;
				$fileName = $video->file_name;
				$thumbnail = 'videos/'.$folderName. DIRECTORY_SEPARATOR .$fileName. DIRECTORY_SEPARATOR .$fileName.'.jpg';
				$videos[$key]->thumbnail = 'img\thumbnails\video.png';
				if(file_exists(public_path($thumbnail))){
					$videos[$key]->thumbnail = $thumbnail;
				}
			}

			//return DB::getQueryLog();
			if(!$videos->isEmpty()){
				return View::make('homes.category', compact(array('videos','category')));
			}
		}
		return Redirect::route('homes.index');
	}

	public function testingpage(){ 
		dd(file_exists(public_path('/videos/7-mygsc/ZsBuaZgQdg9/ZsBuaZgQdg9.jpg')));

	}

	public function getChangeLogs() {

		return View::make('homes.changelogs');
	}
}
