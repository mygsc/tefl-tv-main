<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Publisher extends Eloquent implements UserInterface, RemindableInterface {
	use SoftDeletingTrait,UserTrait, RemindableTrait;
	protected $table = 'publishers';
	protected $softDeletes = true;

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

}