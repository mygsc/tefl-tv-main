<?php

class ReportController extends BaseController {
	public function __construct(User $user, Video $video,Notification $notification, Subscribe $subscribes,Playlist $playlists, Comment $comments) {
		$this->User = $user;
		$this->Video = $video;
		$this->Notification = $notification;
		$this->Auth = Auth::User();
		$this->Subscribe = $subscribes;
		$this->Playlist = $playlists;
		$this->Comment = $comments;
	}
	
	public function getComplaintForm() {
		$categories = $this->Video->getCategory();
		$notifications = $this->Notification->getNotificationForSideBar();

		return View::make('homes.complaintform', compact('categories','notifications'));
	}
}
