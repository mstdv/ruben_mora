<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Grupo extends Eloquent {

	protected $table = 'grupos';

	public static function getInf($id){
		$data = Grupo::where('id',$id)->get();
		return $data[0];
	}

}
