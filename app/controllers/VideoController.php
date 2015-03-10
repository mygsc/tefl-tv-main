<?php

class VideoController extends Controller {


	public function __construct(Video $videos, User $users, Playlist $playlists){
		$this->Playlist = $playlists;
		$this->User = $users;
		$this->Video = $videos;
	}

	public function getUpload(){
		return View::make('users.upload');
	}
	public function postUpload(){
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
			$db_filename->save();
			//uploading
			$file = Input::file('video');
			$destinationPath = 'public/videos/';
			$ext = $file->getClientOriginalExtension();
			$file->move($destinationPath, $ecrypt_name.'.'.$ext);
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
			$video = Video::find($id);
			$video->title = Input::get('title');
			$video->description = Input::get('description');
			$video->publish = Input::get('publish');
			$video->save();
			$tags = Input::get('tags');
			if($tags != null){
				$tags_unique = explode(',',$tags);
				$exploded_tags = array_unique($tags_unique);
				foreach($exploded_tags as $exploded_tag){
					$tags = Tag::where('tags','=',$exploded_tag)->get();
					if($tags->count()){
						if($exploded_tag != null){
							$tag_id = Tag::where('tags','=',$exploded_tag)->get()->toArray();
							TagVideo::create(array('tag_id' => $tag_id[0]["id"],'video_id' => $id));
						}
					}
					else{
						if($exploded_tag != null){
							Tag::create(array('tags' => $exploded_tag));
							$tag_id = Tag::where('tags','=',$exploded_tag)->get()->toArray();
							TagVideo::create(array('tag_id' => $tag_id[0]["id"],'video_id' => $id));
								//var_dump($tag_id[0]["id"]);
						}
					}
				}
			}
			return Redirect::route('get.index');
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

	//delete or update this, just made this for viewing purpose -Cess
	public function watchVideo(){
		return View::make('homes.watch-video');
	}
	//end of watchVideo

	public function postSearchVideos(){
		$input = Input::all();
		return Redirect::route('homes.searchresult', array($input['type'].'?'.$input['search']));
	}

	public function getSearchResult(){
		$type = Input::get('type');
		$search = Input::get('search');

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
				MATCH(title,description,tags) AGAINST("'.$search.'" IN BOOLEAN MODE)
				';

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
