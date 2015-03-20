<?php


class UserProfile extends Eloquent {

	protected $table = 'users_profile';


	public function user() {

		return $this->belongsTo('User');
	}



}