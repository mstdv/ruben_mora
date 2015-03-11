    <tr>
        <td colspan="2">Hora: <b>{{$logro->hora_partido}}</b></td>
    </tr>
    <tr>
        <td>
			<b>
				<b>({{$logro->referencia_equipo1}})</b>
				{{Equipo::getInf($logro->equipo1)->nombre}} </b>

			<small><i>Pitcher: <b>{{Pitcher::getInf($logro->pitcher_equipo1)->nombre}}</b> </i></small>
        </td>
        <td>
			<b>
				<b>({{$logro->referencia_equipo2}})</b>
				{{Equipo::getInf($logro->equipo2)->nombre}} </b>

			<small><i>Pitcher: <b>{{Pitcher::getInf($logro->pitcher_equipo2)->nombre}}</b> </i></small>
        </td>
    </tr>
    {{Form::open(['url'=>'/resultados/post/baseball/'.$liga.'/'.$logro->id, 'method'=>'POST'])}}
    <tr>
        <td colspan="2" class="info">
            <small><b>JUEGO COMPLETO</b></small>
        </td>
    </tr>
    <tr>
        <td>{{Form::text('ca', (Resultado::where('logro_id', $logro->id)->count()==1)?Resultado::getInf($logro->id)->completo_a:'', ['class' => 'dd form-control'])}}</td>
        <td>{{Form::text('cb', (Resultado::where('logro_id', $logro->id)->count()==1)?Resultado::getInf($logro->id)->completo_b:'', ['class' => 'dd form-control'])}}</td>
    </tr>
    <tr>
        <td colspan="2" class="info">
            <small><b>JUEGO MITAD</b></small>
        </td>
    </tr>
    <tr>
        <td>
            {{Form::text('ma', (Resultado::where('logro_id', $logro->id)->count()==1)?Resultado::getInf($logro->id)->mitad_a:'', ['class' => 'dd form-control'])}}
        </td>
        <td>
            {{Form::text('mb', (Resultado::where('logro_id', $logro->id)->count()==1)?Resultado::getInf($logro->id)->mitad_b:'', ['class' => 'dd form-control'])}}
        </td>
    </tr>
    {{--Exoticas--}}
    <tr>
        <td colspan="2" class="info">
            <small><b>EXOTICAS</b></small>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table class="table">
                <tr>
                    <td width="100px">
                        <b>Carreras 1er Inn.</b>
                        <br>
                        <div class="formradio">

                        {{Form::select('c', [1 => 'SI', 0 => 'NO'],
                            (Resultado::where('logro_id', $logro->id)->count()==1)?Resultado::getInf($logro->id)->carreras_primer_inn:null, ['class'=>'form-control']
                        )}}

                        </div>
                    </td>
                    <td width="100px">
                        <b>Quien anota primero </b>
                        <br>
                        <div class="formradio">

                        {{Form::select('d', [1 => 'Visitante', 0 => 'Homeclub'],
                            (Resultado::where('logro_id', $logro->id)->count()==1)?Resultado::getInf($logro->id)->exoticas_quienanotaprimero:null, ['class'=>'form-control']
                        )}}

                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Total CHE</b> <br>
                    </td>
                    <td> {{Form::text('e', (Resultado::where('logro_id', $logro->id)->count()==1)?Resultado::getInf($logro->id)->exoticas_totalche:'', ['class'=>'ff form-control'])}} </td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        <button type="submit" class="btn btn-success btn-block">Guardar Cambios</button>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    {{Form::close()}}
	<tr>
		<td colspan="2" class="info">
			@if(Resultado::where('logro_id', $logro->id)->count()==1)
				<div class="text-success"><b>Este juego posee resultados publicados.</b></div>

			@if($resultado != null)
			{{Form::open(['method'=>'DELETE', 'url'=>'/resultados/'.$resultado->id])}}
			    <br/>
				<button type="submit" class="btn btn-warning btn-xs">Eliminar Cambios</button>
			{{Form::close()}}

			@endif
			@else
				<div class="text-alert"><b>Este juego "NO" posee resultados publicados.</b></div>
			@endif
		</td>
	</tr>

	<tr class="info">
		<td colspan="2" class="info">
			@if(Resultado::where('logro_id', $logro->id)->count()==1)
				<div class="text-muted"><i>Ultima actualizacion: {{Resultado::getInf($logro->id)->updated_at}} </i></div>
			@endif
		</td>
	</tr>

    <tr>
        <td colspan="2">
            <hr/>
        </td>
    </tr>
