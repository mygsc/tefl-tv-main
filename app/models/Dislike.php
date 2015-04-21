<?php
class Dislike extends Eloquent{
	protected $table = 'users_dislikes';
	protected $fillable = ['video_id','user_id'];
}