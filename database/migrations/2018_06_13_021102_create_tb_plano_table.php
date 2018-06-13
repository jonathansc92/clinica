<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbPlanoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_plano', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('descricao', 100)->nullable();
			$table->string('cnpj', 14)->nullable();
			$table->string('contato', 100)->nullable();
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
		Schema::drop('tb_plano');
	}

}
