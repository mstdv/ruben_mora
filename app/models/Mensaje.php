<?php

class Mensaje extends \Eloquent {

	protected $table 	= "mensajes";
	protected $fillable = [
		'de_id_user',
		'para_id',
		'msj'
	];
}