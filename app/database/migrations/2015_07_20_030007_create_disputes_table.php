<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisputesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('disputes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->char('report_id', 100);
			$table->bigInteger('user_id');
			$table->bigInteger('country_id');
			$table->longText('dispute_description')->nullable();
			$table->longText('dispute_additional_info')->nullable();
			$table->char('legal_name', 255)->nullable();
			$table->char('authority_position', 255)->nullable();
			$table->char('contact_number', 255)->nullable();
			$table->char('fax', 255)->nullable();
			$table->longText('streetaddress')->nullable();
			$table->char('city', 150)->nullable();
			$table->char('state_province', 150)->nullable();
			$table->char('zip_postal', 150)->nullable();
			$table->char('signature', 150)->nullable();
			$table->enum('status', array('0', '1'))->comment('0 = inactive, 1 = active');
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
		Schema::drop('disputes');
	}

}
