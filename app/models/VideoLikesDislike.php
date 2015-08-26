<?php 

class VideoLikesDislike extends Eloquent{
	protected $fillable = ['video_id','user_id','likes','dislikes'];
	function __construct(){
	
	}
	public function video(){
		return $this->belongsTo('Video');
	}
	public function totalLikesDislikes($video_id){
		$likes = VideoLikesDislike::where('video_id', $video_id)->sum('likes');
		$dislikes = VideoLikesDislike::where('video_id', $video_id)->sum('dislikes');
		return array('likes'=>$likes, 'dislikes'=>$dislikes);
	}
}