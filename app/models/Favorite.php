<?php

class Favorite extends Eloquent {
	protected $table = 'users_favorite';
	protected $fillable = ['user_id','video_id'];
	public function user(){
		return $this->hasMany('User');
	}

	public function video(){
		return $this->hasMany('Video');
	}

	public function getUserFavoriteVideos($auth = null, $limit = null) {
		if(!empty($limit)) {
			$limit = 'LIMIT '.$limit;
		}

		$userFavorite = Favorite::select('users_favorite.id','users_favorite.user_id', 'video_id', 'videos.views', 'videos.title', 'videos.user_id', 'users_favorite.created_at',
			'users_favorite.updated_at',
			DB::raw('(SELECT COUNT(ul.video_id) FROM users_likes ul WHERE ul.user_id = videos.user_id) AS likes'),
			DB::raw('(SELECT v2.user_id FROM videos v2 WHERE v2.id = users_favorite.video_id) AS uploader_id'),
			DB::raw('(SELECT u2.channel_name FROM users u2 WHERE u2.id = uploader_id) AS uploaders_channel_name'))
		->join('videos', 'videos.id', '=', 'users_favorite.video_id')
		->join('users', 'users_favorite.user_id', '=', 'users.id')
		->where('users_favorite.user_id', $auth)
		->take($limit)
		->get();

		return $userFavorite;
	}
}