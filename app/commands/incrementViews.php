<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class incrementViews extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'incrementViews';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'To increment TEFLtv views randomly from 2-5 views';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(){
		parent::__construct();
		$this->Video = new Video;
	}


	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$videos = Video::select('videos.id','views','title','reported','uploaded','publish','users.status', 'user_id')
			->where('reported', 0)
			->where('uploaded', 1)
			->where('publish', 1)
			->where('users.status', 1)
			->join('users', 'user_id', '=', 'users.id')
			->get();

		foreach($videos as $video){
			$randomNumber = rand(2,5);
			$video->views += $randomNumber;
			$video->save();

			$this->info($video->title. ' is incremented by '. $randomNumber. ' views');
		}

		$this->info('Incrementing done!');
		
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
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

}
