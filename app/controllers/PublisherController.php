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

	public function getTermsAndConditions(){
		return View::make('publishers.termsandconditions');
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
			$data = array('adsense_id' => $adsense_id,'channel_name' => $this->Auth->channel_name);
			Mail::send('emails.publishers.register', $data, function($message) {
				$getUserInfo = User::where('channel_name', $this->Auth->channel_name)->first();
				$message->to($getUserInfo->email)->subject('TEFLtv Publisher account');
			});
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
		if (Hash::check($input['password'],$this->Auth->password)){
			$partnershipToken = $this->Auth->channel . rand(0,50);
			$partnershipToken = Crypt::encrypt($partnershipToken);
			Session::put('partnership_token', $partnershipToken);
			return Redirect::route('publishers.register-adsense');
		}
		return Redirect::route('publishers.verification')->with('flash_bad','Invalid credentials')->withInput();
	}

	public function getEditPublisher(){
		if(Auth::User()->role == '4' || Auth::User()->role == '5'){
			$credentials = Publisher::where('user_id', $this->Auth->id)->first();
			return View::make('publishers.edit-publisher', compact('credentials'));
		}
		return Redirect::route('homes')->withFlashWarning('page not found');
	}

	public function postEditPublisher(){
		$input = Input::all();
		$input['adsense_id'] = strtolower($input['adsense_id']);
		$validate_adsense_id = $this->User->validateAdsensePublisherID($input['adsense_id']);
		$validator = Validator::make($input, Publisher::getValidation('update'));

		if($validate_adsense_id === false){
			return Redirect::route('edit.publishers')->withFlashBad('Invalid Adsense Publisher ID. Please check your inputs')->withInput();
		}
		if($validator->fails()){
			return Redirect::route('edit.publishers')->withFlashBad('Please check your inputs')->withInput()->withErrors($validator);
		}

		if(Hash::check($input['password'],$this->Auth->password)){
			$users = Publisher::where('user_id',$this->Auth->id)->first();
			$users->adsense_id = $input['adsense_id'];
			$users->ad_slot_id = $input['ad_slot_id'];
			$users->save();

			return Redirect::route('edit.publishers')->withFlashGood('Your TEFLtv Publisher account was updated');
		}
		return Redirect::route('edit.publishers')->withFlashBad('Your password was incorrect!');
	}

	public function getCancelPublisher(){
		if(Auth::User()->role == '4' || Auth::User()->role == '5'){
			return View::make('publishers.cancel');
			
		}
		return Redirect::route('homes')->withFlashWarning('page not found');
	}

	public function postCancelPublisher(){
		$input = Input::all();
		$validator = Validator::make($input, Publisher::getValidation('cancel'));

		if($validator->fails()){
			return Redirect::route('cancel.publishers')->withFlashBad('Please check your inputs')->withErrors($validator);
		}
		if(Hash::check($input['password'],$this->Auth->password)){
			$this->Publisher->cancelPublisher($this->Auth->id);

			$data = array('url' => route('homes.get.verify', $generateToken),'first_name' => $input['first_name']);
			Mail::send('emails.publishers.cancel', $data, function($message) {
				$message->to(Input::get('email'))->subject('TEFLtv Publishers account cancellation');
			});

			return Redirect::route('users.earnings.settings')->withFlashWarning('Your TEFLtv Publisher account was cancelled');
		}
		return Redirect::route('cancel.publishers')->withFlashBad('Password didn\'t mactch please try again')->withErrors($validator);
	}
}
