<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTbCadastroMedicoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tb_cadastro_medico', function(Blueprint $table)
		{
			$table->foreign('id_especialidade', 'fk_tb_especialidade_id')->references('id')->on('tb_especialidade')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tb_cadastro_medico', function(Blueprint $table)
		{
			$table->dropForeign('fk_tb_especialidade_id');
		});
	}

}
