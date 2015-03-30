<?php

class VideoController extends Controller {
	protected $user;
	protected $tmpImg;
	protected $thumbImg;
	public function __construct(Video $videos, User $users, Playlist $playlists,Subscribe $subscribers){
		$this->Subscribe = $subscribers;
		$this->Playlist = $playlists;
		$this->User = $users;
		$this->Video = $videos;
		$this->Auth = Auth::User();
		define('DS', DIRECTORY_SEPARATOR); 
	}

	public function getUpload(){
		return View::make('users.upload');
	}
	public function postUpload(){
		$fileName = str_random(11);
		$input = Input::all();
		$validator = Validator::make($input,Video::$video_rules);
		if($validator->passes()){
			//insert into database
			$file = Input::file('video');
			$input['user_id'] = $this->Auth->id;//'1';
			$input['extension'] = $file->getClientOriginalExtension();
			$create = Video::create($input);
			//Find / Updated
			$latest_id = $create->id;
			$encrypt_name = $fileName;
			Session::put('fileName', $fileName);
			$db_filename = Video::find($latest_id);
			$db_filename->file_name = $encrypt_name;
			$db_filename->uploaded = 0;

			if($db_filename->save()){
					//Start upload
				$userFolderName = $this->Auth->id .'-'.$this->Auth->channel_name;
				$destinationPath = public_path('videos'.DS. $userFolderName);
				if(!file_exists($destinationPath)){
					mkdir($destinationPath);
				}
				$ext = $file->getClientOriginalExtension();
				$videoFolderPath = $destinationPath. DS. $encrypt_name;
				if(!file_exists($videoFolderPath)){
					mkdir($videoFolderPath);
				}
				$file->move($videoFolderPath, $encrypt_name.'.'.$ext);  
				return Redirect::route('get.addDescription', $encrypt_name)->with('tokenId', $fileName);
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
		$destinationPath = public_path('videos'.DS. $userFolderName);
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
		$posterFilename = str_random(5);
		$thumbnailSelected = Input::get('thumbnail');
		$poster = Input::file('poster');
		$uploadPosterDir = $this->thumbImg;
		$videos = Video::where('id','=',$id)->get();
		$fileName = $videos[0]['file_name'];
		$input = Input::all(); 
		$validator = Validator::make($input,Video::$addDescription);
		$userFolderName = $this->Auth->id .'-'.$this->Auth->channel_name;
		$destinationPath =  public_path('videos'.DS. $userFolderName.DS.$fileName.DS);

		if($validator->passes()){
			if(Input::hasFile('poster')){
				$tags = explode(',',Input::get('tags'));
				foreach($tags as $tag){
					if($tag != null){
						$newTags[] = strtolower($tag);
					}
				}
				$posterExt = $poster->getClientOriginalExtension();
						// $modifiedImage = Image::make($poster->getRealPath()->resize('1280','720')->save($uploadPosterDir.$posterFilename.$id.'.'.$posterExt));
						//$poster->move($destinationPath, $fileName.'.jpg');
				$resizeImage = Image::make($poster->getRealPath())->resize(1280,720)->save($destinationPath.$fileName.'.jpg'); 
				$uniqueTag = array_unique($newTags);
				$implodeTag = implode(',',$uniqueTag);
				$video = Video::find($id);
				$uploadedVid = $video->uploaded;
				if($uploadedVid==0){
					$video->total_time = Input::get('totalTime');
					$video->title = Input::get('title');
					$video->description = Input::get('description');
					$video->publish = Input::get('publish');
					$video->tags =  $implodeTag;
					$video->uploaded =  1;
					$video->save();
					return Redirect::route('users.myvideos','upload=success&token='.$fileName)->with('success',1);
				}
				return Redirect::route('homes.index');

			}else{
				$getImage = $thumbnailSelected;
				if($getImage == '0'){ //no selected thumbnail 
					$tags = explode(',',Input::get('tags'));
					foreach($tags as $tag){
						if($tag != null){
							$newTags[] = strtolower($tag);
						}
					}
					$uniqueTag = array_unique($newTags);
					$implodeTag = implode(',',$uniqueTag);
					$video = Video::find($id);
					$uploadedVid = $video->uploaded;
					if($uploadedVid==0){
						$video->total_time = Input::get('totalTime');
						$video->title = Input::get('title');
						$video->description = Input::get('description');
						$video->publish = Input::get('publish');
						$video->tags =  $implodeTag;
						$video->uploaded =  1;
						$video->save();
						return Redirect::route('users.myvideos','upload=success&token='.$fileName)->with('success',1);
					}
				}
				$getImage = str_replace('data:image/png;base64,', '', $getImage);
				$getImage = str_replace(' ', '+', $getImage);
				$decodeImage = base64_decode($getImage);
				$saveImage = $destinationPath.$fileName.".jpg";
				$success = file_put_contents($saveImage, $decodeImage);
				$resizeImage = Image::make($saveImage)->resize(1280,720)->save($destinationPath.$fileName.'.jpg');		
				$tags = explode(',',Input::get('tags'));
				foreach($tags as $tag){
					if($tag != null){
						$newTags[] = strtolower($tag);
					}
				}
				$uniqueTag = array_unique($newTags);
				$implodeTag = implode(',',$uniqueTag);
				$video = Video::find($id);
				$uploadedVid = $video->uploaded;
				if($uploadedVid==0){
					$video->total_time = Input::get('totalTime');
					$video->title = Input::get('title');
					$video->description = Input::get('description');
					$video->publish = Input::get('publish');
					$video->tags =  $implodeTag;
					$video->uploaded =  1;
					$video->save();
					return Redirect::route('users.myvideos','upload=success&token='.$fileName)->with('success',1);
				}
				return Redirect::route('homes.index');

			}					
		}
		
		return Redirect::route('get.addDescription',$fileName)
		->withInput()
		->withErrors($validator)
		->with('message', 'There were validation errors.');
	}

	public function getViewVideoPlayer(){
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
				
				foreach($datas as $key => $channels){
					$img = 'img/user/'. $channels->id. '.jpg';
					if(!empty($auth)){
						$datas[$key]->ifsubscribe = Subscribe::where(array('user_id' => $auth->id, 'subscriber_id' => $channels->id))->first();
					}
					if(!file_exists('public/'.$img)){
						$img = 'img/user/0.jpg';
					}
					$datas[$key]->image_src = $img;
					$datas[$key]->subscribers = $this->Subscribe->getSubscribers($channels->channel_name, 10);
				}
			}

			if($category == 'playlist'){
				$datas = $this->Playlist->getRandomPlaylist();
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

		if($type == 'playlist'){
			$searchResults = Playlist::where('name', $search)->get();

		}else if($type == 'channel'){
			$searchresults = User::where('channel_name', $search)->get();
			
		}else{
			$longwords = 'SELECT DISTINCT v.id,v.user_id,u.channel_name, v.title,v.description,
			v.tags,v.views,(SELECT count(ul.id) from users_likes ul where ul.video_id = v.id) as likes,v.publish, v.file_name,
			v.report_count,v.deleted_at,v.created_at
			FROM videos v 
			INNER JOIN users u ON v.user_id = u.id
			WHERE
			v.deleted_at IS NULL
			AND
			publish ="1"
			AND
			report_count < "5"
			AND
			MATCH(title,description,tags) AGAINST("'.$search.'")';

			$searchResults = DB::select($longwords);
			if(strlen($search) < 3){
				$shortwords = ' or title like "%'. $search .'%"
				AND
				v.deleted_at IS NULL
				AND
				publish ="1"
				AND
				report_count < "5"
				or tags like "%'. $search .'%"
				AND
				v.deleted_at IS NULL
				AND
				publish ="1"
				AND
				report_count < "5"';

				$searchResults = DB::select($longwords . $shortwords);
			}
		}
		

		foreach($searchResults as $key => $searchResult){
			//Thumbnails
			$folderName = $searchResult->user_id. '-'. $searchResult->channel_name;
			$fileName = $searchResult->file_name;
			$path = 'videos'.DS.$folderName.DS.$fileName.DS.$fileName.'.jpg';
			$searchResults[$key]->thumbnail = 'img\thumbnails\video.png';
			if(file_exists(public_path($path))){
				$searchResults[$key]->thumbnail = $path;
			}
			//truncate text
			$searchResults[$key]->description = $this->truncate($searchResult->description, 50);
			//
			$getTags = explode(',',$searchResult->tags);
			foreach($getTags as $key2 => $getTags){
				$searchResults[$key]->tag[$key2]['url'] = route('homes.searchresult', array($getTags));
				$searchResults[$key]->tag[$key2]['tags'] = $getTags;
			}
		}

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

	public function truncate($text, $chars = 50) {
		if(strlen($text) > $chars){
			$text = $text." ";
			$text = substr($text,0,$chars);
			$text = substr($text,0,strrpos($text,' '));
			$text = $text."...";
		}
		return $text;
	}




}
