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
		// $size = '1024x768'; 
		// $second = 5; 
		// $ffmpegPath ="C:\\xampp\\ffmpeg\\bin\\ffmpeg";
		$tokenId = str_random(11);
		$input = Input::all();
		$validator = Validator::make($input,Video::$video_rules);
		if($validator->passes()){
			//insert into database
			$file = Input::file('video');
			$input['user_id'] = $this->user->id;//'1';
			$input['extension'] = $file->getClientOriginalExtension();
			$create = Video::create($input);
			$latest_id = $create->id;
			$encrypt_name = Crypt::encrypt($latest_id);
			$db_filename = Video::find($latest_id);
			$db_filename->file_name = $encrypt_name;

			if($db_filename->save()){
					//Start upload
					$img = $this->user->channel_name;
					$destinationPath = 'public/videos/';
					$ext = $file->getClientOriginalExtension();
					$file->move($destinationPath, $encrypt_name.'.'.$ext);  
			return Redirect::route('get.addDescription', $encrypt_name)->with('tokenId', $tokenId);
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
		$posterFilename = str_random(5);
		$imgSelected = Input::get('thumbnail');
		$poster = Input::file('poster');
		$uploadPosterDir = $this->thumbImg;
		$id = Crypt::decrypt($id);	
		$videos = Video::where('id','=',$id)->get();
		$input = Input::all();  
		$validator = Validator::make($input,Video::$addDescription);
			
				if($validator->passes()){
					if(Input::hasFile('poster')){
						$tags = explode(',',Input::get('tags'));
						foreach($tags as $tag){
							if($tag != null){
								$newTags[] = strtolower($tag);
							}
						}
						$posterExt = $poster->getClientOriginalExtension();
						$modifiedImage = Image::make($poster->getRealPath()->resize('1280','720')->save($uploadPosterDir.$posterFilename.$id.'.'.$posterExt));
						//$poster->move($uploadPosterDir, $posterFilename.$id.'.'.$posterExt); 
						$uniqueTag = array_unique($newTags);
						$implodeTag = implode(',',$uniqueTag);
						$video = Video::find($id);
						$video->token_id = Input::get('tokenId');
						$video->poster = $posterFilename.$id.'.'.$posterExt;
						$video->total_time = Input::get('totalTime');
						$video->title = Input::get('title');
						$video->description = Input::get('description');
						$video->publish = Input::get('publish');
						$video->tags =  $implodeTag;
						$video->save();
						return Redirect::route('get.upload','=success')->with('success','New video has been upload successfully');
					}else{
						// $img = $imgSelected;
						// $img = str_replace('data:image/png;base64,', '', $img);
						// $img = str_replace(' ', '+', $img);
						// $data = base64_decode($img);
						// $file = $uploadPosterDir.Crypt::encrypt($id).".jpg";
						// $success = file_put_contents($file, $data);

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
						return Redirect::route('get.upload','=success')->with('success','New video has been upload successfully');
					}					
				}
			
			// delete unselected thumbnail move, and rename 
			// File::delete($this->tmpImg.$this->user->channel_name.'2.jpg');
			// File::delete($this->tmpImg.$this->user->channel_name.'3.jpg');
			// $oldName = $this->tmpImg.$this->user->channel_name.'1.jpg';
			// $newName = $this->thumbImg.$id.'.jpg';
			// $rename = rename($oldName, $newName);	
		
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

		$randomResults = $this->Video->getVideoByCategory('random', 18);	//Default Value of randomResults
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
