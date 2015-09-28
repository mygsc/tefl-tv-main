<?php

class Report extends Eloquent {
	use SoftDeletingTrait;
	protected $table = 'reports';

	public static $complaintRules = array(
		'copyrighted_video_url' => 'required','copyrighted_description' => 'required',
		'legal_name' => 'required','authority_position' =>'required',
		'contact_number' => 'required','signature' => 'required'
	);
	public static $disputeRules = array(
		'dispute_description' => 'required','legal_name' => 'required', 'authority_position' =>'required',
		'contact_number' => 'required', 'signature' => 'required'
	);

	public function createReport($input, $case_number, $complainant_id, $user_id, $video_id){
		Report::create(array('case_number'=> $case_number, 'complainant_id'=> $complainant_id, 
			'user_id'=> $user_id, 'country_id'=> $inputs['country_id'], 
			'issue' => $input['issue'], 'video_id'=>$video_id,
			'copyrighted_description' => $input['copyrighted_description'],
		 	'copyrighted_additional_info' => $input['copyrighted_additional_info'], 
		 	'legal_name'=> $input['legal_name'],'authority_position'=> $input['authority_position'], 
		 	'contact_number'=> $input['contact_number'], 'fax'=> $input['fax'], 
		 	'streetaddress'=> $input['streetaddress'], 'city'=> $input['city'], 
		 	'state_province'=> $input['state_province'], 'zip_postal'=> $input['zip_postal'],
		 	'signature'=> $input['signature']
		));
	}

	public function getReports($sort = null, $reportid = null){	
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
		if($sort == NULL and isset($reportid)){
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
	public function getReportPerVideo($videoid){
		$reports = Report::select(
			'reports.id',
			'case_number',
			'complainant_id',
			'user_id',
			'reports.video_id',
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
			'reports.updated_at',
			'reports.created_at'
			)
		->where('reports.video_id', $videoid)
		->where('reports.deleted_at','=','')
		->where('user_id', Auth::User()->id)
		->get();

		return $reports;
	}


	public function checkVideoReports($filename){
		$video = Video::where('file_name', $filename)->first();
		if($video->reported == '1') return 'reported';
		$report = Report::where('video_id', $video->id)->first();
		if(empty($report)) return false;

		$dispute = Dispute::where('report_id', $report->id)->first();

		if(empty($dispute)){
			$now = date('Y-m-d H:i:s');
			$disputeDate_plus30Days = date('Y-m-d H:i:s', strtotime($report->created_at . '+30 days'));
			if($disputeDate_plus30Days > $now){
				Video::where('id', $video->id)->update(array('reported' => '1'));
			}
		}
		if(!empty($report) and !empty($dispute)){
			$now = date('Y-m-d H:i:s');
			$plus90daysDispute = date('Y-m-d H:i:s', strtotime($dispute->created_at . '+90 days'));
			if($plus90daysDispute > $now){
				Video::find($video->id)->update(array('reported' => '1'));
			}
			return 'disableAds';
		}
		return false;
	}
	public function checkVideoIfDeleted($filename){
		$video = Video::where('file_name',$filename)->withTrashed()->first();
		if(empty($video)) return true;
		return false;
	}

	public function getMyReport($user_id){
		$reports = $this->Report->select(
			'reports.id', 'case_number', 'complainant_id', 'user_id',
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
			'reports.deleted_at','reports.created_at', 'reports.updated_at')
		->where('reports.complainant_id', $user_id)
		->get();
		return $reports;
	}
}