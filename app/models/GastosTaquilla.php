<?php

class GastosTaquilla extends \Eloquent {

	protected $table = 'gastos_taquillas';

	protected $fillable = [
		'id',
		'user_id',
		'tipo_gasto',
		'fecha',
		'n_factura',
		'monto',
		'status'
	];
}