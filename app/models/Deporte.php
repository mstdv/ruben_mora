<?php

class Deporte extends \Eloquent {
	protected $fillable = [];

	public static function getRef()
	{
		$data = array();
		foreach (Liga::get() as $liga) {
			foreach (Deporte::where('id', $liga->deporte_id)->get() as $deporte) {
				$data[$liga->id] = $deporte->logro_referencia;
			}
		}
		return json_encode($data);
	}

	public static function getInf($id){
		$data = Deporte::where('id',$id)->get();
		return $data[0];
	}


}