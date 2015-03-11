<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResultadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resultados', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('created_at');
			$table->date('updated_at');
			$table->integer('logro_id');
			$table->integer('liga_id');
			$table->float('mitad_a');
			$table->float('mitad_b');
			$table->float('completo_a');
			$table->float('completo_b');
			$table->integer('exoticas_quienanotaprimero');
			$table->float('exoticas_totalche');
			$table->integer('carreras_primer_inn');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('resultados');
	}

}
