<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTiketsJugadasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tikets_jugadas', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('tiket_id');
            $table->string('logro_id');
            $table->string('referencia_equipo');
            $table->string('referencia_jugada');
            $table->string('logro_calc');

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
		Schema::drop('tikets_jugadas');
	}

}
