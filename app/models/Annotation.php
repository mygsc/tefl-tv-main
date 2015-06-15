<?php
/**
* 
*/
class Annotation extends Eloquent{
	protected $table = 'annotations';
	function __construct(){
		
	}
	public function video(){
		return $this->belongsTo('Video');
	}
}