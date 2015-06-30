<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Partner extends Eloquent implements UserInterface, RemindableInterface {
	use SoftDeletingTrait,UserTrait, RemindableTrait;
	protected $table = 'partners';
	protected $softDeletes = true;

	public function savePartner($adsense_id){

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
		$partners->save();

		$users = User::find(Auth::User()->id);
		$users->role = $role;
		$users->save();

		return true;
	}

	public function getPublisherID($user_id = null){
		$adsense_id = 'pub-3138986188138771';
		if(!empty($user_id)){
			$user = User::find($user_id);
		}

		if($user->role == '3' || $user->role == '5'){
			$adsense_id = Partner::where('user_id', $user_id)->first();
			$adsense_id = $adsense_id['adsense_id'];
		}

		return 'ca-'.$adsense_id;

	}

}