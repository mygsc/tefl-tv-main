<?php

class Video extends Eloquent {

	protected $table = 'videos';

	public function getRandomVideos(){
		return Video::orderByRaw("RAND()")
		->where('publish', '1')
		->where('report_count', '<', '5')
		->get(array('title', 'likes', 'views'))
		->take(18);
	}

	public function test(){
		return 'hi';
	}

}