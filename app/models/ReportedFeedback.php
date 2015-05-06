<?php

class ReportedFeedback extends Eloquent {

	protected $table = 'reported_feedbacks';

	public function getReportCount($feedbackId = null, $channelId = null, $userId = null) {

		$reportCount = DB::table('reported_feedbacks')
		->insert(array(
			'feedback_id' => $feedbackId, 
			'channel_id' => $channelId, 
			'user_id' => $userId));
		return $reportCount;
	}
}