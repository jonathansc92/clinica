<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbCadastroMedicoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_cadastro_medico', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('crm', 13)->unique('crm');
			$table->string('cpf', 11)->unique('cpf');
			$table->string('nome', 100);
			$table->char('sexo', 1);
			$table->date('d_nascimento');
			$table->integer('id_especialidade')->index('fk_tb_especialidade_id');
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
		Schema::drop('tb_cadastro_medico');
	}

}
