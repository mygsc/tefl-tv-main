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

		$userFavorite = DB::select('SELECT uf.id, uf.user_id, uf.video_id, uf.created_at, uf.updated_at, v.title, v.views, v.file_name, v.description, u.channel_name,
			(SELECT COUNT(ul.video_id) FROM users_likes ul WHERE ul.user_id = v.user_id) AS numberOfLikes
			FROM users_favorite AS uf
			INNER JOIN videos AS v ON uf.video_id = v.id
			INNER JOIN users AS u ON uf.user_id = u.id WHERE uf.user_id ="'.$auth.'"');

		return $userFavorite;
	}
}