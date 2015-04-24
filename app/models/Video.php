<?php

class Video extends Eloquent{
	use SoftDeletingTrait;
	protected $table = 'videos';
	protected $dates = ['deleted_at'];
	protected $softDelete = true;
	protected $guarded = array('id');
	protected $fillable = ['user_id','title','description','publish','file_name','extension','views','likes','inappropriate'];

	public static $video_rules = array(
		'video' => 'mimes:mp4,webm,wmv,mov,ogg,asf,wav|required', //,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo
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
	public function getFeaturedVideo($type = null, $limit = null){
		if(!empty($type)){

			switch ($type) {
				case 'recommended':
				$orderBy = '(views + likes)';
				$sort = 'ASC';
				break;
				case 'latest':
				$orderBy = 'created_at';
				$sort = 'DESC';
				break;
				case 'popular':
				$orderBy = 'views';
				$sort = 'DESC';
				break;
				case 'random':
				$orderBy = 'RAND()';
				$sort = '';
				break;
				default:
				return false;
				break;
			}

			$videoData = Video::select('videos.id','user_id','title',
				'description','users.channel_name',
				'tags','file_name','views','videos.created_at',
				DB::raw('(SELECT count(ul.video_id) from users_likes ul where ul.video_id = videos.id) as likes')
				)
			->where('deleted_at', null)
			->where('report_count', '<', 5)
			->where('uploaded', '1')
			->where('publish', '1')
			->where('users.status', '!=', '0')
			->join('users', 'user_id', '=', 'users.id')
			->take($limit)
			->orderBy(DB::raw($orderBy), $sort)
			->get();

			return $this->addThumbnail($videoData);	
		}
		return false;		
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

			$videoData = $this->addThumbnail($videoData);
			return $this->addVideoTags($videoData);
		}
		return false;
	}

	public function addThumbnail($data = null){
		foreach($data as $key => $video){
			//Thumbnails
			$folderName = $video->user_id. '-'. $video->channel_name;
			$fileName = $video->file_name;
			$thumbnailPath = '/videos/'.$folderName. DIRECTORY_SEPARATOR .$fileName. DIRECTORY_SEPARATOR .$fileName.'.jpg';
			$data[$key]->thumbnail = '/img/thumbnails/video.png';
			if(file_exists(public_path($thumbnailPath))){
				$data[$key]->thumbnail = $thumbnail;
			}
		}
		return $data;
	}

	public function addVideoTags($videoData){
		foreach($videoData as $key => $video){
			$getTags = explode(',',$video->tags);
			$videoData[$key]->tags = $getTags;;
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
			$findCategory = Video::where('category', 'LIKE', '%'.$category.'%')->first();
			if(isset($findCategory)){
				$categories[] = '<li><a href='.route('homes.category',array($category)).'>'.$category.'</a></li>';
			}
		}
		if(!empty($categories)){
			return $categories;
		}
		return false;

	}

	public function relations($query = null,$id = null,$limit = null){

	  $returndata =	Video::select('videos.id','videos.user_id as uid','videos.title','videos.description','videos.tags','videos.created_at','videos.deleted_at','videos.publish','videos.report_count',
									'videos.file_name','videos.user_id','users.channel_name','users.verified','users.status')
						->whereRaw($query)
						->where('deleted_at', NULL)
						->where('publish','=', '1')
						->where('report_count', '<', 5)
						->where('videos.id','!=',$id)
						->join('users', 'user_id', '=', 'users.id');

		if(!empty($limit)){
			$returndata = $returndata->take($limit);
		}
		return  $returndata->get();

	}

	public function randomRelation($limit = null,$id = null){
	  if(empty($limit)){
	   $limit = "";
	  }
	  $returndata = Video::select('videos.id','videos.user_id as uid','videos.title','videos.description','videos.tags','videos.created_at','videos.deleted_at','videos.publish','videos.report_count',
									'videos.file_name','videos.user_id','users.channel_name','users.verified','users.status')
							->where('deleted_at', NULL)
							->where('publish','=', '1')
							->where('report_count', '<', 5)
							->where('videos.id','!=',$id)
							->join('users', 'user_id', '=', 'users.id')
							->take($limit)->get();
	  return $returndata;
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
