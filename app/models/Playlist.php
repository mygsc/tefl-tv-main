<?php

class Playlist extends Eloquent {
	use SoftDeletingTrait;
	protected $table = 'playlists';
	protected $fillable = ['user_id','name','description','privacy'];
	protected $softDelete = true;

	public function getRandomPlaylist(){
		return Playlist::select('playlists.id',
			'playlists.user_id',
			'users.channel_name',
			'playlists.name',
			'playlists.description',
			DB::raw('(SELECT count(playlists_items.playlist_id) from playlists_items where playlists_items.playlist_id = playlists.id) as video_count'))
			->where('privacy', '0')
			->join('users', 'playlists.user_id', '=', 'users.id')
			->orderByRaw("RAND()")
			->get();
	}
}