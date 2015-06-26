<?php

class PartnerController extends Controller {
	public function __construct(){
		$this->Auth = Auth::User();
	}
	
	
	public function getIndex(){
		return View::make('partners.index');
	}

	public function getLearnMore(){
		return View::make('partners.learnmore');
	}

	public function getFaqs(){
		return View::make('partners.faqs');
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
		Session::forget('partnership_token');
		//return Session::all();
		return View::make('partners.success');
	}

	public function getVerification(){
		Session::forget('partnership_token');
		return View::make('partners.verification');
	}

	public function postVerification(){
		$input = Input::all();
		if (Hash::check($input['password'],$this->Auth->password))
		{
			$partnershipToken = $this->Auth->channel . rand(0,50);
			$partnershipToken = Crypt::encrypt($partnershipToken);
			Session::put('partnership_token', $partnershipToken);
			return Redirect::route('partners.success');
		}
		return Redirect::route('partners.verification')->with('flash_bad','Invalid credentials')->withInput();
	}
}
