<?php

class LogrosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /logros
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('logros.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /logros/create
	 *
	 * @return Response
	 */
	public function create()
	{

		if (Input::get('paso') == 1) {
			$rules = array(
				'paso'  => 'required',
				'liga' => 'required|min:1|max:3',
			);

			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) {
				Session::flash('successMsj', 'Error!');
				return Redirect::back()
					->withErrors($validator)
					->withInput();
			} else {

				$liga = Liga::where('id', Input::get('liga'))->get();
				$liga_nombre = $liga[0]->nombre;
				$deporte_id = $liga[0]->deporte_id;

				$deporte = Deporte::where('id', $deporte_id)->get();
				$deporte_referencia = $deporte[0]->logro_referencia;
				$deporte_nombre = $deporte[0]->nombre;

				$referencia = $deporte_referencia;

				$c = Logro::where('deporte_id', $deporte_id)->orderBy('referencia_equipo2', 'DESC');

				if ($c->count() >= 1) {
					$referencia = $c->get();
					$referencia = $referencia[0]->referencia_equipo2;
				}

				if (Equipo::where('liga_id',Input::get('liga'))->count() == 0) {
					Session::flash('alertOn', 'La liga '.$liga_nombre.' no posee equipos disponibles.');
					return Redirect::back()
					->withInput();
				} else {
					return Redirect::to('/logros/create/step/2?step=2&liga_id='.Input::get('liga').'&deporte_nombre='.$deporte_nombre.'&deporte_id='.$deporte_id.'&referencia='.$referencia.'');
				}
			}

		} elseif (Input::get('paso') == 2) {
			$rules = array(
				'equipo1'      => 'required',
				'referencia1'  => 'required|min:2|max:9|unique:logros,referencia_equipo1',
				'equipo2'      => 'required',
				'referencia2'  => 'required|min:2|max:9|unique:logros,referencia_equipo2',
				'fecha'        => 'required|date_format:"m/d/Y"',
				'hora'         => 'required',
				'paso'         => 'required|min:1|max:3',
			);

			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) {
				Session::flash('successMsj', 'Error!');
				return Redirect::back()
					->withErrors($validator)
					->withInput();
			} else {

					$equipo1     = e(Input::get('equipo1'));
					$referencia1 = e(Input::get('referencia1'));
					$equipo2     = e(Input::get('equipo2'));
					$referencia2 = e(Input::get('referencia2'));
					$pitcher1    = e(Input::get('pitcher1'));
					$pitcher2    = e(Input::get('pitcher2'));
					$pitcher1_text    = e(Input::get('pitcher1_text'));
					$pitcher2_text    = e(Input::get('pitcher2_text'));
					$fecha       = e(Input::get('fecha'));
					$hora        = e(Input::get('hora'));

				if ($equipo1 == $equipo2) {
					Session::flash('alertOn', 'Los equipos no pueden ser iguales');
					return Redirect::back()
					->withInput();
				} elseif ($referencia1 == $referencia2) {
					Session::flash('alertOn', 'Las referencias no pueden ser iguales');
					return Redirect::back()
					->withInput();
				} else {
					if (Logro::where('referencia_equipo1', $referencia1)->count() == 1 or
						Logro::where('referencia_equipo2', $referencia1)->count() == 1 or
						Logro::where('referencia_equipo1', $referencia2)->count() == 1 or
						Logro::where('referencia_equipo2', $referencia2)->count() == 1 ) {

						Session::flash('alertOn', 'La referencia ingresada ya exite dentro del sistema');
						return Redirect::back()
						->withInput();
					} else {
						$fecha = explode('/', $fecha);
						$fecha = $fecha[2].'-'.$fecha[0].'-'.$fecha[1];

						if ($fecha < date('Y-m-d')) {
							Session::flash('alertOn', 'La fecha ingresada, es una fecha pasada.');
							return Redirect::back()
							->withInput();
						} else {
							$cadena = $hora;
							$cadena = strtotime($cadena);
							$cadena = date("H:i:s", $cadena);

							if ($fecha == date('Y-m-d')) {
								if ($cadena<date('H:i:s')) {
									Session::flash('alertOn', 'La hora ingresada, es una hora pasada.');
									return Redirect::back()
									->withInput();
								} else {
									$logro = new Logro;

									$logro->deporte_id = e(Input::get('deporte_id'));
									$logro->liga_id = 	 e(Input::get('liga_id'));
									$logro->equipo1 = $equipo1;
									$logro->equipo2 = $equipo2;
									$logro->referencia_equipo1 = $referencia1;
									$logro->referencia_equipo2 = $referencia2;

									if($pitcher1_text!=null) {
										$logro->pitcher_equipo1text = $pitcher1_text;
										$logro->pitcher_equipo1 = 0;
									} else {
										$logro->pitcher_equipo1 = $pitcher1;
									}

									if($pitcher2_text!=null) {
										$logro->pitcher_equipo2text = $pitcher2_text;
										$logro->pitcher_equipo2 = 0;
									} else {
										$logro->pitcher_equipo2 = $pitcher2;
									}

									$logro->fecha_partido = $fecha;
									$logro->hora_partido = $cadena;

									$logro->save();

									Session::flash('successMsj', 'Logro creado con exito!');
									return Redirect::to('/logros');
								}
							} elseif ($fecha > date('Y-m-d')) {
									$logro = new Logro;

									$logro->deporte_id = e(Input::get('deporte_id'));
									$logro->liga_id = e(Input::get('liga_id'));
									$logro->equipo1 = $equipo1;
									$logro->equipo2 = $equipo2;
									$logro->referencia_equipo1 = $referencia1;
									$logro->referencia_equipo2 = $referencia2;

									if($pitcher1_text!=null) {
										$logro->pitcher_equipo1text = $pitcher1_text;
										$logro->pitcher_equipo1 = 0;
									} else {
										$logro->pitcher_equipo1 = $pitcher1;
									}

									if($pitcher2_text!=null) {
										$logro->pitcher_equipo2text = $pitcher2_text;
										$logro->pitcher_equipo2 = 0;
									} else {
										$logro->pitcher_equipo2 = $pitcher2;
									}

									$logro->fecha_partido = $fecha;
									$logro->hora_partido = $cadena;

									$logro->save();

									Session::flash('successMsj', 'Logro creado con exito!');
									return Redirect::to('/logros');
							}
						}
					}
				}
			}
		}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /logros
	 *
	 * @return Response
	 */
	public function store()
	{

	}

	public function search()
	{
		$rules = array(
				'liga' => 'required|min:1|max:3',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('successMsj', 'No exite logros para la liga seleccionada.!');
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			$fecha2 = explode('/', Input::get('fecha_hoja2'));
			$fecha2 = $fecha2[2].'-'.$fecha2[0].'-'.$fecha2[1];

			$fecha1 = explode('/', Input::get('fecha_hoja1'));
			$fecha1 = $fecha1[2].'-'.$fecha1[0].'-'.$fecha1[1];

			$logros = Logro::where('liga_id', e(Input::get('liga')))->whereBetween('fecha_partido',
				array(e($fecha1), e($fecha2)));

			if ($logros->count() == 0) {
				Session::flash('successMsj', 'No exite logros para la liga seleccionada.!');
				return Redirect::back()
				->withErrors($validator)
				->withInput();
			} else {
				return Redirect::to('/logros/show/'.e(Input::get('liga')).'/'.$fecha1.'/'.$fecha2.'');
			}
		}
	}

	/**
	 * Display the specified resource.
	 * GET /logros/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /logros/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		$rules = array(
			'equipo1'      => 'required',
			'referencia1'  => 'required|min:2|max:9|unique:logros,referencia_equipo1,'.Input::get('logro_id').'',
			'equipo2'      => 'required',
			'referencia2'  => 'required|min:2|max:9|unique:logros,referencia_equipo2,'.Input::get('logro_id').'',
			'fecha'        => 'required|date_format:"m/d/Y"',
			'hora'         => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('successMsj', 'Error en algun campo!');
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

				$equipo1     = e(Input::get('equipo1'));
				$referencia1 = e(Input::get('referencia1'));
				$equipo2     = e(Input::get('equipo2'));
				$referencia2 = e(Input::get('referencia2'));
				$fecha       = e(Input::get('fecha'));
				$hora        = e(Input::get('hora'));

			if ($referencia1 == $referencia2) {
				Session::flash('alertOn', 'Las referencias no pueden ser iguales');
				return Redirect::back()
				->withInput();
			} else {
				$fecha = explode('/', $fecha);
				$fecha = $fecha[2].'-'.$fecha[0].'-'.$fecha[1];

				if ($fecha < date('Y-m-d')) {
					Session::flash('alertOn', 'La fecha ingresada, es una fecha pasada.');
					return Redirect::back()
					->withInput();
				} else {
					$cadena = $hora;
					$cadena = strtotime($cadena);
					$cadena = date("H:i:s", $cadena);

					if ($fecha == date('Y-m-d')) {
						if ($cadena<date('H:i:s')) {
							Session::flash('alertOn', 'La hora ingresada, es una hora pasada.');
							return Redirect::back()
							->withInput();
						} else {
							$logro = Logro::find(Input::get('logro_id'));

							$logro->deporte_id = e(Input::get('deporte_id'));
							$logro->liga_id = e(Input::get('liga_id'));

							if($equipo1!=0)
								$logro->equipo1 = $equipo1;

							if($equipo2 != 0)
								$logro->equipo2 = $equipo2;

							$logro->referencia_equipo1 = $referencia1;
							$logro->referencia_equipo2 = $referencia2;

							$logro->fecha_partido = $fecha;
							$logro->hora_partido = $cadena;

							$logro->save();

							Session::flash('successMsj', 'Logro modificado con exito!');
							return Redirect::to('/logros');
						}
					} elseif ($fecha > date('Y-m-d')) {
							$logro = Logro::find(Input::get('logro_id'));

							$logro->deporte_id = e(Input::get('deporte_id'));
							$logro->liga_id = e(Input::get('liga_id'));

							if($equipo1!=0)
								$logro->equipo1 = $equipo1;

							if($equipo2 != 0)
								$logro->equipo2 = $equipo2;

							$logro->referencia_equipo1 = $referencia1;
							$logro->referencia_equipo2 = $referencia2;

							$logro->fecha_partido = $fecha;
							$logro->hora_partido = $cadena;

							$logro->save();

							Session::flash('successMsj', 'Logro modificado con exito!');
							return Redirect::to('/logros');
					}
				}
			}
		}

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /logros/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$rules = array(
				'id'                           => 'min:1|max:10',
				'completo_aganar_a'            => 'min:1|max:10',
				'completo_aganar_b'            => 'min:1|max:10',
				'completo_runline_a'           => 'min:1|max:10',
				'completo_runline_b'           => 'min:1|max:10',
				'completo_runline_c'           => 'min:1|max:10',
				'completo_runline_d'           => 'min:1|max:10',
				'completo_super_runline_a'     => 'min:1|max:10',
				'completo_super_runline_b'     => 'min:1|max:10',
				'completo_super_runline_c'     => 'min:1|max:10',
				'completo_super_runline_d'     => 'min:1|max:10',
				'completo_altabaja_a'          => 'min:1|max:10',
				'completo_altabaja_b'          => 'min:1|max:10',
				'completo_altabaja_c'          => 'min:1|max:10',
				'mitad_aganar_a'               => 'min:1|max:10',
				'mitad_aganar_b'               => 'min:1|max:10',
				'mitad_runline_a'              => 'min:1|max:10',
				'mitad_runline_b'              => 'min:1|max:10',
				'mitad_runline_c'              => 'min:1|max:10',
				'mitad_runline_d'              => 'min:1|max:10',
				'mitad_altabaja_a'             => 'min:1|max:10',
				'mitad_altabaja_b'             => 'min:1|max:10',
				'mitad_altabaja_c'             => 'min:1|max:10',
				'exoticas_ab_visitante_a'      => 'min:1|max:10',
				'exoticas_ab_visitante_b'      => 'min:1|max:10',
				'exoticas_ab_visitante_c'      => 'min:1|max:10',
				'carreras_primer_inn_a'        => 'min:1|max:10',
				'carreras_primer_inn_b'        => 'min:1|max:10',
				'exoticas_ab_home_a'           => 'min:1|max:10',
				'exoticas_ab_home_b'           => 'min:1|max:10',
				'exoticas_ab_home_c'           => 'min:1|max:10',
				'exoticas_quienanotaprimero_a' => 'min:1|max:10',
				'exoticas_quienanotaprimero_b' => 'min:1|max:10',
				'exoticas_totalche_a'          => 'min:1|max:10',
				'exoticas_totalche_b'          => 'min:1|max:10',
				'completo_empate'              => 'min:1|max:10',
				'mitad_empate'                 => 'min:1|max:10',
				'exoticas_totalche_c'          => 'min:1|max:10'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('successMsj', 'Cometistes algun error al rellenar algun campo!: ');
			Session::flash('alertOn', 'Cometistes algun error al rellenar algun campo!: ');
			return Redirect::back()->withErrors($validator)->withInput();
		} else {
			$logro = Logro::find(e(Input::get('id')));

			$logro->pitcher_equipo1text             = e(Input::get('pitcher_equipo1'));
			$logro->pitcher_equipo2text             = e(Input::get('pitcher_equipo2'));

			$logro->completo_aganar_a             = e(Input::get('completo_aganar_a'));
			$logro->completo_aganar_b             = e(Input::get('completo_aganar_b'));
			$logro->completo_runline_a            = e(Input::get('completo_runline_a'));
			$logro->completo_runline_b            = e(Input::get('completo_runline_b'));
			$logro->completo_runline_c            = e(Input::get('completo_runline_c'));
			$logro->completo_runline_d            = e(Input::get('completo_runline_d'));
			$logro->completo_super_runline_a      = e(Input::get('completo_super_runline_a'));
			$logro->completo_super_runline_b      = e(Input::get('completo_super_runline_b'));
			$logro->completo_super_runline_c      = e(Input::get('completo_super_runline_c'));
			$logro->completo_super_runline_d      = e(Input::get('completo_super_runline_d'));
			$logro->completo_altabaja_a           = e(Input::get('completo_altabaja_a'));
			$logro->completo_altabaja_b           = e(Input::get('completo_altabaja_b'));
			$logro->completo_altabaja_c           = e(Input::get('completo_altabaja_c'));
			$logro->mitad_aganar_a                = e(Input::get('mitad_aganar_a'));
			$logro->mitad_aganar_b                = e(Input::get('mitad_aganar_b'));
			$logro->mitad_runline_a               = e(Input::get('mitad_runline_a'));
			$logro->mitad_runline_b               = e(Input::get('mitad_runline_b'));
			$logro->mitad_runline_c               = e(Input::get('mitad_runline_c'));
			$logro->mitad_runline_d               = e(Input::get('mitad_runline_d'));
			$logro->mitad_altabaja_a              = e(Input::get('mitad_altabaja_a'));
			$logro->mitad_altabaja_b              = e(Input::get('mitad_altabaja_b'));
			$logro->mitad_altabaja_c              = e(Input::get('mitad_altabaja_c'));
			$logro->exoticas_ab_visitante_a       = e(Input::get('exoticas_ab_visitante_a'));
			$logro->exoticas_ab_visitante_b       = e(Input::get('exoticas_ab_visitante_b'));
			$logro->exoticas_ab_visitante_c       = e(Input::get('exoticas_ab_visitante_c'));
			$logro->carreras_primer_inn_a         = e(Input::get('carreras_primer_inn_a'));
			$logro->carreras_primer_inn_b         = e(Input::get('carreras_primer_inn_b'));
			$logro->exoticas_ab_home_a            = e(Input::get('exoticas_ab_home_a'));
			$logro->exoticas_ab_home_b            = e(Input::get('exoticas_ab_home_b'));
			$logro->exoticas_ab_home_c            = e(Input::get('exoticas_ab_home_c'));
			$logro->exoticas_quienanotaprimero_a  = e(Input::get('exoticas_quienanotaprimero_a'));
			$logro->exoticas_quienanotaprimero_b  = e(Input::get('exoticas_quienanotaprimero_b'));
			$logro->exoticas_totalche_a           = e(Input::get('exoticas_totalche_a'));
			$logro->exoticas_totalche_b           = e(Input::get('exoticas_totalche_b'));
			$logro->exoticas_totalche_c           = e(Input::get('exoticas_totalche_c'));
			$logro->mitad_empate                  = e(Input::get('mitad_empate'));
			$logro->completo_empate               = e(Input::get('completo_empate'));

			if ($logro->save()) {
				Session::flash('successMsj', 'Cambios guardados con exito!');
				Session::flash('alertOn', 'Cambios guardados con exito!');
				return Redirect::back();
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /logros/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$logro = Logro::find($id);
		$logro->delete();
		return Redirect::back();
	}

	public function changeState($id)
	{
		$logro = Logro::find($id);
			if($logro->estado == 1)
				$logro->estado = 0;
			else
				$logro->estado = 1;
		$logro->save();
		return Redirect::back();
	}

}
