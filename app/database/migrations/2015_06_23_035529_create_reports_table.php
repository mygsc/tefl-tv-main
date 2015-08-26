<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reports', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->char('case_number', 100);
			$table->bigInteger('complainant_id');
			$table->bigInteger('user_id');
			$table->bigInteger('video_id');
			$table->bigInteger('country_id');
			$table->longText('issue');
			$table->longText('copyrighted_description');
			$table->longText('copyrighted_additional_info');
			$table->char('legal_name', 255);
			$table->char('authority_position', 255);
			$table->char('contact_number', 255);
			$table->char('fax', 255);
			$table->longText('streetaddress');
			$table->char('city', 150);
			$table->char('state_province', 150);
			$table->char('zip_postal', 150);
			$table->char('signature', 150);
			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reports');
	}
}
