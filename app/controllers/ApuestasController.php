<?php

class ApuestasController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 * GET /apuestas/create
	 *
	 * @return Response
	 */
	public function create()
	{
		if (Auth::user()->rol == 3) {
			return View::make('apuestas.create');
		} else {
			return Redirect::home();
		}
	}


    /**
     * @param $param
     * @return \Illuminate\Http\RedirectResponse
     */
    public function preCreate($param)
	{
		$logro = explode(',', $param);
		$gg = array($logro[4] => array($logro[4] => $logro));

		// Apuestas iguales
		if (Session::get('apuestas')!=null) {
		foreach(Session::get('apuestas') as $apuesta) {
		  foreach($apuesta as $logro_for) {
		  foreach($logro_for as $data) {
		  	if ($data[4] == $logro[4]) {
		  		Session::flash('alertOn', 'No puede realizar la misma apuesta dos veces.');
		  		return Redirect::back();
		  	}
		  }
		  }
		}
		}

		// Limites
		$limites = Limite::where('user_id', Auth::user()->id)->get();

		$apuestas_count = 0;
		if (!empty(Session::get('apuestas'))) {
		foreach(Session::get('apuestas') as $apuesta) {
		  $apuestas_count += 1;
		}
		}

		$apuestas_count_hembras = 0;
		if (Session::get('apuestas')!=null) {
		foreach(Session::get('apuestas') as $apuesta) {
	    foreach($apuesta as $logro_hem) {
	    foreach($logro_hem as $data) {
	  	if ($data[5] > 0) {
	  		$apuestas_count_hembras += 1;
	  	}
		}
		}
		}
		}

		if ($apuestas_count >= $limites[0]->maximo_parlays) {
	  		Session::flash('alertOn', 'Error de limites: Tu maximo de jugadas por parley es de: '.$limites[0]->maximo_parlays);
	  		return Redirect::back();
		} elseif ($apuestas_count_hembras >= $limites[0]->maximo_hembras) {
				Session::flash('alertOn', 'Error de limites: tu maximo de jugadas (hembras) es de: '.$limites[0]->maximo_hembras);
	  		return Redirect::back();
		}

		if (empty(Session::get('apuestas'))) {
			Session::put('apuestas', [$logro[4] => array($logro[4] => array($logro[4] => $logro))]);
            return Redirect::back();
        } else {
            // Aqui inicia la parte de la validaciones...
            $apuestasConfirmada=array();

            foreach(Session::get('apuestas') as $a){
                foreach($a as $b){
                    foreach($b as $apuesta){
                        $juego = Logro::where('referencia_equipo1', $apuesta[1])->orWhere('referencia_equipo2', $apuesta[1]);
                        if($juego->count() == 1) {
                            $juego = $juego->get();
                            if(isset($apuestasConfirmada[$juego[0]->id]) == true) {
                                array_push($apuestasConfirmada[$juego[0]->id], $apuesta);
                            } else {
                                array_push($apuestasConfirmada, [$juego[0]->id => $apuesta]);
                            }
                        }
                    }
                }
            }

            foreach ($apuestasConfirmada as $a => $b) {
                foreach($b as $e => $f) {
                    foreach($gg as $c => $d){
                        foreach($d as $g => $h){

                            $juego_v = array();
                            $juego_v[1] = Logro::where('referencia_equipo1', $h[1])->orWhere('referencia_equipo2', $h[1]);
                            $juego_v[1] = $juego_v[1]->get();


                            $juego_v[2] = Logro::where('referencia_equipo1', $f[1])->orWhere('referencia_equipo2', $f[1]);
                            $juego_v[2] = $juego_v[2]->get();

                            $baseball = null;
                            foreach (Deporte::get() as $deporte) {
                                if(strtoupper($deporte->nombre) == 'BASEBALL') {
                                    $baseball = $deporte->id;
                                }
                            }

                            $is_baseball = false;
                            if($baseball != null){
                             if( $juego_v[1][0]->deporte_id == $baseball and $juego_v[2][0]->deporte_id == $baseball) {
                                 $is_baseball = true;
                             }
                            }


                            if($is_baseball == false) {

                                if($f[4] == 'A'.$f[1] or $f[4] == 'A5'.$f[1] or $f[4] == 'B'.$f[1] or $f[4] == 'B5'.$f[1]){
                                    if($h[4] == 'A'.$h[1] or $h[4] == 'A5'.$h[1] or $h[4] == 'B'.$h[1] or $h[4] == 'B5'.$h[1]){
                                        $juego[1] = Logro::where('referencia_equipo1', $h[1])->orWhere('referencia_equipo2', $h[1]);
                                        $juego[1] = $juego[1]->get();
                                        $juego[2] = Logro::where('referencia_equipo1', $f[1])->orWhere('referencia_equipo2', $f[1]);
                                        $juego[2] = $juego[2]->get();

                                        if($juego[1][0]->id == $juego[2][0]->id){
                                            Session::flash('alertOn', 'No puedes jugar dos A/B para un mismo juego.');
                                            return Redirect::back();
                                        }
                                    }
                                } else {
                                    if($h[4] == ''.$h[1] or $h[4] == '1'.$h[1] or $h[4] == '2'.$h[1] or
                                        $h[4] == 'E'.$h[1] or $h[4] == '5'.$h[1] or $h[4] == '6'.$h[1] or
                                        $h[4] == 'E5'.$h[1] or $h[4] == 'S'.$h[1] or $h[4] == 'N'.$h[1] or
                                        $h[4] == 'AV'.$h[1] or $h[4] == 'BV'.$h[1] or $h[4] == 'AH'.$h[1] or
                                        $h[4] == 'BH'.$h[1] or $h[4] == 'V'.$h[1] or $h[4] == 'H'.$h[1]){
                                        $juego[1] = Logro::where('referencia_equipo1', $h[1])->orWhere('referencia_equipo2', $h[1]);
                                        $juego[1] = $juego[1]->get();
                                        $juego[2] = Logro::where('referencia_equipo1', $f[1])->orWhere('referencia_equipo2', $f[1]);
                                        $juego[2] = $juego[2]->get();

                                        if($juego[1][0]->id == $juego[2][0]->id){
                                            Session::flash('alertOn', 'Solo puedes hacer una apuesta por A/B con la combinacion actual.');
                                            return Redirect::back();
                                        }
                                    }
                                }

                            } else {

                                if($f[4] == 'A'.$f[1] or $f[4] == 'A5'.$f[1] or $f[4] == 'B'.$f[1] or $f[4] == 'B5'.$f[1]){
                                    if($h[4] == 'A'.$h[1] or $h[4] == 'A5'.$h[1] or $h[4] == 'B'.$h[1] or $h[4] == 'B5'.$h[1]){
                                        $juego[1] = Logro::where('referencia_equipo1', $h[1])->orWhere('referencia_equipo2', $h[1]);
                                        $juego[1] = $juego[1]->get();
                                        $juego[2] = Logro::where('referencia_equipo1', $f[1])->orWhere('referencia_equipo2', $f[1]);
                                        $juego[2] = $juego[2]->get();

                                        if($juego[1][0]->id == $juego[2][0]->id){
                                            Session::flash('alertOn', 'No puedes jugar dos A/B para un mismo juego.');
                                            return Redirect::back();
                                        }
                                    }
                                } else {
                                    if($h[4] == ''.$h[1] or $h[4] == '1'.$h[1] or $h[4] == '2'.$h[1] or
                                        $h[4] == 'E'.$h[1] or $h[4] == '5'.$h[1] or $h[4] == '6'.$h[1] or
                                        $h[4] == 'E5'.$h[1] or $h[4] == 'S'.$h[1] or $h[4] == 'N'.$h[1] or
                                        $h[4] == 'AV'.$h[1] or $h[4] == 'BV'.$h[1] or $h[4] == 'AH'.$h[1] or
                                        $h[4] == 'BH'.$h[1] or $h[4] == 'V'.$h[1] or $h[4] == 'H'.$h[1]){

                                        $juego[1] = Logro::where('referencia_equipo1', $h[1])->orWhere('referencia_equipo2', $h[1]);
                                        $juego[1] = $juego[1]->get();
                                        $juego[2] = Logro::where('referencia_equipo1', $f[1])->orWhere('referencia_equipo2', $f[1]);
                                        $juego[2] = $juego[2]->get();

                                        if($juego[1][0]->id == $juego[2][0]->id){
                                            Session::flash('alertOn', 'Solo puedes hacer una apuesta por A/B con la combinacion actual.');
                                            return Redirect::back();
                                        }
                                    }
                                }

                            }
                        }
                    }
                }
            }

            $apuestas = Session::get('apuestas');
            array_push($apuestas, $gg);
            Session::put('apuestas', $apuestas);
            return Redirect::back();

        }
        // fin

	}

	public function continuar ()
	{
        $limites = Limite::where('user_id', Auth::user()->id)->get();
        $limites = $limites[0];
        $pass = false;

        $contador = 0;
        foreach(Session::get('apuestas') as $a){
            foreach($a as $b){
                foreach($b as $apuesta){
                    $contador+=1;
                }
            }
        }

        $monto = array();
        foreach(Session::get('apuestas') as $a){
            foreach($a as $b){
                foreach($b as $apuesta){
                   array_push($monto,$apuesta[5]);
                }
            }
        }

        $monto_ganar = Apuestas::CalcularParlay($monto, e(Input::get('monto')));

        if($limites->acepta_derecho == 'SI'){
            if($contador < 1) {
                Session::flash('alertOn','El minimo de juegos por parley permitido es de: 1');
                return Redirect::back();
            } elseif(e(Input::get('monto')) > $limites->max_monto_der){
                Session::flash('alertOn','No puede realizar una apuesta que el monto a ganar sea mayor al de su restriccion.');
                return Redirect::back();
            } elseif($monto_ganar > $limites->max_premio){
                Session::flash('alertOn','Ah superado el monto maximo de ganacias por tikets, porfavor verifique sus limites.');
                return Redirect::back();
            } else {
                $pass = true;
            }
        } else {
            if($contador < $limites->minimo_parlays) {
                Session::flash('alertOn','El minimo de juegos por parley permitido es de: '.$limites->minimo_parlays);
                return Redirect::back();
            } elseif(e(Input::get('monto')) > $limites->max_monto_par){
                Session::flash('alertOn','No puede realizar una apuesta que el monto a ganar sea mayor al de su restriccion.');
                return Redirect::back();
            } elseif($monto_ganar > $limites->max_premio){
                Session::flash('alertOn','Ah superado el monto maximo de ganacias por tikets, porfavor verifique sus limites.');
                return Redirect::back();
            } else {
                $pass = true;
            }
        }

        $apuestasConfirmada=array();

        foreach(Session::get('apuestas') as $a){
            foreach($a as $b){
                foreach($b as $apuesta){
                    $juego = Logro::where('referencia_equipo1', $apuesta[1]);
                    if($juego->count() == 1) {
                        $juego = $juego->get();
                        if(array_key_exists('ID:'.$juego[0]->id, $apuestasConfirmada)){
                            array_push($apuestasConfirmada['ID:'.$juego[0]->id], $apuesta);
                        } else {
                            array_push($apuestasConfirmada,['ID:'.$juego[0]->id => $apuesta]);
                        }
                    }

                    $juego = Logro::where('referencia_equipo2', $apuesta[1]);
                    if($juego->count() == 1) {
                        $juego = $juego->get();
                        if(array_key_exists('ID:'.$juego[0]->id, $apuestasConfirmada)){
                            array_push($apuestasConfirmada['ID:'.$juego[0]->id], $apuesta);
                        } else {
                            array_push($apuestasConfirmada,['ID:'.$juego[0]->id => $apuesta]);
                        }
                    }
                }
            }
        }

        /** Validar para beisboll, que solo puedan jugar totalche con ab o quien anota primero.**/

        if($pass == true){
            /*
            array(6) {
              [0]=>
              string(10) "2014-12-18"
              [1]=>
              string(3) "902"
              [2]=>
              string(8) "19:45:31"
              [3]=>
              string(17) "Aguilas del Zulia"
              [4]=>
              string(4) "1902"
              [5]=>
              string(4) "-150"
            }
            */

            // variable que utilizare para validar si todas las validaciones se cumplen, pasar status a true
            $status = false;

//            $restricciones = Restriccion::where('user_id', Auth::user()->id)->get();
//            foreach($apuestasConfirmada as $key => $value){
//            echo var_dump($value);
//            }
//
//            // Validar restricciones
//            foreach($restricciones as $res){
//                echo var_dump($res->restriccion);
//            }

            /* si status es true es decir que: todo esta correcto, y guardamos las jugadas y tiket y venta. */
            // eliminar esta linea despues de hacer las validaciones
            $status = true;
            if($status == true){

                $tiket = new Tiket();
                $tiket->monto = Input::get('monto');
                $tiket->premio = $monto_ganar;
                $tiket->estado = 'PENDIENTE';
                $tiket->pago = 'NO-PAGADO';
                $tiket->fecha_de_apuesta = \Carbon\Carbon::now();
                $tiket->save();
                $id_tiket = $tiket->id;

                $venta = new Ventum();
                $venta->tiket_id = $id_tiket;
                $venta->user_id = Auth::user()->id;
                $venta->fecha_de_venta = \Carbon\Carbon::now();
                $venta->save();

                foreach($apuestasConfirmada as $key => $value){
                foreach($value as $a => $b) {
                    $id_logro = null;
                    $id_logro = $a;
                    $id_logro = explode(':', $id_logro);
                    $id_logro = $id_logro[1];

                    $tiket_jugada = new TiketsJugada();
                    $tiket_jugada->tiket_id = $id_tiket;
                    $tiket_jugada->logro_id = $id_logro;
                    $tiket_jugada->referencia_equipo = $b[1];
                    $tiket_jugada->referencia_jugada = $b[4];
                    $tiket_jugada->logro_calc = $b[5];
                    $tiket_jugada->save();

                }
                }

                // mandar a imprimir IMPORTANTE
                Session::put('apuestas', null);

                Session::flash('alertOn', 'OK');
                return Redirect::back();
            } else {
                Session::flash('alertOn', 'Ocurrio un error al procesar las restricciones con las jugadas actuales del tiket.');
                return Redirect::back();
            }

        } else {
            return Redirect::back();
        }
	}

	public function referencia ()
	{
		$rules = array(
			'referencia'    	=> 'required|alphaNum|min:1|max:20',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('alertOn', 'Solo se permite letras y numeros.');
			return Redirect::back();
		} else {
			$referencia = Input::get('referencia');

				$fecha = Carbon::now()->format('Y-m-d');
				$listLiga = array();
				foreach($u = Deporte::get() as $deporte) {
				  foreach(Logro::where('deporte_id', $deporte->id)->where('fecha_partido', $fecha)->get() as $logro) {
				  foreach(Liga::get() as $liga) {
				    if($liga->id == $logro->liga_id) {
				      array_push($listLiga, $liga->nombre);
				    }
				  }
				}
				}

				$listLiga = array_unique($listLiga);
				$logros_referencias = array();

				foreach($listLiga as $nombre) {
						$logro = Logro::where('liga_id', Liga::getIdforNombre($nombre)->id)->where('fecha_partido', $fecha)->get();
						foreach(Logro::where('liga_id', Liga::getIdforNombre($nombre)->id)->where('fecha_partido', $fecha)->get() as $juego) {
							array_push($logros_referencias, $juego->referencia_equipo1);
							array_push($logros_referencias, $juego->referencia_equipo2);
						}
				}

				$posibles_combinaciones = array();

				foreach ($logros_referencias as $ref) {
					array_push($posibles_combinaciones, $ref.'|'.''.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'1'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'2'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'A'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'B'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'E'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'5'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'6'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'A5'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'B5'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'E5'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'S'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'N'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'AV'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'BV'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'AH'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'BH'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'V'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'H'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'O'.$ref);
					array_push($posibles_combinaciones, $ref.'|'.'U'.$ref);
				}

				$status = 0;
				$referencia_esp = 0;

				foreach ($posibles_combinaciones as $comb) {
					$combinacion = explode('|', $comb);
					if ($referencia == $combinacion[1]) {
						$status = 1;
						$referencia_esp = $combinacion[0];
					}
				}

				if ($status==1) {
					$logro = Logro::where('referencia_equipo1', $referencia_esp)->orWhere('referencia_equipo2', $referencia_esp)->get();
					$logro = $logro[0];
					$inflogro = 0;

					if ($referencia_esp == $logro->referencia_equipo1) {
						$nombre_equipo = Equipo::getInf($logro->equipo1)->nombre;

							if(''.$referencia_esp == $referencia) {
								$inflogro = $logro->completo_aganar_a;
							}	elseif('1'.$referencia_esp == $referencia) {
								$inflogro = $logro->completo_runline_b;
							}	elseif('2'.$referencia_esp == $referencia) {
								$inflogro = $logro->completo_super_runline_b;
							}	elseif('A'.$referencia_esp == $referencia) {
								$inflogro = $logro->completo_altabaja_b;
							}	elseif('B'.$referencia_esp == $referencia) {
								$inflogro = $logro->completo_altabaja_c;
							}	elseif('E'.$referencia_esp == $referencia) {
								$inflogro = $logro->completo_empate;
							}	elseif('5'.$referencia_esp == $referencia) {
								$inflogro = $logro->mitad_aganar_a;
							}	elseif('6'.$referencia_esp == $referencia) {
								$inflogro = $logro->mitad_runline_b;
							}	elseif('A5'.$referencia_esp == $referencia) {
								$inflogro = $logro->mitad_altabaja_b;
							}	elseif('B5'.$referencia_esp == $referencia) {
								$inflogro = $logro->mitad_altabaja_c;
							}	elseif('E5'.$referencia_esp == $referencia) {
								$inflogro = $logro->mitad_empate;
							}	elseif('S'.$referencia_esp == $referencia) {
								$inflogro = $logro->carreras_primer_inn_a;
							}	elseif('N'.$referencia_esp == $referencia) {
								$inflogro = $logro->carreras_primer_inn_b;
							}	elseif('AV'.$referencia_esp == $referencia) {
								$inflogro = $logro->exoticas_ab_visitante_b;
							}	elseif('BV'.$referencia_esp == $referencia) {
								$inflogro = $logro->exoticas_ab_visitante_c;
							}	elseif('AH'.$referencia_esp == $referencia) {
								$inflogro = $logro->exoticas_ab_home_b;
							}	elseif('BH'.$referencia_esp == $referencia) {
								$inflogro = $logro->exoticas_ab_home_c;
							}	elseif('V'.$referencia_esp == $referencia) {
								$inflogro = $logro->exoticas_quienanotaprimero_a;
							}	elseif('H'.$referencia_esp == $referencia) {
								$inflogro = $logro->exoticas_quienanotaprimero_b;
							}	elseif('O'.$referencia_esp == $referencia) {
								$inflogro = $logro->exoticas_totalche_b;
							}	elseif('U'.$referencia_esp == $referencia) {
								$inflogro = $logro->exoticas_totalche_c;
							}

					} else {
						$nombre_equipo = Equipo::getInf($logro->equipo2)->nombre;

							if(''.$referencia_esp == $referencia) {
								$inflogro = $logro->completo_aganar_b;
							}	elseif('1'.$referencia_esp == $referencia) {
								$inflogro = $logro->completo_runline_d;
							}	elseif('2'.$referencia_esp == $referencia) {
								$inflogro = $logro->completo_super_runline_d;
							}	elseif('A'.$referencia_esp == $referencia) {
								$inflogro = $logro->completo_altabaja_b;
							}	elseif('B'.$referencia_esp == $referencia) {
								$inflogro = $logro->completo_altabaja_c;
							}	elseif('E'.$referencia_esp == $referencia) {
								$inflogro = $logro->completo_empate;
							}	elseif('5'.$referencia_esp == $referencia) {
								$inflogro = $logro->mitad_aganar_b;
							}	elseif('6'.$referencia_esp == $referencia) {
								$inflogro = $logro->mitad_runline_d;
							}	elseif('A5'.$referencia_esp == $referencia) {
								$inflogro = $logro->mitad_altabaja_b;
							}	elseif('B5'.$referencia_esp == $referencia) {
								$inflogro = $logro->mitad_altabaja_c;
							}	elseif('E5'.$referencia_esp == $referencia) {
								$inflogro = $logro->mitad_empate;
							}	elseif('S'.$referencia_esp == $referencia) {
								$inflogro = $logro->carreras_primer_inn_a;
							}	elseif('N'.$referencia_esp == $referencia) {
								$inflogro = $logro->carreras_primer_inn_b;
							}	elseif('AV'.$referencia_esp == $referencia) {
								$inflogro = $logro->exoticas_ab_visitante_b;
							}	elseif('BV'.$referencia_esp == $referencia) {
								$inflogro = $logro->exoticas_ab_visitante_c;
							}	elseif('AH'.$referencia_esp == $referencia) {
								$inflogro = $logro->exoticas_ab_home_b;
							}	elseif('BH'.$referencia_esp == $referencia) {
								$inflogro = $logro->exoticas_ab_home_c;
							}	elseif('V'.$referencia_esp == $referencia) {
								$inflogro = $logro->exoticas_quienanotaprimero_a;
							}	elseif('H'.$referencia_esp == $referencia) {
								$inflogro = $logro->exoticas_quienanotaprimero_b;
							}	elseif('O'.$referencia_esp == $referencia) {
								$inflogro = $logro->exoticas_totalche_b;
							}	elseif('U'.$referencia_esp == $referencia) {
								$inflogro = $logro->exoticas_totalche_c;
							}

					}

					$new_logro = array(
                     $logro->fecha_partido,
                     $referencia_esp,
                     $logro->hora_partido,
                     $nombre_equipo,
                     $referencia,
                     $inflogro);

                    if (empty(Session::get('apuestas'))) {
                        Session::put('apuestas', [$new_logro[4] => array($new_logro[4] => array($new_logro[4] => $new_logro))]);
                        return Redirect::back();
                    } else {

                        $gg = array($new_logro[4] => array($new_logro[4] => $new_logro));

                        // Aqui inicia la parte de la validaciones...
                        $apuestasConfirmada=array();

                        foreach(Session::get('apuestas') as $a){
                            foreach($a as $b){
                                foreach($b as $apuesta){
                                    $juego = Logro::where('referencia_equipo1', $apuesta[1])->orWhere('referencia_equipo2', $apuesta[1]);
                                    if($juego->count() == 1) {
                                        $juego = $juego->get();
                                        if(isset($apuestasConfirmada[$juego[0]->id]) == true) {
                                            array_push($apuestasConfirmada[$juego[0]->id], $apuesta);
                                        } else {
                                            array_push($apuestasConfirmada, [$juego[0]->id => $apuesta]);
                                        }
                                    }
                                }
                            }
                        }


                        foreach ($apuestasConfirmada as $a => $b) {
                            foreach($b as $e => $f) {
                                foreach($gg as $c => $d){
                                    foreach($d as $g => $h){

                                        $juego_v = array();
                                        $juego_v[1] = Logro::where('referencia_equipo1', $h[1])->orWhere('referencia_equipo2', $h[1]);
                                        $juego_v[1] = $juego_v[1]->get();

                                        $juego_v[2] = Logro::where('referencia_equipo1', $f[1])->orWhere('referencia_equipo2', $f[1]);
                                        $juego_v[2] = $juego_v[2]->get();

                                        $baseball = null;
                                        foreach (Deporte::get() as $deporte) {
                                            if(strtoupper($deporte->nombre) == 'BASEBALL') {
                                                $baseball = $deporte->id;
                                            }
                                        }


                                        $is_baseball = false;
                                        if($baseball != null){
                                            if( $juego_v[1][0]->deporte_id == $baseball and $juego_v[2][0]->deporte_id == $baseball) {
                                                $is_baseball = true;
                                            }
                                        }


                                        if($is_baseball == false) {

                                            if($f[4] == 'A'.$f[1] or $f[4] == 'A5'.$f[1] or $f[4] == 'B'.$f[1] or $f[4] == 'B5'.$f[1]){
                                                if($h[4] == 'A'.$h[1] or $h[4] == 'A5'.$h[1] or $h[4] == 'B'.$h[1] or $h[4] == 'B5'.$h[1]){
                                                    $juego[1] = Logro::where('referencia_equipo1', $h[1])->orWhere('referencia_equipo2', $h[1]);
                                                    $juego[1] = $juego[1]->get();
                                                    $juego[2] = Logro::where('referencia_equipo1', $f[1])->orWhere('referencia_equipo2', $f[1]);
                                                    $juego[2] = $juego[2]->get();

                                                    if($juego[1][0]->id == $juego[2][0]->id){
                                                        Session::flash('alertOn', 'No puedes jugar dos A/B para un mismo juego.');
                                                        return Redirect::back();
                                                    }
                                                }
                                            } else {
                                                if($h[4] == ''.$h[1] or $h[4] == '1'.$h[1] or $h[4] == '2'.$h[1] or
                                                    $h[4] == 'E'.$h[1] or $h[4] == '5'.$h[1] or $h[4] == '6'.$h[1] or
                                                    $h[4] == 'E5'.$h[1] or $h[4] == 'S'.$h[1] or $h[4] == 'N'.$h[1] or
                                                    $h[4] == 'AV'.$h[1] or $h[4] == 'BV'.$h[1] or $h[4] == 'AH'.$h[1] or
                                                    $h[4] == 'BH'.$h[1] or $h[4] == 'V'.$h[1] or $h[4] == 'H'.$h[1]){
                                                    $juego[1] = Logro::where('referencia_equipo1', $h[1])->orWhere('referencia_equipo2', $h[1]);
                                                    $juego[1] = $juego[1]->get();
                                                    $juego[2] = Logro::where('referencia_equipo1', $f[1])->orWhere('referencia_equipo2', $f[1]);
                                                    $juego[2] = $juego[2]->get();

                                                    if($juego[1][0]->id == $juego[2][0]->id){
                                                        Session::flash('alertOn', 'Solo puedes hacer una apuesta por A/B con la combinacion actual.');
                                                        return Redirect::back();
                                                    }
                                                }
                                            }

                                        } else {

                                            if($f[4] == 'A'.$f[1] or $f[4] == 'A5'.$f[1] or $f[4] == 'B'.$f[1] or $f[4] == 'B5'.$f[1]){
                                                if($h[4] == 'A'.$h[1] or $h[4] == 'A5'.$h[1] or $h[4] == 'B'.$h[1] or $h[4] == 'B5'.$h[1]){
                                                    $juego[1] = Logro::where('referencia_equipo1', $h[1])->orWhere('referencia_equipo2', $h[1]);
                                                    $juego[1] = $juego[1]->get();
                                                    $juego[2] = Logro::where('referencia_equipo1', $f[1])->orWhere('referencia_equipo2', $f[1]);
                                                    $juego[2] = $juego[2]->get();

                                                    if($juego[1][0]->id == $juego[2][0]->id){
                                                        Session::flash('alertOn', 'No puedes jugar dos A/B para un mismo juego.');
                                                        return Redirect::back();
                                                    }
                                                }
                                            } else {
                                                if($h[4] == ''.$h[1] or $h[4] == '1'.$h[1] or $h[4] == '2'.$h[1] or
                                                    $h[4] == 'E'.$h[1] or $h[4] == '5'.$h[1] or $h[4] == '6'.$h[1] or
                                                    $h[4] == 'E5'.$h[1] or $h[4] == 'S'.$h[1] or $h[4] == 'N'.$h[1] or
                                                    $h[4] == 'AV'.$h[1] or $h[4] == 'BV'.$h[1] or $h[4] == 'AH'.$h[1] or
                                                    $h[4] == 'BH'.$h[1] or $h[4] == 'V'.$h[1] or $h[4] == 'H'.$h[1]){

                                                    $juego[1] = Logro::where('referencia_equipo1', $h[1])->orWhere('referencia_equipo2', $h[1]);
                                                    $juego[1] = $juego[1]->get();
                                                    $juego[2] = Logro::where('referencia_equipo1', $f[1])->orWhere('referencia_equipo2', $f[1]);
                                                    $juego[2] = $juego[2]->get();

                                                    if($juego[1][0]->id == $juego[2][0]->id){
                                                        Session::flash('alertOn', 'Solo puedes hacer una apuesta por A/B con la combinacion actual.');
                                                        return Redirect::back();
                                                    }
                                                }
                                            }

                                        }
                                    }
                                }
                            }
                        }

                        $apuestas = Session::get('apuestas');
                        array_push($apuestas, $gg);
                        Session::put('apuestas', $apuestas);
                        return Redirect::back();

                    }

					$ll = array($new_logro[4] => array($new_logro[4] => $new_logro));

					if (empty(Session::get('apuestas'))) {
						Session::put('apuestas', [$new_logro[4] => array($new_logro[4] => array($new_logro[4] => $new_logro))]);
					} else {
						$apuestas = Session::get('apuestas');
						array_push($apuestas, $ll);
						Session::put('apuestas', $apuestas);
					}



					Session::flash('redirect', URL::to('/apuestas/create'));
					return Redirect::back();
				} else {
					Session::flash('successMsj', 'Referencia no encontrada, porfavor verifique eh intente de nuevo.');
					return Redirect::back();
				}


		}
    }



}