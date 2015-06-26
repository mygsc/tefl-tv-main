<?php

class PublisherController extends Controller {

	public function __construct(){
		$this->Auth = Auth::User();
	}
	
	public function getIndex(){
		return View::make('publishers.index');
	}

	public function getLearnMore(){
		return View::make('publishers.learnmore');
	}

	public function getFaqs(){
		return View::make('publishers.faqs');
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
		Session::forget('partnership_token');
		return View::make('publishers.success');
	}

		public function getVerification(){
		Session::forget('partnership_token');
		return View::make('publishers.verification');
	}

	public function postVerification(){
		$input = Input::all();
		if (Hash::check($input['password'],$this->Auth->password))
		{
			$partnershipToken = $this->Auth->channel . rand(0,50);
			$partnershipToken = Crypt::encrypt($partnershipToken);
			Session::put('partnership_token', $partnershipToken);
			return Redirect::route('publishers.success');
		}
		return Redirect::route('publishers.verification')->with('flash_bad','Invalid credentials')->withInput();
	}

}
