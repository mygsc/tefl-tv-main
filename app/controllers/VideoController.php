<?php

class VideoController extends BaseController {
	protected $user;
	protected $url;
	public function __construct(Video $videos, User $users, Playlist $playlists,Subscribe $subscribers){
		$this->Subscribe = $subscribers;
		$this->Playlist = $playlists;
		$this->User = $users;
		$this->Video = $videos;
		$this->Auth = Auth::User();
		$this->url = URL::full();
		define('DS', DIRECTORY_SEPARATOR); 
	}
	public function getUpload(){
		if(Auth::check()){return View::make('users.upload');}
		return Redirect::route('homes.signin')->withFlashWarning('Please sign in to upload video.');
	}
	public function postUpload($filenameLenght = 11){
		$fileName = str_random($filenameLenght);$input = Input::all();
		$userFolderName = $this->Auth->id .'-'.$this->Auth->channel_name;
		$validator = Validator::make($input,Video::$video_rules); 
		$checkFilenameExist = Video::where('file_name', '=', $fileName); 
		if($checkFilenameExist->count()){$fileName = str_random($filenameLenght++);}
		if($validator->passes()){
			$input['user_id'] = $this->Auth->id;
			$create = Video::create($input);
			$latest_id = $create->id;
			Session::put('fileName', $fileName);
			$getVidDuration = $this->getTimeDuration($input['video']);
			$db_filename = Video::find($latest_id);
			$db_filename->file_name = $fileName;
			$db_filename->title = 'Untitled';
			$db_filename->total_time = $getVidDuration;
			$db_filename->tags = null;
			$db_filename->publish = 0;
			if($db_filename->save()){
				$destinationPath = public_path('videos'.DS. $userFolderName);
				$videoFolderPath = $destinationPath.DS.$fileName;
				if(!file_exists($destinationPath)){mkdir($destinationPath);}
				if(!file_exists($videoFolderPath)){mkdir($videoFolderPath);}

				// $this->convertVideoToHigh($input['video'],$destinationPath,$fileName);
				// $this->convertVideoToNormal($input['video'],$destinationPath,$fileName);
				// $this->convertVideoToLow($input['video'],$destinationPath,$fileName);
				$this->captureImage($input['video'], $destinationPath, $fileName);
				$ext = $input['video']->getClientOriginalExtension();
				$input['video']->move($destinationPath.DS.$fileName.DS, 'original.'.$ext);
				$videoPath = $destinationPath.DS.$fileName.DS.$fileName.'.'.$ext;
				return Response::json([
					'vidid'=>Crypt::encrypt($latest_id),
					'file'=>$fileName, 
					'thumb1' => Session::get('thumbnail_1'),
					'thumb2' => Session::get('thumbnail_2'),
					'thumb3' => Session::get('thumbnail_3'),
					'videoPath' => $videoPath,
					'destinationPath' => $destinationPath,
					'ext' => $ext,
					]);  
			}
		}
		return Redirect::route('get.upload')
		->withInput()
		->withErrors($validator)
		->with('message', 'There were validation errors.');
	}
	public function getconvertVideo($fileName, $ext){
		$filename = Video::where('file_name',$fileName)->where('publish',0)->first();
		if($filename->count()){
			$id = $filename->user_id;
			$user = User::find($id);
			$videoPath = public_path('videos'.DS.$user->id.'-'.$user->channel_name.DS.$fileName.DS.'original'.'.'.$ext);
			$destinationPath = public_path('videos'.DS.$user->id.'-'.$user->channel_name.DS);
			shell_exec("php artisan ConvertVideo ". $videoPath." " .$destinationPath." ".  $fileName);
			return Response::json(['response'=>'Done converting...']);
		}
		return app::abort(404,'Page not found.');
	}
	private function captureImage($videoFile,$destinationPath,$fileName){
		$duration = $this->duration($videoFile);
		$firstSnap = rand(1, $duration);$secondSnap = rand(1, $duration);$thirdSnap = rand(1, $duration);
		$ffmpeg = FFMpeg\FFMpeg::create();$video = $ffmpeg->open($videoFile);$getImage1 = $destinationPath.DS.$fileName.DS.$fileName.'_thumb1.png';$getImage2 = $destinationPath.DS.$fileName.DS.$fileName.'_thumb2.png';$getImage3 = $destinationPath.DS.$fileName.DS.$fileName.'_thumb3.png';
		$video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($firstSnap))->save($getImage1);$video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($secondSnap))->save($getImage2);$video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($thirdSnap))->save($getImage3);
  	  	$convertImageData_URI_1 = pathinfo($getImage1, PATHINFO_EXTENSION);$saveImage_1 = file_get_contents($getImage1);$convertedImage_1 = 'data:image/' . $convertImageData_URI_1 . ';base64,' . base64_encode($saveImage_1);Session::put('thumbnail_1',$convertedImage_1);
		$convertImageData_URI_2 = pathinfo($getImage2, PATHINFO_EXTENSION);$saveImage_2 = file_get_contents($getImage2);$convertedImage_2 = 'data:image/' . $convertImageData_URI_2 . ';base64,' . base64_encode($saveImage_2);Session::put('thumbnail_2',$convertedImage_2);
		$convertImageData_URI_3 = pathinfo($getImage3, PATHINFO_EXTENSION);$saveImage_3 = file_get_contents($getImage3);$convertedImage_3 = 'data:image/' . $convertImageData_URI_3 . ';base64,' . base64_encode($saveImage_3);Session::put('thumbnail_3',$convertedImage_3);
	}
	private function convertVideoToHigh($videoFile, $destinationPath, $fileName, $percentage1=0,$percentage2=0,$percentage3=0){
		$ffmpeg = $this->ffmpeg();
		$video = $ffmpeg->open($videoFile);
		$video->filters()->resize(new FFMpeg\Coordinate\Dimension(1280,720))->synchronize();
		$mp4 = new FFMpeg\Format\Video\CustomVideo();
			$mp4->setKiloBitrate(1000)->setAudioChannels(2)->setAudioKiloBitrate(256);
		$webm = new FFMpeg\Format\Video\WebM();
			$webm->setKiloBitrate(1000)->setAudioChannels(2)->setAudioKiloBitrate(256);
		$ogg = new FFMpeg\Format\Video\Ogg();
			$ogg->setKiloBitrate(1000)->setAudioChannels(2)->setAudioKiloBitrate(256);
		// $mp4
		// 	->on('progress', function ($video, $mp4, $percentage1) {$percentage1;});
		// $webm
		// 	->on('progress', function ($video, $webm, $percentage2) {$percentage2;});
		// $ogg
		// 	->on('progress', function ($video, $ogg, $percentage3) {$percentage3;});
		$video
			->save($mp4, $destinationPath.DS.$fileName.DS.$fileName.'_hd.mp4')
			->save($webm, $destinationPath.DS.$fileName.DS.$fileName.'_hd.webm')
			->save($ogg, $destinationPath.DS.$fileName.DS.$fileName.'_hd.ogg');
		//return Response::json(['percentloaded'=>$percentage1+$percentage2+$percentage3]);	
	}
	private function convertVideoToNormal($videoFile, $destinationPath, $fileName){
		$ffmpeg = $this->ffmpeg();
		$video = $ffmpeg->open($videoFile);
		$video->filters()->resize(new FFMpeg\Coordinate\Dimension(640,360))->synchronize();
		$mp4 = new FFMpeg\Format\Video\CustomVideo();$mp4->setKiloBitrate(400)->setAudioChannels(2)->setAudioKiloBitrate(256);
		$ogg = new FFMpeg\Format\Video\Ogg();$ogg->setKiloBitrate(400)->setAudioChannels(2)->setAudioKiloBitrate(256);
	    $webm = new FFMpeg\Format\Video\WebM();$webm->setKiloBitrate(400)->setAudioChannels(2)->setAudioKiloBitrate(256);
		$video
			->save($mp4, $destinationPath.DS.$fileName.DS.$fileName.'.mp4')
			->save($ogg, $destinationPath.DS.$fileName.DS.$fileName.'.ogg')
			->save($webm, $destinationPath.DS.$fileName.DS.$fileName.'.webm');	
	}
	private function convertVideoToLow($videoFile, $destinationPath, $fileName){
		$ffmpeg = $this->ffmpeg();$video = $ffmpeg->open($videoFile);
		$video->filters()->resize(new FFMpeg\Coordinate\Dimension(320,240))->synchronize();
		$mp4 = new FFMpeg\Format\Video\CustomVideo();$mp4->setKiloBitrate(200)->setAudioChannels(2)->setAudioKiloBitrate(256);
		$ogg = new FFMpeg\Format\Video\Ogg();$ogg->setKiloBitrate(200)->setAudioChannels(2)->setAudioKiloBitrate(256);
	    $webm = new FFMpeg\Format\Video\WebM();$webm->setKiloBitrate(200)->setAudioChannels(2)->setAudioKiloBitrate(256);
		$video
			->save($mp4, $destinationPath.DS.$fileName.DS.$fileName.'_low.mp4')
			->save($ogg, $destinationPath.DS.$fileName.DS.$fileName.'_low.ogg')
			->save($webm, $destinationPath.DS.$fileName.DS.$fileName.'_low.webm');	
	}
	private function ffmpeg(){
		if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){
    		return $ffmpeg = FFMpeg\FFMpeg::create([
			'ffmpeg.binaries'=>'C:\xampp\ffmpeg\bin\ffmpeg',
			'ffprobe.binaries'=>'C:\xampp\ffmpeg\bin\ffprobe',
			'timeout'=>0,
			'ffmpeg.threads'=>12,
			]);
		} 
		return $ffmpeg = FFMpeg\FFMpeg::create([
			'ffmpeg.binaries'=>'/usr/bin/ffmpeg',
			'ffprobe.binaries'=>'/usr/bin/ffprobe',
			'timeout'=>0,
			'ffmpeg.threads'=>12,
			]);
	}
	// private function convertToMP4($videoFile, $destinationPath,$fileName, $w=320, $h = 240, $kbrate=200){
	// 	$ffmpeg = $this->ffmpeg();$video = $ffmpeg->open($videoFile);
	// 	for($n=1; $n<=3; $n++){
	// 		$w = $w * $n;$h = $h * $n;
	// 		$video->filters()->resize(new FFMpeg\Coordinate\Dimension($w,$h))->synchronize();
	// 		$format = new FFMpeg\Format\Video\CustomVideo();
	// 		$format
	// 		    -> setKiloBitrate($kbrate)
	// 		    -> setAudioChannels(2)
	// 		    -> setAudioKiloBitrate(256);
	// 		$video->save($format, $destinationPath.DS.$fileName.DS.$fileName.$n.'.mp4');
	// 		$kbrate = $kbrate * $n;
	// 		if($kbrate==400){$kbrate * $n - 200;}
	// 	}
	// }
	private function getTimeDuration($path){
		$ffprobe = FFMpeg\FFProbe::create();$duration = $ffprobe->format($path)->get('duration');
		$vidMinLenght = floor($duration / 60);$vidSecLenght = floor($duration - ($vidMinLenght * 60));$hrs = floor($vidMinLenght / 60);$mins =  floor($vidMinLenght - ($hrs * 60));$secs =   floor($duration - ($vidMinLenght * 60));
		if($secs < 10) { $secs = '0'.$secs; }if($vidSecLenght < 10) { $vidSecLenght = '0'.$vidSecLenght;}if($mins < 10) { $mins = '0'.$mins; }if($hrs < 10) { $hrs = '0'.$hrs; }
		if($duration <= 3600){return $result=$vidMinLenght.':'.$vidSecLenght;}else{return $result = $hrs.':'.$mins.':'.$secs;}
	}
	private function duration($path){
		$ffprobe = FFMpeg\FFProbe::create(); 
		$duration = $ffprobe->format($path)->get('duration');
		return $result = floor($duration);
	}
	public function getCancelUploadVideo(){
		$fileName = Session::get('fileName');
		if(empty($fileName)){return app::abort('404','Page not found.');}
		$userFolderName = $this->Auth->id .'-'.$this->Auth->channel_name;
		$destinationPath = public_path('videos'.DS. $userFolderName.DS);
		if(file_exists($destinationPath.$fileName)){
			$this->deleteDirectory($destinationPath.$fileName);
			Video::where('file_name', $fileName)->delete();
			return Redirect::route('get.upload', '=cancelled')->withFlashGood('Video uploading has been cancelled.');
		}
	}
	public function deleteDirectory($dirname) {
		if (is_dir($dirname))
			$dir_handle = opendir($dirname);
		if (!$dir_handle)
			return false;
		while($file = readdir($dir_handle)) {
			if ($file != "." && $file != "..") {
				if (!is_dir($dirname.DS.$file))
					unlink($dirname.DS.$file);
				else
					deleteDirectory($dirname.DS.$file);
			}
		}
		closedir($dir_handle);
		rmdir($dirname);
		return true;
	}
	public function getAddDescription($filename = null){
		$videos = Video::where('file_name','=',$filename)->get();
		return View::make('users.addDescription',compact('videos'));
	}
	public function postAddDescription($id){
		$id = Crypt::decrypt($id);  
		$videos = Video::where('id','=',$id)->get();
		$fileName = $videos[0]['file_name'];
		$input = Input::all(); 
		$validator = Validator::make($input,Video::$addDescription);
		$userFolderName = $this->Auth->id .'-'.$this->Auth->channel_name;
		$destinationPath =  public_path('videos'.DS. $userFolderName.DS.$fileName.DS);
		$selectedCategory = null;
		if($validator->passes()){
			if(Input::hasFile('poster')){
				$this->imageResize($input['poster'], 600, 338, $destinationPath.$fileName.'_600x338.jpg');
				$this->imageResize($input['poster'], 240, 141, $destinationPath.$fileName.'.jpg');
			}
			if(strlen($input['thumbnail']) > 1){ //has selected thumbnail 
				$getImage = $input['thumbnail'];
				$getImage = str_replace('data:image/png;base64,', '', $getImage);
				$getImage = str_replace(' ', '+', $getImage);
				$decodeImage = base64_decode($getImage);
				$saveImage = $destinationPath.$fileName.'.jpg';
				$success = file_put_contents($saveImage, $decodeImage);
				$this->imageResize($saveImage, 600, 338, $destinationPath.$fileName.'_600x338.jpg');
				$this->imageResize($saveImage, 240, 141, $destinationPath.$fileName.'.jpg');	

			}		
			$tags = explode(',',Input::get('tags'));
			foreach($tags as $tag){
				if($tag != null){
					$newTags[] = strtolower($tag);
				}
			}
			$uniqueTag = array_unique($newTags);$implodeTag = implode(',',$uniqueTag);$video = Video::find($id);$publish = $video->publish;
			if(Input::has('cat')){$selectedCategory = implode(',',Input::get('cat'));}
			if($publish == 0){
				$video->title = $input['title'];
				$video->description = $input['description'];
				$video->category = $selectedCategory;
				$video->tags =  $implodeTag;
				$video->publish = $input['publish'];
				$video->save();
				for($n=1;$n<=3;$n++){
					File::delete($destinationPath.$fileName.'_thumb'.$n.'.png');
				}
				return Redirect::route('users.myvideos','upload=success&token='.$fileName)->withFlashGood('New video has been uploaded successfully.');
			}
			return Redirect::route('get.upload');					
		}
		
		return Redirect::route('get.addDescription',$fileName)
		->withInput()
		->withErrors($validator)
		->with('message', 'There were validation errors.');
	}
	public function imageResize($image, $w, $h, $destination){
		Image::make($image)->resize($w,$h)->encode('jpg', 10)->save($destination);
	}

	public function getViewVideoPlayer(){
		$filename = str_replace('http://localhost:8000/watch?v=', '', $this->url);
		return $filename;
		return View::make('videoplayer');
	}

	public function postRandom(){
		$input = Input::all();

		return Redirect::route('homes.random', $input['option'])->withInput();
	}


	public function postSearchVideos(){
		$input = Input::all();
		return Redirect::route('homes.searchresult', array($input['type'].'?'.$input['search']));
	}

	public function getSearchResult(){
		$type = preg_replace('/[^A-Za-z0-9\-]/', ' ',Input::get('type'));
		$search = preg_replace('/[^A-Za-z0-9\-]/', ' ',Input::get('search'));
		$searchResults = $this->Video->searchVideos($search);
		//return $searchResults;

		//return (microtime(true) - LARAVEL_START);
		return View::make('homes.searchresult', compact(array('type','searchResults', 'search')));
	}

	public function counter($id){
		$id = Crypt::decrypt($id);
		$video = Video::where('id','=',$id)->first();
		$video->views = $video->views+1;
		$video->update();
	}

	public function fileExist($path, $filename, $ext = null, $user_id = null, $channel_name = null, $callback_message = null){
		$userFolderName = $user_id. '-'. $channel_name;
		$file = $filename .'.'. $ext;
		$path = 'public' .DS. $path .DS. $userFolderName .DS. $filename. $file;
		if(file_exists($path)){
			return true;
		} 
		return $path;
	}

	public function getEmbedVideo($filename){
		$vidFilename = Video::where('file_name','=',$filename);
		if($vidFilename->count()){
			$vidFilename = $vidFilename->first();
			$vidOwner = User::find($vidFilename->user_id);
			return View::make('homes.embedvideo', compact('vidFilename','vidOwner'));
		}
		return app::abort(404, 'Page not available');
	}
}
