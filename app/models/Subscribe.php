<?php

class Subscribe extends Eloquent {

	protected $table = 'subscribe';

	public function user() {

		return $this->belongsToMany('User');
	}
}