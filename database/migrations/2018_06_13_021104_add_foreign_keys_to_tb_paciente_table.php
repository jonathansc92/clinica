<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTbPacienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tb_paciente', function(Blueprint $table)
		{
			$table->foreign('id_plano', 'fk_tb_plano_id')->references('id')->on('tb_plano')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tb_paciente', function(Blueprint $table)
		{
			$table->dropForeign('fk_tb_plano_id');
		});
	}

}
