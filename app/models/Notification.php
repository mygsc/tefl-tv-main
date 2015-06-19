<?php

class Notification extends Eloquent {
	use SoftDeletingTrait;
	protected $table = 'notifications';

	public function users(){
		return $this->belongsTo('User');
	}

	public function videos(){
		return $this->belongsTo('Video');
	}

	/** sendNotification
	*	$user_id			Notification receiver ID
	*	$notifier_id		The notification sender ID
	*	$type 				Please refer to database(table notifications) for list of types
	*	$video_id			Nullable video_id of the file
	*/

	public function sendNotification($user_id,$notifier_id = null, $type, $video_id = null){
		if(!empty($user_id) || !empty($type)){
			$notifications = new Notification();
			$notifications->user_id = $user_id;
			$notifications->notifier_id = $notifier_id;
			$notifications->type = $type;
			$notifications->read = '0';
			$notifications->save();

			return true;
		}
		return false;
	}

	public function constructNotificationMessage($user_id, $notifier_id = null, $type, $video_id = null, $callback = null){
		if($type == 'video-is-ready'){
			$videos = Video::find($video_id);
			$video_link = link_to_route('homes.watch-video', 'video', 'v='. $videos->file_name);
			$return['notification'] = 'Your '.$video_link. ' is ready';
			$return['profile_picture'] = User::getUsersImages($user_id)['profile_picture'];
			return $return;
		}elseif($type == 'subscribe'){
			$subscriber = User::find($notifier_id);
			$subscriberLink = link_to_route('view.users.channel', $subscriber->channel_name, $subscriber->channel_name);
			$return['notification'] = $subscriberLink. ' has subscribe to your channel';
			$return['profile_picture'] = User::getUsersImages($notifier_id)['profile_picture'];
			return $return;
		}elseif($type == 'mention'){

		}elseif($type == 'uploaded-new-video'){

		}elseif($type == 'like'){
			$liker = User::find($notifier_id);
			$videos = Video::find($video_id);
			$likerLink = link_to_route('view.users.channel', $liker->channel_name, $liker->channel_name);
			$video_link = link_to_route('homes.watch-video', 'comment', 'v='. $videos->file_name);
			$return['notification'] = $likerLink. ' likes your '. $video_link;
			$return['profile_picture'] = User::getUsersImages($notifier_id)['profile_picture'];
			return $message;
		}elseif($type == 'reply'){
			$replied = User::find($notifier_id);
			$videos = Video::find($video_id);
			$likerLink = link_to_route('view.users.channel', $replied->channel_name, $replied->channel_name);
			$video_link = link_to_route('homes.watch-video', 'comment', 'v='. $videos->file_name);
			$return['notification'] = $likerLink. ' replied to your '. $video_link;
			$return['profile_picture'] = User::getUsersImages($notifier_id)['profile_picture'];
			return $message;
		}else{
			return null;
		}

	}

	public function getTimePosted($notifications = null){
		if(isset($notifications)){
			$getTimeDiff = (strtotime($notifications->created_at) - time()) / 3600;
			$roundedTime = round($getTimeDiff);
			$getTime = abs($roundedTime);

			switch (true) {
				case ($getTime >= 6143):
				$getTime = round($getTime / 6144);
				$getTime = ($getTime > 1 ? $getTime.' years ago' : $getTime.' year ago');
				break;
				case ($getTime >= 719):
				$getTime = round($getTime / 720);
				$getTime = ($getTime > 1 ? $getTime.' months ago' : $getTime.' month ago');
				break;
				case ($getTime >= 167):
				$getTime = round($getTime / 168);
				$getTime = ($getTime > 1 ? $getTime.' weeks ago' : $getTime.' week ago');
				break;
				case ($getTime >= 24):
				$getTime = round($getTime / 24);
				$getTime = ($getTime > 1 ? $getTime.' days ago' : $getTime.' day ago');
				break;
				case ($getTime >= 1 and $getTime <= 23):
				$getTime = round($getTime);
				$getTime = ($getTime > 1 ? $getTime.' hours ago' : $getTime.' hour ago');
				break;

				default:
				$getTime = 'a few minutes ago';
				break;
			}

			return $getTime;
		}
		return false;
	}

	public function getNotificationForSideBar(){
		if(Auth::check()){
			$notifications =  $this->getNotifications(Auth::user()->id, null, '10');

			return $notifications;
		}
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
			$notification = new Notification();
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
				->OrderBy('created_at', 'ASC')
				->take($limit)
				->get();
			}else{
				$result = Notification::whereUserId($id)
				->whereDeletedAt(null)
				->OrderBy('created_at', 'DESC')
				->get();
			}

			foreach($result as $key => $notification){
				$constructNotification = $this->constructNotificationMessage($notification->user_id, $notification->notifier_id, $notification->type, $notification->video_id);
				$result[$key]['notification'] = $constructNotification['notification'];
				$result[$key]['profile_picture'] = $constructNotification['profile_picture'];
				$result[$key]['time_difference'] = $this->getTimePosted($notification);
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