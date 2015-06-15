<?php

class PartnershipController extends Controller {

	public function __construct(){
		$this->Auth = Auth::user();
	}

	public function getIndex(){
		Session::forget('partnership_token');
		return View::make('partnerships.index');
	}

	public function getPartnerLearnMore(){
		Session::put('url.intended', URL::route('partners.adsense'));
		return View::make('partners.learnmore');
	}

	public function getPublisherLearnMore(){
		Session::put('url.intended', URL::route('publishers.adsense'));
		return View::make('publishers.learnmore');
	}

	public function getVerification(){
		Session::forget('partnership_token');
		return View::make('partnerships.verification');
	}

	public function postVerification(){
		$input = Input::all();

		if ($this->Auth->channel_name == $input['channel_name'] && Hash::check($input['password'],$this->Auth->password))
		{
			$partnershipToken = $this->Auth->channel . rand(0,50);
			$partnershipToken = Crypt::encrypt($partnershipToken);
			Session::put('partnership_token', $partnershipToken);
			return Redirect::intended('/');
		}
		return Redirect::route('partnerships.verification')->with('flash_bad','Invalid credentials')->withInput();
	}


	public function getPartnersAdsense(){
		return View::make('partners.adsense');
	}

	public function getPublisherAdsense(){
		return View::make('publishers.adsense');
	}

	public function getSuccess(){
		return View::make('partnerships.success');
	}

}
