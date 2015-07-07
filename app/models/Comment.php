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
	public function countLikesAndComments($id,$totalLikes=0,$totalDislikes=0){
		$result = Comment::where('video_id',$id)->get();
		if(!$result->isEmpty()){
			for($i=0;$i<count($result);$i++){
				$likes[]=$result[$i]->likes;
				$dislikes[]=$result[$i]->dislikes;
				$totalLikes +=$likes[$i];
				$totalDislikes +=$dislikes[$i];
			}
			return array('comment' => $result->count(), 'likes' => $totalLikes, 'dislikes' => $totalDislikes);
		}
		return array('comment' => 0, 'likes' => 0, 'dislikes' => 0);
	}
}