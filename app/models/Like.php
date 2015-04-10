<?php
class Like extends Eloquent{
	protected $table = 'users_likes';
	protected $fillable = ['video_id','user_id'];

	public function countLikes($video_id){
		return UserLike::where('video_id', $video_id)->count();
	}
}

