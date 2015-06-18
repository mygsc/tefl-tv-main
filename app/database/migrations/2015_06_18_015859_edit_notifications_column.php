<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditNotificationsColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up()
	{
		Schema::table('notifications', function(Blueprint $table)
		{
			$table->enum('type', array('like','comment','mention','reply','video-is-ready','subscribe','uploaded-new-video'));
			$table->integer('video_id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('notifications', function(Blueprint $table)
		{
			$table->dropColumn('enum');
			$table->dropColumn('video_id');
		});
	}

}
