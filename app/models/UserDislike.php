<?php
class UserDislike extends Eloquent{
	protected $table = 'user_dislikes';
	protected $fillable = ['video_id','user_id'];
}