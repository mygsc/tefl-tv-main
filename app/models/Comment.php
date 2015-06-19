<?php

class Comment extends Eloquent {

	protected $table = 'comments';

	public function getComments($videoId){
		$comments = DB::table('users')->join('comments', 'users.id', '=', 'comments.user_id')
			->where('comments.video_id', $videoId)->orderBy('comments.id','desc')->get();

		foreach($comments as $key => $comment){
			$profile_picture =	User::getUsersImages($comment->user_id)['profile_picture'];
			$comments[$key]->profile_picture = $profile_picture;

			$notifications = new Notification();
			$comments[$key]->time_difference = $notifications->getTimePosted($comment);
		}

		return $comments;
	}
}