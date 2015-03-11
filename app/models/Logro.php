<?php

class Logro extends \Eloquent {
	protected $fillable = [];
	public static function getInf($id){
		$data = Logro::where('id',$id)->get();
		if ($data->count() == 1) {
			return $data[0];
		}
	}

	public static function getFechaMDY($id){
		$data = Logro::where('id',$id)->get();
		$data = $data[0];
		$fecha = $data->fecha_partido;
		$fecha = explode('-', $fecha);
		$fecha = $fecha[1].'/'.$fecha[2].'/'.$fecha[0];
		return $fecha;
	}

	public static function getHoraHMS($id){
		$data = Logro::where('id',$id)->get();
		$data = $data[0];
		$hora = $data->hora_partido;
		$hora = date("g:i A", strtotime($hora));
		return $hora;
	}
}