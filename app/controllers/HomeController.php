<?php

class HomeController extends BaseController {


	public function __construct(User $user, Video $video,Notification $notification, Subscribe $subscribes,Playlist $playlists) {
		$this->User = $user;
		$this->Video = $video;
		$this->Notification = $notification;
		$this->Auth = Auth::User();
		$this->Subscribe = $subscribes;
		$this->Playlist = $playlists;
	}
	public function getAboutUs() { 
		return View::make('homes.aboutus');
	}

	public function postContactUs(){
		$input = Input::all();
		$validate = $validator = Validator::make(
			array(
				'name' => $input['name'],
				'email' => $input['email'],
				'message' => $input{'message'}),
			array(
				'name' => 'required',
				'email' => 'required|email',
				'message' => 'required')
			);

		if($validate->fails()){
			return Redirect::route('homes.aboutus')->withFlashBad('Please check your inputs!')->withInput()->withErrors($validate);
		}
		return Redirect::route('homes.aboutus')->withFlashGood('Your message was successfully sent. Thank you for using our services!');
	}

	public function getPrivacy() {
		return View::make('homes.privacy');
		$getCommentReplies = 
		User::select(
			'users.id',
			'channel_name')
		->join('comments_reply', 'comments_reply.user_id', '=', 'users.id')
		->orderBy('comments_reply.created_at', 'asc')
		->where('comments_reply.comment_id', $getVideoComment->id)->get();

		$getCommentReplies = DB::select('users.id', 'comments.id as commentid')
		->table('comments_reply')
		->join('users', 'users.id', '=', 'comments_reply.user_id')
		->orderBy('comments_reply.created_at', 'asc')
		->where('comment_id', $getVideoComment->id)->get();
	}

	public function getTermsAndConditions() {
		return View::make('homes.termsandconditions');
	}

	public function getAdvertisements() {
		return View::make('homes.advertisements');
	}

	public function getCopyright() {

	}

	public function postPlaylist() {
		return View::make('homes.playlist');
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

	public function getIndex() {
		$recommendeds = $this->Video->getFeaturedVideo('recommended', '9');
		$populars = $this->Video->getFeaturedVideo('popular', '9');
		$latests = $this->Video->getFeaturedVideo('latest', '9');
		$randoms = $this->Video->getFeaturedVideo('random', '9');
		$categories = $this->Video->getCategory();
		$notifications = $this->Notification->getNotificationForSideBar();
		//return $notifications;
		return View::make('homes.index', compact(array('recommendeds', 'populars', 'latests', 'randoms', 'categories', 'notifications')));
	}

	public function getPopular() {
		$categories = $this->Video->getCategory();
		$popularVideos = $this->Video->getFeaturedVideo('popular', 12);
		$notifications = $this->Notification->getNotificationForSideBar();

		if($popularVideos === false){
			app::abort(404, 'Unauthorized Action'); 
		}

		return View::make('homes.popular', compact('popularVideos','categories','notifications'));
	}

	public function getLatest() {
		$categories = $this->Video->getCategory();
		$latestVideos =  $this->Video->getFeaturedVideo('latest', 12);
		$notifications = $this->Notification->getNotificationForSideBar();

		if($latestVideos === false){
			app::abort(404, 'Unauthorized Action'); 
		}

		return View::make('homes.latest', compact('latestVideos','categories', 'notifications'));
	}

	public function getPlaylist() {
		$categories = $this->Video->getCategory();
		$input = Input::all();
		$playlists = $this->Playlist->getPlaylist(12,'playlists.created_at');
		$notifications = $this->Notification->getNotificationForSideBar();

		// return (DB::getQueryLog());
		$options = array('Likes'=>'Likes','View'=>'View', 'Recent'=>'Recent');
		return View::make('homes.playlist', compact(array('options', 'playlists','categories', 'notifications')));
	}

	public function getCategory($category = null){
		$notifications = $this->Notification->getNotificationForSideBar();
		$categories = $this->Video->getCategory();
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
				DB::raw('(SELECT count(ul.video_id) from user_likes ul where ul.video_id = videos.id) as likes'))
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
				return View::make('homes.category', compact(array('videos','category','categories','notifications')));
			}
		}
		return Redirect::route('homes.index');
	}

	public function watchVideo($idtitle=null){
		$videos = Video::where('file_name','=',$idtitle)->first();
		if(!isset($videos)) return Redirect::route('homes.index')->with('flash_bad','This video is not found.');
		$id = $videos->id;
		$videoId = $id;
		$owner = User::find($videos->user_id);
		if($videos->publish != '1')return Redirect::route('homes.index')->with('flash_bad','The video is not published.');
		if($owner->status != '1') return Redirect::route('homes.index')->with('flash_bad','The owner of this video is deactivated.');
		$title = preg_replace('/[^A-Za-z0-9\-]/', ' ',$videos->title);
		$description = preg_replace('/[^A-Za-z0-9\-]/', ' ',$videos->description);
		$tags = $videos->tags;
		$query = "MATCH(videos.title,videos.description,videos.tags) AGAINST ('".$title.','.$description.','.$tags."' IN BOOLEAN MODE)";
		$relations = $this->Video->relations($query,$videos->id);
		$counter = count($relations);
		$ownerVideos = Video::where('user_id',$videos->user_id)
		->where('publish','1')
		->where('report_count','<','5')
		->where('id','!=',$videos->id)
		->orderBy('id','desc')
		->take(3)->get();
		$likeownerVideosCounter = 0;
		foreach($ownerVideos as $ownerVideo){
			$likeownerVideos[] = UserLike::where('video_id',$ownerVideo->id)->count();
		}
		if($counter >= 15){
			$newRelation = $this->Video->relations($query,$videos->id,'15');
		}else{
			$randomCounter = 14;
			for($i = 0;$i <= $randomCounter; $i++){
				if($counter == $i){
					$randoms = $this->Video->randomRelation($randomCounter,$videos->id);
					$merging = array_merge(json_decode($relations, true),json_decode($randoms, true));
					$newRelation =array_unique($merging,SORT_REGULAR);
				}		
				$randomCounter--;

			}
		}

		if(isset(Auth::User()->id)){
			$playlists = $this->Playlist->playlistchoose($id);
			$playlistNotChosens =  $this->Playlist->playlistnotchosen($id);

			$favorites = UserFavorite::where('video_id','=',$id)
			->where('user_id','=',Auth::User()->id)->first();
			$watchLater = UserWatchLater::where('video_id','=',$id)
			->where('user_id','=',Auth::User()->id)->first();
			$like = UserLike::where('video_id','=',$id)
			->where('user_id','=',Auth::User()->id)->first();
			$dislike = UserDislike::where('video_id','=',$id)
			->where('user_id','=',Auth::User()->id)->first();

		}
		else{
			$playlists = null;
			$playlistNotChosens = null;
			$favorites = null;
			$watchLater = null;
			$like = null;
			$dislike = null;
		}
		$likeCounter = UserLike::where('video_id','=',$id)->count();
		$dislikeCounter = UserDislike::where('video_id','=',$id)->count();		

		//////////////////////r3mmel////////////////////////////
		$getVideoComments = DB::table('users')->join('comments', 'users.id', '=', 'comments.user_id')
		->where('comments.video_id', $videoId)->orderBy('comments.id','desc')->get();
		$countSubscribers = $this->Subscribe->getSubscribers($owner->channel_name);
		$ifAlreadySubscribe = 0;
		if(isset(Auth::User()->id)) {
			$ifAlreadySubscribe =  DB::table('subscribes')->where(array('user_id' => $owner->id,'subscriber_id' => Auth::User()->id))->first();
		}
		//////////////////////r3mmel////////////////////////////

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
		
		return View::make('homes.watch-video',compact('videos','owner','id','playlists','playlistNotChosens','favorites', 'getVideoComments', 'videoId','like','likeCounter','watchLater','newRelation','countSubscribers','ownerVideos','likeownerVideos','likeownerVideosCounter','datas', 'ifAlreadySubscribe','dislikeCounter','dislike'));

	}
	public function getWatchPlaylist($videoId,$playlistId){
		$randID = Playlist::where('randID',$playlistId)->first();
		$playlistId = $randID->id;
		if(!isset(Auth::User()->id)){
			if($randID->privacy == '0') return Redirect::route('homes.index');
		}
		$video = Video::where('file_name','=',$videoId)->first();
		$owner = User::find($video->user_id);
		$itemId = PlaylistItem::where('video_id',$video->id)
		->where('playlist_id',$playlistId)->first();
		$nextA = $this->Playlist->playlistControl('>',$playlistId,$video->id,$itemId->id);
		$previousA = $this->Playlist->playlistControl('<',$playlistId,$video->id,$itemId->id);
		$playlistVideos = $this->Playlist->playlistControl(NULL,$playlistId,$video->id,$itemId->id);
		if(isset(Auth::User()->id)){
			$like = UserLike::where('video_id','=',$video->id)
			->where('user_id','=',Auth::User()->id)->first();
			$favorites = UserFavorite::where('video_id','=',$video->id)
			->where('user_id','=',Auth::User()->id)->first();
			$watchLater = UserWatchLater::where('video_id','=',$video->id)
			->where('user_id','=',Auth::User()->id)->first();
			$dislike = UserDislike::where('video_id','=',$video->id)
			->where('user_id','=',Auth::User()->id)->first();
		}
		else{
			$like = null;
			$favorites = null;
			$watchLater = null;
			$dislike = null;
		}
		
		$countSubscribers = $this->Subscribe->getSubscribers($owner->channel_name);
		$likeCounter = UserLike::where('video_id','=',$video->id)->count();
		$dislikeCounter = UserDislike::where('video_id','=',$video->id)->count();
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
			// $videoData = Video::find($video_id);
			// if($user_id != $videoData->user_id){
			// 	$channel_id = $videoData->user_id;
			// 	$notifier_id = $user_id;
			// 	$routes = route('homes.watch-video', $videoData->file_name);
			// 	$type = 'comment';
			// 	$this->Notification->constructNotificationMessage($channel_id, $notifier_id, $type, $routes); //Creates the notifcation
			// }
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
						<p class="text-justify">'. $comments->comment . '</p>
						<div class="fa commentlikedup">
							<span class="fa-thumbs-up hand"></span>
							<input type="hidden" value="'.$comments->id.'" name="likeCommentId">
							<input type="hidden" value='.Auth::User()->id.'" name="likeUserId">
							<input type="hidden" value="'.$video_id.'" name="video_id">
							<input type="hidden" value="liked" name="status">
							<span class="likescount" id="likescount">'.$likesCount.'</span>
						</div>
						&nbsp;
						<div class="fa commentdislikedup">
							<span class="fa-thumbs-down hand"></span>
							<input type="hidden" value="'.$comments->id.'" name="dislikeCommentId">
							<input type="hidden" value="'.Auth::User()->id.'" name="dislikeUserId">
							<input type="hidden" value="'.$video_id.'" name="video_id">
							<input type="hidden" value="disliked" name="status">
							<span class="dislikescount" id="dislikescounts">'.$dislikeCount.'</span> &nbsp;
						</div>
						&nbsp;
						<span class="repLink hand">0<i class="fa fa-reply"></i></span>

						<div id="replysection" class="panelReply" style="display: none;">'.
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
			$newReply = '';
			$newReply2 = '';

			$newReplyFirst = 

				'<div class="commentProfilePic col-md-1">
					<img src="'.$temp.'" class="img-responsive inline" height="48px" width="48px" alt="alt"></div>
				<div class="col-md-11">
					<div class="row">' .
						link_to_route("view.users.channel", $userInfo->channel_name, $parameters = array($userInfo->channel_name), $attributes = array("id" => "channel_name")) . '&nbsp|&nbsp;' .
						'<small>just now.</small><br/>
						<p style="text-align:justify;">' . $replies->reply . '<br/>' . '</p></hr>
					</div>
			';
			$likesCountReply = DB::table('comments_reply_likesdislikes')->where(array('comments_reply_id' => $replies->id, 'status' => 'liked'))->count();
			$dislikeCountReply = DB::table('comments_reply_likesdislikes')->where(array('comments_reply_id' => $replies->id, 'status' => 'disliked'))->count();

			
			$ifAlreadyLiked = DB::table('comments_reply_likesdislikes')->where(array(
				'comments_reply_id' => $replies->id, 
				'user_id' => $user_id,
				'status' => 'liked'
			))->first();
			$ifAlreadyDisliked = DB::table('comments_reply_likesdislikes')->where(array(
				'comments_reply_id' => $replies->id, 
				'user_id' => $user_id,
				'status' => 'disliked'
			))->first();

			$newReply2 = $newReply2 . '
				<div class="fa replylikedup">';
					if(!$ifAlreadyLiked){
						$newReply2 = $newReply2 .'
						<span class="fa-thumbs-up hand"></span>
						<input type="hidden" value="liked" name="status">';
					}else{
						$newReply2 = $newReply2 .'
						<span class="fa-thumbs-up blueC hand"></span>
						<input type="hidden" value="unliked" name="status">';
					}
					$newReply2 = $newReply2 .'
					<input type="hidden" value="'.$replies->id.'" name="likeCommentId">
					<input type="hidden" value="'.$user_id.'" name="likeUserId">
					<input type="hidden" value="'.$video_id.'" name="video_id">
					<span class="likescount" id="likescount">'.$likesCountReply.'</span>
				</div>
				&nbsp;
				<div class="fa replydislikedup">
					<input type="hidden" value="'.$replies->id.'" name="dislikeCommentId">
					<input type="hidden" value="'.$user_id.'" name="dislikeUserId">
					<input type="hidden" value="'.$video_id.'" name="video_id">';
					if(!$ifAlreadyDisliked){
						$newReply2 = $newReply2 .'
						<input type="hidden" value="disliked" name="status">
						<span class="fa-thumbs-down hand"></span>';
					}else{
						$newReply2 = $newReply2 .'
						<input type="hidden" value="undisliked" name="status">
						<span class="fa-thumbs-down redC hand"></span>';
					}
					$newReply2 = $newReply2 .'
					<span class="dislikescount" id="dislikescounts">'.$dislikeCountReply.'</span> &nbsp;
				</div>
				&nbsp;';
				$getCommentReplies = DB::table('comments_reply')
				->join('users', 'users.id', '=', 'comments_reply.user_id')
				->where('comment_id', $comment_id)->count(); 

			$newReply2 = $newReply2 .'
			</div>';
			$newReply = $newReplyFirst . "" . $newReply2;

			/*Notification Start*/
			// $videoData = Video::find($video_id);
			// if($user_id != $videoData->user_id){
			// 	$channel_id = Comment::find($comment_id)->user_id;
			// 	$notifier_id = $user_id;
			// 	$routes = route('homes.watch-video', $videoData->file_name);
			// 	$type = 'replied';
			// 	$this->Notification->constructNotificationMessage($channel_id, $notifier_id, $type, $routes); //Creates the notifcation
			// 	/*Notification End*/
			// }
			return Response::json(array('status' => 'success', 'reply' => $newReply));
		}
	}

	public function addLikedComment(){
		$likeCommentId = Input::get('likeCommentId');
		$likeUserId = Input::get('likeUserId');
		$statuss = Input::get('status');
		$videoId = Input::get('video_id');

		if($statuss == 'liked'){
			DB::table('comments_likesdislikes')->insert(
				array('comment_id' => $likeCommentId,'user_id' => $likeUserId,'status' => 'liked')
			);
			$likesCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $likeCommentId, 'status' => 'liked'))->count();

			/*Notification Start*/
			$videoData = Video::find($videoId)->first();
			if($likeUserId != $videoData->user_id){
				$channel_id = Comment::find($likeCommentId)->first();
				$notifier_id = $likeUserId;
				$routes = route('homes.watch-video', $videoData->file_name);
				$type = 'liked';
				$this->Notification->constructNotificationMessage($channel_id->user_id, $notifier_id, $type, $routes); //Creates the notifcation
			}
			/*Notification End*/
			return Response::json(array('status' => 'success', 'likescount' => $likesCount, 'label' => 'unliked'));

		} elseif($statuss == 'unliked'){
			DB::table('comments_likesdislikes')->where(array('comment_id' => $likeCommentId, 'user_id' => $likeUserId, 'status' => 'liked'))->delete();
			$likesCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $likeCommentId, 'status' => 'liked'))->count();
			return Response::json(array('status' => 'success', 'likescount' => $likesCount, 'label' => 'liked'));
		}
	}
	public function addDislikedComment(){
		$dislikeCommentId = Input::get('dislikeCommentId');
		$dislikeUserId = Input::get('dislikeUserId');
		$statuss = Input::get('status');
		$videoId = Input::get('video_id');

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

	public function addLikedReply(){
		$likeCommentId = Input::get('likeCommentId');
		$likeUserId = Input::get('likeUserId');
		$statuss = Input::get('status');
		$videoId = Input::get('video_id');

		if($statuss == 'liked'){
			DB::table('comments_reply_likesdislikes')->insert(
				array('comments_reply_id' => $likeCommentId,'user_id' => $likeUserId,'status' => 'liked')
			);
			$likesCount = DB::table('comments_reply_likesdislikes')->where(array('comments_reply_id' => $likeCommentId, 'status' => 'liked'))->count();

			/*Notification Start*/
			$videoData = Video::find($videoId)->first();
			if($likeUserId != $videoData->user_id){
				$channel_id = Comment::find($likeCommentId)->first();
				$notifier_id = $likeUserId;
				$routes = route('homes.watch-video', $videoData->file_name);
				$type = 'liked';
				$this->Notification->constructNotificationMessage($channel_id->user_id, $notifier_id, $type, $routes); //Creates the notifcation
			}
			/*Notification End*/
			return Response::json(array('status' => 'success', 'likescount' => $likesCount, 'label' => 'unliked'));

		} elseif($statuss == 'unliked'){
			DB::table('comments_reply_likesdislikes')->where(array('comments_reply_id' => $likeCommentId, 'user_id' => $likeUserId, 'status' => 'liked'))->delete();
			$likesCount = DB::table('comments_reply_likesdislikes')->where(array('comments_reply_id' => $likeCommentId, 'status' => 'liked'))->count();
			return Response::json(array('status' => 'success', 'likescount' => $likesCount, 'label' => 'liked'));
		}
	}
	public function addDislikedReply(){
		$dislikeCommentId = Input::get('dislikeCommentId');
		$dislikeUserId = Input::get('dislikeUserId');
		$statuss = Input::get('status');
		$videoId = Input::get('video_id');

		if($statuss == 'disliked'){
			DB::table('comments_reply_likesdislikes')->insert(
				array('comments_reply_id' => $dislikeCommentId,
					'user_id'    => $dislikeUserId,
					'status' 	   => 'disliked'
					)
				);
			$dislikesCount = DB::table('comments_reply_likesdislikes')->where(array('comments_reply_id' => $dislikeCommentId, 'status' => 'disliked'))->count();
			return Response::json(array('status' => 'success', 'dislikescount' => $dislikesCount, 'label' => 'undisliked'));
		} elseif($statuss == 'undisliked'){
			DB::table('comments_reply_likesdislikes')->where(array('comments_reply_id' => $dislikeCommentId, 'user_id' => $dislikeUserId, 'status' => 'disliked'))->delete();
			$dislikesCount = DB::table('comments_reply_likesdislikes')->where(array('comments_reply_id' => $dislikeCommentId, 'status' => 'disliked'))->count();
			return Response::json(array('status' => 'success', 'dislikescount' => $dislikesCount, 'label' => 'disliked'));
		}
	}


	public function getChangeLogs() {
		return View::make('homes.changelogs');
	}

	public function getTimezone(){
		$inputs = Input::all();
		$convert_time = date("d-m-Y H:i:s", strtotime($inputs['current_time']));
		$time = date('F d, Y', strtotime($convert_time. '+'. $inputs['users_GMT'].' hours'));
		return $time;
	}

	public function testingpage(){ 
		Pencepay_Context::setPublicKey("pub_jgCebc4gqioxgC");
		Pencepay_Context::setSecretKey("Dsm17Im1BLncat3If8YA7zYA9stJty8MM8l7EfqMkbI=");
		Pencepay_Context::setEnvironment(Pencepay_Context::PRODUCTION);

		$transaction = Pencepay_Transaction::create(
			Pencepay_Request_Transaction::build()
			->orderId('123456')
			->amount(10.99)
			->currencyCode('EUR')
			->creditCard()
			->cardholderName('John Hancock')
			->number('4350100010001002')
			->cvv('313')
			->expiryMonth(12)
			->expiryYear(2016)
			->done()
			);

		print_r($transaction);
		
	}
}
