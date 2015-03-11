@extends('panel')

@section('web-titulo')
    @parent
    Hoja de logros
@stop

@section('mod-titulo')
	Hoja de logros
@stop

@section('web-contenido')
<div class="row">
<div class="col-lg-12">
	<h3>Seleccione la opcion de su preferencia <br> <small>
		Con las siguientes opciones podra generar la hoja de logro para una fecha estipulada.
	</small></h3>

<hr>
{{Form::open(['url' => '/logros/hojas/print', 'method' => 'POST', 'class' => 'form-horizontal'])}}
<div class="row">
	<div class="col-md-4">
	<label>Seleccione la ligas que desea imprimir</label>
	<ul class="list-group">
	<div id="listado" style="display:none;"></div>

	<?php $ligas = array(); ?>
	@foreach(Logro::where('fecha_partido', $fecha)->get() as $logro)
		<?php array_push($ligas, $logro->liga_id); ?>
	@endforeach
	<?php $ligas = array_unique($ligas); ?>

	@foreach($ligas as $liga)
	  <li class="list-group-item">
	    <label id="liga_{{$liga}}">
	    <span class="badge" style="background:transparent !important; margin: -4px 10px 0px 0px;">
	    	<input value="{{$liga}}" id="liga_{{$liga}}" type="checkbox">
	    </span>

	    	{{Liga::getInf($liga)->nombre}}
	    </label>
	  </li>

	<script  type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>
	$('input#liga_{{$liga}}').click(function(){
		if($('input#liga_{{$liga}}').prop('checked')==true) {
			var liga_id = $('input#liga_{{$liga}}').val();
			var liga_nombre = "{{Liga::getInf($liga)->nombre}}";
			var contenido = '<div class="label label-success liga_{{$liga}}" style="margin:5px 5px 0px 0px">'+liga_nombre+',</div>';
			$('div#listado').append(contenido);
			$('input#ligas_list').val($('div#listado').text());
		} else {
			$('div.label-success.liga_{{$liga}}').remove();
			$('input#ligas_list').val($('div#listado').text());
		}
	});
	</script>
	@endforeach

	<input name="ligas_list" type="hidden" id="ligas_list">
	</ul>


	</div>
	<div class="col-md-4">
		<label>Seleccione las opciones a imprimir</label>
		<ul class="list-group">

		@for($i=1; $i<=4; $i++)
			<li class="list-group-item">
		    <label for="op_{{$i}}">
			    <span class="badge" style="background:transparent !important; margin: -4px 10px 0px 0px;">
			    	<input id="op_{{$i}}" value="{{$i}}" type="checkbox" class="op">
			    </span>
				@if($i==1)
			   		Juego Completo
		  		@elseif($i==2)
					Completo + Mitad
		  		@elseif($i==3)
					Completo + SuperRunline
		  		@elseif($i==4)
					Completo + Exoticas
		  		@endif
	  		</label>
	  		</li>

			<script>
			$('input#op_{{$i}}').click(function(){
				if($('input#op_{{$i}}').prop('checked')==true) {
					$('div#listado_div').append('<span class="opc_{{$i}}">'+$('input#op_{{$i}}').val()+'<span>,');
					$('input#op_list').val($('div#listado_div').text());
				} else {
					$('span.opc_{{$i}}').remove();
					$('input#op_list').val($('div#listado_div').text());
				}
			});
			</script>

		@endfor

		</ul>
		<!-- Realizar un for donde muestre las 5 opciones con sus respectivos js debajo, para que funcione bien -->


		<div id="listado_div" style="display:none;"></div>
		<input name="op_list" type="hidden" id="op_list">
		<input name="fecha" type="hidden" value="{{$fecha}}">
	</div>
	<div class="col-md-4">

		<label>Imprimir con:</label>
		{{Form::select('tipo', ['0' => 'impresora', '1' => 'tikera'], '', ['class' => 'form-control'])}}
		<p class="text-danger"><b>{{ $errors->first('tipo') }}</b></p>

	</div>


</div>

<button type="submit" class="btn btn-info"><span class="icon16 icomoon-icon-enter white"></span> Generar hoja </button>
{{Form::close()}}

</div><!-- End .span12 -->
</div><!-- End .row -->
@stop