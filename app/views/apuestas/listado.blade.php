<h3>Listado de apuestas en juego</h3>
<style>
  .listadoc2 .a1 {
    font-size: 11px;
    font-weight: bold;
    text-align: left;
  }

  .listadoc2 .a1 td {
    text-align: left;
  }

  .listadoc2 .a2 {
    font-size: 11px;
  }


</style>
<table class="table table-striped table-hover table-bordered table-condensed listadoc1 listadoc2" id="apuestas">
<tr>
  <td colspan="7">
  <label class="label label-info" style="margin-top: 1px; margin-bottom: 3px; display: inline-block;">Referencia:</label>
    {{Form::open(['method'=>'post', 'url'=>'/apuestas/create/referencia'])}}
      {{Form::text('referencia', Input::old('referencia'), ['style'=>'margin-left:0px;'])}}
    {{Form::close()}}
  </td>
</tr>
<tr class="a1">
  <td>NUM</td>
  <td>FECHA</td>
  <td>REF</td>
  <td>EQUIPO</td>
  <td>TIPO</td>
  <td>LOGRO</td>
  <td>---</td>
</tr>

<?php $ii=0; ?>
@if(Session::get('apuestas') != null)
  @foreach(Session::get('apuestas') as $apuesta)
  @foreach($apuesta as $logro)
  @foreach($logro as $data)
  <?php $ii=$ii+1; ?>
  <tr class="juegos">
    <td width="10px"> {{$ii}} </td>
    <td width="90px"> {{$data[0]}} </td>
    <td> <b>{{$data[4]}}</b>  </td>
    <td> <b>{{$data[3]}}</b>  </td>
    <td> {{Apuestas::nombreLogro($data[1],$data[4])}} </td>
    <td> {{$data[5]}} </td>
    <td width="150px">
      {{HTML::link('/apuestas/create?remover='.$data[4], 'Remover', ['class'=>'btn btn-xs btn-default btn-block'])}}
    </td>
  </tr>

  @endforeach
  @endforeach
  @endforeach
@endif

@if(Session::get('apuestas') != null)
<tr>
  <td colspan="6">
    <div class="well">
    <ol>
      <li><b>Ingrese el monto de la apuesta</b></li>
      <li><b>Precione el boton continuar</b></li>
      <li><b>Una vez precionado validara la apuesta y le dira el monto a ganar</b></li>
      <li><b>Imprima su tiket</b></li>
    </ol>
    </div>
  </td>
  <td colspan="1">
    <center>
      <br>
      <label class="label label-info">Monto a apostar</label>
      <br>
      <br>
      {{Form::open(['method'=>'POST', 'url'=>'/apuestas/create/continuar'])}}
      {{Form::text('monto', Input::old('monto'), ['class'=>'form-control'])}}
      <br>
      <button type="submit" class="btn btn-success btn-block"> Continuar </button>
      {{Form::close()}}
    </center>
  </td>
</tr>
@endif

</table>

<?php
  if (Input::get('remover')!=null) {
    $apuesta_lista = Session::get('apuestas');

    foreach($apuesta_lista as $a=>$b) {
    foreach($b as $key => $apuesta) {
      if ($key == Input::get('remover')) {
        Session::flash('successMsj', 'Logro removido de la lista de apuestas actuales...');
        unset($apuesta_lista[$a]);
      }
    }
    }

    Session::put('apuestas', $apuesta_lista);
    Session::flash('redirect', URL::to('/apuestas/create'));
    return Redirect::back();
  }

 ?>