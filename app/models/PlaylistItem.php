<?php

class PlaylistItem extends Eloquent {

	protected $table = 'playlists_items';
	protected $fillable = ['playlist_id','video_id'];
}