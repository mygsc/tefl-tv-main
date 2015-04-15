<?php

class VideoController extends BaseController {
	protected $user;
	protected $url;
	public function __construct(Video $videos, User $users, Playlist $playlists,Subscribe $subscribers){
		$this->Subscribe = $subscribers;
		$this->Playlist = $playlists;
		$this->User = $users;
		$this->Video = $videos;
		$this->Auth = Auth::User();
		$this->url = URL::full();
		define('DS', DIRECTORY_SEPARATOR); 
	}

	public function getUpload(){
		return View::make('users.upload');
	}
	public function postUpload($randomNo = 11){
		$fileName = str_random($randomNo);
		$input = Input::all();
		$file = Input::file('video');
		$userFolderName = $this->Auth->id .'-'.$this->Auth->channel_name;
		$destinationPath = public_path('videos'.DS. $userFolderName);
		$validator = Validator::make($input,Video::$video_rules);
		$checkFilenameExist = Video::where('file_name', '=', $fileName);
		if($checkFilenameExist->count()){
			$fileName = str_random($randomNo+1);
		}
		if($validator->passes()){
			//insert into table
			// $ffmpeg = FFMpeg\FFMpeg::create();
			// 	$video = $ffmpeg->open($input['video']);
			// 	$video
			// 	    ->filters()
			// 	    ->resize(new FFMpeg\Coordinate\Dimension(320, 240))
			// 	    ->synchronize();
			// 	$video
			// 	    ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(10))
			// 	    ->save($destinationPath.DS.'test.jpg');
			// 	$video
			// 	    ->save(new FFMpeg\Format\Video\X264(), $destinationPath.'export-x264.mp4')
			// 	    ->save(new FFMpeg\Format\Video\WMV(), $destinationPath.DS.'export-wmv.wmv')
			// 	    ->save(new FFMpeg\Format\Video\WebM(), $destinationPath.DS.'export-webm.webm');
			// 	    return 'success';
			$input['user_id'] = $this->Auth->id;
			$create = Video::create($input);
			//Find / Updated
			$latest_id = $create->id;
			Session::put('fileName', $fileName);
			$userFolderName = $this->Auth->id .'-'.$this->Auth->channel_name;
			$destinationPath = public_path('videos'.DS. $userFolderName);
			$videoFolderPath = $destinationPath. DS. $fileName;
			$db_filename = Video::find($latest_id);
			$db_filename->file_name = $fileName;
			$db_filename->title = 'Untitled';
			$db_filename->tags = null;
			$db_filename->publish = 0;

			if($db_filename->save()){
				//Start upload
				if(!file_exists($destinationPath)){
					mkdir($destinationPath);
				}
				if(!file_exists($videoFolderPath)){
					mkdir($videoFolderPath);
				}
				$ext = $file->getClientOriginalExtension();
				$file->move($videoFolderPath, $fileName.'.'.$ext);  
				return Response::json(['file'=>$fileName]);
				//return Redirect::route('get.addDescription', $encrypt_name)->with('tokenId', $fileName);
			}
		}
		return Redirect::route('get.upload')
		->withInput()
		->withErrors($validator)
		->with('message', 'There were validation errors.');
	}
	public function getCancelUploadVideo(){
		$fileName = Session::get('fileName');
		if(empty($fileName)){
			return App::abort('404');
		}
		$userFolderName = $this->Auth->id .'-'.$this->Auth->channel_name;
		$destinationPath = public_path('videos'.DS. $userFolderName.DS);
		if(file_exists($destinationPath.$fileName)){
			$this->deleteDirectory($destinationPath.$fileName);
			Video::where('file_name', $fileName)->delete();
			return Redirect::route('get.upload', '=cancelled');
		}


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
	public function postAddDescription($id){
		$id = Crypt::decrypt($id);  
		$videos = Video::where('id','=',$id)->get();
		$fileName = $videos[0]['file_name'];
		$input = Input::all(); 
		$validator = Validator::make($input,Video::$addDescription);
		$userFolderName = $this->Auth->id .'-'.$this->Auth->channel_name;
		$destinationPath =  public_path('videos'.DS. $userFolderName.DS.$fileName.DS);
		$selectedCategory = null;
		if($validator->passes()){
			if(Input::hasFile('poster')){
				$this->imageResize($input['poster'], 600, 338, $destinationPath.$fileName.'.jpg');
				$this->imageResize($input['poster'], 240, 141, $destinationPath.$fileName.'_sm.jpg');
			}
			if(strlen($input['thumbnail']) > 1){ //has selected thumbnail 
				$getImage = $input['thumbnail'];
				$getImage = str_replace('data:image/png;base64,', '', $getImage);
				$getImage = str_replace(' ', '+', $getImage);
				$decodeImage = base64_decode($getImage);
				$saveImage = $destinationPath.$fileName.'.jpg';
				$success = file_put_contents($saveImage, $decodeImage);
				$this->imageResize($saveImage, 600, 338, $destinationPath.$fileName.'.jpg');
				$this->imageResize($saveImage, 240, 141, $destinationPath.$fileName.'_sm.jpg');	

			}		
			$tags = explode(',',Input::get('tags'));
			foreach($tags as $tag){
				if($tag != null){
					$newTags[] = strtolower($tag);
				}
			}
			$uniqueTag = array_unique($newTags);
			$implodeTag = implode(',',$uniqueTag);
			$video = Video::find($id);
			$publish = $video->publish;
			if(Input::has('cat')){
				$selectedCategory = implode(',',Input::get('cat'));
			}
			if($publish == 0){
				$video->total_time = $input['totalTime'];
				$video->title = $input['title'];
				$video->description = $input['description'];
				$video->category = $selectedCategory;
				$video->tags =  $implodeTag;
				$video->publish =  $input['publish'];
				$video->save();
				return Redirect::route('users.myvideos','upload=success&token='.$fileName)->with('success',1);
			}
			return Redirect::route('get.upload');					
		}
		
		return Redirect::route('get.addDescription',$fileName)
		->withInput()
		->withErrors($validator)
		->with('message', 'There were validation errors.');
	}
	public function imageResize($image, $w, $h, $destination){
		Image::make($image)->resize($w,$h)->encode('jpg', 10)->save($destination);
	}

	public function getViewVideoPlayer(){
		$filename = str_replace('http://localhost:8000/watch?v=', '', $this->url);
		return $filename;
		return View::make('videoplayer');
	}

	public function getRandom($category = null){
		$auth = Auth::user();
		$options = array('video' => 'video','playlist' => 'playlist', 'channel' => 'channel');

		$datas = $this->Video->getVideoByCategory('random', 16);	//Default Value of randomResults
		$type = 'video';

		if(!empty($category)){	//Check if there is a specified category
			if($category == 'channel'){

				$datas = $this->User->getRandomChannels();
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
			}

			if($category == 'playlist'){
				$datas = $this->Playlist->getRandomPlaylist();
				//return $datas;
			}
			$type = $category;
		}

		return View::make('homes.random', compact(array('options','datas','type','auth')));
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
		//return $searchResults;

		return View::make('homes.searchresult', compact(array('type','searchResults')));
	}

	public function counter($id){
		$id = Crypt::decrypt($id);
		$video = Video::where('id','=',$id)->first();
		$video->views = $video->views+1;
		$video->update();
	}

	public function fileExist($path, $filename, $ext = null, $user_id = null, $channel_name = null, $callback_message = null){
		$userFolderName = $user_id. '-'. $channel_name;
		$file = $filename .'.'. $ext;
		$path = 'public' .DS. $path .DS. $userFolderName .DS. $filename. $file;
		if(file_exists($path)){
			return true;
		} 
		return $path;
	}

	public function getEmbedVideo($id=NULL){
		$vidFilename = Video::where('file_name', $id)->first();
		$vidOwner = User::find($vidFilename->user_id);
		if($vidFilename->count() && $vidOwner->count()){
			return View::make('homes.embedvideo', compact('vidFilename','vidOwner'));
		}
		return app::abort(404, 'Page not available');
	}




}
