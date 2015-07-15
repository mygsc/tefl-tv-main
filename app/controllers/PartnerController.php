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

	public function getTermsAndConditions(){
		return View::make('partners.termsandconditions');
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
		$ad_slot_id = Input::get('ad_slot_id');
		$validate_adsense_id = $this->User->validateAdsensePublisherID($adsense_id);
		$validate_ad_slot_id = Validator::make(
			array('ad_slot_id' => Input::get('ad_slot_id')),
			array('ad_slot_id' => 'required|digits:10|numeric'));
		if($validate_adsense_id !== true){
			return Redirect::route('partners.register-adsense')->withFlashBad('Invalid Adsense Publisher ID. Please check your inputs');
		}

		if(!$validate_ad_slot_id->passes()){
			return Redirect::route('partners.register-adsense')->withFlashBad('Invalid Ad Slot ID format. Please check your inputs');
		}

		if($this->Partner->savePartner($adsense_id, $ad_slot_id) === true){
			$data = array('adsense_id' => $adsense_id,'channel_name' => $this->Auth->channel_name);
			Mail::send('emails.partners.register', $data, function($message) {
				$getUserInfo = User::where('channel_name', $this->Auth->channel_name)->first();
				$message->to($getUserInfo->email)->subject('TEFLtv Partner account');
			});
			return Redirect::route('partners.success');
		}
		

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

	public function getEditPartner(){
		$credentials = Partner::where('user_id', $this->Auth->id)->first();
		return View::make('partners.edit-partners', compact('credentials'));
	}

	public function postEditPartner(){
		$input = Input::all();
		$input['adsense_id'] = strtolower($input['adsense_id']);
		$validate_adsense_id = $this->User->validateAdsensePublisherID($input['adsense_id']);
		$validator = Validator::make($input, Partner::getValidation('update'));

		if($validate_adsense_id === false){
			return Redirect::route('edit.partners')->withFlashBad('Invalid Adsense Publisher ID. Please check your inputs')->withInput();
		}

		if($validator->fails()){
			return Redirect::route('edit.partners')->withFlashBad('Please check your inputs')->withInput()->withErrors($validator);
		}

		if(Hash::check($input['password'],$this->Auth->password)){
			$users = Partner::where('user_id',$this->Auth->id)->first();
			$users->adsense_id = $input['adsense_id'];
			$users->ad_slot_id = $input['ad_slot_id'];
			$users->save();

			return Redirect::route('edit.partners')->withFlashGood('Your TEFLtv Partner account was updated');
		}

		return Redirect::route('edit.partners')->withFlashBad('Your password was incorrect!');
	}

	public function getCancelPartner(){
		return View::make('partners.cancel');
	}

	public function postCancelPartner(){
		$input = Input::all();
		$validator = Validator::make($input, Publisher::getValidation('cancel'));

		if($validator->fails()){
			return Redirect::route('cancel.partners')->withFlashBad('Please check your inputs')->withErrors($validator);
		}
		if(Hash::check($input['password'],$this->Auth->password)){
			$this->Partner->cancelPartner($this->Auth->id);

			$data = array('url' => route('homes.get.verify', $generateToken),'first_name' => $input['first_name']);
			Mail::send('emails.partners.cancel', $data, function($message) {
				$message->to(Input::get('email'))->subject('TEFLtv Partners account cancellation');
			});
			return Redirect::route('users.earnings.settings')->withFlashWarning('Your TEFLtv Partner account was cancelled');
		}
		return Redirect::route('cancel.partners')->withFlashBad('Password didn\'t mactch please try again')->withErrors($validator);
	}

}
