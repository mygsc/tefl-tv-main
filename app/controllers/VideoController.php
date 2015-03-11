<?php

class VideoController extends Controller {
	protected $user;
	protected $tmpImg;
	protected $thumbImg;
	public function __construct(Video $videos, User $users, Playlist $playlists){
		$this->Playlist = $playlists;
		$this->User = $users;
		$this->Video = $videos;
		$this->user = Auth::User();
		define('DS', DIRECTORY_SEPARATOR); 
		$this->tmpImg = public_path().DS."videos".DS."tmp-img".DS;
		$this->thumbImg = public_path().DS."videos".DS."img-vid-poster".DS;
	}

	public function getUpload(){
		return View::make('users.upload');
	}
	public function postUpload(){
		
		$size = '1024x768'; 
		$second = 5; 
		$ffmpegPath ="C:\\xampp\\ffmpeg\\bin\\ffmpeg";
		$input = Input::all();
		$validator = Validator::make($input,Video::$video_rules);
		if($validator->passes()){
			//insert into database
			$file = Input::file('video');
			$input['user_id'] = '1';
			$input['extension'] = $file->getClientOriginalExtension();
			$create = Video::create($input);
			$latest_id = $create->id;
			$ecrypt_name = Crypt::encrypt($latest_id);
			$db_filename = Video::find($latest_id);
			$db_filename->file_name = $ecrypt_name;
			if($db_filename->save()){

				//if img-thumbnail exist in the tmp-img then delete file first
				if(File::exists($this->tmpImg.$this->user->channel_name.'1.jpg')){
					//Start upload
					$img = $this->user->channel_name;
					$destinationPath = 'public/videos/';
					$ext = $file->getClientOriginalExtension();
					//$file->move($destinationPath, $ecrypt_name.'.'.$ext);
					//$cmd = "$ffmpegPath -i $file -an -ss $second -s $size public/img/$img.jpg";
						for($uploadStart=1; $uploadStart<=3; $uploadStart++){
							$secondsInterval = $uploadStart*5;
							$cmd = "$ffmpegPath -i $file -an -ss $secondsInterval -s $size public/videos/tmp-img/$img$uploadStart.jpg";
							$createThumb = shell_exec($cmd);
							//if($createThumb){return'thumbnail created successfully.';}
						}	

			  }else{
			  		$img = $this->user->channel_name;
					$destinationPath = 'public/videos/';
					$ext = $file->getClientOriginalExtension();
					//$file->move($destinationPath, $ecrypt_name.'.'.$ext);
					for($n=1; $n<=3; $n++){
						$secondsInterval = $n*5;
						$cmd = "$ffmpegPath -i $file -an -ss $secondsInterval -s $size public/videos/tmp-img/$img$n.jpg";
						$createThumb = shell_exec($cmd);
						//if($createThumb){return'thumbnail created successfully.';}
					}
			}
			return Redirect::route('get.addDescription', $ecrypt_name);
		}
	}
	return Redirect::route('get.upload')
		->withInput()
		->withErrors($validator)
		->with('message', 'There were validation errors.');
}
	public function getAddDescription($id){
		$id = Crypt::decrypt($id);	
		$videos = Video::where('id','=',$id)->get();
		return View::make('users.addDescription',compact('videos'));
	}
	public function postAddDescription($id){
		$imgSelected = Input::get('thumbnail');
		if($imgSelected == 1){
			// delete unselected thumbnail move, and rename 
			File::delete($this->tmpImg.$this->user->channel_name.'2.jpg');
			File::delete($this->tmpImg.$this->user->channel_name.'3.jpg');
			$oldName = $this->tmpImg.$this->user->channel_name.'1.jpg';
			$newName = $this->thumbImg.$id.'.jpg';
			$rename = rename($oldName, $newName);
			
			$id = Crypt::decrypt($id);	
			$videos = Video::where('id','=',$id)->get();
			$input = Input::all();
			$validator = Validator::make($input,Video::$addDescription);
			if($validator->passes()){
				$tags = explode(',',Input::get('tags'));
				foreach($tags as $tag){
					if($tag != null){
						$newTags[] = strtolower($tag);
					}
				}
				$uniqueTag = array_unique($newTags);
				$implodeTag = implode(',',$uniqueTag);
				$video = Video::find($id);
				$video->title = Input::get('title');
				$video->description = Input::get('description');
				$video->publish = Input::get('publish');
				$video->tags =  $implodeTag;
				$video->save();
				return Redirect::route('homes.index');
			}
		}
		if($imgSelected == 2){

			// delete unselected thumbnail
			File::delete($this->tmpImg.$this->user->channel_name.'1.jpg');
			File::delete($this->tmpImg.$this->user->channel_name.'3.jpg');
			$oldName = $this->tmpImg.$this->user->channel_name.'2.jpg';
			$newName = $this->thumbImg.$id.'.jpg';
			rename($oldName, $newName);

			// rename img-thumbnail and move
			move_uploaded_file($newName, $this->thumbImg);
			$id = Crypt::decrypt($id);	
			$videos = Video::where('id','=',$id)->get();
			$input = Input::all();
			$validator = Validator::make($input,Video::$addDescription);
			if($validator->passes()){
				$tags = explode(',',Input::get('tags'));
				foreach($tags as $tag){
					if($tag != null){
						$newTags[] = strtolower($tag);
					}
				}
				$uniqueTag = array_unique($newTags);
				$implodeTag = implode(',',$uniqueTag);
				$video = Video::find($id);
				$video->title = Input::get('title');
				$video->description = Input::get('description');
				$video->publish = Input::get('publish');
				$video->tags =  $implodeTag;
				$video->save();
				return Redirect::route('homes.index');
			}
		}
		if($imgSelected == 3){

			// delete unselected thumbnail
			File::delete($this->tmpImg.$this->user->channel_name.'1.jpg');
			File::delete($this->tmpImg.$this->user->channel_name.'2.jpg');
			$oldName = $this->tmpImg.$this->user->channel_name.'3.jpg';
			$newName = $this->thumbImg.$id.'.jpg';
			$rename = rename($oldName, $newName);
			if($rename == true){
				return App::abort(404);
			}

			// rename img-thumbnail and move

			move_uploaded_file($newName, $this->thumbImg);
			$id = Crypt::decrypt($id);	
			$videos = Video::where('id','=',$id)->get();
			$input = Input::all();
			$validator = Validator::make($input,Video::$addDescription);
			if($validator->passes()){
				$tags = explode(',',Input::get('tags'));
				foreach($tags as $tag){
					if($tag != null){
						$newTags[] = strtolower($tag);
					}
				}
				$uniqueTag = array_unique($newTags);
				$implodeTag = implode(',',$uniqueTag);
				$video = Video::find($id);
				$video->title = Input::get('title');
				$video->description = Input::get('description');
				$video->publish = Input::get('publish');
				$video->tags =  $implodeTag;
				$video->save();
				return Redirect::route('homes.index');
			}
		}
		
		return Redirect::route('get.addDescription',Crypt::encrypt($id))
		->withInput()
		->withErrors($validator)
		->with('message', 'There were validation errors.');
	}

	public function getViewVideoPlayer(){
		return View::make('videoplayer');
	}

	public function getRandom($category = null){
		$options = array('video' => 'video','playlist' => 'playlist', 'channel' => 'channel');

		$randomResults = $this->Video->getRandomVideos();	//Default Value of randomResults
		$type = 'video';
		if(!empty($category)){	//Check if there is a specified category
			if($category == 'channel'){
				$randomResults = $this->User->getRandomChannels();
				$type = $category;
			}

			if($category == 'playlist'){
				$randomResults = $this->Playlist->getRandomPlaylist();
				$type = $category;
			}
		}
		
		return View::make('homes.random', compact(array('options','randomResults','type')));
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
				v.tags,v.views,v.likes,v.publish,
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
				MATCH(title,description,tags) AGAINST("'.$search.'" IN BOOLEAN MODE)';

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
			$getTags = explode(',',$searchResult->tags);
			foreach($getTags as $key2 => $getTags){
			$searchResults[$key]->tag[$key2]['url'] = route('homes.searchresult', array('search' => $getTags));
			$searchResults[$key]->tag[$key2]['tags'] = $getTags;
			}
		}

		return View::make('homes.searchresult', compact(array('type','searchResults')));
	}
}
