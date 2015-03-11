<?php

class Liga extends \Eloquent {
	protected $fillable = [];

	public static function getInf($id){
		$data = Liga::where('id',$id)->get();
		return $data[0];
	}

	public static function getDeporte($id){
		$data = Liga::where('id',$id)->get();
		$deporte = Deporte::where('id', $data[0]->deporte_id)->get();
		if (strtolower($deporte[0]->nombre) == 'baseball') {
			return 1;
		} else {
			return 0;
		}
	}

	public static function getIdforNombre($nombre)
	{
		$data = Liga::where('nombre',$nombre)->get();
		return $data[0];
	}

	public static function getINombre($nombre)
	{
		$data = Liga::where('nombre',$nombre)->get();
		return $data[0];
	}

}