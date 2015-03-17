<?php



class WatchLater extends Eloquent {

	protected $table = 'users_watch_later';
	protected $fillable = ['user_id','video_id','status'];

	public function user() {

		return $this->hasMany('User');
	}

	public function video() {

		return $this->hasMany('Video');
	}
}