<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersFeedbacksLikesDislikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feedbacks_likesdislikes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('feedback_id');
			$table->integer('user_id');
			$table->varchar('status');
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
		Schema::drop('feedbacks_likesdislikes');
	}

}
