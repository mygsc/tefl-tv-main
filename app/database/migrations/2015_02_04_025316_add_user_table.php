<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email')->unique();
	        $table->string('username', 40)->unique();
	        $table->string('password', 100);
	        $table->string('first_name', 100);
	        $table->string('last_name', 100);
	        $table->string('website', 255);
	        $table->string('organization', 100);
	        $table->integer('contact_number');
	        $table->string('address');
	        $table->string('city', 100);
	        $table->string('state', 100);
	        $table->string('country', 100);
	        $table->integer('zip_code');
	        $table->enum('verified',array(0,1));
	        $table->enum('activated',array(0,1,2));
	        $table->enum('status',array(0,1));
	        $table->string('remember_me');
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
		Schema::drop('users');
	}

}
