<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex() {
	
		return View::make('index');
	}

	public function getAboutUs() {

		return View::make('aboutus');
	}

	public function getPrivacy() {

		return View::make('privacy');
	}

	public function getTermsAndConditions() {

		return View::make('termsandconditions');
	}

	public function getAdvertisements() {

		return View::make('advertisements');
	}

	public function getCopyright() {

		return View::make('copyright');
	}
	

}
