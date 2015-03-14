<?php

class GastosTaquilla extends \Eloquent {

	protected $table = 'gastos_taquillas';

	protected $fillable = [
		'tipo_gasto',
		'fecha',
		'n_factura',
		'monto',
		'status'
	];
}