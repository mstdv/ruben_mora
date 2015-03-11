@extends('panel')

@section('web-titulo')
    @parent
    Crear nuevo juego
@stop

@section('mod-titulo')
	Crear nuevo juego
@stop

@section('web-contenido')

{{Form::open(['url' => '/logros/edit', 'method' => 'POST', 'class' => 'form-horizontal'])}}

<div class="row">
		<div class="col-md-6">
		<div class="row">
			<div class="col-xs-10">
				{{ Form::hidden('deporte_id', e(Input::get('deporte_id'))) }}
				{{ Form::hidden('liga_id', e(Input::get('liga_id'))) }}
				{{ Form::hidden('logro_id', e(Input::get('logro_id'))) }}

				@foreach(Liga::where('deporte_id',e(Input::get('deporte_id')))->where('id', e(Input::get('liga_id')))->get() as $data_liga)
					@if(Equipo::where('liga_id',$data_liga->id)->count() == 0)
						<?php $arra['NP']='No posee equipos'; ?>
					@endif
					@foreach(Equipo::where('liga_id',$data_liga->id)->get() as $equipo)
						<?php $arra[$equipo->id]=$equipo->nombre; ?>
					@endforeach
					<?php $cont[$data_liga->nombre] = $arra;
							$array1[$data_liga->nombre] = $arra;
							$array2[$data_liga->nombre] = $arra;

							array_unshift($array1[$data_liga->nombre],
								Equipo::getInf(Logro::getInf(Input::get('logro_id'))->equipo1)->nombre);

							array_unshift($array2[$data_liga->nombre],
								Equipo::getInf(Logro::getInf(Input::get('logro_id'))->equipo2)->nombre);
					?>
				@endforeach


				<label class="tip">Selecciona el primer equipo</label>
				{{Form::select('equipo1', $array1, '', ['class' => 'form-control'])}}
				<p class="text-danger"><b>{{ $errors->first('equipo1') }}</b></p>
			</div>
			<div class="col-xs-2">

			<label class="tip">Ref.</label>
			<input type="text" class="form-control input-md" name="referencia1" value="{{Input::get('referencia')+1}}">
			<p class="text-danger"><b>{{ $errors->first('referencia1') }}</b></p>
			</div>

		</div>
		</div>

		<div class="col-md-6">
		<div class="row">
			<div class="col-xs-10">

				<label class="tip">Selecciona el primer equipo</label>
				{{Form::select('equipo2', $array2, '', ['class' => 'form-control'])}}
				<p class="text-danger"><b>{{ $errors->first('equipo2') }}</b></p>

			</div>
			<div class="col-xs-2">

				<label class="tip">Ref.</label>
				<input type="text" class="form-control input-md" name="referencia2" value="{{Input::get('referencia')+2}}">
				<p class="text-danger"><b>{{ $errors->first('referencia2') }}</b></p>

			</div>
		</div>
		</div>

	</div>


	<div class="row">
		<div class="col-md-2">
			<label class="tip">Fecha</label>
			{{Form::text('fecha', Logro::getFechaMDY(Input::get('logro_id')), ['class'=>'form-control fecha'])}}
			<p class="text-danger"><b>{{ $errors->first('fecha') }}</b></p>
		</div>
		<div class="col-md-2">
			<label class="tip">Hora</label>
			{{Form::text('hora', Logro::getHoraHMS(Input::get('logro_id')), ['class'=>'form-control hora'])}}
			<p class="text-danger"><b>{{ $errors->first('hora') }}</b></p>
		</div>
		<div class="col-lg-3">
			<button type="submit" class="btn btn-info" style="margin-top: 23px"><span class="icon16 icomoon-icon-enter white"></span> Guardar cambios</button>
		</div>
	</div>

{{Form::close()}}


@stop
