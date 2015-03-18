<?php

class Website extends Eloquent {

	protected $table = 'websites';

	public function user() {

		return $this->belongsTo('User');
	}
}