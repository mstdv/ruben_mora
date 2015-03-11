@extends('panel')

@section('web-titulo')
    @parent
    Mis limites
@stop

@section('mod-titulo')
	Mis limites
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

	<h3>Informacion de mis limites <b>(Taquilla)</b></h3>
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
		</tr>
		@foreach($g = User::where('rol', 3)->where('id', $id)->paginate(5) as $usuario)
		{{Form::open(['method'=>'PUT', 'url'=>'/limites/'.$usuario->id])}}
		<tr>
			<td style="color:grey;">
				<b>{{$usuario->nombre}} {{$usuario->apellido}}</b>
			</td>


			<?php $d=Limite::where('user_id', $usuario->id); ?>
			@if($d->count() >= 1)
			<?php $d=$d->get();
					$d=$d[0]; ?>
			<td class="successtd">
				{{$d->acepta_derecho}}
			</td>
			<td class="successtd">
				{{$d->maximo_parlays}}
			</td>
			<td class="successtd">
				{{$d->minimo_parlays}}
			</td>
			<td class="successtd">
				{{$d->maximo_hembras}}
			</td>
			<td class="successtd">
				{{$d->max_monto_der}}
			</td>
			<td class="successtd">
				{{$d->max_monto_par}}
			</td>
			<td class="successtd">
				{{$d->max_der_perder}}
			</td>
			<td class="successtd">
				{{$d->max_premio}}
			</td>
			@else

			@endif

		</tr>
		<tr>
			<td colspan="9">Ultima vez actualizado: <i>{{$d->updated_at}}</i></td>
		</tr>
		{{Form::close()}}
		@endforeach
	</table>



	<br>
	{{$g->links()}}

</div><!-- End .span12 -->
</div><!-- End .row -->
@stop