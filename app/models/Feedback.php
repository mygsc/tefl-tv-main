<?php


class Feedback extends Eloquent {

	protected $table = 'feedbacks';

	public function getFeedbacks($auth = null, $limit = null) {
		if(!empty($limit)) {
			$limit = 'LIMIT '.$limit;
		}

		$feedbacks = DB::select("SELECT f.id, f.channel_id, f.user_id, f.feedback, f.likes, f.dislikes, 
			f.spam_count, f.created_at, f.updated_at, u.channel_name FROM feedbacks AS f 
			INNER JOIN users as u ON u.id = f.user_id 
			WHERE f.user_id = '" .$auth."'");

		return $feedbacks;
	}
}