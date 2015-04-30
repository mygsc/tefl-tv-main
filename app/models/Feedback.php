<?php


class Feedback extends Eloquent {

	protected $table = 'feedbacks';

	public function getFeedbacks($auth = null, $limit = null) {
		if(!empty($limit)) {
			$limit = 'LIMIT '.$limit;
		}

		$feedbacks = Feedback::select('feedbacks.id','channel_id','user_id','report', 'feedback','feedbacks.created_at','feedbacks.updated_at','users.channel_name')
		->join('users', 'users.id', '=', 'user_id')
		->where('channel_id',$auth)
		->get();

		return $feedbacks;
	}
}