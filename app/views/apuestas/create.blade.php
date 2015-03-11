@extends('panel')

@section('web-titulo')
    @parent
    Apostar
@stop

@section('mod-titulo')
	Apostar
@stop

@section('web-contenido')
<div class="row">
<div class="col-lg-12">

<h5>Tenga en cuenta los siguientes limites:</h5>
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

	<table class="table table-striped table-hover table-bordered juegos_listadook">
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
		@foreach($g = User::where('rol', 3)->where('id', Auth::user()->id)->paginate(5) as $usuario)
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

<hr>

@include('apuestas.listado')

<hr>
<h3>Logros para hoy, y ma&ntilde;ana.</h3>
<!-- Inicio -->
@include('apuestas.css1')
<!-- Nav tabs -->
<?php $fecha = Carbon::now()->format('Y-m-d');  ?>
<?php $listLiga = array();  ?>
@foreach($u = Deporte::get() as $deporte)
  @foreach(Logro::where('deporte_id', $deporte->id)->where('fecha_partido', $fecha)->get() as $logro)
  @foreach(Liga::get() as $liga)
    @if($liga->id == $logro->liga_id)
      <?php array_push($listLiga, $liga->nombre); ?>
    @endif
  @endforeach
@endforeach
@endforeach

<?php $listLiga = array_unique($listLiga); ?>

<ul class="nav nav-tabs" role="tablist">
@foreach($listLiga as $nombre)
  <li role="presentation"><a href="#{{str_replace(' ', '_', $nombre)}}" role="tab" data-toggle="tab">
    {{$nombre}}
  </a></li>
@endforeach

</ul>
<!-- Tab panes -->
<div class="tab-content">
<style>
	a {
		cursor: pointer !important;
	}
</style>

@foreach($listLiga as $nombre)
    <div role="tabpanel" class="tab-pane fade panels" id="{{str_replace(' ', '_', $nombre)}}">
    <table class="table table-striped table-hover table-bordered table-condensed listado">
		<?php $logro = Logro::where('liga_id', Liga::getIdforNombre($nombre)->id)->where('fecha_partido', $fecha)->get(); ?>
		@foreach($g = Logro::where('liga_id', Liga::getIdforNombre($nombre)->id)->where('fecha_partido', $fecha)->paginate(5) as $juego)
  		<tr class="c">

				<td colspan="10">
					<table class="table table-striped table-hover table-bordered table-condensed listadoc1">
							<tr>
							@if(strtoupper(Deporte::getInf($logro[0]->deporte_id)->nombre) == 'BASEBALL')
							<td colspan="15">Hora del partido: {{date("h:m A", strtotime($juego->hora_partido))}}</td>
							@else
							<td colspan="11">Hora del partido: {{date("h:m A", strtotime($juego->hora_partido))}}</td>
							@endif

							</tr>
							<tr class="a">
								<td colspan="1">
								{{Deporte::getInf($logro[0]->deporte_id)->nombre}}</td>
								<td colspan="5" class="c1">Completo</td>
								<td colspan="4" class="c2">Mitad</td>
							@if(strtoupper(Deporte::getInf($logro[0]->deporte_id)->nombre) == 'BASEBALL')
								<td colspan="4">Exoticas</td>
							@endif
							</tr>
							<tr class="b">
							<td width="150px;">Equipos</td>
							<td width="100px;">Ganar</td>
							<td width="100px;">Runline</td>
							<td width="50px;"></td>
							<td width="100px;">Totales</td>
							<td width="50px;">Empate</td>
							<td width="100px;">Ganar</td>
							<td width="100px;">Runline</td>

							<td width="50px;"></td>
							<td width="100px;">Totales</td>
						@if(strtoupper(Deporte::getInf($logro[0]->deporte_id)->nombre) == 'BASEBALL')
							<td width="100px;"><marquee scrollamount="1" behavior="scroll" direction="left">Hay Carreras 1er Inn.</marquee></td>
							<td width="100px;"><marquee scrollamount="1" behavior="scroll" direction="left">Quien anota primero</marquee></td>
							<td width="100px;" colspan="2"><marquee scrollamount="1" behavior="scroll" direction="left">Total CHE</marquee></td>

						@endif
						</tr>

						<tr class="f1">
						<!-- Equipo 1 -->
							<td>{{Equipo::getInf($juego->equipo1)->nombre}}</td>

							<td>
							<a class="apuestas_dd" href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo1}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo1)->nombre}},{{$juego->referencia_equipo1}},{{$juego->completo_aganar_a}}">
								{{$juego->referencia_equipo1}}
							</a>

							[{{$juego->completo_aganar_a}}]
							</td>

							<td>
							<a href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo1}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo1)->nombre}},1{{$juego->referencia_equipo1}},{{$juego->completo_runline_b}}" class="apuestas_dd">
							1{{$juego->referencia_equipo1}} </a> [{{$juego->completo_runline_b}} | {{$juego->completo_runline_a}}]
							</td>

							<td>{{$juego->completo_altabaja_a}}</td>

							<td> <a href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo1}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo1)->nombre}},A{{$juego->referencia_equipo1}},{{$juego->completo_altabaja_b}}" class="apuestas_dd">
							A{{$juego->referencia_equipo1}} </a> [{{$juego->completo_altabaja_b}}]</td>

							<td>
							<a href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo1}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo1)->nombre}},E{{$juego->referencia_equipo1}},{{$juego->completo_empate}}" class="apuestas_dd">
							E{{$juego->referencia_equipo1}}
							</a>
							 [{{$juego->completo_empate}}]
							</td>
							<td>
							<a class="apuestas_dd" href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo1}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo1)->nombre}},5{{$juego->referencia_equipo1}},{{$juego->mitad_aganar_a}}">
							5{{$juego->referencia_equipo1}}
							</a>
							[{{$juego->mitad_aganar_a}}]</td>

							<td>
								<a href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo1}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo1)->nombre}},6{{$juego->referencia_equipo1}},{{$juego->mitad_runline_b}}" class="apuestas_dd">
								6{{$juego->referencia_equipo1}}
								</a>
							 [{{$juego->mitad_runline_b}} | {{$juego->mitad_runline_a}}]</td>


							<td>{{$juego->mitad_altabaja_a}}</td>

							<td>
							<a href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo1}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo1)->nombre}},A5{{$juego->referencia_equipo1}},{{$juego->mitad_altabaja_b}}" class="apuestas_dd">
							A5{{$juego->referencia_equipo1}}</a>
							[{{$juego->mitad_altabaja_b}}]</td>

							<!-- Exoticas -->
							@if(strtoupper(Deporte::getInf($logro[0]->deporte_id)->nombre) == 'BASEBALL')
								<td>
								<a class="apuestas_dd" href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo1}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo1)->nombre}},S{{$juego->referencia_equipo1}},{{$juego->carreras_primer_inn_a}}">
									S{{$juego->referencia_equipo1}}
								</a>
								[{{$juego->carreras_primer_inn_a}}]</td>
								<td>

								<a href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo1}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo1)->nombre}},V{{$juego->referencia_equipo1}},{{$juego->exoticas_quienanotaprimero_a}}" class="apuestas_dd">V{{$juego->referencia_equipo1}}</a>
								[{{$juego->exoticas_quienanotaprimero_a}}]</td>

								<td>{{$juego->exoticas_totalche_a}}</td>

								<td>
									<a href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo1}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo1)->nombre}},U{{$juego->referencia_equipo1}},{{$juego->exoticas_totalche_b}}" class="apuestas_dd">U{{$juego->referencia_equipo1}} </a>
								[{{$juego->exoticas_totalche_b}}]</td>

							@endif

						</tr>
						<tr class="f2">
							<td>{{Equipo::getInf($juego->equipo2)->nombre}}</td>
							<td><a class="apuestas_dd" href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo2}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo2)->nombre}},{{$juego->referencia_equipo2}},{{$juego->completo_aganar_b}}">{{$juego->referencia_equipo2}}</a> [{{$juego->completo_aganar_b}}]</td>
							<td>
								<a href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo2}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo2)->nombre}},1{{$juego->referencia_equipo2}},{{$juego->completo_runline_d}}" class="apuestas_dd">
								1{{$juego->referencia_equipo2}} </a>
							 [{{$juego->completo_runline_d}} | {{$juego->completo_runline_c}}]</td>
							<td>--</td>
							<td>
							<a href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo2}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo2)->nombre}},B{{$juego->referencia_equipo2}},{{$juego->completo_altabaja_c}}" class="apuestas_dd">
							B{{$juego->referencia_equipo2}}</a>
							[{{$juego->completo_altabaja_c}}]</td>
							<td>--</td>
							<td>
							<a class="apuestas_dd" href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo2}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo2)->nombre}},5{{$juego->referencia_equipo2}},{{$juego->mitad_aganar_b}}">
							5{{$juego->referencia_equipo2}}
							</a>
							[{{$juego->mitad_aganar_b}}]</td>
							<td>
								<a href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo2}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo2)->nombre}},6{{$juego->referencia_equipo2}},{{$juego->mitad_runline_d}}" class="apuestas_dd">
								6{{$juego->referencia_equipo2}} </a>
							 [{{$juego->mitad_runline_d}} | {{$juego->mitad_runline_c}}]</td>


							<td>--</td>

							<td>
								<a href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo2}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo2)->nombre}},B5{{$juego->referencia_equipo2}},{{$juego->mitad_altabaja_c}}" class="apuestas_dd">
								B5{{$juego->referencia_equipo2}}</a>
							 [{{$juego->mitad_altabaja_c}}]</td>

							<!-- Exoticas -->
							@if(strtoupper(Deporte::getInf($logro[0]->deporte_id)->nombre) == 'BASEBALL')
								<td>
									<a href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo2}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo2)->nombre}},N{{$juego->referencia_equipo2}},{{$juego->carreras_primer_inn_b}}" class="apuestas_dd">
									N{{$juego->referencia_equipo2}}</a>
								 [{{$juego->carreras_primer_inn_b}}]</td>
								<td>
									<a href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo2}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo2)->nombre}},H{{$juego->referencia_equipo2}},$juego->exoticas_quienanotaprimero_b}}" class="apuestas_dd">H{{$juego->referencia_equipo2}}</a>
								 [{{$juego->exoticas_quienanotaprimero_b}}]</td>
								<td>--</td>
								<td>
									<a href="{{URL::to('apuestas/create')}}/{{$juego->fecha_partido}},{{$juego->referencia_equipo2}},{{$juego->hora_partido}},{{Equipo::getInf($juego->equipo2)->nombre}},O{{$juego->referencia_equipo1}},{{$juego->exoticas_totalche_c}}" class="apuestas_dd">
									O{{$juego->referencia_equipo1}}</a>
								 [{{$juego->exoticas_totalche_c}}]</td>
							@endif
						</tr>

					</table>
				</td>

			</tr>
			@endforeach

    </table>
    {{ $g->links() }}
    </div>
@endforeach

<div class="alert alert-info center" style="padding:5px; font-weight: bold;">SELECCIONE DENTRO DE LAS SERIES DISPONIBLES  </div>
</div>

<img src="" alt=""/>

@include('apuestas.script')


</div><!-- End .span12 -->
</div><!-- End .row -->
@stop