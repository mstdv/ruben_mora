@extends('panel')

@section('web-titulo')
    @parent
    Gestion de Resultados
@stop

@section('mod-titulo')
	Gestion de Resultados
@stop

@section('web-contenido')
<div class="row">
<div class="col-lg-12">

	<h3>Selecciona la opcion adecuada</h3>

	<div class="row">
		<div class="col-lg-6">
			<h5>Gestionar resultados para logros (juegos) ya publicados.</h5>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			{{Form::open(['url' => '/resultados/find', 'method' => 'post', 'class' => 'form-horizontal'])}}
		<div class="row">
			<div class="col-lg-6">

				{{Form::label('fecha', 'Fecha')}}
				{{Form::text('fecha', '', ['class'=>'form-control' , 'id' => 'fecha2'] )}}

			</div>
			<div class="col-lg-6">
				{{Form::label('liga', 'Liga') }}
				<select name="liga" class="form-control">
				@foreach(Deporte::get() as $deporte)
					<optgroup label="{{$deporte->nombre}}">
					@foreach(Liga::where('deporte_id',$deporte->id)->get() as $liga)
						<option value="{{$liga->id}}">{{$liga->nombre}}</option>
					@endforeach
					</optgroup>
				@endforeach
				</select>
			</div>

		</div>
			<br>
			<button type="submit" class="btn btn-default btn-block">Buscar y publicar</button>
			{{Form::close()}}

			<br>
			<div class="well">
				El siguiente modulo te ayudara a gestionar todos los resultados de los juegos publicados anteriormente, recuerda que la fecha que se coloca en el formulario anteriror es la fecha de comienzo del juego.
			</div>
		</div>
	</div>


</div><!-- End .span12 -->
</div><!-- End .row -->
@stop