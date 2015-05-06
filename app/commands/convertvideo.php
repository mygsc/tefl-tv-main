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
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$video_id = $this->argument('example');
		$videos = Video::find($video_id);
		$videos->uploaded = '1';
		$videos->save();
		print("\r \n Conversion Done \r \n");
	}

	public function createLowQuality($video){
		return "\r \n done creating low quality for ". $video->title;
	}

	public function createNormalQuality($video){
		return "\r \n done creating Normal quality for ". $video->title;
	}

	public function createHighQuality($video){
		return "\r \n done creating High quality for ". $video->title;
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('video_id', InputArgument::REQUIRED, 'You need a video_id to proceed to conversion.'),
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

}
