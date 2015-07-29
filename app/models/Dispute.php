<?php

class Dispute extends Eloquent {
	protected $table = 'disputes';
	protected $guarded = array();

	public function getDisputes($sort = null, $reportid = null){	
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
}