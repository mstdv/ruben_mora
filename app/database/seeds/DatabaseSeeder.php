<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		$this->call('UsersTableSeeder');
		$this->call('DeportesTableSeeder');
		$this->call('PitchersTableSeeder');
		$this->call('EquiposTableSeeder');
		$this->call('LigasTableSeeder');
		$this->call('LogrosTableSeeder');
		$this->call('GruposTableSeeder');
        $this->call('LimitesTableSeeder');
        $this->call('RestriccionsTableSeeder');
        $this->call('GastosTaquillasTableSeeder');
	}

}

class UsersTableSeeder extends Seeder {

	public function run()
	{

		DB::table('users')->insert(array(
			'id'				=> 1,
		    'nombre' 	        => 'Pedro',
		    'apellido'          => 'Carvajal',
		    'cedula'            => 'V22800114',
		    'direccion'         => 'Urb Santa FE, Calle Alberto Carnevalli C33 L1',
		    'ciudad'            => 'Bolivar',
		    'telefono'          => '',
		    'dueno'             => 0,
		    'grupo_id'          => 1,
		    'banco'             => 'Banesco',
		    'numero_cuenta'     => '0000-0000-00-0000000000',
		    'usuario'           => 'forza4x',
		    'email'             => 'xd.peter73@gmail.com',
		    'password'          => Hash::make('123456'),
		    'rol'               => 1
		));

		DB::table('users')->insert(array(
			'id'				=> 2,
		    'nombre' 	        => 'Ruben',
		    'apellido'          => 'Mora',
		    'cedula'            => 'V10573102',
		    'direccion'         => 'Vella vista, maracay.',
		    'ciudad'            => 'Maracay',
		    'telefono'          => '04145863215',
		    'dueno'             => 0,
		    'grupo_id'          => 1,
		    'banco'             => 'Venezuela',
		    'numero_cuenta'     => '0000-0000-00-0000000000',
		    'usuario'           => 'rubenmora',
		    'email'             => 'rubenmora@gmail.com',
		    'password'          => Hash::make('123456'),
		    'rol'               => 3,
		    'estado'			=> 1
		));

		DB::table('users')->insert(array(
			'id'				=> 3,
			'nombre'			=> 'Carluis',
			'apellido'			=> 'Pateti',
			'cedula'			=> 'V23732794',
			'direccion'			=> 'Simón Bolívar, Calle Soublette',
			'ciudad'			=> 'Bolívar',
			'telefono'			=> '04165851084',
			'dueno'				=> 0,
			'grupo_id'			=> 0,
			'banco'				=> 'Venezuela',
			'numero_cuenta'		=> '0000-0000-00-0000000000',
			'usuario'			=> 'carluis',
			'email'				=> 'pateticarluis@gmail.com',
			'password'			=> Hash::make('123456'),
			'rol'				=> 2,
			'estado'			=> 1
			));

		$faker = Faker\Factory::create();
		for ($i = 4; $i <= 35; $i++)
		{
			DB::table('users')->insert(array(
				'id'				=> $i,
			    'nombre' 	        => $faker->firstName,
			    'apellido'          => $faker->lastName,
			    'cedula'            => 'V'.rand(17800114,23880224).'',
			    'usuario'           => $faker->userName,
			    'email'             => $faker->email,
			    'grupo_id'          => rand(1,2),
			    'password'          => Hash::make('123456'),
			    'rol'               => rand(1,3)
			));
		}
	}

}


class GruposTableSeeder extends Seeder {

    public function run()
    {
        DB::table('grupos')->insert(array(
            'id'			       => 1,
            'nombre' 	           => 'CaracasPPT',
            'descripcion'          => 'Grupo de parley de Caracas, ubicado en la zona norte.',
            'user_id'              => 1
        ));

        DB::table('grupos')->insert(array(
            'id'			       => 2,
            'nombre' 	           => 'Maracaibo',
            'descripcion'          => 'Grupo de parley de maracaibo bonito y precioso.',
            'user_id'              => 2
        ));
    }

}

class RestriccionsTableSeeder extends Seeder {

    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('restriccions')->insert(array(
                'id' => $i,
                'user_id' => 2,
                'deporte_id' => rand(1, 3),
                'restriccion' => rand(1, 10)
            ));
        }
    }

}

class LimitesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('limites')->insert(array(
			'id'			       => 1,
		    'user_id'              => 2,
		    'acepta_derecho' 	   => 'SI',
		    'maximo_parlays' 	   => '8',
		    'minimo_parlays' 	   => '3',
		    'maximo_hembras' 	   => '3',
		    'max_monto_der'  	   => '2500',
		    'max_monto_par'  	   => '1530',
		    'max_der_perder' 	   => '10',
		    'max_premio'     	   => '30000',
		    'created_at' => '2015-09-13',
		    'updated_at' => '2015-09-13',
		));

	}

}

class DeportesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('deportes')->insert(array(
		    'nombre' 	        => 'Futbol Soccer',
		    'logro_referencia' 	=> '800'
		));

		DB::table('deportes')->insert(array(
		    'nombre' 	        => 'Baseball',
		    'logro_referencia' 	=> '900'
		));

		DB::table('deportes')->insert(array(
		    'nombre' 	        => 'Hockey',
		    'logro_referencia' 	=> '500'
		));
	}
}

class PitchersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker\Factory::create();
		for ($i = 1; $i <= 10; $i++)
		{
			DB::table('pitchers')->insert(array(
			    'equipo_id'   => rand(1,3),
			    'nombre' 	  => $faker->firstName.' '.$faker->lastName
			));
		}
	}
}

class EquiposTableSeeder extends Seeder {

	public function run()
	{
		DB::table('equipos')->insert(array(
			'liga_id'			=> 5,
		    'nombre' 	        => 'Aguilas del Zulia'
		));

		DB::table('equipos')->insert(array(
			'liga_id'			=> 5,
		    'nombre' 	        => 'Caribes de Anzoategui'
		));

		DB::table('equipos')->insert(array(
			'liga_id'			=> 5,
		    'nombre' 	        => 'Leones del Caracas'
		));

		DB::table('equipos')->insert(array(
			'liga_id'			=> 1,
		    'nombre' 	        => 'Real Madrid'
		));

		DB::table('equipos')->insert(array(
			'liga_id'			=> 1,
		    'nombre' 	        => 'Millan'
		));

		DB::table('equipos')->insert(array(
			'liga_id'			=> 1,
		    'nombre' 	        => 'Vinotinto'
		));
	}

}

class LigasTableSeeder extends Seeder {

	public function run()
	{
		DB::table('ligas')->insert(array(
			'deporte_id'		=> 1,
		    'nombre' 	        => 'Copa del rey'
		));

		DB::table('ligas')->insert(array(
			'deporte_id'		=> 1,
		    'nombre' 	        => 'Copa libertador'
		));

		DB::table('ligas')->insert(array(
			'deporte_id'		=> 1,
		    'nombre' 	        => 'Fut. Venezolano'
		));

		DB::table('ligas')->insert(array(
			'deporte_id'		=> 2,
		    'nombre' 	        => 'LVBP'
		));

		DB::table('ligas')->insert(array(
			'deporte_id'		=> 2,
		    'nombre' 	        => 'Series del caribe'
		));


		DB::table('ligas')->insert(array(
			'deporte_id'		=> 3,
		    'nombre' 	        => 'NHL Hockey'
		));
	}

}

class LogrosTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker\Factory::create();
		for ($i = 1; $i < 60; $i++)
		{
			DB::table('logros')->insert(array(
				'pitcher_equipo2' 		       => rand(1,5),
				'pitcher_equipo1' 		       => rand(6,10),
				'deporte_id'			       		 => 2,
				'liga_id' 		               => rand(4,5),
				'equipo1' 		               => rand(1,3),
				'equipo2' 		               => rand(1,3),
				'referencia_equipo1'           => 900+$i,
				'referencia_equipo2'           => 900+$i+1,
				'fecha_partido' 		         => date('2015-'.date('m').'-'.date('d').''),
				'hora_partido' 		           => date(''.rand(01,24).':'.rand(01,60).':'.rand(00,60).''),

				'completo_aganar_a'            => '-115',
				'completo_aganar_b'            => '-115',

				'completo_runline_a'           => '-110',
				'completo_runline_b'           => '1.5',
				'completo_runline_c'           => '-110',
				'completo_runline_d'           => '-1.5',

				'completo_super_runline_a'     => '-2.5',
				'completo_super_runline_b'     => '165',
				'completo_super_runline_c'     => '2.5',
				'completo_super_runline_d'     => '-250',

				'completo_altabaja_a'          => '9.5',
				'completo_altabaja_b'          => '-115',
				'completo_altabaja_c'          => '-115',

				'completo_empate'              => '-120',

				'mitad_aganar_a'               => '-115',
				'mitad_aganar_b'               => '-115',

				'mitad_runline_a'              => '-0.5',
				'mitad_runline_b'              => '-115',
				'mitad_runline_c'              => '0.5',
				'mitad_runline_d'              => '-115',

				'mitad_altabaja_a'             => '5.5',
				'mitad_altabaja_b'             => '-115',
				'mitad_altabaja_c'             => '-115',

				'mitad_empate'                 => '-110',

				'exoticas_ab_visitante_a'      => '5.0',
				'exoticas_ab_visitante_b'      => '-110',
				'exoticas_ab_visitante_c'      => '-110',

				'exoticas_ab_home_a'           => '4.5',
				'exoticas_ab_home_b'           => '-110',
				'exoticas_ab_home_c'           => '-110',

				'carreras_primer_inn_a'       => '-150',
				'carreras_primer_inn_b'       => '-140',

				'exoticas_quienanotaprimero_a' => '-125',
				'exoticas_quienanotaprimero_b' => '-125',

				'exoticas_totalche_a'          => '29.5',
				'exoticas_totalche_b'          => '-110',
				'exoticas_totalche_c'          => '-110'

			));

            $i=$i+1;
        }

        for ($i = 1; $i < 60; $i++)
		{
			DB::table('logros')->insert(array(
				'deporte_id'			       => 1,
				'liga_id' 		               => 1,
				'equipo1' 		               => rand(4,6),
				'equipo2' 		               => rand(4,6),
				'referencia_equipo1'           => 800+$i,
				'referencia_equipo2'           => 800+$i+1,
				'fecha_partido' 		       => date('2015-'.date('m').'-'.date('d').''),
				'hora_partido' 		           => date(''.rand(01,24).':'.rand(01,60).':'.rand(00,60).''),

				'completo_aganar_a'            => '-115',
				'completo_aganar_b'            => '-115',

				'completo_runline_a'           => '-1.5',
				'completo_runline_b'           => '135',
				'completo_runline_c'           => '1.5',
				'completo_runline_d'           => '-150',

				'completo_super_runline_a'     => '-2.5',
				'completo_super_runline_b'     => '165',
				'completo_super_runline_c'     => '2.5',
				'completo_super_runline_d'     => '-250',

				'completo_altabaja_a'          => '9.5',
				'completo_altabaja_b'          => '-115',
				'completo_altabaja_c'          => '-115',

				'completo_empate'              => '-150',

				'mitad_aganar_a'               => '-115',
				'mitad_aganar_b'               => '-115',

				'mitad_runline_a'              => '-0.5',
				'mitad_runline_b'              => '-115',
				'mitad_runline_c'              => '0.5',
				'mitad_runline_d'              => '-115',

				'mitad_altabaja_a'             => '5.5',
				'mitad_altabaja_b'             => '-115',
				'mitad_altabaja_c'             => '-115',

				'mitad_empate'                 => '-120'

			));
            $i=$i+1;
		}

	}

}

class GastosTaquillasTableSeeder extends Seeder {

	public function run()
	{
		DB::table('gastos_taquillas')->insert(array(
			'id'			=> 1,
			'user_id'		=> 2,
			'tipo_gasto'	=> 'askldj alks djkla djkj',
			'fecha'			=> '2015-03-16',
			'n_factura'		=> 146515413,
			'monto'			=> 300,
			'status'		=> 1
			));

		DB::table('gastos_taquillas')->insert(array(
			'id'			=> 2,
			'user_id'		=> 2,
			'tipo_gasto'	=> 'askldj alks djkla djkj',
			'fecha'			=> '2015-03-16',
			'n_factura'		=> 444564541,
			'monto'			=> 500,
			'status'		=> 1
			));

		DB::table('gastos_taquillas')->insert(array(
			'id'			=> 3,
			'user_id'		=> 2,
			'tipo_gasto'	=> 'askldj alks djkla djkj',
			'fecha'			=> '2015-03-17',
			'n_factura'		=> 211456454,
			'monto'			=> 450,
			'status'		=> 1
			));

		DB::table('gastos_taquillas')->insert(array(
			'id'			=> 4,
			'user_id'		=> 2,
			'tipo_gasto'	=> 'askldj alks djkla djkj',
			'fecha'			=> '2015-03-17',
			'n_factura'		=> 5345442111,
			'monto'			=> 1200,
			'status'		=> 1
			));

		DB::table('gastos_taquillas')->insert(array(
			'id'			=> 5,
			'user_id'		=> 2,
			'tipo_gasto'	=> 'askldj alks djkla djkj',
			'fecha'			=> '2015-03-18',
			'n_factura'		=> 21345454212,
			'monto'			=> 1500,
			'status'		=> 1
			));

		DB::table('gastos_taquillas')->insert(array(
			'id'			=> 6,
			'user_id'		=> 2,
			'tipo_gasto'	=> 'askldj alks djkla djkj',
			'fecha'			=> '2015-03-18',
			'n_factura'		=> 2545645642,
			'monto'			=> 50,
			'status'		=> 1
			));
	}

}