<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Publisher extends Eloquent implements UserInterface, RemindableInterface {
	use SoftDeletingTrait,UserTrait, RemindableTrait;
	protected $table = 'publishers';
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

	public function savePublisher($adsense_id, $ad_slot_id){

		$role = Auth::User()->role;
		if($role == '4' || $role == '5'){
			return false;
		}elseif($role == '3'){
			$role = '5';
		}else{
			$role = '4';
		}

		$publishers = Publisher::where('user_id', Auth::User()->id)->get();
		if($publishers->isEmpty()){
			$publishers = new Publisher();
		}else{
			$publishers = $publishers->first();
		}
		
		$publishers->user_id = Auth::user()->id;
		$publishers->adsense_id = $adsense_id;
		$publishers->ad_slot_id = $ad_slot_id;
		$publishers->save();

		$users = User::find(Auth::User()->id);
		$users->role = $role;
		$users->save();

		return true;
	}
	public function getAdsenseID($id=null){
		$get = Publisher::where('user_id',$id);
		if($get->count()){
			$get = $get->first();
			return array('adsenseID'=>$get->adsense_id,'adSlotID'=>$get->ad_slot_id);
		}
		return app::abort('404','Page not found.');

	}

	public function cancelPublisher($user_id = null){
		if(!empty($user_id)){
			$publishsers = Publisher::where('user_id', $user_id);
			$publishsers->delete();

			$users = User::find($user_id);

			$role = '1';
			if($users->role == '5'){
				$role = '3';
			}
			$users->role = $role;
			$users->save();

			return true;
		}
		return false;
	}

}