<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfigsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('configs', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('op1');
			$table->string('op2');
			$table->string('op3');
			$table->string('op4');

			$table->float('exoticas_ab_home_a');
			$table->float('exoticas_ab_home_b');
			$table->float('exoticas_ab_home_c');

			$table->float('exoticas_quienanotaprimero_a');
			$table->float('exoticas_quienanotaprimero_b');

			$table->float('exoticas_totalche_a');
			$table->float('exoticas_totalche_b');
			$table->float('exoticas_totalche_c');

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
		Schema::drop('configs');
	}

}
