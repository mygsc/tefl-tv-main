<?php

class Subscribe extends Eloquent {

	protected $table = 'subscribes';

	public function user() {

		return $this->belongsToMany('User');
	}
}