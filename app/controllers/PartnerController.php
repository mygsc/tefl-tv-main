<?php

class PartnerController extends Controller {
	public function __construct(User $users, Partner $partners){
		$this->Auth = Auth::User();
		$this->User = $users;
		$this->Partner = $partners;
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
		if(Auth::User()->role != '3' && Auth::User()->role != '5'){
			return View::make('partners.register-adsense');
		}
		return Redirect::route('partners.index')->withFlashWarning('You are already a TEFL TV partner');
	}

	public function postRegisterAdsense(){
		$user_id = Auth::User()->id;
		$adsense_id = strtolower(Input::get('adsense'));
		$validator = $this->User->validateAdsensePublisherID($adsense_id);
		if($validator == true){
			if($this->Partner->savePartner($adsense_id) === true){
				return Redirect::route('partners.success');
			}
			$data = array('adsense_id' => $adsense_id,'channel_name' => Auth::User()->channel_name);
			Mail::send('emails.partners.register', $data, function($message) {
				$message->to(Auth::User()->email)->subject('You just became a TEFL TV partner');
			});
		}
		return Redirect::route('partners.register-adsense')->withFlashBad('Invalid Adsense Publisher ID. Please check your inputs');

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
			return Redirect::route('partners.register-adsense');
		}
		return Redirect::route('partners.verification')->with('flash_bad','Invalid credentials')->withInput();
	}

}
