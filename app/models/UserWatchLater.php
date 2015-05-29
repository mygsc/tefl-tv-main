<?php



class UserWatchLater extends Eloquent {

	protected $table = 'user_watch_later';
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
		$userVideoWatchLater = UserWatchLater::select('user_watch_later.id', 'user_watch_later.user_id', 
			'user_watch_later.video_id', 'status', 'user_watch_later.created_at', 'user_watch_later.updated_at',
			'videos.file_name', 'videos.title', 'videos.description', 'videos.views',
			DB::raw('(SELECT COUNT(ul.video_id) FROM user_likes ul WHERE ul.user_id = user_watch_later.user_id) AS likes'),
			DB::raw('(SELECT v2.user_id FROM videos v2 WHERE v2.id = user_watch_later.video_id) AS uploader,
			(SELECT u2.channel_name FROM users u2 WHERE u2.id = uploader) AS uploaders_channel_name'))
			->join('videos', 'videos.id', '=', 'user_watch_later.video_id')
			->where('user_watch_later.user_id', $auth)
			->take($limit)
			->get();
		return $userVideoWatchLater;
	}

	public function getSearchWatchLater($auth = null, $search = null){
		if(empty($search)){
			return $search;
		}

		$watchLater = UserWatchLater::select('user_watch_later.id', 'user_watch_later.user_id', 'video_id', 'title',
		 'status', 'user_watch_later.created_at','user_watch_later.updated_at',
		 DB::raw('(SELECT COUNT(ul.video_id) FROM user_likes ul WHERE ul.user_id = user_watch_later.user_id) AS likes'),
		 DB::raw('(SELECT v2.user_id FROM videos v2 WHERE v2.id = user_watch_later.video_id) AS uploader,
		(SELECT u2.channel_name FROM users u2 WHERE u2.id = uploader) AS uploaders_channel_name')
		 )
		->join('videos', 'videos.id', '=', 'user_watch_later.video_id')
		->where('user_watch_later.user_id', $auth)
		->where('videos.title', 'LIKE', '%'.$search.'%')
		->get();
		return $watchLater; 
	}
}