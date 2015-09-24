<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPrivacySettings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_privacy_settings', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->integer('user_id');
			$table->enum('email', array('0', '1'))->comment('0 = hide, 1 = show')->default('1');
			$table->enum('name', array('0', '1'))->comment('0 = hide, 1 = show')->default('1');
			$table->enum('address', array('0', '1'))->comment('0 = hide, 1 = show')->default('1');
			$table->enum('subscriber_count', array('0', '1'))->comment('0 = hide, 1 = show')->default('1');
			$table->enum('birthday', array('0', '1'))->comment('0 = hide, 1 = show')->default('1');
			$table->enum('country', array('0', '1'))->comment('0 = hide, 1 = show')->default('1');
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
		//
	}

}
