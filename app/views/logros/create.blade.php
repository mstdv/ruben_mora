@extends('panel')

@section('web-titulo')
    @parent
    Crear nuevo juego
@stop

@section('mod-titulo')
	Crear nuevo juego
@stop

@section('web-contenido')
@if($step==1)
{{Form::open(['url' => '/logros/create/step/1', 'method' => 'POST', 'class' => 'form-horizontal'])}}

	<div class="row">
	<div class="col-md-6">
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

		{{ Form::hidden('paso', '1') }}
		<button type="submit" class="btn btn-info" style="margin-top: 23px"><span class="icon16 icomoon-icon-enter white"></span> Siguiente </button>
	</div>
	</div>
{{Form::close()}}
@elseif($step==2)
{{Form::open(['url' => '/logros/create/step/1', 'method' => 'POST', 'class' => 'form-horizontal'])}}

<div class="row">
		<div class="col-md-6">
		<div class="row">
			<div class="col-xs-10">
				{{ Form::hidden('paso', '2') }}
				{{ Form::hidden('deporte_id', e(Input::get('deporte_id'))) }}
				{{ Form::hidden('liga_id', e(Input::get('liga_id'))) }}

				@foreach(Liga::where('deporte_id',$deporte_id)->where('id', $liga)->get() as $data_liga)
					@if(Equipo::where('liga_id',$data_liga->id)->count() == 0)
						<?php $arra['NP']='No posee equipos'; ?>
					@endif
					@foreach(Equipo::where('liga_id',$data_liga->id)->get() as $equipo)
						<?php $arra[$equipo->id]=$equipo->nombre; ?>
					@endforeach
					<?php $cont[$data_liga->nombre] = $arra; ?>
				@endforeach

				@foreach(Pitcher::get() as $pitcher)
					<?php $pitchers[$pitcher->id] = $pitcher->nombre; ?>
				@endforeach

				<label class="tip">Selecciona el primer equipo</label>
				{{Form::select('equipo1', $cont, '', ['class' => 'form-control'])}}
				<p class="text-danger"><b>{{ $errors->first('equipo1') }}</b></p>

			</div>
			<div class="col-xs-2">

			<label class="tip">Ref.</label>
			<input type="text" class="form-control input-md" name="referencia1" value="{{$referencia+1}}">
			<p class="text-danger"><b>{{ $errors->first('referencia1') }}</b></p>
			</div>

		</div>
		</div>

		<div class="col-md-6">
		<div class="row">
			<div class="col-xs-10">

				<label class="tip">Selecciona el primer equipo</label>
				{{Form::select('equipo2', $cont, '', ['class' => 'form-control'])}}
				<p class="text-danger"><b>{{ $errors->first('equipo2') }}</b></p>

			</div>
			<div class="col-xs-2">

				<label class="tip">Ref.</label>
				<input type="text" class="form-control input-md" name="referencia2" value="{{$referencia+2}}">
				<p class="text-danger"><b>{{ $errors->first('referencia2') }}</b></p>

			</div>
		</div>
		</div>

	</div>
	@if(strtolower($deporte) == 'baseball')
	<hr>
	<div class="row">
		<div class="col-md-6">
			<label class="tip">Selecciona el pitcher del juego numero 1</label>
			{{Form::select('pitcher1', $pitchers, '', ['class' => 'form-control', 'id' => 'pitcher1'])}}
			{{Form::text('pitcher1_text', '', ['class'=>'form-control', 'style' => 'margin-top: 10px;', 'id' => 'pitcher1_text'])}}
			<p class="text-danger"><b>{{ $errors->first('pitcher1') }}</b></p>
		</div>
		<div class="col-md-6">
			<label class="tip">Selecciona el pitcher del juego numero 2</label>
			{{Form::select('pitcher2', $pitchers, '', ['class' => 'form-control', 'id' => 'pitcher2'])}}
			{{Form::text('pitcher2_text', '', ['class'=>'form-control', 'style' => 'margin-top: 10px;', 'id' => 'pitcher2_text'])}}
			<p class="text-danger"><b>{{ $errors->first('pitcher2') }}</b></p>
		</div>
	</div>
	<hr>
	@endif

	<div class="row">
		<div class="col-md-2">
			<label class="tip">Fecha</label>
			{{Form::text('fecha', '', ['class'=>'form-control fecha'])}}
			<p class="text-danger"><b>{{ $errors->first('fecha') }}</b></p>
		</div>
		<div class="col-md-2">
			<label class="tip">Hora</label>
			{{Form::text('hora', '', ['class'=>'form-control hora'])}}
			<p class="text-danger"><b>{{ $errors->first('hora') }}</b></p>
		</div>
		<div class="col-lg-3">
			<button type="submit" class="btn btn-info" style="margin-top: 23px"><span class="icon16 icomoon-icon-enter white"></span> Guardar cambios</button>
		</div>
	</div>

{{Form::close()}}

<script  type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
	$('#pitcher2_text').click(function(){
		$('#pitcher2').prop('disabled', true);
	});

	$('#pitcher2').click(function(){
		$('#pitcher2').prop('disabled', false);
		$('#pitcher2_text').prop('disabled', true);
	});

	$('#pitcher1_text').click(function(){
		$('#pitcher1').prop('disabled', true);
	});

	$('#pitcher1').click(function(){
		$('#pitcher1').prop('disabled', false);
		$('#pitcher1_text').prop('disabled', true);
	});
</script>
@endif

@stop
