<?php

class Report extends Eloquent {

	protected $table = 'reports';

	protected $guarded = array();

	public static $complaintRules = array(
		'copyrighted_video_url' => 'required',
		'copyrighted_description' => 'required',
		'legal_name' => 'required',
		'authority_position' =>'required',
		'contact_number' => 'required'
		'signature' => 'required',
	);
}