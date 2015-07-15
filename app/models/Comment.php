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
			$comments[$key]->likesCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $comment->id, 'status' => 'liked'))->count();
			$comments[$key]->dislikeCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $comment->id, 'status' => 'disliked'))->count();

			if(Auth::check()){
				$comments[$key]->ifAlreadyLiked = DB::table('comments_likesdislikes')->where(array(
					'comment_id' => $comment->id, 'user_id' => Auth::User()->id,'status' => 'liked'
				))->first();
				$comments[$key]->ifAlreadyDisliked = DB::table('comments_likesdislikes')->where(array(
					'comment_id' => $comment->id, 'user_id' => Auth::User()->id,'status' => 'disliked'
				))->first();
			}

			$comments[$key]->getCommentRepliesCount = DB::table('comments_reply')
			->join('users', 'users.id', '=', 'comments_reply.user_id')
			->where('comment_id', $comment->id)->count();

			$comments[$key]->getCommentReplies = CommentReply::select('comments_reply.id', 'user_id', 'reply', 'comment_id',
				'comments_reply.created_at', 'comments_reply.updated_at', 'channel_name')
			->join('users', 'users.id', '=', 'comments_reply.user_id')
			->get();	

			/***Comment Replies Section***/
			foreach($comments[$key]->getCommentReplies as $key1 => $getCommentReplies1){
				$profile_picture =	User::getUsersImages($getCommentReplies1->user_id)['profile_picture'];
				$comments[$key]->getCommentReplies[$key1]->profile_picture = $profile_picture;

				$notifications = new Notification();
				$comments[$key]->getCommentReplies[$key1]->time_difference = $notifications->getTimePosted($comment);

				$comments[$key]->getCommentReplies[$key1]->likesCountReply = DB::table('comments_reply_likesdislikes')->where(array('comments_reply_id' => $comment->id, 'status' => 'liked'))->count();
				$comments[$key]->getCommentReplies[$key1]->dislikeCountReply = DB::table('comments_reply_likesdislikes')->where(array('comments_reply_id' => $comment->id, 'status' => 'disliked'))->count();

				if(Auth::check()){
					$comments[$key]->getCommentReplies[$key1]->ifAlreadyLiked = DB::table('comments_reply_likesdislikes')->where(array(
						'comments_reply_id' => $comment->id, 'user_id' => Auth::User()->id,'status' => 'liked')
					)->first();
					$comments[$key]->getCommentReplies[$key1]->ifAlreadyDisliked = DB::table('comments_reply_likesdislikes')->where(array(
						'comments_reply_id' => $comment->id, 'user_id' => Auth::User()->id,'status' => 'disliked')
					)->first();
				}
			}
			/***Comment Replies Section***/
		}

		return $comments;
	}

	public function totalComment($id){
		$result = Comment::where('video_id',$id)->get();
		return array('comment' => $result->count());
	}
}