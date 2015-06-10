<?php

class UserFavorite extends Eloquent {
	protected $table = 'user_favorite';
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

		$userFavorite = UserFavorite::select('user_favorite.id','user_favorite.user_id', 'video_id', 'videos.views', 'videos.title', 'videos.user_id', 'user_favorite.created_at',
			'user_favorite.updated_at',
			DB::raw('(SELECT COUNT(ul.video_id) FROM user_likes ul WHERE ul.user_id = videos.user_id) AS likes'),
			DB::raw('(SELECT v2.user_id FROM videos v2 WHERE v2.id = user_favorite.video_id) AS uploader_id'),
			DB::raw('(SELECT u2.channel_name FROM users u2 WHERE u2.id = uploader_id) AS uploaders_channel_name'))
		->join('videos', 'videos.id', '=', 'user_favorite.video_id')
		->join('users', 'user_favorite.user_id', '=', 'users.id')
		->where('user_favorite.user_id', $auth)
		->take($limit)
		->get();

		return $userFavorite;
	}

	public function getSearchFavoriteVideos($search = null){
		if(empty($search)){
			return false;
		}

		$search = UserFavorite::select('user_favorite.id', 'user_favorite.user_id', 'video_id', 'title',
		 'user_favorite.created_at','user_favorite.updated_at',
		 DB::raw('(SELECT COUNT(ul.video_id) FROM user_likes ul WHERE ul.user_id = user_favorite.user_id) AS likes'),
		 DB::raw('(SELECT v2.user_id FROM videos v2 WHERE v2.id = user_favorite.video_id) AS uploader,
		(SELECT u2.channel_name FROM users u2 WHERE u2.id = uploader) AS uploaders_channel_name')
		 )
		->join('videos', 'videos.id', '=', 'user_favorite.video_id')
		->where('videos.title', 'LIKE', '%'.$search.'%')
		->get();

		return $search;
	}
}