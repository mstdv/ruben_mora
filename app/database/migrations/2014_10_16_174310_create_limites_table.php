<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLimitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('limites', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('acepta_derecho');
			$table->integer('maximo_parlays');
			$table->integer('minimo_parlays');
			$table->integer('maximo_hembras');
			$table->float('max_monto_der');
			$table->float('max_monto_par');
			$table->float('max_der_perder');
			$table->float('max_premio');
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
		Schema::drop('limites');
	}

}
