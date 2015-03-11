<?php

class Pitcher extends \Eloquent {
	protected $fillable = [];
	public static function getInf($id){
		$data = Pitcher::where('id',$id)->get();
		if ($data->count() == 1) {
			return $data[0];
		}
	}
}