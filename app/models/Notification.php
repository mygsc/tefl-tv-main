<?php

class Notification extends Eloquent {
	use SoftDeletingTrait;
	protected $table = 'notifications';

	public function users(){
		return $this->belongsTo('User');
	}

	public function constructNotificationMessage($user_id, $notifier_id, $type, $routes = null, $callback = null){
		if(!empty($user_id) || !empty($notifier_id) || !empty($type)){
			$notifierInfo = User::find($notifier_id);			$notifierLink = '<a class="inline" style="margin-right:0;" href="'.route('view.users.channel',$notifierInfo->channel_name).'">'. $notifierInfo->channel_name.'</a>';

			if($type == 'subscribed'){
				$message = 'has subscribe to your channel';
			}elseif($type == 'mentioned'){
				$message = 'has mentioned you in a <a class="inline" href="'.$routes.'">comment</a>';
			}elseif($type == 'liked'){
				$message = 'has liked your <a class="inline" href="'.$routes.'">comment</a>';
			}elseif($type == 'replied'){
				$message = 'has replied to your <a class="inline" href="'.$routes.'">comment</a>';
			}elseif($type == 'upload'){
				$message = 'has uploaded new <a class="inline" href="'.$routes.'">video</a>';
			}elseif($type == 'comment'){
				$message = 'has added a comment to your <a class="inline" href="'.$routes.'">video</a>';
			}else{
				return false;
			}

			$callback;

			$completeNotification = $notifierLink .' '. $message;
			if($this->insertNotifications($user_id, $completeNotification, $notifier_id, $type) === true){
				return 'success';
			}
		}
		return false;

	}

	public function getTimePosted($notifications = null){
		if(isset($notifications)){
			foreach($notifications as $key => $notification){
				$getTimeDiff = (strtotime($notification->created_at) - time()) / 3600;
				$roundedTime = round($getTimeDiff);
				$getTime = abs($roundedTime);

				switch (true) {
					case ($getTime >= 6144):
					$getTime = round($getTime / 6144);
					$getTime = ($getTime > 1 ? $getTime.' years ago' : $getTime.' year ago');
					break;
					case ($getTime >= 720):
					$getTime = round($getTime / 720);
					$getTime = ($getTime > 1 ? $getTime.' months ago' : $getTime.' month ago');
					break;
					case ($getTime >= 168):
					$getTime = round($getTime / 168);
					$getTime = ($getTime > 1 ? $getTime.' weeks ago' : $getTime.' week ago');
					break;
					case ($getTime >= 24):
					$getTime = round($getTime / 24);
					$getTime = ($getTime > 1 ? $getTime.' days ago' : $getTime.' day ago');
					break;
					case ($getTime >= 24):
					$getTime = round($getTime / 24);
					$getTime = ($getTime > 1 ? $getTime.' hours ago' : $getTime.' hour ago');
					break;

					default:
					$getTime = 'a few minutes ago';
					break;
				}

				$notifications[$key]['time_difference'] = $getTime;
			}
			return $notifications;
		}
		return false;
	}

	public function insertNotifications($user_id, $notificationMessage,$notifier_id,$type){
		if(!empty($user_id) || !empty($completeNotification)){
			if($type == 'subscribe'){
				$findNotification = Notification::where('user_id', $user_id)
				->where('notification', $notificationMessage)
				->where('notifier_id', $notifier_id)->get();

				if(!$findNotification->isEmpty()){
					return true;
				}

			}
			$notification =  new Notification();
			$notification->user_id = $user_id;
			$notification->notification = $notificationMessage;
			$notification->save();

			return true;
		}
		return false;
	}

	public function getNotifications($id = null, $read = null, $paginate = null, $limit = null){
		if(!empty($id)){
			if(isset($paginate)){
				$result = Notification::whereUserId($id)
				->whereDeletedAt(null)
				->OrderBy('created_at', 'DESC')
				->simplePaginate($paginate);
			}elseif(isset($read)){
				$result = Notification::whereUserId($id)
				->whereDeletedAt(null)
				->whereRead($read)
				->OrderBy('created_at', 'DESC')
				->get();
			}elseif(isset($limit)){
				$result = Notification::whereUserId($id)
				->whereDeletedAt(null)
				->OrderBy('created_at', 'DESC')
				->take($limit)
				->get();
			}else{
			$result = Notification::whereUserId($id)
			->whereDeletedAt(null)
			->OrderBy('created_at', 'DESC')
			->get();
			}
			foreach($result as $key => $user){
				$fileName = $user->user_id. '.jpg';
				$path = 'img/user/'.$fileName; 
				if(!file_exists(public_path($path))){
					$path = '/img/user/0.png';
				}

				$result[$key]->profile_picture = $path;
			}
			return $result;
		}
		return false;
	}

	public function setStatus(){
		DB::table('notifications')->where('read', '=', 0)->update(array('read' => 1));
		return true;
	}

	public function deleteNotification(){

	}
}