<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersSubscribeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscribe', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_id', 200);
			$table->string('subscriber', 200);
			$table->enum('notifs', array(0, 1));
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
		Schema::drop('subscribe');
	}

}
