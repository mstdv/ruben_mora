
    <td rowspan="2" class="hour">
      {{date("g:i A", strtotime($data->hora_partido))}}
    </td>
    <!-- VISITANTE -->
    <td class="team">
      {{strtoupper(Equipo::getInf($data->equipo1)->nombre)}} <br /><i style='font-size:85%'>

        <?php
          if($data->pitcher_equipo1 == 0) {
            $pitcher1 = $data->pitcher_equipo1text;
          } else {
            $pitcher1 = Pitcher::getInf($data->pitcher_equipo1)->nombre;
          }
         ?>
        {{$pitcher1}}
        </i>
    </td>
    <td>
      <span class='refr'>{{$data->referencia_equipo1}}</span>{{$data->completo_aganar_a}}
    </td>

    <td><span class='refr'>1{{$data->referencia_equipo1}}</span>{{$data->completo_runline_b}}<br>({{$data->completo_runline_a}})
    </td>

    <td><span class='refr'>2{{$data->referencia_equipo1}}</span>{{$data->completo_super_runline_b}}<br>({{$data->completo_super_runline_a}})
    </td>

    <td rowspan='2' class='last'><div class='abfac'>{{$data->completo_altabaja_a}}</div><span class='refr'>A{{$data->referencia_equipo1}}</span>{{$data->completo_altabaja_b}}<br /><span class='refr'>B{{$data->referencia_equipo1}}</span>{{$data->completo_altabaja_c}}
    </td>

    <td class="bg"><span class='refr'>5{{$data->referencia_equipo1}}</span>{{$data->mitad_aganar_a}}
    </td>

    <td class="bg"><span class='refr'>6{{$data->referencia_equipo1}}</span>{{$data->mitad_runline_b}}<br>({{$data->mitad_runline_a}})
    </td>

    <td rowspan='2' class='last bg'><div class='abfac'>{{$data->mitad_altabaja_a}}</div><span class='refr'>A5{{$data->referencia_equipo1}}</span>{{$data->mitad_altabaja_b}}<br /><span class='refr'>B5{{$data->referencia_equipo1}}</span>{{$data->mitad_altabaja_c}}
    </td>

    <td><div class='infac'>{{$data->exoticas_ab_visitante_a}}</div><span class='refr'>AV{{$data->referencia_equipo1}}</span>{{$data->exoticas_ab_visitante_b}}<br /><span class='refr'>BV{{$data->referencia_equipo1}}</span>{{$data->exoticas_ab_visitante_c}}
    </td>

    <td><span class='refr2'>S{{$data->referencia_equipo1}}</span>{{$data->carreras_primer_inn_a}}
    </td>

    <td><span class='refr2'>V{{$data->referencia_equipo1}}</span>{{$data->exoticas_quienanotaprimero_a}}
    </td>

    <td rowspan='2'><div class='abfac'>{{$data->exoticas_totalche_a}}</div><span class='refr'>O{{$data->referencia_equipo1}}</span>{{$data->exoticas_totalche_b}}<br /><span class='refr'>U{{$data->referencia_equipo1}}</span>{{$data->exoticas_totalche_c}}
    </td>

     </tr>
  <!-- HOME CLUB-->
  <tr class='second'>
    <td class="team">
    {{strtoupper(Equipo::getInf($data->equipo2)->nombre)}}<br><i style='font-size:85%'>

        <?php
          if($data->pitcher_equipo2 == 0) {
            $pitcher2 = $data->pitcher_equipo2text;
          } else {
            $pitcher2 = Pitcher::getInf($data->pitcher_equipo2)->nombre;
          }
         ?>
        {{$pitcher1}}

    </i>
    </td>
    <td><span class='refr'>{{$data->referencia_equipo2}}</span>{{$data->completo_aganar_b}}</td><td><span class='refr'>1{{$data->referencia_equipo1}}</span>{{$data->completo_runline_d}}<br>({{$data->completo_runline_c}})</td><td><span class='refr'>2{{$data->referencia_equipo1}}</span>{{$data->completo_super_runline_d}}<br>({{$data->completo_super_runline_c}})</td><td class="bg"><span class='refr'>5{{$data->referencia_equipo1}}</span>{{$data->mitad_aganar_b}}</td><td class="bg"><span class='refr'>6{{$data->referencia_equipo1}}</span>{{$data->mitad_runline_d}}<br>({{$data->mitad_runline_c}})</td><td ><div class='infac'>{{$data->exoticas_ab_home_a}}</div><span class='refr'>AH{{$data->referencia_equipo1}}</span>{{$data->exoticas_ab_home_b}}<br /><span class='refr'>BH{{$data->referencia_equipo1}}</span>{{$data->exoticas_ab_home_c}}</td><td><span class='refr2'>N{{$data->referencia_equipo1}}</span>{{$data->carreras_primer_inn_b}}</td><td><span class='refr2'>H{{$data->referencia_equipo1}}</span>{{$data->exoticas_quienanotaprimero_b}}</td>  </tr>

