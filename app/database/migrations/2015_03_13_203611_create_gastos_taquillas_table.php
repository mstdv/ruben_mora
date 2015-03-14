<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGastosTaquillasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gastos_taquillas', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('tipo_gasto');
			$table->date('fecha');
			$table->integer('n_factura');
			$table->integer('monto');
			$table->integer('status');

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
		Schema::drop('gastos_taquillas');
	}

}
