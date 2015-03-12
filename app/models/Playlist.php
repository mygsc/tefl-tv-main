<?php

class Playlist extends Eloquent {

	protected $table = 'playlists';
	protected $fillable = ['user_id','name','description','privacy'];

	public function getRandomPlaylist(){
		return Playlist::orderByRaw("RAND()")
			->where('privacy', '0')
			->get(array('id','user_id','name','description'));
	}
}