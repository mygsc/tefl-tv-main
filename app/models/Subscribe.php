<?php

class Subscribe extends Eloquent {

	protected $table = 'subscribes';

	public function user() {

		return $this->belongsToMany('User');
	}

	public function getSubscribers($channel_name = null, $limit = null){
		if(!empty($limit)){
			$limit = 'LIMIT '. $limit;
		}
		$getChannelID = User::where('channel_name', $channel_name)->get(array('id'));
		$getSubscriber = DB::select(
			'SELECT s.id, s.user_id, s.subscriber_id, u.channel_name, u2.channel_name as subscriber_name, 
			s.notifs FROM subscribes s
			INNER JOIN users u ON s.user_id = u.id
			INNER JOIN users u2 ON s.subscriber_id = u2.id
			WHERE s.user_id = "'. $getChannelID->first()->id.'"'. $limit);

		foreach($getSubscriber as $key => $subscriber){
			$profile_picture = User::getUsersImages($subscriber->subscriber_id);
			$getSubscriber[$key]->profile_picture = $profile_picture['profile_picture'];
		}

		return $getSubscriber;
	}

	public function countSubscribers($countAllViews = null){
		$a = $countAllViews;
		$convertNumber = number_format($a);

		if(strlen($countAllViews) >= 4 || strlen($countAllViews) >= 6) {
			$a = $countAllViews;
			$round = round(($a/1000), 1);
			$convertNumber = number_format($round, 3, ',', ' ') . 'k';
		}

		if(strlen($countAllViews) >=7 && strlen($countAllViews) <= 9 ){
			$a = $countAllViews;
			$round = round(($a/1000000), 1);
			$convertNumber = number_format($round, 3, ',', ' ') . 'm';
		}
		return $convertNumber;
	}

	public function Subscribers($auth = null, $limit = null) {
		if(!empty($limit)){
			$limit = 'LIMIT '.$limit;
		}
		$subscribers = Subscribe::select('subscribes.id','subscribes.user_id', 'subscribes.subscriber_id', 
			'notifs', 'subscribes.created_at', 'subscribes.updated_at',
			DB::raw('(SELECT COUNT(s2.id) FROM subscribes s2 WHERE s2.user_id = subscribes.subscriber_id) AS numberOfSubscribers'),
			DB::raw('(SELECT u.channel_name FROM users u WHERE u.id = subscribes.subscriber_id) AS channel_name'))
		->join('users as user', 'subscribes.user_id','=','user.id')
		->where('subscribes.user_id',$auth)
		->take($limit)
		->get();

		foreach($subscribers as $key => $subscriber){
			$profile_picture = User::getUsersImages($subscriber->subscriber_id);
			$subscribers[$key]['profile_picture'] = $profile_picture['profile_picture'];
			$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $subscriber->subscriber_id, 'subscriber_id' => $auth))->first();
			$subscribers[$key]['ifAlreadySubscribe'] = $ifAlreadySubscribe;
			$subscribers[$key]['ifShowSubscriberCount'] = UserPrivacySetting::ifShowSubscriberCount($subscriber->subscriber_id);
		}
		return $subscribers;
	}

	public function Subscriptions($auth = null, $limit = null) {
		if(!empty($limit))
			$limit = 'LIMIT '.$limit;

		$subscriptions = Subscribe::select('subscribes.id','subscribes.user_id', 'subscriber_id', 
			'notifs', 'subscribes.created_at', 'subscribes.updated_at',
			DB::raw('(SELECT COUNT(s2.id) FROM subscribes s2 WHERE s2.user_id = subscribes.user_id) AS numberOfSubscribers'),
			DB::raw('(SELECT u.channel_name FROM users u WHERE u.id = subscribes.user_id) AS channel_name'))
		->join('users', 'subscribes.user_id','=','users.id')
		->where('subscriber_id',$auth)
		->take($limit)
		->get();

		foreach($subscriptions as $key => $subscription){
			$profile_picture = User::getUsersImages($subscription->user_id);
			$subscriptions[$key]['profile_picture'] = $profile_picture['profile_picture'];
			$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $subscription->user_id, 'subscriber_id' => $auth))->first();
			$subscriptions[$key]['ifAlreadySubscribe'] = $ifAlreadySubscribe;
			$subscriptions[$key]['ifShowSubscriberCount'] = UserPrivacySetting::ifShowSubscriberCount($subscription->user_id);
		}
		return $subscriptions;
	}

}
