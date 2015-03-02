<?php
class Tag extends Eloquent{

	protected $table = 'tags';
	protected $guarded = array('id');
	protected $fillable = ['tags'];

	public function videos(){
	return $this->belongsToMany('Video');
	}
}
