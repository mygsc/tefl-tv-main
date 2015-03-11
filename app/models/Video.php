<?php

class Video extends Eloquent{
  use SoftDeletingTrait;
	protected $table = 'videos';
	protected $dates = ['deleted_at'];
	protected $guarded = array('id');
	protected $fillable = ['user_id','title','description','publish','file_name','extension','views','likes','inappropriate'];

	public static $video_rules = array(
		'video' => 'mimes:mp4,webm,mov,ogg,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv|required',	
		);
	public static $addDescription = array(
		'title' => 'required',
		'description' => 'required',
		'tags' => 'required',
		'publish' => 'required'
		);
	public static $video_edit_rules = array(
		'title' => 'required',
		'description' => 'required',
		'publish' => 'required'
		);


    public function tags(){
    return $this->belongsToMany('Tag');
	}

	public function users(){
		return $this->belongsTo('User');
	}

	public function tagvideos(){
		return $this->belongsTo('TagVideo');
	}

	public function getRandomVideos($limit = null){
		return Video::orderByRaw("RAND()")
		->where('publish', '1')
		->where('report_count', '<', '5')
		->get(array('title', 'likes', 'views'))
		->take($limit);
	}

	public function favorite() {

		return $this->hasMany('Favorite');
	}
}
