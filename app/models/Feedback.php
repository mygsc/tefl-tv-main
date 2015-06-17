<?php


class Feedback extends Eloquent {

	protected $table = 'feedbacks';

	public function rules()
	{
		return array('feedback' => 'required|max:255');
	}

	public function getFeedbacks($auth = null, $limit = null) {
		if(!empty($limit)) {
			$limit = 'LIMIT '.$limit;
		}

		$feedbacks = Feedback::select(
			'feedbacks.id',
			'feedback_receiver_id',
			'feedback_sender_id',
			'feedback',
			'feedbacks.created_at',
			'feedbacks.updated_at',
			'users.channel_name',
			DB::raw('(SELECT count(rf.feedback_id) from reported_feedbacks rf where rf.feedback_id = feedbacks.id) as spam'))
		->where('feedback_receiver_id',$auth)
		->join('users', 'users.id', '=', 'feedback_sender_id')
		->get();

		foreach($feedbacks as $key => $feedback){
			$profilePicture = User::getUsersImages($feedback->feedback_sender_id);
			$feedbacks[$key]['profile_picture'] = $profilePicture['profile_picture'];

			$feedbacks[$key]->likesCount = DB::table('feedbacks_likesdislikes')->where(array('feedback_id' => $feedback->id, 'status' => 'liked'))->count();
			$feedbacks[$key]->dislikeCount = DB::table('feedbacks_likesdislikes')->where(array('feedback_id' => $feedback->id, 'status' => 'disliked'))->count();

			if(Auth::check()){
				$feedbacks[$key]->ifAlreadyLiked = DB::table('feedbacks_likesdislikes')->where(array(
					'feedback_id' => $feedback->id, 
					'user_id' => Auth::User()->id,
					'status' => 'liked'
					))->first();
				$feedbacks[$key]->ifAlreadyDisliked = DB::table('feedbacks_likesdislikes')->where(array(
					'feedback_id' => $feedback->id, 
					'user_id' => Auth::User()->id,
					'status' => 'disliked'
					))->first();
			}

			$feedbacks[$key]->countFeedbackReplies = DB::table('feedback_replies')
			->join('users', 'users.id', '=', 'feedback_replies.user_id')
			->where('feedback_id', $feedback->id)->count();

			$feedbacks[$key]->getFeedbackReplies = FeedbackReply::select('feedback_replies.id', 'user_id', 'reply', 'feedback_id',
				'feedback_replies.created_at', 'feedback_replies.updated_at', 'channel_name')
			->join('users', 'users.id', '=', 'feedback_replies.user_id')
			->get();	
		}

		return $feedbacks;
	}
}