<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class GastosTaquillasTableSeeder extends Seeder {

	public function run()
	{
		DB::table('gastos_taquillas')->insert(array(
			'id'			=> 1,
			'user_id'		=> 2,
			'fecha'			=> '2015-03-16',
			'n_factura'		=> 146515413,
			'monto'			=> 300,
			'status'		=> 1
			));

		DB::table('gastos_taquillas')->insert(array(
			'id'			=> 2,
			'user_id'		=> 2,
			'fecha'			=> '2015-03-16',
			'n_factura'		=> 444564541,
			'monto'			=> 500,
			'status'		=> 1
			));

		DB::table('gastos_taquillas')->insert(array(
			'id'			=> 3,
			'user_id'		=> 2,
			'fecha'			=> '2015-03-17',
			'n_factura'		=> 211456454,
			'monto'			=> 450,
			'status'		=> 1
			));

		DB::table('gastos_taquillas')->insert(array(
			'id'			=> 4,
			'user_id'		=> 2,
			'fecha'			=> '2015-03-17',
			'n_factura'		=> 5345442111,
			'monto'			=> 1200,
			'status'		=> 1
			));

		DB::table('gastos_taquillas')->insert(array(
			'id'			=> 5,
			'user_id'		=> 2,
			'fecha'			=> '2015-03-18',
			'n_factura'		=> 21345454212,
			'monto'			=> 1500,
			'status'		=> 1
			));

		DB::table('gastos_taquillas')->insert(array(
			'id'			=> 6,
			'user_id'		=> 2,
			'fecha'			=> '2015-03-18',
			'n_factura'		=> 2545645642,
			'monto'			=> 50,
			'status'		=> 1
			));
	}

}