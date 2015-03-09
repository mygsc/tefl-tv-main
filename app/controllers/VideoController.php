<?php

class VideoController extends Controller {
	
	public function __construct(Video $videos, User $users, Playlist $playlists){
		$this->Playlist = $playlists;
		$this->User = $users;
		$this->Video = $videos;
		define('DS', DIRECTORY_SEPARATOR);
	}

	public function getUpload(){
		return View::make('users.upload');
	}
	public function postUpload(){
		$size = '500x500'; $second = 5; $cmdLine;
		$ffmpeg = app_path().DS.'ffmpeg'.DS.'bin'.DS.'ffmpeg';
		$input = Input::all();
		$validator = Validator::make($input,Video::$video_rules);
		if($validator->passes()){
			//insert in database
			$input['user_id'] = '1';
			$input['extension'] = Input::file('video')->getClientOriginalExtension();
			$create = Video::create($input);
			$latest_id = $create->id;
			$ecrypt_name = Crypt::encrypt($latest_id);
			$db_filename = Video::find($latest_id);
			$db_filename->file_name = $ecrypt_name;
			if($db_filename->save()){
				//Start upload
				$file = Input::file('video');
				$destinationPath = 'public/videos/';
				$ext = $file->getClientOriginalExtension();
				$file->move($destinationPath, $ecrypt_name.'.'.$ext);
				$cmdLine = $ffmpeg . '-i' . $file . '-an -ss' . $second . '-s' . $size;
				if(shell_exec($cmdLine)){
					return 'thumbnail successfully create';
				}
			}
		
			return Redirect::route('get.addDescription',$ecrypt_name);
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
		
		return Redirect::route('homes.searchresult', array($input['type'],$input['search']));
	}

	public function getSearchResult($type = null,$search = null){
		if($type == 'playlist'){
			

		}else if($type == 'playlist'){

		}else{
			$videoResults = DB::select('SELECT DISTINCT v.id, v.user_id, u.channel_name, v.title,v.description, t.tags  FROM tag_video vt
				INNER JOIN tags t ON vt.tag_id = t.id 
				INNER JOIN videos v ON vt.video_id = v.id
				LEFT JOIN users u ON v.user_id = u.id
				WHERE MATCH(v.title,v.description)
				AGAINST ("'.$search.'")
				OR
				MATCH(t.tags)
				AGAINST("'.$search.'")
				GROUP BY id
				ORDER BY MATCH(v.title,v.description)
				AGAINST ("'.$search.'")
				OR
				MATCH(t.tags)
				AGAINST("'.$search.'")
				');

			foreach($videoResults as $key => $videoResult){
				$videoInfo = Video::with('tags')->where('id', $videoResult->id)->first();
				$videoResults[$key]->tags = $videoInfo['tags'];
			}
		}

		return View::make('homes.searchresult', compact('videoResults'));
	}
}
