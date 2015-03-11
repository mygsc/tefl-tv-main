<?php

class Subscribe extends Eloquent {

	protected $table = 'subscribes';

	public function user() {

		return $this->belongsToMany('User');
	}

	public function getSubscribers($channel_name = null){
		$getChannelID = User::where('channel_name', $channel_name)->get(array('id'));
		$getSubscriber = DB::select(
			'SELECT s.id,s.user_id,s.subscriber_id,u.channel_name,u2.channel_name as subscriber_name, s.notifs FROM subscribes s
			INNER JOIN users u ON s.user_id = u.id
			INNER JOIN users u2 ON s.subscriber_id = u2.id
			WHERE user_id = "'. $getChannelID->first()->id.'"');

		return $getSubscriber;
	}
}