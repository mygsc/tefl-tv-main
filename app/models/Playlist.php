<?php

class Playlist extends Eloquent {
	use SoftDeletingTrait;
	protected $table = 'playlists';
	protected $fillable = ['user_id','name','description','privacy','randID'];
	protected $softDelete = true;

	public function getPlaylist(){
		return Playlist::where('privacy', '1')->get();
	}
}