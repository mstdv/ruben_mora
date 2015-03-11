{{Form::hidden('id', $data->id)}}
<style>
	.table-ma {
		border: 1px #ddd dotted;
		margin: 0;
		padding: 0;
	}

	.table-ma tr {
		padding: 0;
		margin: 0;
	}

	table td {
		padding: 5px;
		border: 1px #ccc dotted;
	}

	.table-ma .title {
		font-weight: bold;
	}

	input[type="text"] {
		width: 45px;
		font-size: 11px;
	}

</style>
<table class="table-ma">
	<tr>
		<td><b>DETALLES</b></td>
		<td><b>COMPLETO</b></td>
		<td><b>MITAD</b></td>
	</tr>
	<tr style="width:100%">
		<td>
			<table class="table-ma">
				<tr>
				<td>
				<table class="table-ma" width="100%">
					<tr>
						<td>Fecha:</td>
						<td>{{date("d/m/Y",  strtotime($data->fecha_partido))}}</td>

					</tr>
					<tr>
						<td>Hora:</td>
						<td>{{date("g:i:s A",  strtotime($data->hora_partido))}}</td>
					</tr>
				</table>
				</td>
				</tr>
				<tr>
					<td><b>[{{$data->referencia_equipo1}}]</b> {{strtoupper(Equipo::getInf($data->equipo1)->nombre)}}</td>
				</tr>
				<tr>
					<td><b>[{{$data->referencia_equipo2}}]</b> {{strtoupper(Equipo::getInf($data->equipo2)->nombre)}}</td>
				</tr>
			</table>

		</td>
		<td>
			<table class="table-ma">
				<tr>
					<td class="title">A Ganar</td>
					<td class="title">Runline</td>
					<td class="title">A/B</td>
					<td class="title">Empate</td>
				</tr>
				<tr>
					<td>
						<table>
							<tr>
								<td>{{Form::text('completo_aganar_a', $data->completo_aganar_a)}}</td>
							</tr>
							<tr>
								<td>{{Form::text('completo_aganar_b', $data->completo_aganar_b)}}</td>
							</tr>
						</table>
					</td>
					<td>
						<table>
							<tr>
								<td>{{Form::text('completo_runline_a', $data->completo_runline_a)}}</td>
								<td>{{Form::text('completo_runline_b', $data->completo_runline_b)}}</td>
							</tr>
							<tr>
								<td>{{Form::text('completo_runline_c', $data->completo_runline_c)}}</td>
								<td>{{Form::text('completo_runline_d', $data->completo_runline_d)}}</td>
							</tr>
						</table>
					</td>
					<td>
						<table>
							<tr>
								<td colspan="2">
								<center>{{Form::text('completo_altabaja_a', $data->completo_altabaja_a)}}</center>
								</td>
							</tr>
							<tr>
								<td>{{Form::text('completo_altabaja_b', $data->completo_altabaja_b)}}</td>
								<td>{{Form::text('completo_altabaja_c', $data->completo_altabaja_c)}}</td>
							</tr>
						</table>
					</td>
					<td>
						<table>
							<tr>
								<td colspan="2">
								<center>{{Form::text('completo_empate', $data->completo_empate)}}</center>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table class="table-ma" width="100%">
				<tr>
					<td class="title">A Ganar</td>
					<td class="title">Runline</td>
					<td class="title">A/B</td>
					<td>Empate</td>
				</tr>
				<tr>
					<td>
						<table>
							<tr>
								<td>{{Form::text('mitad_aganar_a', $data->mitad_aganar_a)}}</td>
							</tr>
							<tr>
								<td>{{Form::text('mitad_aganar_b', $data->mitad_aganar_b)}}</td>
							</tr>
						</table>
					</td>
					<td>
						<table>
							<tr>
								<td>{{Form::text('mitad_runline_a', $data->mitad_runline_a)}}</td>
								<td>{{Form::text('mitad_runline_b', $data->mitad_runline_b)}}</td>
							</tr>
							<tr>
								<td>{{Form::text('mitad_runline_c', $data->mitad_runline_c)}}</td>
								<td>{{Form::text('mitad_runline_d', $data->mitad_runline_d)}}</td>
							</tr>
						</table>
					</td>
					<td>
						<table>
							<tr>
								<td colspan="2">
								<center>{{Form::text('mitad_altabaja_a', $data->mitad_altabaja_a)}}</center>
								</td>
							</tr>
							<tr>
								<td>{{Form::text('mitad_altabaja_b', $data->mitad_altabaja_b)}}</td>
								<td>{{Form::text('mitad_altabaja_c', $data->mitad_altabaja_c)}}</td>
							</tr>
						</table>
					</td>
					<td>
						<table>
							<tr>
								<td colspan="2">
								<center>{{Form::text('mitad_empate', $data->mitad_empate)}}</center>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>

		<td>

			<b>Opciones disponibles</b>
			<br>
			<a href="{{URL::to('/logros/destroy/'.$data->id)}}" title="Borrar" class="tip btn-block"><span class="typ-icon-delete"></span>
			Eliminar</a>
					<?php $referencia = $data->referencia_equipo1 - 1; ?>
			<a href="{{URL::to('/logros/edit?&logro_id='.$data->id.'&liga_id='.$data->liga_id.'&deporte_nombre='.Deporte::getInf($data->deporte_id)->nombre.'&deporte_id='.$data->deporte_id.'&referencia='.$referencia.'')}}" title="Modificar" class="tip btn-block"><span class="icomoon-icon-pencil"></span>
			Modificar</a>

			@if($data->estado == 1)
				<a href="{{URL::to('/logros/changeState/'.$data->id)}}" title="Levantar" class="tip btn-block"><span class="icomoon-icon-unlocked"></span>Levantar</a>
			@else
				<a href="{{URL::to('/logros/changeState/'.$data->id)}}" title="Levantar" class="tip btn-block"><span class="icomoon-icon-lock-2"></span>Suspender</a>
			@endif


			<br>
			<button type="submit" href="{{URL::to('/')}}" title="Guardar Cambios" ><span class="icomoon-icon-file-check"></span>
			Guardar Cambios</button>
	</td>
	</tr>

</table>
<hr>