<?php

class Playlist extends Eloquent {
	use SoftDeletingTrait;
	protected $table = 'playlists';
	protected $fillable = ['user_id','name','description','privacy','randID'];
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

	public function playlistchoose($id = null){
		$returndata = Playlist::select('playlists.id','playlists.name','playlists.description','playlists.user_id','playlists.privacy','playlists.deleted_at',
									'playlists_items.video_id')
							->where('video_id',$id)
							->where('user_id',Auth::User()->id)
							->where('playlists.deleted_at',NULL)
							->join('playlists_items', 'playlist_id', '=', 'playlists.id')
							->get();
		return $returndata;
	}
	public function playlistnotchosen($id = null){
		$returndata = Playlist::whereRaw("NOT EXISTS
				(SELECT * FROM playlists_items AS i
					WHERE i.playlist_id = playlists.id
					AND
					i.video_id = '".$id."')")
				->where('user_id',Auth::User()->id)
				->where('deleted_at',NULL)->get();
		return $returndata;
	}
}