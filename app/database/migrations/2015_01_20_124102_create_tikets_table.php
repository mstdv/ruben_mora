<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTiketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tikets', function(Blueprint $table)
		{
			$table->increments('id');
            $table->float('monto');
            $table->float('premio');
            $table->string('estado');
            $table->string('pago');
            $table->dateTime('fecha_de_apuesta');
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
		Schema::drop('tikets');
	}

}
