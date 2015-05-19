#!/var/www/projects/tefl-tv-main
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
		 print("\nVideo is currently converting...\n");
		 $videoPath = $this->argument('videoPath');
		 $destinationPath = $this->argument('destinationPath');
		 $filename = $this->argument('filename');
		 print("\n$videoPath\n\n");
		 $this->convertVideoToHigh($videoPath,$destinationPath,$filename);
		 $this->convertVideoToNormal($videoPath,$destinationPath,$filename);
		 $this->convertVideoToLow($videoPath,$destinationPath,$filename);
		 $publish = Video::where('file_name',$fileName)->where('publish',0);
		if($publish->count()){
			$publish = $publish->first();
			$publish->publish = 1;
			$publish->save();
			//File::delete($videoPath);
		 	print("\r \n Conversion Done... \r \n");
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('videoPath', InputArgument::REQUIRED, 'You need a video path to proceed a conversion.'),
			array('destinationPath', InputArgument::REQUIRED, 'You need a destiantion path to proceed a conversion.'),
			array('filename', InputArgument::REQUIRED, 'You need a video file_name to proceed a conversion.'),
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
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

	private function convertVideoToHigh($videoFile, $destinationPath, $fileName){
		$ffmpeg = $this->ffmpeg();
		$video = $ffmpeg->open($videoFile);
		$video->filters()->resize(new FFMpeg\Coordinate\Dimension(1280,720))->synchronize();
		$mp4 = new FFMpeg\Format\Video\CustomVideo();
			$mp4->setKiloBitrate(1000)->setAudioChannels(2)->setAudioKiloBitrate(256);
		$webm = new FFMpeg\Format\Video\WebM();
			$webm->setKiloBitrate(1000)->setAudioChannels(2)->setAudioKiloBitrate(256);
		$ogg = new FFMpeg\Format\Video\Ogg();
			$ogg->setKiloBitrate(1000)->setAudioChannels(2)->setAudioKiloBitrate(256);
		$video
			->save($mp4, $destinationPath.DS.$fileName.DS.$fileName.'_hd.mp4')
			->save($webm, $destinationPath.DS.$fileName.DS.$fileName.'_hd.webm');
		// $mp4->on('progress', function ($video, $mp4, $percentage1) {$percentage1;});
		// $webm->on('progress', function ($video, $webm, $percentage2) {$percentage2;});
		// $ogg->on('progress', function ($video, $ogg, $percentage3) {$percentage3;});
		//return $percentage1+$percentage2+$percentage3;	
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
			->save($webm, $destinationPath.DS.$fileName.DS.$fileName.'_low.webm');	
	}
	private function ffmpeg(){
		return $ffmpeg = FFMpeg\FFMpeg::create([
			'ffmpeg.binaries'=>'/usr/bin/ffmpeg',
			'ffprobe.binaries'=>'/usr/bin/ffprobe',
			'timeout'=>0,
			'ffmpeg.threads'=>12,
			]);
	}

	

}
