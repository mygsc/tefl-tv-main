<?php

class Dispute extends Eloquent {
	use SoftDeletingTrait;
	protected $table = 'disputes';
	protected $guarded = array();

	public function getDisputes($sort = null, $disputeid = null){	
		if($sort == 'all') return Dispute::all();

		if($sort == 'deleted'){
			return Dispute::select(
				'disputes.id', 'report_id', 'user_id',
				DB::raw('(SELECT complainant.channel_name from users complainant where complainant.id = complainant_id) as complainants_channel'),
				DB::raw('(SELECT uploaders.channel_name from users uploaders where uploaders.id = user_id) as uploaders_channel'),
				DB::raw('(SELECT vid.title from videos vid where vid.id = disputes.video_id) as video_title'),
				DB::raw('(SELECT vid2.file_name from videos vid2 where vid2.id = disputes.video_id) as video_url'),
				'dispute_description',
				'dispute_description',
				'dispute_additional_info',
				'support_link',
				'legal_name',
				'authority_position',
				'signature',
				'disputes.deleted_at', 'disputes.updated_at', 'disputes.created_at')
			->where('disputes.deleted_at', '<>', '')
			->orderBy('disputes.created_at')
			->get();
		}
		if($sort == 'active'){
			return Dispute::select(
				'disputes.id', 'report_id', 'user_id',
				DB::raw('(SELECT complainant.channel_name from users complainant where complainant.id = complainant_id) as complainants_channel'),
				DB::raw('(SELECT uploaders.channel_name from users uploaders where uploaders.id = user_id) as uploaders_channel'),
				DB::raw('(SELECT vid.title from videos vid where vid.id = disputes.video_id) as video_title'),
				DB::raw('(SELECT vid2.file_name from videos vid2 where vid2.id = disputes.video_id) as video_url'),
				'dispute_description',
				'dispute_additional_info',
				'support_link',
				'legal_name',
				'authority_position',
				'signature',
				'disputes.deleted_at', 'disputes.updated_at', 'disputes.created_at')
			->where('disputes.deleted_at','=','')
			->orderBy('disputes.created_at')
			->get();
		}
		if($sort == NULL and isset($disputeid)){
			return Dispute::select(
				'disputes.id',
				'report_id',
				'user_id',
				DB::raw('(SELECT reports.video_id from reports where reports.id = report_id) as report_video_id'),
				DB::raw('(SELECT vid.title from videos vid where vid.id = report_video_id) as video_title'),
				DB::raw('(SELECT vid2.file_name from videos vid2 where vid2.id = report_video_id) as video_url'),
				DB::raw('(SELECT reports.copyrighted_description from reports where reports.id = report_id) as report_reason'),
				'dispute_description',
				'dispute_description',
				'dispute_additional_info',
				'support_link',
				'legal_name',
				'authority_position',
				'signature',
				'disputes.deleted_at', 'disputes.updated_at', 'disputes.created_at')
			->where('disputes.id', $disputeid)
			->first();
		}
		return false;
	}

	public function createDispute($input, $report_id, $user_id){
		$dispute = Dispute::create(array('report_id'=> $report_id, 'user_id'=>$user_id, 
			'country_id'=> $input['country_id'], 'dispute_description' => $input['dispute_description'],
			'dispute_additional_info' => $input['dispute_additional_info'],
			'support_link'=> $input['support_link'], 'legal_name'=> $input['legal_name'],
			'authority_position'=> $input['authority_position'], 'contact_number'=> $input['contact_number'],
			'fax'=> $input['fax'], 'streetaddress'=> $input['streetaddress'],
			'city'=> $input['city'], 'state_province'=> $input['state_province'],
			'zip_postal'=> $input['zip_postal'], 'signature'=> $input['signature']
		));
		return $dispute;
	}
}