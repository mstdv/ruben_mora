<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('grupo_id');
			$table->string('nombre');
			$table->string('apellido');
			$table->string('cedula');
			$table->string('direccion');
			$table->string('ciudad');
			$table->string('telefono');
			$table->string('dueno');
			$table->string('banco');
			$table->string('numero_cuenta');
			$table->string('usuario')->unique();
			$table->string('email')->unique();
			$table->string('password');
			$table->string('rol',2)->default(2);
			$table->string('estado',2)->default(1);
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
