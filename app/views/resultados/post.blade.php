@extends('panel')

@section('web-titulo')
    @parent
    Gestion de Resultados
@stop

@section('mod-titulo')
	Gestion de Resultados
@stop

@section('web-contenido')

<style>
	.dd {
		text-align: center;
	}

	.formradio .xx {
		float: left;
		display: inline-block;
	}


</style>

<div class="row">
<div class="col-lg-12">

	<h3>Juegos para la fecha seleccionada</h3>
	<div class="well">
		<p class="text-warning">
			Cada uno de los resultados que ve a continuación son los juegos para la fecha que selecciono, al momento de presionar guardar cambios se estaría creando automáticamente el resultado para ese partido, a su vez también puedo modificar estos datos cambiando los valores como tal.
		</p>
	</div>
	<table class="table table-striped" width="500px">
	@foreach($logro as $logrodata)

			@if(Resultado::resultadoExist($logrodata->id) == true)
				<?php $resultado_data = Resultado::getInf($logrodata->id); ?>
			@else
				<?php $resultado_data = null; ?>
			@endif

		@if(strtoupper(Deporte::getInf($logrodata->deporte_id)->nombre) == 'BASEBALL')
			@include('resultados.deporte.baseball',['logro'=>$logrodata, 'liga'=>$liga, 'resultado'=>$resultado_data])
		@else
			@include('resultados.deporte.no-baseball',['logro'=>$logrodata, 'liga'=>$liga, 'resultado'=>$resultado_data])
		@endif
	@endforeach
	</table>

</div><!-- End .span12 -->
</div><!-- End .row -->
@stop