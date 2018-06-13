<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbPacienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_paciente', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('cpf', 11)->nullable()->unique('cpf');
			$table->string('nome', 100)->nullable();
			$table->date('d_nascimento')->nullable();
			$table->string('sexo', 1)->nullable();
			$table->integer('id_plano')->index('fk_tb_plano_id');
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
		Schema::drop('tb_paciente');
	}

}
