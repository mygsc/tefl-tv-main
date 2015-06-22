<?php

class PartnerController extends Controller {
	
	public function getIndex(){
		Session::put('url.intended', URL::route('partners.register-adsense'));
		return View::make('partners.index');
	}

	public function getLearnMore(){
		return View::make('partners.learnmore');
	}

	public function getPrivacy(){
		return View::make('partners.privacy');
	}

	public function getSupport(){
		return View::make('partners.support');
	}

	public function getRegisterAdsense(){
		return View::make('partners.register-adsense');
	}

	public function getSuccess(){
		Session::forget('url');
		Session::forget('partnership_token');
		//return Session::all();
		return View::make('partners.success');
	}
}
