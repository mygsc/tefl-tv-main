<?php 

class VideoLikesDislike extends Eloquent{
	
	function __construct(){
	
	}
	public function video(){
		return $this->belongsTo('Video');
	}
}