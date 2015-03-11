@extends('panel')

@section('web-titulo')
    @parent
    Gestion de Logros
@stop

@section('mod-titulo')
	Gestion de Logros
@stop

@section('web-contenido')
<div class="row">
<div class="col-lg-12">
	<h3>Seleccione la opcion de su preferencia <br> <small>
		Con las siguientes opciones podra crear nuevos logros para un deporte seleccionado
	</small></h3>

	<a href="{{URL::to('/logros/create/step/1')}}" class="btn btn-default">Crear nuevo juego</a>
	<hr>
	<div class="well">

		<div class="row">
			<div class="col-md-4">

				{{Form::open(['url' => '/logros/search', 'method' => 'POST', 'class' => 'form-horizontal'])}}
				<div class="row">
				<div class="col-md-12">
					<label>Selecciona la liga</label>
					<select name="liga" class="form-control">
					@foreach(Deporte::get() as $deporte)
						<optgroup label="{{$deporte->nombre}}">
						@foreach(Liga::where('deporte_id',$deporte->id)->get() as $liga)
							<option value="{{$liga->id}}">{{$liga->nombre}}</option>
						@endforeach
						</optgroup>
					@endforeach
					</select>
					<p class="text-danger"><b>{{ $errors->first('liga') }}</b></p>


					<label>Rango de fecha</label>
					<div class="row">
					<div class="col-md-6">
						{{Form::text('fecha_hoja1', '', ['class'=>'form-control fecha'])}}
					</div>
					<div class="col-md-6">
						{{Form::text('fecha_hoja2', '', ['class'=>'form-control fecha'])}}
					</div>
					</div>
					<br>
					<button type="submit" class="btn btn-info"><span class="icon16 icomoon-icon-enter white"></span> Desplegar logros para la LIGA seleccionada </button>
				</div>
				</div>
				{{Form::close()}}

			</div>
			<div class="col-md-4">
			{{Form::open(['url' => '/logros/hojas/search', 'method' => 'POST', 'class' => 'form-horizontal'])}}
				<label>Seleccione fecha para generar hojas de logros</label>
				{{Form::text('fecha_hoja', '', ['class'=>'form-control fecha'])}}
				<p class="text-danger"><b>{{ $errors->first('fecha_hoja') }}</b></p>

				<button type="submit" class="btn btn-default"><span class="icon16 icomoon-icon-enter"></span> Desplegar logros para la FECHA seleccionada </button>
			{{Form::close()}}
			</div>
		</div>
	</div>
	<hr>

</div><!-- End .span12 -->
</div><!-- End .row -->
@stop