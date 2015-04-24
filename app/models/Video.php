<?php

class Video extends Eloquent{
	use SoftDeletingTrait;
	protected $table = 'videos';
	protected $dates = ['deleted_at'];
	protected $softDelete = true;
	protected $guarded = array('id');
	protected $fillable = ['user_id','title','description','publish','file_name','extension','views','likes','inappropriate'];

	public static $video_rules = array(
		'video' => 'max:153600kb|mimes:mp4,webm,wmv,mov,ogg,asf,wav|required', //,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo
		//'video' => 'max:307200kb|mimes:mp4,webm,mov,ogg,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv|required',	
		);
	public static $addDescription = array(
		'title' => 'required',
		'description' => 'required',
		'tags' => 'required',
		'publish' => 'required',
		'poster' => 'mimes:jpg,jpeg,png,gif,pneg,bmp'
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
			ORDER BY (v.views + likes) DESC';
		}elseif($type == 'popular'){
			$additionaQuery = 
			'ORDER BY (v.views) DESC';
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
			'SELECT v.id,v.user_id as uid, v.title, v.description, v.publish, v.file_name,
			v.views,(SELECT count(ul.id) from users_likes ul where video_id = v.id) as likes,v.total_time, v.tags, v.report_count,v.recommended, v.created_at,
			v.deleted_at,v.total_time,u.channel_name,u.status FROM videos v
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

		foreach($returnData as $key => $item){
			$folderName = $item->uid.'-'.$item->channel_name;
			$fileName = $item->file_name;
			$posterName = $fileName. '.jpg';
			$filePath = 'videos' .DIRECTORY_SEPARATOR. $folderName .DIRECTORY_SEPARATOR. $fileName; 
			$thumbnail= $filePath .DIRECTORY_SEPARATOR. $posterName;
			$returnData[$key]->thumbnail = '/img/thumbnails/video.png';
			if(file_exists(public_path($thumbnail))){
				$returnData[$key]->thumbnail = $thumbnail;
			}
			
		}
		return $returnData;
	}

	public function countViews($countAllViews = null){
		$a = $countAllViews;
		$convertNumber = number_format($a);

		if(strlen($countAllViews) >= 4 || strlen($countAllViews) >= 6) {
			$a = $countAllViews;
			$round = round(($a/1000), 1);
			$convertNumber = number_format($round, 4, ',', ' ') . 'k';
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

	public function countLikes(){
		
	}

	public function searchVideos($search = null){
		if(!empty($search)){
			if(strlen($search) >3){
				$query = "MATCH (videos.title, videos.description,videos.tags) AGAINST ('$search' IN BOOLEAN MODE)";

				$videoData =  Video::select('videos.id',
					'videos.user_id',
					'videos.title',
					'videos.description',
					'users.channel_name',
					'videos.tags',
					'videos.file_name',
					'videos.views',
					'videos.created_at',
					DB::raw('(SELECT count(ul.video_id) from users_likes ul where ul.video_id = videos.id) as likes'),
					DB::raw("MATCH (videos.title) AGAINST ('$search') as title_relevance"),
					DB::raw("MATCH (videos.description) AGAINST ('$search') as desc_relevance"),
					DB::raw("MATCH (videos.tags) AGAINST ('$search') as tags_relevance"))
				->whereRaw($query)
				->where('deleted_at', NULL)
				->where('publish', '1')
				->where('report_count', '<', 5)
				->orderBy(DB::raw('((title_relevance * 0.50)+ (desc_relevance * 0.2998) + (tags_relevance * 0.20)) + (views * 0.0001) + (likes * 0.0001)'), 'desc')
				->join('users', 'user_id', '=', 'users.id')
				->paginate(5);	
			}else{
				$videoData = Video::select('videos.id',
					'videos.user_id',
					'videos.title',
					'videos.description',
					'users.channel_name',
					'videos.tags',
					'videos.file_name',
					'videos.views',
					'videos.created_at',
					DB::raw('(SELECT count(ul.video_id) from users_likes ul where ul.video_id = videos.id) as likes'))
				->where('title', 'LIKE', '%'.$search.'%')
				->where('description', 'LIKE', '%'.$search.'%')
				->where('tags', 'LIKE', '%'.$search.'%')
				->where('deleted_at', NULL)
				->where('publish', 1)
				->where('report_count', '<', 5)
				->orWhere("channel_name", "LIKE", "%".$search."%")
				->where('deleted_at', NULL)
				->where('publish', 1)
				->where('report_count', '<', 5)
				->join('users', 'user_id', '=', 'users.id')
				->orderBy(DB::raw('((views) + (likes))'), 'desc')
				->paginate(5);
			}

			return $this->addOtherVideoData($videoData);
		}
		return false;
	}

	public function addOtherVideoData($videoData = null){
		foreach($videoData as $key => $video){
			//Thumbnails
			$folderName = $video->user_id. '-'. $video->channel_name;
			$fileName = $video->file_name;
			$thumbnail = 'videos/'.$folderName. DIRECTORY_SEPARATOR .$fileName. DIRECTORY_SEPARATOR .$fileName.'.jpg';
			$videoData[$key]->thumbnail = 'img\thumbnails\video.png';
			if(file_exists(public_path($thumbnail))){
				$videoData[$key]->thumbnail = $thumbnail;
			}

			//truncate text
			$videoData[$key]->description = Str::limit($video->description, 150, '...');

			//Tags
			$getTags = explode(',',$video->tags);
			foreach($getTags as $key2 => $tags){
				$arraysOfTags[] = $tags;
				$videoData[$key]->tags = $arraysOfTags;
			}
		}
		return $videoData;
		
	}

	public function truncate($text, $chars = 50) {
		if(strlen($text) > $chars){
			$text = $text." ";
			$text = substr($text,0,$chars);
			$text = substr($text,0,strrpos($text,' '));
			$text = $text."...";
		}
		return $text;
	}

	public function getCategory(){
		$categoryList = array('Instructional','Video Blog', 'Music', 'Music Video', 'Animated Video', 'Animated Music Video', 'Questions & Answers', 'Advice', 'Podcast', 'Interviews', 'Documentaries', 'Video CV', 'Job AD', 'miscellaneous');
		foreach ($categoryList as $key => $category) {
			$findCategory = Video::where('category', 'LIKE', '%'.$category.'%')->get();
			if(!$findCategory->isEmpty()){
				$categories[] = '<li><a href='.route('homes.category',array($category)).'>'.$category.'</a></li>';
			}
		}
		if(!empty($categories)){
			return $categories;
		}
		return false;
		
	}

	public function relations($id = null,$counter = null,$title = null,$description = null,$tags = null,$relations = null){
		if($counter == 0){
			$randoms = DB::select("SELECT DISTINCT  v.id, v.user_id as uid, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name,u.verified,u.status FROM videos v 
				LEFT JOIN users u ON v.user_id = u.id
				HAVING v.id!='".$id."'
				AND v.publish = '1'
				AND u.verified = '1'
				AND u.status = '1'
				and v.deleted_at IS NULL
				AND v.report_count < 5
				OR v.report_count IS NULL
				ORDER BY RAND()
				LIMIT 15;");		
			$merging = array_merge($randoms,$relations);
			$newRelation = array_unique($merging, SORT_REGULAR);
			sort($newRelation);
		}
		if($counter == 1){
			$randoms = DB::select("SELECT DISTINCT  v.id, v.user_id as uid, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name,u.verified,u.status FROM videos v 
				LEFT JOIN users u ON v.user_id = u.id
				HAVING v.id!='".$id."'
				AND v.publish = '1'
				AND u.verified = '1'
				AND u.status = '1'
				and v.deleted_at IS NULL
				AND v.report_count < 5
				OR v.report_count IS NULL
				ORDER BY RAND()
				LIMIT 14;");
			$merging = array_merge($randoms,$relations);
			$newRelation = array_unique($merging, SORT_REGULAR);
			sort($newRelation);
		}
		if($counter == 2){
			$randoms = DB::select("SELECT DISTINCT  v.id, v.user_id as uid, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name,u.verified,u.status FROM videos v 
				LEFT JOIN users u ON v.user_id = u.id
				HAVING v.id!='".$id."'
				AND v.publish = '1'
				AND u.verified = '1'
				AND u.status = '1'
				and v.deleted_at IS NULL
				AND v.report_count < 5
				OR v.report_count IS NULL
				ORDER BY RAND()
				LIMIT 13;");
			$merging = array_merge($randoms,$relations);
			$newRelation = array_unique($merging, SORT_REGULAR);
			sort($newRelation);
		}
		if($counter == 3){
			$randoms = DB::select("SELECT DISTINCT  v.id, v.user_id as uid, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name,u.verified,u.status FROM videos v 
				LEFT JOIN users u ON v.user_id = u.id
				HAVING v.id!='".$id."'
				AND v.publish = '1'
				AND u.verified = '1'
				AND u.status = '1'
				and v.deleted_at IS NULL
				AND v.report_count < 5
				OR v.report_count IS NULL
				ORDER BY RAND()
				LIMIT 12;");
			$merging = array_merge($randoms,$relations);
			$newRelation = array_unique($merging, SORT_REGULAR);
			sort($newRelation);
		}
		if($counter == 4){
			$randoms = DB::select("SELECT DISTINCT  v.id, v.user_id as uid, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name,u.verified,u.status FROM videos v 
				LEFT JOIN users u ON v.user_id = u.id
				HAVING v.id!='".$id."'
				AND v.publish = '1'
				AND u.verified = '1'
				AND u.status = '1'
				and v.deleted_at IS NULL
				AND v.report_count < 5
				OR v.report_count IS NULL
				ORDER BY RAND()
				LIMIT 11;");
			$merging = array_merge($randoms,$relations);
			$newRelation = array_unique($merging, SORT_REGULAR);
			sort($newRelation);
		}
		if($counter == 5){
			$randoms = DB::select("SELECT DISTINCT  v.id, v.user_id as uid, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name,u.verified,u.status FROM videos v 
				LEFT JOIN users u ON v.user_id = u.id
				HAVING v.id!='".$id."'
				AND v.publish = '1'
				AND u.verified = '1'
				AND u.status = '1'
				and v.deleted_at IS NULL
				AND v.report_count < 5
				OR v.report_count IS NULL
				ORDER BY RAND()
				LIMIT 10;");
			$merging = array_merge($randoms,$relations);
			$newRelation = array_unique($merging, SORT_REGULAR);
			sort($newRelation);
		}
		if($counter == 6){
			$randoms = DB::select("SELECT DISTINCT  v.id, v.user_id as uid, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name,u.verified,u.status FROM videos v 
				LEFT JOIN users u ON v.user_id = u.id
				HAVING v.id!='".$id."'
				AND v.publish = '1'
				AND u.verified = '1'
				AND u.status = '1'
				and v.deleted_at IS NULL
				AND v.report_count < 5
				OR v.report_count IS NULL
				ORDER BY RAND()
				LIMIT 9;");
			$merging = array_merge($randoms,$relations);
			$newRelation = array_unique($merging, SORT_REGULAR);
			sort($newRelation);
		}
		if($counter == 7){
			$randoms = DB::select("SELECT DISTINCT  v.id, v.user_id as uid, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name,u.verified,u.status FROM videos v 
				LEFT JOIN users u ON v.user_id = u.id
				HAVING v.id!='".$id."'
				AND v.publish = '1'
				AND u.verified = '1'
				AND u.status = '1'
				and v.deleted_at IS NULL
				AND v.report_count < 5
				OR v.report_count IS NULL
				ORDER BY RAND()
				LIMIT 8;");
			$merging = array_merge($randoms,$relations);
			$newRelation = array_unique($merging, SORT_REGULAR);
			sort($newRelation);

		}
		if($counter == 8){
			$randoms = DB::select("SELECT DISTINCT  v.id, v.user_id as uid, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name,u.verified,u.status FROM videos v 
				LEFT JOIN users u ON v.user_id = u.id
				HAVING v.id!='".$id."'
				AND v.publish = '1'
				AND u.verified = '1'
				AND u.status = '1'
				and v.deleted_at IS NULL
				AND v.report_count < 5
				OR v.report_count IS NULL
				ORDER BY RAND()
				LIMIT 7;");
			$merging = array_merge($randoms,$relations);
			$newRelation = array_unique($merging, SORT_REGULAR);
			sort($newRelation);

		}
		if($counter == 9){
			$randoms = DB::select("SELECT DISTINCT  v.id, v.user_id as uid, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name,u.verified,u.status FROM videos v 
				LEFT JOIN users u ON v.user_id = u.id
				HAVING v.id!='".$id."'
				AND v.publish = '1'
				AND u.verified = '1'
				AND u.status = '1'
				and v.deleted_at IS NULL
				AND v.report_count < 5
				OR v.report_count IS NULL
				ORDER BY RAND()
				LIMIT 6;");
			$merging = array_merge($randoms,$relations);
			$newRelation = array_unique($merging, SORT_REGULAR);
			sort($newRelation);
		}
		if($counter == 10){
			$randoms = DB::select("SELECT DISTINCT  v.id, v.user_id as uid, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name,u.verified,u.status FROM videos v 
				LEFT JOIN users u ON v.user_id = u.id
				HAVING v.id!='".$id."'
				AND v.publish = '1'
				AND u.verified = '1'
				AND u.status = '1'
				and v.deleted_at IS NULL
				AND v.report_count < 5
				OR v.report_count IS NULL
				ORDER BY RAND()
				LIMIT 5;");
			$merging = array_merge($randoms,$relations);
			$newRelation = array_unique($merging, SORT_REGULAR);
			sort($newRelation);
		}
		if($counter == 11){
			$randoms = DB::select("SELECT DISTINCT  v.id, v.user_id as uid, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name,u.verified,u.status FROM videos v 
				LEFT JOIN users u ON v.user_id = u.id
				HAVING v.id!='".$id."'
				AND v.publish = '1'
				AND u.verified = '1'
				AND u.status = '1'
				and v.deleted_at IS NULL
				AND v.report_count < 5
				OR v.report_count IS NULL
				ORDER BY RAND()
				LIMIT 4;");
			$merging = array_merge($randoms,$relations);
			$newRelation = array_unique($merging, SORT_REGULAR);
			sort($newRelation);
		}
		if($counter == 12){
			$randoms = DB::select("SELECT DISTINCT  v.id, v.user_id as uid, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name,u.verified,u.status FROM videos v 
				LEFT JOIN users u ON v.user_id = u.id
				HAVING v.id!='".$id."'
				AND v.publish = '1'
				AND u.verified = '1'
				AND u.status = '1'
				and v.deleted_at IS NULL
				AND v.report_count < 5
				OR v.report_count IS NULL
				ORDER BY RAND()
				LIMIT 3;");
			$merging = array_merge($randoms,$relations);
			$newRelation = array_unique($merging, SORT_REGULAR);
			sort($newRelation);
		}
		if($counter == 13){
			$randoms = DB::select("SELECT DISTINCT  v.id, v.user_id as uid, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name,u.verified,u.status FROM videos v 
				LEFT JOIN users u ON v.user_id = u.id
				HAVING v.id!='".$id."'
				AND v.publish = '1'
				AND u.verified = '1'
				AND u.status = '1'
				and v.deleted_at IS NULL
				AND v.report_count < 5
				OR v.report_count IS NULL
				ORDER BY RAND()
				LIMIT 2;");
			$merging = array_merge($randoms,$relations);
			$newRelation = array_unique($merging, SORT_REGULAR);
			sort($newRelation);
		}
		if($counter == 14){
			$randoms = DB::select("SELECT DISTINCT  v.id, v.user_id as uid, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name,u.verified,u.status FROM videos v 
				LEFT JOIN users u ON v.user_id = u.id
				HAVING v.id!='".$id."'
				AND v.publish = '1'
				AND u.verified = '1'
				AND u.status = '1'
				and v.deleted_at IS NULL
				AND v.report_count < 5
				OR v.report_count IS NULL
				ORDER BY RAND()
				LIMIT 1;");
			$merging = array_merge($randoms,$relations);
			$newRelation = array_unique($merging, SORT_REGULAR);
			sort($newRelation);
		}
		if($counter >= 15){
			$newRelation =  DB::select("SELECT DISTINCT  v.id, v.user_id as uid, v.title,v.description,v.tags,v.created_at,v.deleted_at,v.publish,v.report_count,v.file_name,u.channel_name,u.verified,u.status FROM videos v 
			LEFT JOIN users u ON v.user_id = u.id
			WHERE MATCH(v.title,v.description,v.tags) AGAINST ('".$title.','.$description.','.$tags."' IN BOOLEAN MODE)
			HAVING v.id!='".$id."'
			AND v.publish = '1'
			AND u.verified = '1'
			AND u.status = '1'
			and v.deleted_at IS NULL
			AND v.report_count < 5
			OR v.report_count IS NULL
			LIMIT 15;");
		}

		return $newRelation;
	}
	

	
	public function getVideos($auth = null, $orderBy = null, $limit = null) {
		$getVideos = Video::select('videos.id', 'videos.user_id', 'title', 'description', 'publish', 'file_name', 'uploaded', 'total_time', 'views', 
			'category', 'tags', 'report_count', 'recommended', 'deleted_at', 'videos.created_at', 'videos.updated_at',
			DB::raw('(SELECT COUNT(ul.video_id) FROM users_likes ul WHERE ul.user_id = videos.user_id) AS likes'),
			DB::raw('(SELECT users.channel_name FROM users WHERE users.id = videos.user_id) AS channel_name'))
			->where('videos.user_id', $auth);

		if(!empty($orderBy)) {
			$getVideos = $getVideos->orderBy($orderBy, 'DESC');
		}

		if(!empty($limit)) {
			$getVideos = $getVideos->take($limit);
		}

		return $getVideos->take($limit)->get();
	}
}
