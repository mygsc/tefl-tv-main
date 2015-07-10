<?php

class PublisherController extends Controller {

	public function __construct(User $users, Publisher $publishers){
		$this->Auth = Auth::User();
		$this->User = $users;
		$this->Publisher = $publishers;
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
		if(Auth::User()->role != '4' && Auth::User()->role != '5'){
			return View::make('publishers.register-adsense');
		}
		return Redirect::route('publishers.index')->withFlashWarning('You are already a TEFL TV publisher');
	}

	public function postRegisterAdsense(){
		$user_id = Auth::User()->id;
		$adsense_id = strtolower(Input::get('adsense'));
		$ad_slot_id = Input::get('ad_slot_id');
		$validate_adsense_id = $this->User->validateAdsensePublisherID($adsense_id);
		$validate_ad_slot_id = Validator::make(
			array('ad_slot_id' => Input::get('ad_slot_id')),
			array('ad_slot_id' => 'required|digits:10|numeric'));
		if($validate_adsense_id !== true){
			return Redirect::route('publishers.register-adsense')->withFlashBad('Invalid Adsense Publisher ID. Please check your inputs');
		}

		if(!$validate_ad_slot_id->passes()){
			return Redirect::route('publishers.register-adsense')->withFlashBad('Invalid Ad Slot ID format. Please check your inputs');
		}

		if($this->Publisher->savePublisher($adsense_id, $ad_slot_id) === true){
			$data = array('adsense_id' => $adsense_id,'channel_name' => Auth::User()->channel_name);
				// Mail::send('emails.publishers.register', $data, function($message) {
				// 	$message->to(Auth::User()->email)->subject('You just became a TEFL TV partner');
				// });
			return Redirect::route('publishers.success');
		}
		

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
			return Redirect::route('publishers.register-adsense');
		}
		return Redirect::route('publishers.verification')->with('flash_bad','Invalid credentials')->withInput();
	}

	public function getEditPublisher(){
		return View::make('publishers.edit-publisher');
	}

	public function getDeactivatePublisher(){
		return View::make('publishers.deactivate');
	}

}
