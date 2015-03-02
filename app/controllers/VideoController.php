<?php

class VideoController extends Controller {

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
}
