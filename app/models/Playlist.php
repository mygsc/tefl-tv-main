<?php

class Playlist extends Eloquent {
	use SoftDeletingTrait;
	protected $table = 'playlists';
	protected $fillable = ['user_id','name','description','privacy'];
	protected $softDelete = true;

	public function getRandomPlaylist(){
		return Playlist::orderByRaw("RAND()")
			->where('privacy', '0')
			->get(array('id','user_id','name','description'));
	}
}