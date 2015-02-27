<?php

class HomeController extends BaseController {

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
	

}
