<?php
	class Like extends Eloquent{
		protected $table = 'users_likes';
		protected $fillable = ['video_id','user_id'];
	}