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
		Schema::create('annotations', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('reporter_id');
			$table->bigInteger('owner_id');
			$table->char('report_type', 100);
			$table->longText('reasons');
			$table->longText('comment');
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
		Schema::table('users', function(Blueprint $table)
		{
			//
		});
	}

}
