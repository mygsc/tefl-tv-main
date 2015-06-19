<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameFeedbackColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('feedbacks', function($table)
		{
		    $table->renameColumn('channel_id', 'feedback_receiver_id');
		    $table->renameColumn('user_id', 'feedback_sender_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('feedbacks', function($table)
		{
		 $table->renameColumn('feedback_receiver_id', 'channel_id');
		 $table->renameColumn('feedback_sender_id', 'user_id');
		 });
	}

}
