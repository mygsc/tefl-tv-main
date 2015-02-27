<?php

class VideoController extends Controller {
	public function getViewVideoPlayer(){
		return View::make('videoplayer');
	}
}
