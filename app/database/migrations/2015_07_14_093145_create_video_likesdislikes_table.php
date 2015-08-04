<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoLikesdislikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('video_likes_dislikes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('video_id');
			$table->integer('user_id');
			$table->tinyInteger('likes');
			$table->tinyInteger('dislikes');
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
		Schema::drop('video_likesdislikes');
	}

}
