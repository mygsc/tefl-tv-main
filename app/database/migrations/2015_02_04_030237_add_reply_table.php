<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReplyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reply', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('comment_id');
			$table->bigInteger('user_id');
			$table->longText('reply');
			$table->bigInteger('likes');
			$table->integer('spam_count');
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
		Schema::drop('reply');
	}

}
