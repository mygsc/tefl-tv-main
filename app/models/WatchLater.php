<?php



class WatchLater extends Eloquent {

	protected $table = 'users_watch_later';
	protected $fillable = ['user_id','video_id','status'];

	public function user() {

		return $this->hasMany('User');
	}

	public function video() {

		return $this->hasMany('Video');
	}

	public function getWatchLater($auth = null, $authVideo = null ,$limit = null) {
		if(!empty($limit)){
			$limit = 'LIMIT '. $limit;
		}
		$userVideoWatchLater = DB::select(
			"SELECT wl.id, wl.user_id, wl.video_id, wl.status, wl.created_at, wl.updated_at, u.channel_name, v.title, v.file_name, v.description, v.views, v.tags,
			(SELECT COUNT(ul.video_id) FROM users_likes ul WHERE ul.user_id = v.user_id) AS numberOfLikes
			FROM users_watch_later AS wl
			INNER JOIN users AS u ON wl.user_id = u.id
			INNER JOIN videos AS v ON wl.video_id = v.id WHERE wl.user_id = '".$auth."'". $limit);
		return $userVideoWatchLater;
	}
}