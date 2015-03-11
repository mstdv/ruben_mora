    <tr>
        <td>{{$jugada->id}}</td>
        <td style="text-align: left;">{{$jugada->created_at}}</td>
        <td style="text-align: left;">
        <?php
            $nombre = null;
            if(Logro::where('referencia_equipo1', $jugada->referencia_equipo)->count() == 1){
                $nombre = Logro::where('id', $jugada->logro_id)->get();
                $nombre = Equipo::getInf($nombre[0]->equipo1)->nombre;
            }

            if(Logro::where('referencia_equipo2', $jugada->referencia_equipo)->count() == 1){
                $nombre = Logro::where('id', $jugada->logro_id)->get();
                $nombre = Equipo::getInf($nombre[0]->equipo2)->nombre;
            }
        ?>
        {{$nombre}}
        </td>
        <td style="font-weight: bold; text-align: left;">{{$jugada->referencia_equipo}}</td>
        <td style="font-weight: bold; text-align: left;">{{$jugada->referencia_jugada}}</td>
        <td style="text-align: left;">{{$jugada->logro_calc}}</td>
        <td style="text-align: left;"><b>{{$resultado}}</b></td>
    </tr>