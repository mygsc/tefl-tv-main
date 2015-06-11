<?php

class PartnershipController extends Controller {

	public function __construct(){
		$this->Auth = Auth::user();
	}

	public function index(){
		return View::make('partnerships.index');
	}

	public function partnerLearnMore(){
		return View::make('partners.learnmore');
	}

	public function publisherLearnMore(){
		return View::make('publishers.learnmore');
	}

	public function verification(){
		return View::make('partnerships.verification');
	}

	public function postVerification(){
		$input = Input::all();
		return $input;
	}

	public function account(){

	}

	public function apply(){

	}

}
