@extends('panel')

@section('web-titulo')
    @parent
    Control de limites
@stop

@section('mod-titulo')
	Control de limites
@stop

@section('web-contenido')
<div class="row">
<div class="col-lg-12">
	<style>
		.input {
			width: 83px !important;
			display: inline-block;
			margin: 0 auto;
			text-align: center;
		}
		.successtd {
			background: #E9FFE9 !important;
			font-weight: bold;
			color: green;
		}

		.successtd input {
			color: green !important;
			font-weight: bold;
			text-align: center;
		}

		.cabezera {
			background: #eee !important;
			color: #363636;
			text-align: center;
		}
	</style>
	<div class="well">
		A continuación se muestran los usuarios <b>(taquillas)</b> dentro del sistema, podrá gestionar su configuración de limites con las opciones que le parecen debajo.
	</div>

	<h3>Listado de usuarios <b>(Taquilla)</b></h3>
	<table class="table table-striped table-hover table-bordered">
		<tr class="cabezera">
			<td class="cabezera">Nombre del usuario:</td>
			<td class="cabezera">Acepta Derecho</td>
			<td class="cabezera">Maximo Parlays</td>
			<td class="cabezera">Minimo Parlays</td>
			<td class="cabezera">Maximo Hembras</td>
			<td class="cabezera">Max. Monto Der.</td>
			<td class="cabezera">Max. Monto Par.</td>
			<td class="cabezera">Max. Der. Perder</td>
			<td class="cabezera">Max. Premio</td>
			<td></td>
		</tr>
		@foreach($g = User::where('rol', 3)->paginate(5) as $usuario)
		{{Form::open(['method'=>'PUT', 'url'=>'/limites/'.$usuario->id])}}
		<tr>
			<td style="color:grey;">
			<a href="{{URL::to('/')}}/admin-usuarios-info/{{$usuario->id}}">
				{{$usuario->nombre}} {{$usuario->apellido}}
			</a>

			</td>


			<?php $d=Limite::where('user_id', $usuario->id); ?>
			@if($d->count() >= 1)
			<?php $d=$d->get();
					$d=$d[0]; ?>
			<td class="successtd">
				{{Form::select('acepta_derecho',
					[''=>'--', 'SI'=>'SI', 'NO'=>'NO'],
					$d->acepta_derecho,
					['class'=>'form-control'])}}
			</td>
			<td class="successtd">
				{{Form::select('maximo_parlays',
					[''=>'--', '1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5',
					 '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10'],
					$d->maximo_parlays,
					['class'=>'form-control'])}}
			</td>
			<td class="successtd">
				{{Form::select('minimo_parlays',
					[''=>'--', '1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5',
					 '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10'],
					$d->minimo_parlays,
					['class'=>'form-control'])}}
			</td>
			<td class="successtd">
				{{Form::select('maximo_hembras',
					[''=>'--', '1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5',
					 '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10'],
					$d->maximo_hembras,
					['class'=>'form-control'])}}
			</td>
			<td class="successtd">
				{{Form::text('max_monto_der', $d->max_monto_der, ['class' => 'form-control input'])}}
			</td>
			<td class="successtd">
				{{Form::text('max_monto_par', $d->max_monto_par, ['class' => 'form-control input'])}}
			</td>
			<td class="successtd">
				{{Form::text('max_der_perder', $d->max_der_perder, ['class' => 'form-control input'])}}
			</td>
			<td class="successtd">
				{{Form::text('max_premio', $d->max_premio, ['class' => 'form-control input'])}}
			</td>
			@else
			<td>
				{{Form::select('acepta_derecho',
					[''=>'--', 'SI'=>'SI', 'NO'=>'NO'],
					'',
					['class'=>'form-control'])}}
			</td>
			<td>
				{{Form::select('maximo_parlays',
					[''=>'--', '1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5',
					 '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10'],
					'',
					['class'=>'form-control'])}}
			</td>
			<td>
				{{Form::select('minimo_parlays',
					[''=>'--', '1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5',
					 '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10'],
					'',
					['class'=>'form-control'])}}
			</td>
			<td>
				{{Form::select('maximo_hembras',
					[''=>'--', '1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5',
					 '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10'],
					'',
					['class'=>'form-control'])}}
			</td>
			<td>
				{{Form::text('max_monto_der', '', ['class' => 'form-control input'])}}
			</td>
			<td>
				{{Form::text('max_monto_par', '', ['class' => 'form-control input'])}}
			</td>
			<td>
				{{Form::text('max_der_perder', '', ['class' => 'form-control input'])}}
			</td>
			<td>
				{{Form::text('max_premio', '', ['class' => 'form-control input'])}}
			</td>
			@endif
			<td>
				<button type="submit" class="btn btn-default">Guardar</button>
			</td>
		</tr>
		{{Form::close()}}
		@endforeach
	</table>

	<br>
	{{$g->links()}}

</div><!-- End .span12 -->
</div><!-- End .row -->
@stop