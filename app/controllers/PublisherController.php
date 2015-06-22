<?php

class PublisherController extends Controller {
	
	public function getIndex(){
		Session::put('url.intended', URL::route('publishers.register-adsense'));
		return View::make('publishers.index');
	}

	public function getLearnMore(){
		return View::make('publishers.learnmore');
	}

	public function getPrivacy(){
		return View::make('publishers.privacy');
	}

	public function getSupport(){
		return View::make('publishers.support');
	}

	public function getRegisterAdsense(){
		return View::make('publishers.register-adsense');
	}

	public function getSuccess(){
		Session::forget('url');
		Session::forget('partnership_token');
		return View::make('publishers.success');
	}
}
