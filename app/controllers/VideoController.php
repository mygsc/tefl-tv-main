<?php

class VideoController extends BaseController {
	protected $user;
	protected $url;
	protected $video_;
	public function __construct(Video $videos, User $users, Notification $notifications, Playlist $playlists,Subscribe $subscribers, UserWatchLater $watchLater, UserFavorite $userFavorite){
		$this->Subscribe = $subscribers;
		$this->Playlist = $playlists;
		$this->User = $users;
		$this->Video = $videos;
		$this->Auth = Auth::User();
		$this->url = URL::full();
		$this->Notification	= $notifications;
		define('DS', DIRECTORY_SEPARATOR); 
		$this->UserWatchLater = $watchLater;
		$this->UserFavorite = $userFavorite;
		$this->video_ = new Video;
	}
	public function getUpload(){
		if(Auth::check()){return View::make('users.upload');}
		return Redirect::route('homes.signin')->withFlashWarning('Please sign in to upload video.');
	}
	public function postUpload($filenameLenght = 11){
		$fileName = $this->video_->randomChar();
		$input = Input::all();
		$userFolderName = $this->Auth->id;
		$validator = Validator::make($input,Video::$video_rules); 
		$checkFilenameExist = Video::where('file_name', '=', $fileName); 
		if($checkFilenameExist->count()){$fileName = $this->video_->randomChar(12);}
		if($validator->passes()){
			$input['user_id'] = $this->Auth->id;
			$ext = $input['video']->getClientOriginalExtension();
			$create = Video::create($input);
			$latest_id = $create->id;
			Session::put('fileName', $fileName);
			$getVidDuration = $this->video_->getTimeDuration($input['video']);
			$db_filename = Video::find($latest_id);
			$db_filename->file_name = $fileName;
			$db_filename->title = 'Untitled';
			$db_filename->total_time = $getVidDuration;
			$db_filename->tags = null;
			$db_filename->extension = $ext;
			$db_filename->uploaded = 0;
			$db_filename->publish = 0;
			if($db_filename->save()){
				$destinationPath = public_path('videos'.DS. $userFolderName);
				$videoFolderPath = $destinationPath.DS.$fileName;
				if(!file_exists($destinationPath)){mkdir($destinationPath);}
				if(!file_exists($videoFolderPath)){mkdir($videoFolderPath);}
				$this->video_->captureImage($input['video'], $destinationPath, $fileName);
				$input['video']->move($destinationPath.DS.$fileName.DS, 'original.'.$ext);
				$thumbnail = '/videos'.DS.$userFolderName.DS.$fileName.DS.$fileName;
				return Response::json([
					'vidid' => Crypt::encrypt($latest_id),
					'file' => $fileName, 
					'thumb1' => $thumbnail.'_thumb1.png',//Session::get('thumbnail_1'),
					'thumb2' => $thumbnail.'_thumb2.png',//Session::get('thumbnail_2'),
					'thumb3' => $thumbnail.'_thumb3.png',//Session::get('thumbnail_3'),
				]);
			}
		}
		return Redirect::route('get.upload')->withInput()->withErrors($validator)
		->withFlashBad('Oops please check your video details.');
	}
	private function duration($path){
		$ffprobe = $this->video_->ffprobe(); 
		$duration = $ffprobe->format($path)->get('duration');
		return $result = floor($duration);
	}
	public function getCancelUploadVideo(){
		$fileName = Session::get('fileName');
		if(empty($fileName)){return Redirect::route('get.upload')->withFlashBad('Video uploading has been cancelled.');}
		$userFolderName = $this->Auth->id;
		$destinationPath = public_path('videos'.DS. $userFolderName.DS);
		if(file_exists($destinationPath.$fileName)){
			$this->deleteDirectory($destinationPath.$fileName);
			Video::where('file_name', $fileName)->delete();
		}
		return Redirect::route('get.upload')->withFlashBad('Video uploading has been cancelled.');

	}
	public function deleteDirectory($dirname) {
		if (is_dir($dirname))
			$dir_handle = opendir($dirname);
		if (!$dir_handle)
			return false;
		while($file = readdir($dir_handle)) {
			if ($file != "." && $file != "..") {
				if (!is_dir($dirname.DS.$file))
					unlink($dirname.DS.$file);
				else
					deleteDirectory($dirname.DS.$file);
			}
		}
		closedir($dir_handle);
		rmdir($dirname);
		return true;
	}
	public function getAddDescription($filename = null){
		$videos = Video::where('file_name','=',$filename)->get();
		return View::make('users.addDescription',compact('videos'));
	}
	public function postAddDescription($id, $selectedCategory = null){
		$id = Crypt::decrypt($id);  
		$videos = Video::find($id);
		$fileName = $videos->file_name;
		$validator = Validator::make([
			'title'=>Input::get('title'),
			'description' => Input::get('description'),
			'tags' => Input::get('tags')
			],
			[
			'title'=> 'required',
			'tags' => 'required'
		]);//Video::$addDescription
		$userFolderName = $this->Auth->id;
		$destinationPath =  public_path('videos'.DS. $userFolderName.DS.$fileName.DS);
		if($validator->passes()){
			if(Input::hasFile('poster')){
				$this->video_->resizeImage(Input::file('poster'), 1200, 630, $destinationPath.$fileName.'_600x338.jpg');
				$this->video_->resizeImage(Input::file('poster'), 240, 141, $destinationPath.$fileName.'.jpg');
			} else{
				$selectedThumb =  Input::get('thumbnail');
				if(strlen($selectedThumb) > 1){  
					$getDomain = asset('/');
					$thumbnail = str_replace($getDomain, '', $selectedThumb);
					$removeSpace = str_replace('%20',' ', $thumbnail);
					$this->video_->resizeImage(public_path($removeSpace), 1200, 630, $destinationPath.$fileName.'_600x338.jpg');
					$this->video_->resizeImage(public_path($removeSpace), 240, 141, $destinationPath.$fileName.'.jpg');
				}		
			}
			
			$tags = explode(',',Input::get('tags'));
			foreach($tags as $tag){
				if($tag != null){
					$newTags[] = strtolower($tag);
				}
			}
			$uniqueTag = array_unique($newTags);$implodeTag = implode(',',$uniqueTag);$video = Video::find($id);$publish = $video->publish;
			if(Input::has('cat')){$selectedCategory = implode(',',Input::get('cat'));}
			if($publish == 0){
				$video->title = Input::get('title');
				$video->description = Input::get('description');
				$video->category = $selectedCategory;
				$video->tags =  $implodeTag;
				$video->publish = Input::get('publish');
				$video->save();
				return Redirect::route('users.myvideos','upload=success&token='.$fileName)->withFlashGoodWithoutHide('Your video has been saved. We will notify you by email when your video is ready.');
			}
			return Redirect::route('get.upload');					
		}
		
		return Redirect::route('get.addDescription',$fileName)->withInput()->withErrors($validator)
		->with('message', 'There were validation errors.');
	}

	public function getViewVideoPlayer(){
		$domain = asset('/');
		$filename = str_replace($domain.'watch?v=', '', $this->url);
		return $filename;
		return View::make('videoplayer');
	}

	public function postRandom(){
		$input = Input::all();
		return Redirect::route('homes.random', $input['option'])->withInput();
	}

	public function postSearchVideos(){
		$input = Input::all();
		return Redirect::route('homes.searchresult', array($input['type'].'?'.$input['search']));
	}

	public function getSearchResult(){
		$type = preg_replace('/[^A-Za-z0-9\-]/', ' ',Input::get('type'));
		$search = preg_replace('/[^A-Za-z0-9\-]/', ' ',Input::get('search'));
		$searchResults = $this->Video->searchVideos($search);
		$notifications = $this->Notification->getNotificationForSideBar();
		$categories = $this->Video->getCategory();

		return View::make('homes.searchresult', compact(array('type','searchResults', 'search', 'categories','notifications')));
	}

	public function counter($id){
		$id = Crypt::decrypt($id);
		$video = Video::where('id','=',$id)->first();
		$video->views = $video->views++;
		$video->update();
	}

	public function fileExist($path, $filename, $ext = null, $user_id = null, $channel_name = null, $callback_message = null){
		$userFolderName = $user_id;
		$file = $filename .'.'. $ext;
		$path = 'public' .DS. $path .DS. $userFolderName .DS. $filename. $file;
		if(file_exists($path)){
			return true;
		} 
		return $path;
	}

	public function getEmbedVideo($filename){
		$vidFilename = Video::where('file_name','=',$filename);
		if($vidFilename->count()){
			$vidFilename = $vidFilename->first();
			$vidOwner = User::find($vidFilename->user_id);
			return View::make('homes.embedvideo', compact('vidFilename','vidOwner'));
		}
		return app::abort(404, 'Page not available.');
	}
	public function getSearch() {
		$search = preg_replace('/[^A-Za-z0-9\-]/', ' ',Input::get('search'));
		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = $this->Video->getVideos($this->Auth->id, 'videos.created_at', 1,8);
		$countVideos = Video::where('user_id', $this->Auth->id)->where('uploaded', 1)->count();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$picture = public_path('img/user/') . Auth::User()->id . '.jpg';
		$countAllViews = $this->Video->convertToShortNumbers($allViews);
		$usersWebsite = Website::where('user_id', $this->Auth->id)->first();
	  	$usersVideos =$this->Video->getSearchVideos($this->Auth->id, $search);
	  	return View::make('users.mychannels.videos', compact('searchVids','countSubscribers','usersChannel','usersVideos', 'countVideos', 'countAllViews','picture'));
	 }
	public function getSearchWatchLater() {
		$search = preg_replace('/[^A-Za-z0-9\-]/', ' ',Input::get('search'));
		$usersWatchLater = $this->UserWatchLater->getSearchWatchLater($this->Auth->id, $search);
		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$usersChannel = UserProfile::where('user_id',Auth::User()->id)->first();
		$usersVideos = User::find(Auth::User()->id)->video;
		$countVideos = Video::where('user_id', $this->Auth->id)->where('uploaded', 1)->count();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->convertToShortNumbers($allViews);		
		$picture = public_path('img/user/') . Auth::User()->id . '.jpg';

		return View::make('users.mychannels.watchlater', compact('countSubscribers','usersChannel','usersVideos', 'videosWatchLater', 'watch','countAllViews', 'countVideos','findUsersWatchLaters', 'usersWatchLater','picture'));
	}
	public function getSearchFavorites() {
		$search = preg_replace('/[^A-Za-z0-9\-]/', ' ',Input::get('search'));
		$findUsersVideos = $this->UserFavorite->getSearchFavoriteVideos($search);
		$countSubscribers = $this->Subscribe->getSubscribers(Auth::User()->channel_name);
		$usersChannel = UserProfile::find(Auth::User()->id);
		$usersVideos = User::find(Auth::User()->id)->video;
		$countVideos = Video::where('user_id', $this->Auth->id)->where('uploaded', 1)->count();
		$allViews = DB::table('videos')->where('user_id', Auth::User()->id)->sum('views');
		$countAllViews = $this->Video->convertToShortNumbers($allViews);
		$picture = public_path('img/user/') . Auth::User()->id . '.jpg';

		return View::make('users.mychannels.favorites', compact('countSubscribers','usersChannel','usersVideos', 'findUsersVideos','countAllViews', 'countVideos','picture'));
	}

	public function getChannelSearch($channel_name) {
		$userChannel = User::where('channel_name', $channel_name)->first();
		$user_id = 0;
		$search = preg_replace('/[^A-Za-z0-9\-]/', ' ',Input::get('searchTitle'));
		$usersVideos =$this->Video->getSearchVideos($search);
		$allViews = DB::table('videos')->where('user_id', $userChannel->id)->sum('views');
		$countAllViews = $this->Video->convertToShortNumbers($allViews);
		$countVideos = Video::where('user_id', $userChannel->id)->count();
		$countSubscribers = $this->Subscribe->getSubscribers($userChannel->channel_name);
		$picture = public_path('img/user/') . $userChannel->id . '.jpg';
		$usersWebsite = Website::where('user_id', $userChannel->id)->first();
		return View::make('users.channels.videos', compact('userChannel', 'countSubscribers','usersChannel','usersVideos','countVideos','countAllViews','picture','user_id','usersWebsite'));
	}

	public function getSearchChannelPlaylists($channel_name) {
		$user_id = 0;
		$userChannel = User::where('channel_name', $channel_name)->first();
		$search = preg_replace('/[^A-Za-z0-9\-]/', ' ',Input::get('searchPlaylists'));
		$playlists = $this->Playlist->searchPlaylists($userChannel->id, $search);

		$countSubscribers = $this->Subscribe->getSubscribers($userChannel->channel_name);
		$usersChannel = UserProfile::find($userChannel->id);
		$countVideos = DB::table('videos')->where('user_id', $userChannel->id)->get();
		$allViews = DB::table('videos')->where('user_id', $userChannel->id)->sum('views');
		$countAllViews = $this->Video->convertToShortNumbers($allViews);
		$picture = public_path('img/user/') . $userChannel->id . '.jpg';

		if(!empty($playlists)){
			foreach($playlists as $playlist){
				$thumbnail_playlists[] = $this->Playlist->playlistControl(null,$playlist->id,null,null);
			}
		}
		$usersWebsite = Website::where('user_id', $userChannel->id)->first();
		return View::make('users.channels.playlists', compact('userChannel','countSubscribers','usersChannel','usersVideos', 'playlists','countAllViews', 'countVideos','thumbnail_playlists','picture','user_id','usersWebsite'));
	}

	public function getUserSearchPlaylists() {
		return Input::all();
	}
	
	public function getWatchVideoRemoved(){
		return View::make('homes.watch-video-removed');
	}

	public function getWatchVideoCopyrighted(){
		return View::make('homes.watch-video-copyrighted');
	}
}

