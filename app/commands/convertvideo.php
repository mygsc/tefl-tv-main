<?php
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
class convertvideo extends Command {
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'ConvertVideo';
	protected $ffmpegPath = '/root/bin/ffmpeg';
	protected $ffprobePath = '/root/bin/ffprobe';
	/**  
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Convert video to low, normal and high.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		define('DS', DIRECTORY_SEPARATOR); 
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$routes = route('homes.watch-video', '1');
		echo $routes;
	
		 print("\nVideo is currently converting...\n");
		 $videos = $this->findVideoNotConverted();
		 if($videos !== false){
		 	$this->convertVideo($videos);
		 }
		 // $videoPath = $this->argument('videoPath');
		 // $destinationPath = $this->argument('destinationPath');
		 // $filename = $this->argument('filename');
		 // print("\n$videoPath\n\n");
		 // $this->convertVideoToHigh($videoPath,$destinationPath,$filename);
		 // $this->convertVideoToNormal($videoPath,$destinationPath,$filename);
		 // $this->convertVideoToLow($videoPath,$destinationPath,$filename);
		//  $publish = Video::where('file_name',$filename);
		// if($publish->count()){
		// 	$publish = $publish->first();
		// 	$publish->uploaded = 1;
		// 	$publish->save();
		// 	//File::delete($videoPath);
		// }
		print("\r \n Conversion Done... \r \n");
	}

	public function findVideoNotConverted(){

		$videos = Video::select('videos.id', 'videos.user_id','users.channel_name','videos.uploaded', 'videos.extension', 'videos.file_name', 'videos.created_at')
		->where('uploaded', '0')
		->where('report_count', '<', 5)
		->join('users', 'videos.user_id', '=','users.id')
		->take(1)
		->orderBy('created_at', 'asc')
		->get();
		if($videos->isEmpty()){
			return false;
		}
		return $videos->first();
	}

	public function convertVideo($videos = null){
		if(!empty($videos)){
			$filename = $videos->file_name;
			$folderName = $videos->user_id. '-'. $videos->channel_name;
			$destinationPath = public_path('videos/'. $folderName .DS. $filename);
			$source = $destinationPath . DS. 'original' .'.'. $videos->extension;
			$this->convertVideoToHigh($source, $destinationPath, $filename);
			$this->convertVideoToNormal($source, $destinationPath, $filename);
			$this->convertVideoToLow($source, $destinationPath, $filename);
			$checkFilename = Video::where('file_name',$filename)->first();
			if($checkFilename->count()){
				$checkFilename->uploaded = 1;
				$checkFilename->save();
				
				$routes = route('homes.watch-video', $filename);
				$message = 'your <a href="'.$routes.'">Video</a> is ready';
				$notification = new Notification();
				$notification->user_id = $videos->user_id;
				$notification->notification = $message;
				$notification->save();
			}

			return true;
		}
		return false;
	}
	
	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(

		);
	}
	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			//array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}
	public function convertVideoToHigh($videoFile, $destinationPath, $fileName){
		$ffmpeg = $this->ffmpeg();
		$video = $ffmpeg->open($videoFile);
		$video->filters()->resize(new FFMpeg\Coordinate\Dimension(1280,720))->synchronize();
		$mp4 = new FFMpeg\Format\Video\CustomVideo();
			$mp4->setKiloBitrate(1000)->setAudioChannels(2)->setAudioKiloBitrate(256);
		$webm = new FFMpeg\Format\Video\WebM();
			$webm->setKiloBitrate(1000)->setAudioChannels(2)->setAudioKiloBitrate(256);
		$video->save($mp4, $destinationPath.DS.$fileName.'_hd.mp4')
			->save($webm, $destinationPath.DS.$fileName.'_hd.webm');
	}
	public function convertVideoToNormal($videoFile, $destinationPath, $fileName){
		$ffmpeg = $this->ffmpeg();
		$video = $ffmpeg->open($videoFile);
		$video->filters()->resize(new FFMpeg\Coordinate\Dimension(640,360))->synchronize();
		$mp4 = new FFMpeg\Format\Video\CustomVideo();$mp4->setKiloBitrate(400)->setAudioChannels(2)->setAudioKiloBitrate(256);
		$webm = new FFMpeg\Format\Video\WebM();$webm->setKiloBitrate(400)->setAudioChannels(2)->setAudioKiloBitrate(256);
		$video->save($mp4, $destinationPath.DS.$fileName.'.mp4')
			->save($webm, $destinationPath.DS.$fileName.'.webm');	
	}
	public function convertVideoToLow($videoFile, $destinationPath, $fileName){
		$ffmpeg = $this->ffmpeg();$video = $ffmpeg->open($videoFile);
		$video->filters()->resize(new FFMpeg\Coordinate\Dimension(320,240))->synchronize();
		$mp4 = new FFMpeg\Format\Video\CustomVideo();$mp4->setKiloBitrate(200)->setAudioChannels(2)->setAudioKiloBitrate(256);
		$webm = new FFMpeg\Format\Video\WebM();$webm->setKiloBitrate(200)->setAudioChannels(2)->setAudioKiloBitrate(256);
		$video->save($mp4, $destinationPath.DS.$fileName.'_low.mp4')
			->save($webm, $destinationPath.DS.$fileName.'_low.webm');	
	}
	public function ffmpeg(){
		return $ffmpeg = FFMpeg\FFMpeg::create([
			'ffmpeg.binaries'=>$this->ffmpegPath,
			'ffprobe.binaries'=>$this->ffprobePath,
			'timeout'=>0,
			'ffmpeg.threads'=>12
			]);
	}

	

}