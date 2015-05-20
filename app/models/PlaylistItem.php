<?php


class PlaylistItem extends Eloquent {
	use SoftDeletingTrait;
	protected $softDelete = true;
	protected $table = 'playlists_items';
	protected $fillable = ['playlist_id','video_id'];
}