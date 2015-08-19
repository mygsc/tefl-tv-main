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
				DB::raw('(SELECT users.channel_name from users where users.id = user_id) as user_channel'),
				DB::raw('(SELECT reports.complainant_id from reports where reports.id = report_id) as reporter_id'),
				DB::raw('(SELECT users.channel_name from users where users.id = reporter_id) as reporter_channel'),
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
				DB::raw('(SELECT users.channel_name from users where users.id = user_id) as user_channel'),
				DB::raw('(SELECT reports.complainant_id from reports where reports.id = report_id) as reporter_id'),
				DB::raw('(SELECT users.channel_name from users where users.id = reporter_id) as reporter_channel'),
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
				DB::raw('(SELECT users.channel_name from users where users.id = user_id) as user_channel'),
				DB::raw('(SELECT reports.complainant_id from reports where reports.id = report_id) as reporter_id'),
				DB::raw('(SELECT users.channel_name from users where users.id = reporter_id) as reporter_channel'),
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
		Dispute::create(array('report_id'=> $report_id, 'user_id'=>$user_id, 
			'country_id'=> $input['country_id'], 'dispute_description' => $input['dispute_description'],
			'dispute_additional_info' => $input['dispute_additional_info'],
			'support_link'=> $input['support_link'], 'legal_name'=> $input['legal_name'],
			'authority_position'=> $input['authority_position'], 'contact_number'=> $input['contact_number'],
			'fax'=> Input::get('fax'), 'streetaddress'=> $input['streetaddress'],
			'city'=> $input['city'], 'state_province'=> $input['state_province'],
			'zip_postal'=> $input['zip_postal'], 'signature'=> $input['signature']
		));
	}
}