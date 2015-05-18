<?php

class TagVideo extends Eloquent{

	protected $table = 'tag_video';
	protected $guarded = array('id');
	protected $fillable = ['video_id','tag_id'];

	public function videos(){
		return $this->hasMany('Video');
	}

	public function tags(){
		return $this->belongsTo('Tag');
	}

}