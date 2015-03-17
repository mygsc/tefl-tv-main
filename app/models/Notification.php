<?php

class Notification extends Eloquent {
	use SoftDeletingTrait;
	protected $table = 'notifications';

	public function users(){
		return $this->belongsTo('User');
	}

	public function constructNotificationMessage($user_id, $notifier_id, $type, $routes = null, $callback = null){
		if(!empty($user_id) || !empty($notifier_id) || !empty($type)){
			$notifierInfo = User::find($notifier_id);
			$notifierLink = '<a href="channels/{{$notifierInfo->channel_name}}">'. $notifierInfo->channel_name.'</a>';

			if($type == 'subscribed'){
				$message = 'has subscribe to your channel';
			}elseif($type == 'mentioned'){
				$message = 'has mentioned you in a <a href="'.$routes.'">comment</a>';
			}elseif($type == 'liked'){
				$message = 'has liked your <a href="'.$routes.'">comment</a>';
			}elseif($type == 'replied'){
				$message = 'has replied to your <a href="'.$routes.'">comment</a>';
			}elseif($type == 'upload'){
				$message = 'has uploaded new <a href="'.$routes.'">comment</a>';
			}elseif($type == 'comment'){
				$message = 'has added a comment to your <a href="{{$routes}}">video</a>';
			}else{
				return false;
			}

			$completeNotification = $notifierLink .' '. $message;
			if($this->insertNotifications($user_id, $completeNotification) === true){
				return true;
			}
		}
		return false;

	}

	public function insertNotifications($user_id, $notificationMessage){
		if(!empty($user_id) || !empty($completeNotification)){
			$notification =  new Notification();
			$notification->user_id = $user_id;
			$notification->notification = $notificationMessage;
			$notification->save();

			return true;
		}
		return false;
	}

	public function getNotifications($id = null, $paginate = null){
		if(!empty($id)){
			$result = Notification::whereUserId($id)
			->whereDeletedAt(null)
			->OrderBy('created_at', 'DESC')
			->simplePaginate($paginate);
			return $result;
		}
		return false;
	}

	public function setStatus(){

	}

	public function deleteNotification(){

	}
}