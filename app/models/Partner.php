<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Partner extends Eloquent implements UserInterface, RemindableInterface {
	use SoftDeletingTrait,UserTrait, RemindableTrait;
	protected $table = 'partners';
	protected $softDeletes = true;

	public static function getValidation($rules){
		if($rules == 'update'){
			return array(
				'password' => 'required|confirmed',
				'password_confirmation' =>'required',
				'adsense_id' => 'required',
				'ad_slot_id' => 'required|digits:10|numeric');
		}else{
			return array(
				'password' => 'required|confirmed',
				'password_confirmation' =>'required');
		}
	} 

	public static function validateConcern(){
		return array(
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		);
	} 

	public function savePartner($adsense_id, $ad_slot_id){

		$role = Auth::User()->role;
		if($role == '3' || $role == '5'){
			return false;
		}elseif($role == '4'){
			$role = '5';
		}else{
			$role = '3';
		}

		$partners = Partner::where('user_id', Auth::User()->id)->get();
		if($partners->isEmpty()){
			$partners = new Partner();
		}else{
			$partners = $partners->first();
		}
		
		$partners->user_id = Auth::user()->id;
		$partners->adsense_id = $adsense_id;
		$partners->ad_slot_id = $ad_slot_id;
		$partners->save();

		$users = User::find(Auth::User()->id);
		$users->role = $role;
		$users->save();

		return true;
	}

	public function getAdsenseID($user_id = null){
		$adsense['adsense_id'] = 'pub-3138986188138771';	//our adsense id
		$adsense['ad_slot_id'] = 'slot="6814231249"';
		if(!empty($user_id)){
			$user = User::find($user_id);
		}

		if($user->role == '3' || $user->role == '5'){
			$rand = rand(0,9);
			if($rand >= 5){
				$adsense_id = Partner::where('user_id', $user_id)->first();
				$adsense['adsense_id'] = $adsense_id['adsense_id'];
				$adsense['ad_slot_id'] = $adsense_id['ad_slot_id'];
			}
			

		}
		return $adsense;
	}

	public function cancelPartner($user_id = null){
		if(!empty($user_id)){
			$publishsers = Partner::where('user_id', $user_id);
			$publishsers->delete();

			$users = User::find($user_id);

			$role = '1';
			if($users->role == '5'){
				$role = '4';
			}
			$users->role = $role;
			$users->save();

			return true;
		}
		return false;
	}

}