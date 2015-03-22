@extends("panel")

@section("web-titulo")

	@parent
	Mensajes

@stop

@section('mod-titulo')

	Mensaje: {{$msj->titulo}}

@stop

@section("web-contenido")

	<div class="col-lg-6">

		<h4>Mensaje:</h4>
		<p>
			{{$msj->msj}}
		</p>
	
	</div>

@stop