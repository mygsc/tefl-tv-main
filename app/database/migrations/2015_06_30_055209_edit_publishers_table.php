<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditPublishersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('publishers', function(Blueprint $table)
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
		Schema::table('publishers', function(Blueprint $table)
		{
			$table->dropColumn('ad_slot_id');
		});
	}

}
