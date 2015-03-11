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

{{Form::open(['url' => '/logros/hoja/print', 'method' => 'POST', 'class' => 'form-horizontal'])}}
<div class="row">
<div class="col-md-6">
	<label>Selecciona la liga de los equipos que deseea generar su hoja de logros</label>
	<select name="liga" class="form-control">
	<option value="00000" selected="true">Todas las ligas</option>
	@foreach(Deporte::get() as $deporte)
		<optgroup label="{{$deporte->nombre}}">
		@foreach(Liga::where('deporte_id',$deporte->id)->get() as $liga)
			<option value="{{$liga->id}}">{{$liga->nombre}}</option>
		@endforeach
		</optgroup>
	@endforeach
	</select>
	<p class="text-danger"><b>{{ $errors->first('liga') }}</b></p>


</div>
<div class="col-md-2">
	<label class="tip">Desde</label>
	{{Form::text('desde', '', ['class'=>'form-control fecha'])}}
	<p class="text-danger"><b>{{ $errors->first('desde') }}</b></p>
</div>
<div class="col-md-2">
	<label class="tip">Hasta</label>
	{{Form::text('hasta', '', ['class'=>'form-control fecha'])}}
	<p class="text-danger"><b>{{ $errors->first('hasta') }}</b></p>
</div>
<div class="col-md-2">
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