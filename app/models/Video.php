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
		'publish' => 'required',
		'poster' => 'mimes:jpg,jpeg,png,gif,pneg'
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

	public function favorite() {

		return $this->hasMany('Favorite');
	}

	public function watchlater() {

		return $this->hasMany('WatchLater');
	}
	public function getVideoByCategory($type = null, $limit = null){
		if(empty($type)){
			return false;
		}

		if(!empty($limit)){
			$limit = 'LIMIT '. $limit;
		}

		if($type == 'recommended'){
			$additionaQuery = 
				'AND recommended = "1"
				ORDER BY (v.views + v.likes) DESC';
		}elseif($type == 'popular'){
			$additionaQuery = 
				'ORDER BY (v.views + v.likes) DESC';
		}elseif($type == 'latest'){
			$additionaQuery = 
				'ORDER BY v.created_at DESC';
		}elseif($type == 'random'){
			$additionaQuery =
				'ORDER BY RAND()';
		}else{
			return false;
		}

		$returnData = DB::select(
				'SELECT v.id,v.user_id, v.title, v.description, v.publish, 
				v.views, v.likes, v.tags, v.report_count,v.recommended, v.created_at,
				v.deleted_at,u.channel_name,u.status FROM videos v
				INNER JOIN users u ON
				v.user_id = u.id
				WHERE
				v.deleted_at IS NULL
				AND
				v.report_count < 5
				AND
				NOT(u.status = "0")
				AND
				publish = "1"'.
				$additionaQuery.
				' '.
				$limit. '');

		return $returnData;
	}

	public function countViews($countAllViews = null){
		$a = $countAllViews;
		$convertNumber = number_format($a);
			
		if(strlen($countAllViews) >= 4 || strlen($countAllViews) >= 6) {
			$a = $countAllViews;
			$round = round(($a/1000), 1);
			$convertNumber = number_format($round, 3, ',', ' ') . 'k';
		}

		if(strlen($countAllViews) >=7 && strlen($countAllViews) <= 9 ){
			$a = $countAllViews;
			$round = round(($a/1000000), 1);
			$convertNumber = number_format($round, 3, ',', ' ') . 'm';
		}
		return $convertNumber;
	}

	public function countVideos($countAllViews = null){
		$a = $countAllViews;
		$convertNumber = number_format($a);
			
		if(strlen($countAllViews) >= 4 || strlen($countAllViews) >= 6) {
			$a = $countAllViews;
			$round = round(($a/1000), 1);
			$convertNumber = number_format($round, 3, ',', ' ') . 'k';
		}

		if(strlen($countAllViews) >=7 && strlen($countAllViews) <= 9 ){
			$a = $countAllViews;
			$round = round(($a/1000000), 1);
			$convertNumber = number_format($round, 3, ',', ' ') . 'm';
		}
		return $convertNumber;
	}
}
