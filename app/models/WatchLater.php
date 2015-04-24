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

	public function getWatchLater($auth = null, $limit = null) {
		if(!empty($limit)){
			$limit = 'LIMIT '. $limit;
		}
		$userVideoWatchLater = WatchLater::select('users_watch_later.id', 'users_watch_later.user_id', 
			'users_watch_later.video_id', 'status', 'users_watch_later.created_at', 'users_watch_later.updated_at',
			'videos.file_name', 'videos.title', 'videos.description', 'videos.views',
			DB::raw('(SELECT COUNT(ul.video_id) FROM users_likes ul WHERE ul.user_id = users_watch_later.user_id) AS likes'),
			DB::raw('(SELECT v2.user_id FROM videos v2 WHERE v2.id = users_watch_later.video_id) AS uploader,
			(SELECT u2.channel_name FROM users u2 WHERE u2.id = uploader) AS uploaders_channel_name'))
			->join('videos', 'videos.id', '=', 'users_watch_later.video_id')
			->where('users_watch_later.user_id', $auth)
			->take($limit)
			->get();
	}
}