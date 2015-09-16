<?php


class UserPrivacySetting extends Eloquent {
	protected $table = 'user_privacy_settings';
	protected $fillable = ['user_id','email','name', 'address', 'subscriber_count', 'birthday', 'country'];

	public static function ifShowSubscriberCount($user_id){

		$ifShowSubscriberCount = UserPrivacySetting::where('user_id', $user_id)->first();
		$showHideSubscriber = 'show';
		if($ifShowSubscriberCount != NULL){
			if($ifShowSubscriberCount->subscriber_count == '1') $showHideSubscriber = 'show';
			if($ifShowSubscriberCount->subscriber_count == '0') $showHideSubscriber = 'hide';
		}
		return $showHideSubscriber;
	}
	public static function ifShowInformation($user_id){
		$ifShowSubscriberCount = UserPrivacySetting::where('user_id', $user_id)->first();
		if($ifShowSubscriberCount != NULL){
			if($ifShowSubscriberCount->email == '1') $ifShowSubscriberCount->email = 'show';
			if($ifShowSubscriberCount->name == '1') $ifShowSubscriberCount->name = 'show';
			if($ifShowSubscriberCount->address == '1') $ifShowSubscriberCount->address = 'show';
			if($ifShowSubscriberCount->subscriber_count == '1') $ifShowSubscriberCount->subscriber_count = 'show';
			if($ifShowSubscriberCount->birthday == '1') $ifShowSubscriberCount->birthday = 'show';
			if($ifShowSubscriberCount->country == '1') $ifShowSubscriberCount->country = 'show';

			if($ifShowSubscriberCount->email == '0') $ifShowSubscriberCount->email = 'hide';
			if($ifShowSubscriberCount->name == '0') $ifShowSubscriberCount->name = 'hide';
			if($ifShowSubscriberCount->address == '0') $ifShowSubscriberCount->address = 'hide';
			if($ifShowSubscriberCount->subscriber_count == '0') $ifShowSubscriberCount->subscriber_count = 'hide';
			if($ifShowSubscriberCount->birthday == '0') $ifShowSubscriberCount->birthday = 'hide';
			if($ifShowSubscriberCount->country == '0') $ifShowSubscriberCount->country = 'hide';
			return $ifShowSubscriberCount;
		}
		$ifShowSubscriberCount = new UserPrivacySetting;
		$ifShowSubscriberCount->email = 'show';
		$ifShowSubscriberCount->name = 'show';
		$ifShowSubscriberCount->address = 'show';
		$ifShowSubscriberCount->subscriber_count = 'show';
		$ifShowSubscriberCount->birthday = 'show';
		$ifShowSubscriberCount->country = 'show';
		return $ifShowSubscriberCount;
	}
}