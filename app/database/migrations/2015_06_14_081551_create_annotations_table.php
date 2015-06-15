<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnotationsTable extends Migration {

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
			$table->bigInteger('user_id');
			$table->char('file_name', 255);
			$table->char('types', 100);
			$table->char('content', 255);
			$table->char('start', 8);
			$table->char('end', 8);
			$table->longText('link');
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
		Schema::drop('annotations');
	}

}
