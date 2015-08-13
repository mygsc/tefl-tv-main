<?php

class Dispute extends Eloquent {
	use SoftDeletingTrait;
	protected $table = 'disputes';
	protected $guarded = array();

	public function getDisputes($sort = null, $disputeid = null){	
		if($sort == 'all'){
			return Dispute::all();
		}
		if($sort == 'deleted'){
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
				'disputes.deleted_at',
				'disputes.updated_at')
			->where('disputes.deleted_at', '<>', '')
			->orderBy('created_at')
			->get();
		}
		if($sort == 'active'){
			return Dispute::select(
				'disputes.id',
				'report_id',
				'user_id',
				DB::raw('(SELECT users.channel_name from users where users.id = user_id) as user_channel'),
				DB::raw('(SELECT reports.complainant_id from reports where reports.id = report_id) as reporter_id'),
				DB::raw('(SELECT users.channel_name from users where users.id = reporter_id) as reporter_channel'),
				'dispute_description',
				'dispute_additional_info',
				'support_link',
				'legal_name',
				'authority_position',
				'signature',
				'disputes.deleted_at',
				'disputes.updated_at')
			->where('disputes.deleted_at','=','')
			->orderBy('disputes.updated_at')
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
				'disputes.deleted_at',
				'disputes.updated_at')
			->where('disputes.id', $disputeid)
			->first();
		}

		return false;
	}
}