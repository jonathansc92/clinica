<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTbAgendamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tb_agendamento', function(Blueprint $table)
		{
			$table->foreign('id_medico', 'fk_tb_agendamento_tb_cadastro_medico1')->references('id')->on('tb_cadastro_medico')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_paciente', 'fk_tb_agendamento_tb_paciente1')->references('id')->on('tb_paciente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tb_agendamento', function(Blueprint $table)
		{
			$table->dropForeign('fk_tb_agendamento_tb_cadastro_medico1');
			$table->dropForeign('fk_tb_agendamento_tb_paciente1');
		});
	}

}
