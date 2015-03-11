<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logros', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('deporte_id');

			$table->integer('liga_id');

			$table->integer('equipo1');
			$table->integer('equipo2');

			$table->integer('referencia_equipo1');
			$table->integer('referencia_equipo2');

			$table->integer('pitcher_equipo1');
			$table->string('pitcher_equipo1text');
			$table->integer('pitcher_equipo2');
			$table->string('pitcher_equipo2text');

			$table->date('fecha_partido');
			$table->time('hora_partido');

			$table->integer('estado');

			$table->decimal('completo_aganar_a', 5, 2);
			$table->decimal('completo_aganar_b', 5, 2);

			$table->decimal('completo_runline_a', 5, 2);
			$table->decimal('completo_runline_b', 5, 2);
			$table->decimal('completo_runline_c', 5, 2);
			$table->decimal('completo_runline_d', 5, 2);

			$table->decimal('completo_super_runline_a', 5, 2);
			$table->decimal('completo_super_runline_b', 5, 2);
			$table->decimal('completo_super_runline_c', 5, 2);
			$table->decimal('completo_super_runline_d', 5, 2);

			$table->decimal('completo_altabaja_a', 5, 2);
			$table->decimal('completo_altabaja_b', 5, 2);
			$table->decimal('completo_altabaja_c', 5, 2);

			$table->decimal('completo_empate', 5, 2);

			$table->decimal('mitad_aganar_a', 5, 2);
			$table->decimal('mitad_aganar_b', 5, 2);

			$table->decimal('mitad_runline_a', 5, 2);
			$table->decimal('mitad_runline_b', 5, 2);
			$table->decimal('mitad_runline_c', 5, 2);
			$table->decimal('mitad_runline_d', 5, 2);

			$table->decimal('mitad_altabaja_a', 5, 2);
			$table->decimal('mitad_altabaja_b', 5, 2);
			$table->decimal('mitad_altabaja_c', 5, 2);

			$table->decimal('mitad_empate', 5, 2);

			$table->decimal('exoticas_ab_visitante_a', 5, 2);
			$table->decimal('exoticas_ab_visitante_b', 5, 2);
			$table->decimal('exoticas_ab_visitante_c', 5, 2);

			$table->decimal('exoticas_ab_home_a', 5, 2);
			$table->decimal('exoticas_ab_home_b', 5, 2);
			$table->decimal('exoticas_ab_home_c', 5, 2);

			$table->decimal('exoticas_quienanotaprimero_a', 5, 2);
			$table->decimal('exoticas_quienanotaprimero_b', 5, 2);

			$table->decimal('exoticas_totalche_a', 5, 2);
			$table->decimal('exoticas_totalche_b', 5, 2);
			$table->decimal('exoticas_totalche_c', 5, 2);

			$table->decimal('carreras_primer_inn_a', 5, 2);
			$table->decimal('carreras_primer_inn_b', 5, 2);

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
		Schema::drop('logros');
	}

}
