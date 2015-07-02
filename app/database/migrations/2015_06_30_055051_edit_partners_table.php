<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditPartnersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('partners', function(Blueprint $table)
		{
			$table->string('ad_slot_id')->after('adsense_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('partners', function(Blueprint $table)
		{
			$table->dropColumn('ad_slot_id');
		});
	}

}
