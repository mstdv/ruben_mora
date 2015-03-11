<?php

class Resultado extends \Eloquent {
	protected $fillable = [];

	public static function getInf($logro){
		$data = Resultado::where('logro_id',$logro)->get();

		if ($data->count() == 1) {
			return $data[0];
		}
	}

	public static function resultadoExist($logro)
	{
		$resultado=Resultado::where('logro_id', $logro);
		if ($resultado->count() == 1) {
			return true;
		} else {
			return false;
		}
	}

    public static function information($data)
    {
        $logro = Logro::where('referencia_equipo1', $data->referencia_equipo)
            ->orWhere('referencia_equipo2', $data->referencia_equipo)
            ->take(1)
            ->get();

        $estado_tiket = '--';

        $equipo = null;

        $equipo = Logro::where('referencia_equipo1', $data->referencia_equipo)
            ->count();

        if($equipo == 1) {
            $equipo = 1;
        } else {
            $equipo = 2;
        }

        $logro = $logro[0];

        $resultado = Resultado::where('logro_id', $logro->id)
            ->take(1)
            ->get();

        if(Resultado::where('logro_id', $logro->id)->count() == 1) {
            $resultado = $resultado[0];

        if($data->referencia_jugada == ''.$data->referencia_equipo   ){
            // COMPLETO A GANAR
            if($resultado->completo_a == $resultado->completo_b) {
                $estado_tiket = 'EMPATE <b>(PERDEDOR)</b>';
            } elseif($resultado->completo_a > $resultado->completo_b) {
                if ($equipo == 1) {
                    $estado_tiket = 'GANADOR';
                } else {
                    $estado_tiket = 'PERDEDOR';
                }
            } else {
                if ($equipo == 2) {
                    $estado_tiket = 'GANADOR';
                } else {
                    $estado_tiket = 'PERDEDOR';
                }
            }
        } elseif($data->referencia_jugada == '1'.$data->referencia_equipo  ){
            // RUNLINE COMPLETO
            // MACHO: - HEMBRA: +
            if($equipo == 1) {
                $run = $logro->completo_runline_a;
                if($run < 0){
                    // MACHO: -
                    $r1 = $resultado->completo_a + round($logro->completo_runline_b);

                    if($r1 > $resultado->completo_b) {
                        $r2 = $r1 - $resultado->completo_b;
                        if($r2>=2){
                            $estado_tiket = 'GANADOR';
                        } else {
                            $estado_tiket = 'PERDEDOR';
                        }
                    } else {
                        $estado_tiket = 'PERDEDOR';
                    }

                } else {
                    // HEMBRA: +
                    if($resultado->completo_a > $resultado->completo_b){
                        $estado_tiket = 'GANADOR';
                    } else {
                        $r = $resultado->completo_b - $resultado->completo_a;
                        if($r == 1){
                            $estado_tiket = 'GANADOR';
                        } else {
                            $estado_tiket = 'PERDEDOR';
                        }
                    }
                }
            } else {
                $run = $logro->completo_runline_b;
                if($run < 0){
                    // MACHO: -
                    $r1 = $resultado->completo_b + round($logro->completo_runline_d);

                    if($r1 > $resultado->completo_a) {
                        $r2 = $r1 - $resultado->completo_a;
                        if($r2>=2){
                            $estado_tiket = 'GANADOR';
                        } else {
                            $estado_tiket = 'PERDEDOR';
                        }
                    } else {
                        $estado_tiket = 'PERDEDOR';
                    }
                } else {
                    // HEMBRA: +
                    if($resultado->completo_b > $resultado->completo_a){
                        $estado_tiket = 'GANADOR';
                    } else {
                        $r = $resultado->completo_a - $resultado->completo_b;
                        if($r == 1){
                            $estado_tiket = 'GANADOR';
                        } else {
                            $estado_tiket = 'PERDEDOR';
                        }
                    }
                }
            }
        } elseif($data->referencia_jugada == 'E'.$data->referencia_equipo  ){
            if($resultado->completo_a == $resultado->completo_b){
                $estado_tiket = 'GANADOR';
            } else {
                $estado_tiket = 'PERDEDOR';
            }
        } elseif($data->referencia_jugada == '5'.$data->referencia_equipo  ){
            // COMPLETO A GANAR
            if($resultado->mitad_a == $resultado->mitad_b) {
                $estado_tiket = 'EMPATE <b>(PERDEDOR)</b>';
            } elseif($resultado->mitad_a > $resultado->mitad_b) {
                if ($equipo == 1) {
                    $estado_tiket = 'GANADOR';
                } else {
                    $estado_tiket = 'PERDEDOR';
                }
            } else {
                if ($equipo == 2) {
                    $estado_tiket = 'GANADOR';
                } else {
                    $estado_tiket = 'PERDEDOR';
                }
            }
        } elseif($data->referencia_jugada == '6'.$data->referencia_equipo  ){
            // RUNLINE MITAD
            // MACHO: - HEMBRA: +
            if($equipo == 1) {
                $run = $logro->mitad_runline_a;
                if($run < 0){
                    // MACHO: -
                    $r1 = $resultado->mitad_a + round($logro->mitad_runline_b);

                    if($r1 > $resultado->mitad_b) {
                        $r2 = $r1 - $resultado->mitad_b;
                        if($r2>=2){
                            $estado_tiket = 'GANADOR';
                        } else {
                            $estado_tiket = 'PERDEDOR';
                        }
                    } else {
                        $estado_tiket = 'PERDEDOR';
                    }

                } else {
                    // HEMBRA: +
                    if($resultado->mitad_a > $resultado->mitad_b){
                        $estado_tiket = 'GANADOR';
                    } else {
                        $r = $resultado->mitad_b - $resultado->mitad_a;
                        if($r == 1){
                            $estado_tiket = 'GANADOR';
                        } else {
                            $estado_tiket = 'PERDEDOR';
                        }
                    }
                }
            } else {
                $run = $logro->mitad_runline_b;
                if($run < 0){
                    // MACHO: -
                    $r1 = $resultado->mitad_b + round($logro->mitad_runline_d);

                    if($r1 > $resultado->mitad_a) {
                        $r2 = $r1 - $resultado->mitad_a;
                        if($r2>=2){
                            $estado_tiket = 'GANADOR';
                        } else {
                            $estado_tiket = 'PERDEDOR';
                        }
                    } else {
                        $estado_tiket = 'PERDEDOR';
                    }
                } else {
                    // HEMBRA: +
                    if($resultado->mitad_b > $resultado->mitad_a){
                        $estado_tiket = 'GANADOR';
                    } else {
                        $r = $resultado->mitad_a - $resultado->mitad_b;
                        if($r == 1){
                            $estado_tiket = 'GANADOR';
                        } else {
                            $estado_tiket = 'PERDEDOR';
                        }
                    }
                }
            }
        } elseif($data->referencia_jugada == 'E5'.$data->referencia_equipo ){
            if($resultado->mitad_a == $resultado->mitad_b){
                $estado_tiket = 'GANADOR';
            } else {
                $estado_tiket = 'PERDEDOR';
            }
        } elseif($data->referencia_jugada == 'S'.$data->referencia_equipo  ){
            if($resultado->carreras_primer_inn == 1){
                $estado_tiket = 'GANADOR';
            } else {
                $estado_tiket = 'PERDEDOR';
            }
        } elseif($data->referencia_jugada == 'N'.$data->referencia_equipo  ){
            if($resultado->carreras_primer_inn == 0){
                $estado_tiket = 'GANADOR';
            } else {
                $estado_tiket = 'PERDEDOR';
            }
        } elseif($data->referencia_jugada == 'V'.$data->referencia_equipo  ){
            if($resultado->exoticas_quienanotaprimero == 1){
                $estado_tiket = 'GANADOR';
            } else {
                $estado_tiket = 'PERDEDOR';
            }
        } elseif($data->referencia_jugada == 'H'.$data->referencia_equipo  ){
            if($resultado->exoticas_quienanotaprimero == 0){
                $estado_tiket = 'GANADOR';
            } else {
                $estado_tiket = 'PERDEDOR';
            }
        } elseif($data->referencia_jugada == 'A'.$data->referencia_equipo  ){
            $ab = ['ab' => $logro->completo_altabaja_a];

            $ab['a'] = round($logro->completo_altabaja_a);

            $es = 'alta';

            $resultado_final = $resultado->completo_a + $resultado->completo_b;

            if($es == 'alta') {
                if ($resultado_final >= ($ab['a']+1)) {
                    $estado_tiket = 'GANADOR';
                }

                if ($resultado_final == $ab['a']) {
                    $estado_tiket = 'ANULADO';
                }

                if ($resultado_final <= ($ab['a']-1)) {
                    $estado_tiket = 'PERDEDOR';
                }
            }
        } elseif($data->referencia_jugada == 'A5'.$data->referencia_equipo ){

            $ab = ['ab' => $logro->mitad_altabaja_a];

            $ab['a'] = round($logro->mitad_altabaja_a);

            $es = 'alta';

            $resultado_final = $resultado->mitad_a + $resultado->mitad_b;

            if($es == 'alta') {
                if ($resultado_final >= ($ab['a']+1)) {
                    $estado_tiket = 'GANADOR';
                }

                if ($resultado_final == $ab['a']) {
                    $estado_tiket = 'ANULADO';
                }

                if ($resultado_final <= ($ab['a']-1)) {
                    $estado_tiket = 'PERDEDOR';
                }
            }

        } elseif($data->referencia_jugada == 'B'.$data->referencia_equipo  ){
            $ab = ['ab' => $logro->completo_altabaja_a];

            $ab['b'] = round($logro->completo_altabaja_a);

            $es = 'baja';

            $resultado_final = $resultado->completo_a + $resultado->completo_b;

            if($es == 'baja') {
                if ($resultado_final <= ($ab['b']+1)) {
                    $estado_tiket = 'GANADOR';
                }

                if ($resultado_final == $ab['b']) {
                    $estado_tiket = 'ANULADO';
                }

                if ($resultado_final >= ($ab['b']-1)) {
                    $estado_tiket = 'PERDEDOR';
                }
            }
        } elseif($data->referencia_jugada == 'B5'.$data->referencia_equipo ){
            $ab = ['ab' => $logro->mitad_altabaja_a];

            $ab['b'] = round($logro->mitad_altabaja_a);

            $es = 'baja';

            $resultado_final = $resultado->mitad_a + $resultado->mitad_b;

            if($es == 'baja') {
                if ($resultado_final <= ($ab['b']+1)) {
                    $estado_tiket = 'GANADOR';
                }

                if ($resultado_final == $ab['b']) {
                    $estado_tiket = 'ANULADO';
                }

                if ($resultado_final >= ($ab['b']-1)) {
                    $estado_tiket = 'PERDEDOR';
                }
            }
        } elseif($data->referencia_jugada == 'O'.$data->referencia_equipo  ){

            if($logro->exoticas_totalche_a > $resultado->exoticas_totalche){
                $estado_tiket = 'PERDEDOR';
            }

            if($logro->exoticas_totalche_a < $resultado->exoticas_totalche){
                $estado_tiket = 'GANADOR';
            }

            if($logro->exoticas_totalche_a == $resultado->exoticas_totalche){
                $estado_tiket = 'ANULADO';
            }

        } elseif($data->referencia_jugada == 'U'.$data->referencia_equipo  ){

            if($logro->exoticas_totalche_a < $resultado->exoticas_totalche){
                $estado_tiket = 'PERDEDOR';
            }

            if($logro->exoticas_totalche_a > $resultado->exoticas_totalche){
                $estado_tiket = 'GANADOR';
            }

            if($logro->exoticas_totalche_a == $resultado->exoticas_totalche){
                $estado_tiket = 'ANULADO';
            }
        }

        } else {
            $estado_tiket = 'RESULTADOS PENDIENTES';
        }

        return View::make('tikets_jugadas.show', ['jugada' => $data, 'resultado' => $estado_tiket]);
    }

}