<?php

class Playlist extends Eloquent {
	use SoftDeletingTrait;
	protected $table = 'playlists';
	protected $fillable = ['user_id','name','description','privacy','randID'];
	protected $softDelete = true;

	public function getPlaylist($limit = null, $orderBy = null){
		$playlists = Playlist::select('playlists.id',
			'user_id',
			'name',
			'channel_name',
			'randID')
		->where('privacy', '1')
		->whereExists(function($query){
			$query->select('playlists_items.playlist_id')
			->from('playlists_items')
			->whereRaw('playlists_items.playlist_id = playlists.id');
		})
		->join('users', 'users.id','=','playlists.user_id');

		if(!empty($limit)){
			$playlists->take($limit);
		}

		if(!empty($orderBy)){
			$playlists->orderBy($orderBy, 'DESC');
		}

		$playlists = $playlists->get();

		foreach($playlists as $key => $playlist){
			$playlist_item =PlaylistItem::select('file_name')
			->where('playlist_id', $playlist->id)
			->where('publish', 1)
			->where('uploaded', 1)
			->where('videos.deleted_at', null)
			->join('videos', 'videos.id', '=', 'playlists_items.id')
			->get();
			
			if(!$playlist_item->isEmpty()){
				$playlists[$key]->video_id = $playlist_item[0]->file_name;
			}else{
				unset($playlists[$key]);
			}
		}

		return $playlists;
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

	public function playlistControl($control = null, $playlistId = null,$id = null,$itemId = null){
		$returvalue = Playlist::select('videos.*','users.channel_name','playlists.randID',
			'playlists.id as playlist_id')
		->join('playlists_items','playlists.id','=','playlists_items.playlist_id')
		->join('videos','playlists_items.video_id','=','videos.id')
		->join('users','videos.user_id','=','users.id')
		->where('playlist_id','=',$playlistId)
		->where('publish','=','1')
		->where('videos.deleted_at',NULL)
		->where('videos.report_count','<=','5');
		if($control == '>'){
			$returvalue->where('videos.id','!=',$id)->where('playlists_items.id','>',$itemId)->orderBy('playlists_items.id','ASC')->take(1);			
		}
		else if($control == '<'){
			$returvalue->where('videos.id','!=',$id)->where('playlists_items.id','<',$itemId)->orderBy('playlists_items.id','DESC')->take(1);
		}
		return $returvalue->get();
	}

	public function searchPlaylists($auth = null, $search = null){
		$search = 'sad';
		if($search = null){
			return 'wrong';
		}

		$searchPlaylist = Playlist::where('name', 'LIKE', "%$search%")
		->where('user_id', $auth)
		->get();

		return $searchPlaylist;

	}
}