<?php
/**
* 
*/
class Annotation extends Eloquent{
	protected $table = 'annotations';
	protected $guarded = array('id');
	//protected $fillable = ['user_id','vid_filename','types','content','start','end','link'];
	function __construct(){
		
	}
	public function video(){
		return $this->belongsTo('Video');
	}
}