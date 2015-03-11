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

	.pit {
		width: 100% !important;
		display: block;
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
					<td class="title">Super Runline</td>
					<td class="title">A/B</td>
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
								<td>{{Form::text('completo_super_runline_a', $data->completo_super_runline_a)}}</td>
								<td>{{Form::text('completo_super_runline_b', $data->completo_super_runline_b)}}</td>
							</tr>
							<tr>
								<td>{{Form::text('completo_super_runline_c', $data->completo_super_runline_c)}}</td>
								<td>{{Form::text('completo_super_runline_d', $data->completo_super_runline_d)}}</td>
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
				</tr>
			</table>
		</td>
		<td>
			<table class="table-ma" width="100%">
				<tr>
					<td class="title">A Ganar</td>
					<td class="title">Runline</td>
					<td class="title">A/B</td>
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
				</tr>
			</table>
		</td>


	</tr>
	<tr>
		<td><b>PITCHERS</b></td>
		<td colspan="2"><b>EXOTICAS</b></td>
	</tr>
	<tr valign="top">
	<td>
		<table>
			<tr>
				<?php
					if($data->pitcher_equipo1 == 0) {
						$pitcher1 = $data->pitcher_equipo1text;
					} else {
						$pitcher1 = Pitcher::getInf($data->pitcher_equipo1)->nombre;
					}
				 ?>
				<td> <b>Para el equipo 1:</b> {{Form::text('pitcher_equipo1', $pitcher1, ['class' => 'pit'])}} </td>

			</tr>
			<tr>
				<?php
					if($data->pitcher_equipo2 == 0) {
						$pitcher2 = $data->pitcher_equipo2text;
					} else {
						$pitcher2 = Pitcher::getInf($data->pitcher_equipo2)->nombre;
					}
				 ?>
				<td> <b>Para el equipo 2:</b> {{Form::text('pitcher_equipo2', $pitcher2, ['class' => 'pit'])}} </td>
			</tr>
			<tr>
				<td class="text-left">
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
	</td>
		<td>
			<table class="table-ma" width="100%">
			<tr>
				<td class="title">A/B Visit.</td>
				<td class="title">Carr. 1er Inn.</td>
			</tr>
			<tr>
				<td>
					<table>
						<tr>
							<td colspan="2">
							<center>{{Form::text('exoticas_ab_visitante_a', $data->exoticas_ab_visitante_a)}}</center>
							</td>
						</tr>
						<tr>
							<td>{{Form::text('exoticas_ab_visitante_b', $data->exoticas_ab_visitante_b)}}</td>
							<td>{{Form::text('exoticas_ab_visitante_c', $data->exoticas_ab_visitante_c)}}</td>
						</tr>
					</table>
				</td>
				<td>
					<table>
						<tr>
							<td><b>SI</b></td>
							<td>{{Form::text('carreras_primer_inn_a', $data->carreras_primer_inn_a)}}</td>
						</tr>
						<tr>
							<td><b>NO</b></td>
							<td>{{Form::text('carreras_primer_inn_b', $data->carreras_primer_inn_b)}}</td>
						</tr>
					</table>
				</td>
			</tr>
			</table>
		</td>

		<td valign="top">
			<table class="table-ma" style="display:block;" width="100%">
			<tr>
				<td class="title">A/B Home.</td>
				<td class="title">Quien Anota Pr.</td>
				<td class="title">Total CHE</td>
			</tr>
			<tr>
				<td>
					<table>
						<tr>
							<td colspan="2">
							<center>{{Form::text('exoticas_ab_home_a', $data->exoticas_ab_home_a)}}</center>
							</td>
						</tr>
						<tr>
							<td>{{Form::text('exoticas_ab_home_b', $data->exoticas_ab_home_b)}}</td>
							<td>{{Form::text('exoticas_ab_home_c', $data->exoticas_ab_home_c)}}</td>
						</tr>
					</table>
				</td>
				<td>
					<table>
						<tr>
							<td><b>VI</b></td>
							<td>{{Form::text('exoticas_quienanotaprimero_a', $data->exoticas_quienanotaprimero_a)}}</td>
						</tr>
						<tr>
							<td><b>HC</b></td>
							<td>{{Form::text('exoticas_quienanotaprimero_b', $data->exoticas_quienanotaprimero_b)}}</td>
						</tr>
					</table>
				</td>
				<td>
					<table>
						<tr>
							<td colspan="2">
							<center>{{Form::text('exoticas_totalche_a', $data->exoticas_totalche_a)}}</center>
							</td>
						</tr>
						<tr>
							<td>{{Form::text('exoticas_totalche_b', $data->exoticas_totalche_b)}}</td>
							<td>{{Form::text('exoticas_totalche_c', $data->exoticas_totalche_c)}}</td>
						</tr>
					</table>
				</td>
			</tr>
			</table>
		</td>

	</tr>
</table>
<hr>