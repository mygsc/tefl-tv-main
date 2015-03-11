<?php

class Favorite extends Eloquent {

	protected $table = 'users_favorite';

	public function user() {

		return $this->hasMany('User');
	}

	public function video() {

		return $this->hasMany('Video');
	}
}