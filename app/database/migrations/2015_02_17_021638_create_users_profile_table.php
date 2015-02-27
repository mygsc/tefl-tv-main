<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_profile', function(Blueprint $table)
		{
			$table->BigIncrements('id');
			$table->Integer('user_id');
			$table->string('pics');
			$table->longtext('interests');
			$table->string('work');
			$table->string('birthdate');
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
		Schema::drop('users_profile');
	}

}
