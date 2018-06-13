<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbAgendamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_agendamento', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('data')->nullable();
			$table->timestamps();
			$table->integer('status')->nullable();
			$table->integer('id_paciente')->index('fk_tb_agendamento_tb_paciente1_idx');
			$table->integer('id_medico')->index('fk_tb_agendamento_tb_cadastro_medico1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_agendamento');
	}

}
