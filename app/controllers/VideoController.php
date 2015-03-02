<?php

class VideoController extends Controller {

	public function __construct(Video $videos, User $users, Playlist $playlists){
		$this->Playlist = $playlists;
		$this->User = $users;
		$this->Video = $videos;
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

		return Redirect::route('homes.random', $input['option']);
	}
}
