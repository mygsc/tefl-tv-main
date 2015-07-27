<?php

class Report extends Eloquent {
	protected $table = 'reports';
	protected $guarded = array();

	public static $complaintRules = array(
		'copyrighted_video_url' => 'required',
		'copyrighted_description' => 'required',
		'legal_name' => 'required',
		'authority_position' =>'required',
		'contact_number' => 'required',
		'signature' => 'required'
	);
	public static $disputeRules = array(
		'dispute_description' => 'required',
		'legal_name' => 'required',
		'authority_position' =>'required',
		'contact_number' => 'required',
		'signature' => 'required'
	);
	public function getReports($reportid = null, $sort = null){	
		if($sort == 'all'){
			return Report::all();
		}
		if($sort == 'deleted'){
			return Report::select(
				'reports.id',
				'case_number',
				'complainant_id',
				'user_id',
				DB::raw('(SELECT complainant.channel_name from users complainant where complainant.id = complainant_id) as complainants_channel'),
				DB::raw('(SELECT uploaders.channel_name from users uploaders where uploaders.id = user_id) as uploaders_channel'),
				DB::raw('(SELECT vid.title from videos vid where vid.id = reports.video_id) as video_title'),
				DB::raw('(SELECT vid2.file_name from videos vid2 where vid2.id = reports.video_id) as video_url'),
				'copyrighted_description',
				'legal_name',
				'authority_position',
				'signature',
				'reports.deleted_at',
				'updated_at')
			->where('reports.deleted_at', '<>', '')
			->orderBy('created_at')
			->get();
		}
		if($sort == 'active'){
			return Report::select(
				'reports.id',
				'case_number',
				'complainant_id',
				'user_id',
				DB::raw('(SELECT complainant.channel_name from users complainant where complainant.id = complainant_id) as complainants_channel'),
				DB::raw('(SELECT uploaders.channel_name from users uploaders where uploaders.id = user_id) as uploaders_channel'),
				DB::raw('(SELECT vid.title from videos vid where vid.id = reports.video_id) as video_title'),
				DB::raw('(SELECT vid2.file_name from videos vid2 where vid2.id = reports.video_id) as video_url'),
				'copyrighted_description',
				'legal_name',
				'authority_position',
				'signature',
				'reports.deleted_at',
				'reports.updated_at')
			->where('reports.deleted_at','=','')
			->orderBy('reports.updated_at')
			->get();
		}
		if(isset($reportid)){
			return Report::select(
				'reports.id',
				'case_number',
				'complainant_id',
				'user_id',
				DB::raw('(SELECT complainant.channel_name from users complainant where complainant.id = complainant_id) as complainants_channel'),
				DB::raw('(SELECT uploaders.channel_name from users uploaders where uploaders.id = user_id) as uploaders_channel'),
				DB::raw('(SELECT vid.title from videos vid where vid.id = reports.video_id) as video_title'),
				DB::raw('(SELECT vid2.file_name from videos vid2 where vid2.id = reports.video_id) as video_url'),
				'issue',
				'copyrighted_description',
				'copyrighted_additional_info',
				'legal_name',
				'authority_position',
				'signature',
				'reports.deleted_at',
				'reports.updated_at')
			->where('reports.id', $reportid)
			->first();
		}

		return false;
	}
}