<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 45)->nullable();
			$table->string('email', 45)->nullable();
			$table->string('password')->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->string('iplastlogin', 45)->nullable();
			$table->dateTime('lastlogin_at')->nullable();
			$table->string('img')->nullable();
			$table->text('whoarewe')->nullable();
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
