<?php

class Equipo extends \Eloquent {
	protected $fillable = [];

	public static function getInf($id){
		$data = Equipo::where('id',$id)->get();
		return $data[0];
	}
}