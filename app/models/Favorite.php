<?php

class Favorite extends Eloquent {

	protected $table = 'users_favorite';
	protected $fillable = ['user_id','video_id'];

	public function user() {

		return $this->hasMany('User');
	}

	public function video() {

		return $this->hasMany('Video');
	}
}