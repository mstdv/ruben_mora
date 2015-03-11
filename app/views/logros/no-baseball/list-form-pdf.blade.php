
    <td rowspan="2" class="hour">
      {{date("g:i A", strtotime($data->hora_partido))}}    </td>
    <!-- VISITANTE -->
    <td class="team">
    {{strtoupper(Equipo::getInf($data->equipo1)->nombre)}}
    </td>
    <td><span class='refr'>{{$data->referencia_equipo1}}</span>{{$data->completo_aganar_a}}</td><td><span class='refr'>1{{$data->referencia_equipo1}}</span>{{$data->completo_runline_b}}<br>({{$data->completo_runline_a}})</td><td>-</td><td rowspan='2' class='last'><div class='abfac'>{{$data->completo_altabaja_a}}</div><span class='refr'>A{{$data->referencia_equipo1}}</span>{{$data->completo_altabaja_b}}<br /><span class='refr'>B{{$data->referencia_equipo1}}</span>{{$data->completo_altabaja_c}}<div class='draw'><span class='refr'>E{{$data->referencia_equipo1}}</span>{{$data->completo_empate}}</div></td><td><span class='refr'>5{{$data->referencia_equipo1}}</span>{{$data->mitad_aganar_a}}</td><td><span class='refr'>--</span>--<br>(--)</td><td rowspan='2' class='last'><div class='abfac'>--</div><span class='refr'>--</span>--<br /><span class='refr'>--</span>--<div class='draw'><span class='refr'>E5{{$data->referencia_equipo1}}</span>{{$data->mitad_empate}}</div></td><td></td><td></td><td></td><td rowspan='2'></td>  </tr>
  <!-- HOME CLUB-->
  <tr class='second'>
    <td class="team">
    {{strtoupper(Equipo::getInf($data->equipo2)->nombre)}}
    </td>
    <td><span class='refr'>{{$data->referencia_equipo2}}</span>{{$data->completo_aganar_b}}</td><td><span class='refr'>1{{$data->referencia_equipo2}}</span>{{$data->completo_runline_d}}<br>({{$data->completo_runline_c}})</td><td>-</td><td><span class='refr'>5{{$data->referencia_equipo1}}</span>{{$data->mitad_aganar_b}}</td><td><span class='refr'>--</span>--<br>(--)</td><td></td><td></td><td></td> </tr>
