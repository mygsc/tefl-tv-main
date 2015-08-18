<?php


class Video extends Eloquent{
	use SoftDeletingTrait;
	protected $table = 'videos';
	protected $dates = ['deleted_at'];
	protected $softDelete = true;
	protected $guarded = array('id');
	protected $fillable = ['user_id','title','total_time', 'description','publish','uploaded','file_name','extension','views','category','tags','report_count','recommended'];
	/*
	* Path of ffmpeg located at opt folder for local development
	* It is used for converting video, capturing image and grabbing information of the video (open source).
	* version 2.6.2 stable release
	* Note: Please don't update or change the path of ffmpeg in the server default ('/home/tefltv/bin/ffmpeg').
	* If ffmpeg encounter error when converting it might be useful to check the php.ini settings ff: 
	* max_input_time = 24000
	* max_execution_time = 24000
	* upload_max_filesize = 12000M
	* post_max_size = 24000M
	* memory_limit = 12000M
	* upload_max_size = 2500M
	* post_max_file = 2500M
	*/
	public $ffmpegPath = '/home/tefltv/bin/ffmpeg'; 
	public $ffprobePath = '/home/tefltv/bin/ffprobe';

	public static $video_rules = array(
		'video' => 'required' //,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo 'video' => 'max:307200kb|mimes:mp4,webm,mov,ogg,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv|required',	
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

		return $this->hasMany('UserFavorite');
	}
	public function annotation(){
		return $this->hasMany('Annotation');
	}

	public function watchlater() {

		return $this->hasMany('UserWatchLater');
	}

	public function notifications(){
		return $this->hasMany('notifications');
	}
	public function videoLikesDislikes(){
		return $this->hasOne('VideoLikesDislike');
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
				'description','users.channel_name','total_time',
				'tags','file_name','views','videos.created_at',
				DB::raw('(SELECT count(ul.video_id) from user_likes ul where ul.video_id = videos.id) as likes')
				)
			->where('deleted_at', null)
			->where('report_count', '<', 5)
			->where('uploaded', '1')
			->where('publish', '1')
			->where('uploaded','1')
			->where('users.status', 1)
			->join('users', 'user_id', '=', 'users.id')
			->take($limit)
			->orderBy(DB::raw($orderBy), $sort)
			->get();

			return $this->addThumbnail($videoData);	
		}
		return false;		
	}
	

	public function convertToShortNumbers($numbers = null){
		$splitNumber = str_split($numbers);
		if(strlen($numbers) >=  10){
			$suffix = 'B';
			$prefix = substr($numbers,0, -9);
			$convertedNumber = $prefix . $suffix;
		}elseif(strlen($numbers) >= 7 && strlen($numbers) <= 9){
			$suffix = 'M';
			$prefix = substr($numbers,0, -6);
			$convertedNumber = $prefix . $suffix;
		}elseif(strlen($numbers) >= 4 && strlen($numbers) <= 6){
			$suffix = 'K';
			$prefix = substr($numbers,0, -3);
			$convertedNumber = $prefix . $suffix;
		}else{
			$convertedNumber = $numbers;
		}

		return $convertedNumber;
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
					DB::raw('(SELECT count(ul.video_id) from user_likes ul where ul.video_id = videos.id) as likes'),
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
					DB::raw('(SELECT count(ul.video_id) from user_likes ul where ul.video_id = videos.id) as likes'))
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

			return $this->addVideoTagsandThumbnails($videoData);
		}
		return false;
	}

	public function addThumbnail($data = null){
		foreach($data as $key => $video){
			//Thumbnails
			$folderName = $video->user_id;
			$fileName = $video->file_name;
			$thumbnailPath = '/videos/'.$folderName. DIRECTORY_SEPARATOR .$fileName. DIRECTORY_SEPARATOR .$fileName.'.jpg';
			$data[$key]->thumbnail = '/img/thumbnails/video.png';
			if(file_exists(public_path($thumbnailPath))){
				$data[$key]->thumbnail = $thumbnailPath;
			}
		}
		return $data;
	}

	public function addVideoTagsandThumbnails($videoData){
		foreach($videoData as $key => $video){
			$getTags = explode(',',$video->tags);
			$videoData[$key]->tags = $getTags;;

			$folderName = $video->user_id;
			$fileName = $video->file_name;
			$thumbnailPath = '/videos/'.$folderName. DIRECTORY_SEPARATOR .$fileName. DIRECTORY_SEPARATOR .$fileName.'.jpg';
			$videoData[$key]->thumbnail = '/img/thumbnails/video.png';
			if(file_exists(public_path($thumbnailPath))){
				$videoData[$key]->thumbnail = $thumbnailPath;
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
		$categoryList = array('For Teachers','For Students','For Schools','Video Blog', 'Music', 'Animated Video', 'Animated Music Video', 'Questions & Answers', 'Advice', 'Podcast', 'Interviews', 'Documentaries', 'Video CV', 'Job AD', 'miscellaneous');
		$categories = array();
		foreach ($categoryList as $key => $category) {
			$findCategory = Video::where('category', 'LIKE', '%'.$category.'%')->first();
			if(isset($findCategory)){
				array_push($categories,'<li><a href='.route('homes.category',array($category)).'>'.$category.'</a></li>');
			}
		}
		if(!empty($categories)){
			return $categories;
		}
		return false;
	}

	public function relations($query = null,$id = null,$limit = null){
		$returndata =	Video::select('videos.id','videos.user_id as uid','videos.title','videos.description',
			'videos.tags','videos.views', 'videos.created_at','videos.deleted_at','videos.publish',
			'videos.uploaded','videos.report_count', 'videos.file_name','videos.user_id','users.channel_name',
			'users.verified','users.status')
		->whereRaw($query)
		->where('videos.deleted_at', NULL)
		->where('videos.publish', '1')
		->where('videos.uploaded', '1')
		->where('videos.report_count', '<', 5)
		->where('videos.id','!=',$id)
		->where('users.status','=','1')
		->join('users', 'videos.user_id', '=', 'users.id');

		if(!empty($limit)){
			$returndata = $returndata->take($limit);
		}

		return  $returndata->get();

	}

	public function randomRelation($limit = null,$id = null){
		if(empty($limit)){
			$limit = "";
		}
		$returndata = Video::select('videos.id','videos.user_id as uid','videos.title','videos.description','videos.tags','videos.views', 'videos.created_at','videos.deleted_at','videos.publish','videos.uploaded','videos.report_count',
			'videos.file_name','videos.user_id','users.channel_name','users.verified','users.status')
		->where('videos.deleted_at', NULL)
		->where('videos.publish', '1')
		->where('videos.uploaded','1')
		->where('videos.report_count', '<', 5)
		->where('videos.id','!=',$id)
		->where('users.status','=','1')
		->join('users', 'user_id', '=', 'users.id')
		->take($limit)->get();
		return $returndata;
	}


	public function getVideos($auth = null, $orderBy = null, $uploaded = null, $limit = null) {
		$getVideos = Video::select('videos.id', 'videos.user_id', 'title', 'description', 'publish', 'file_name', 'uploaded', 'total_time', 'views', 
			'category', 'tags', 'report_count', 'recommended', 'deleted_at', 'videos.created_at', 'videos.updated_at',
			DB::raw('(SELECT COUNT(ul.video_id) FROM user_likes ul WHERE ul.video_id = videos.id) AS likes'),
			DB::raw('(SELECT users.channel_name FROM users WHERE users.id = videos.user_id) AS channel_name'))
		->where('videos.user_id', $auth)
		->where('deleted_at', NULL);

		if(!empty($uploaded)){
			$getVideos = $getVideos->where('uploaded', $uploaded);
		}
		if(!empty($orderBy)) {
			$getVideos = $getVideos->orderBy($orderBy, 'DESC');
		}

		if(!empty($limit)) {
			$getVideos = $getVideos->take($limit);
		}

		return $getVideos->take($limit)->get();
	}

	public function getVideo($filename){
		$videos = Video::where('file_name', '=', $filename)->first();
		if(!isset($videos)) return false;
		$temp1 = '';
		$split_tags = explode(',', $videos->tags);
		$lastCount1 = count($split_tags) - 1;
		$x = 0;
		if(count($split_tags) != 1){
			foreach ($split_tags as $split_tag) {
				$split_tag = trim($split_tag);
				if ($x != $lastCount1) {
			        $temp1 = $temp1 . ucfirst($split_tag) . ", ";
			    }else{
			    	$temp1 = $temp1 . ucfirst($split_tag);
			    }
			    $x++;
			}
			$videos->tags = $temp1;
		}

		$temp2 = '';
		$split_categories = explode(',', $videos->category);
		$lastCount2 = count($split_tags) - 1;
		$y = 0;
		if(count($split_categories) != 1){
			foreach ($split_categories as $split_category) {
				$split_category = trim($split_category);
				if ($y != $lastCount2) {
			        $temp2 = $temp2 . ucfirst($split_category) . ", ";
			    }else{
			    	$temp2 = $temp2 . ucfirst($split_category);
			    }
			    $y++;
			}
			$videos->category = $temp2;
		}
		return $videos;
	}

	public function getVideoswithDispute($auth = null) {
		$getVideos = Video::select('videos.id', 'videos.user_id', 'title', 'description', 'publish', 'file_name', 'uploaded', 'total_time', 'views', 
			'category', 'tags', 'report_count', 'recommended', 'deleted_at', 'videos.created_at', 'videos.updated_at',
			DB::raw('(SELECT COUNT(ul.video_id) FROM user_likes ul WHERE ul.video_id = videos.id) AS likes'),
			DB::raw('(SELECT users.channel_name FROM users WHERE users.id = videos.user_id) AS channel_name'))
		->where('videos.user_id', $auth)
		->where('deleted_at', NULL)
		->get();

		foreach($getVideos as $key => $getVideo){
			$getVideos[$key]->ifReported = DB::table('reports')->where(array(
				'video_id' => $getVideo->id, 'user_id' => Auth::User()->id
			))->first();
		}

		return $getVideos;
	}

	public function getUserVideos($auth = null, $orderBy = null, $uploaded = null, $limit = null) {
		$getVideos = Video::select('videos.id', 'videos.user_id', 'title', 'description', 'publish', 'file_name', 'uploaded', 'total_time', 'views', 
			'category', 'tags', 'report_count', 'recommended', 'videos.deleted_at', 'videos.created_at', 'videos.updated_at',
			DB::raw('(SELECT COUNT(ul.video_id) FROM user_likes ul WHERE ul.video_id = videos.id) AS likes'),
			DB::raw('(SELECT users.channel_name FROM users WHERE users.id = videos.user_id) AS channel_name'))
		->where('videos.user_id', $auth)
		->where('publish', '1')
		->where('deleted_at', NULL);

		if(!empty($uploaded)){
			$getVideos = $getVideos->where('uploaded', $uploaded);
		}
		if(!empty($orderBy)) {
			$getVideos = $getVideos->orderBy($orderBy, 'DESC');
		}

		if(!empty($limit)) {
			$getVideos = $getVideos->take($limit);
		}

		return $getVideos->take($limit)->get();
	}

	public function getSearchVideos($auth = null, $search = null){
		if(empty($search)){
			return App::abort('Error!');
		}

		$search = Video::select('videos.id', 'videos.user_id', 'title', 'description', 'publish', 'file_name', 'uploaded', 'total_time', 'views', 
			'category', 'tags', 'report_count', 'recommended', 'deleted_at', 'videos.created_at', 'videos.updated_at',
			DB::raw('(SELECT COUNT(ul.video_id) FROM user_likes ul WHERE ul.video_id = videos.id) AS likes'))
		->where('videos.user_id', $auth)
		->where('deleted_at', NULL)
		->where('publish', '1')
		->where('uploaded', '1')
		->where('title','LIKE', '%'.$search.'%')->get();
		return $search;
	}

	public function deleteJobAdVideo(){
		$date = new DateTime;
		$date->modify('-30 days');
		$formatted_date = $date->format('Y-m-d H:i:s');

		$videos = Video::where('category', 'LIKE','%Video CV%')
		->where('created_at','<', $formatted_date)
		->orderBy('created_at','ASC')
		->orwhere('category', 'LIKE', '%Job AD')
		->where('created_at','<', $formatted_date)
		->orderBy('created_at','ASC');

		$findVideo = $videos->get(array('videos.id'));
		if(!$findVideo->isEmpty()){
			foreach($findVideo as $playlist_item){
				PlaylistItem::where('video_id', $playlist_item->id)->delete();
			}
		}
		$videos->delete();
		return true;
	}
	public function convertImageToBase64($getImage1,$getImage2,$getImage3){
		$convertImageData_URI_1 = pathinfo($getImage1, PATHINFO_EXTENSION);$saveImage_1 = file_get_contents($getImage1);$convertedImage_1 = 'data:image/' . $convertImageData_URI_1 . ';base64,' . base64_encode($saveImage_1);//Session::put('thumbnail_1',$convertedImage_1);
		$convertImageData_URI_2 = pathinfo($getImage2, PATHINFO_EXTENSION);$saveImage_2 = file_get_contents($getImage2);$convertedImage_2 = 'data:image/' . $convertImageData_URI_2 . ';base64,' . base64_encode($saveImage_2);//Session::put('thumbnail_2',$convertedImage_2);
		$convertImageData_URI_3 = pathinfo($getImage3, PATHINFO_EXTENSION);$saveImage_3 = file_get_contents($getImage3);$convertedImage_3 = 'data:image/' . $convertImageData_URI_3 . ';base64,' . base64_encode($saveImage_3);//Session::put('thumbnail_3',$convertedImage_3);
	}
	public function convertSingleImageToBase64($getImage1){
		$convertImageData_URI_1 = pathinfo($getImage1, PATHINFO_EXTENSION);$saveImage_1 = file_get_contents($getImage1);$convertedImage_1 = 'data:image/' . $convertImageData_URI_1 . ';base64,' . base64_encode($saveImage_1);Session::put('thumbnail_selected',$convertedImage_1);
		return $convertedImage_1;
	}
	public function resizeImage($source, $w, $h, $destination){
		Image::make($source)->resize($w,$h)->encode('jpg', 10)->save($destination);
	}
	public function getTimeDuration($path){
		$ffprobe = $this->ffprobe();$duration = $ffprobe->format($path)->get('duration');
		$vidMinLenght = floor($duration / 60);$vidSecLenght = floor($duration - ($vidMinLenght * 60));$hrs = floor($vidMinLenght / 60);$mins =  floor($vidMinLenght - ($hrs * 60));$secs =   floor($duration - ($vidMinLenght * 60));
		if($secs < 10) { $secs = '0'.$secs; }if($vidSecLenght < 10) { $vidSecLenght = '0'.$vidSecLenght;}if($mins < 10) { $mins = '0'.$mins; }if($hrs < 10) { $hrs = '0'.$hrs; }
		if($duration <= 3600){return $result=$vidMinLenght.':'.$vidSecLenght;}else{return $result = $hrs.':'.$mins.':'.$secs;}
	}
	public function captureImage($videoFile,$destinationPath,$fileName){
		$duration = $this->duration($videoFile);
		$firstSnap = rand(1, $duration);$secondSnap = rand(1, $duration);$thirdSnap = rand(1, $duration);
		$ffmpeg = $this->ffmpeg();
		$video = $ffmpeg->open($videoFile);
		$getImage1 = $destinationPath.DS.$fileName.DS.$fileName.'_thumb1.png';$getImage2 = $destinationPath.DS.$fileName.DS.$fileName.'_thumb2.png';$getImage3 = $destinationPath.DS.$fileName.DS.$fileName.'_thumb3.png';
		$video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($firstSnap))->save($getImage1);$video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($secondSnap))->save($getImage2);$video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($thirdSnap))->save($getImage3);
		$this->convertImageToBase64($getImage1,$getImage2,$getImage3);
	}
	public function duration($path){
		$ffprobe = $this->ffprobe(); 
		$duration = $ffprobe->format($path)->get('duration');
		return $result = floor($duration);
	}
	public function ffmpeg(){
		return $ffmpeg = FFMpeg\FFMpeg::create([
			'ffmpeg.binaries'=>$this->ffmpegPath,
			'ffprobe.binaries'=>$this->ffprobePath,
			'timeout'=>0,
			'ffmpeg.threads'=>12
			]);
	}
	public function ffprobe(){
		return $ffprobe = FFMpeg\FFProbe::create([
			'ffmpeg.binaries'=>$this->ffmpegPath,
			'ffprobe.binaries'=>$this->ffprobePath,
			'timeout'=>0,
			'ffmpeg.threads'=>12
			]);
	}
	public function categorySelected($category, $advice=false, $animatedMusicVideo=false, $animatedVideo=false, $documentaries=false, $forStudents=false, $forTeachers=false, $interviews=false, $jobAd=false, $miscellaneous=false, $music=false, $podcast=false, $qa=false, $videoBlog=false, $videoCV=false){
		$categories = ['advice'=>'Advice','animatedmusicvideo'=> 'Animated Music Video','animatedvideo'=>'Animated Video','documentaries'=> 'Documentaries','forstudents'=>'For Students','forteachers'=>'For Teachers','interviews'=> 'Interviews','jobad'=> 'Job AD','miscellaneous'=> 'Miscellaneous','music'=> 'Music','podcast'=> 'Podcast', 'qa' => 'qa', 'videoblog'=>'Video Blog', 'videocv' =>'Video CV'];
		for($n=0;$n<count($category);$n++){
			if($categories['advice']==$category[$n]) $advice=true;
			if($categories['animatedmusicvideo']==$category[$n]) $animatedMusicVideo=true;
			if($categories['animatedvideo']==$category[$n]) $animatedVideo=true;
			if($categories['documentaries']==$category[$n]) $documentaries=true;
			if($categories['forstudents']==$category[$n]) $forStudents=true;
			if($categories['forteachers']==$category[$n]) $forTeachers=true;
			if($categories['interviews']==$category[$n]) $interviews=true;
			if($categories['jobad']==$category[$n]) $jobAd=true;
			if($categories['miscellaneous']==$category[$n]) $miscellaneous=true;
			if($categories['music']==$category[$n]) $music=true;
			if($categories['podcast']==$category[$n]) $podcast=true;
			if($categories['qa']==$category[$n]) $qa=true;
			if($categories['videoblog']==$category[$n]) $videoBlog=true;
			if($categories['videocv']==$category[$n]) $videoCV=true;
		}
		return array($advice, $animatedMusicVideo, $animatedVideo, $documentaries, $forStudents, $forTeachers, $interviews, $jobAd, $miscellaneous, $music, $podcast, $qa, $videoBlog, $videoCV);
	}
	public function randomChar($length = 11, $result = '') {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';
		$charactersLength = strlen($characters);
		for ($i = 0; $i < $length; $i++) {
			$result .= $characters[rand(0, $charactersLength - 1)];
		}
		return $result;
	}
}
