@extends('panel')

@section('web-titulo')
    @parent
    Tikets vendidos
@stop

@section('mod-titulo')
	Tikets vendidos
@stop

@section('web-contenido')
<div class="row">
<div class="col-lg-12">
	<h3>Seleccione el rango de fechas <br> <small>
		para el cual desea generar informacion sobre ventas de tikets.
	</small></h3>

    {{Form::open(['method'=>'post', 'url'=>'/tikets/search'])}}
        <div class="row"><div class="col-lg-2">
            {{Form::label('Desde')}}
            {{Form::text('desde', Input::old('desde', \Carbon\Carbon::now('America/Caracas')->format('m/d/Y')), ['class'=>'form-control fecha'])}}
        </div>
        <div class="col-lg-2">
            {{Form::label('Hasta')}}
            {{Form::text('hasta', Input::old('hasta', \Carbon\Carbon::now('America/Caracas')->format('m/d/Y')), ['class'=>'form-control', 'id'=>'fecha2'])}}
        </div>
        <div class="col-lg-2">
            {{Form::label('Estado')}}
            {{Form::select('estado', ['TODOS' => 'TODOS', 'PENDIENTE' => 'PENDIENTE', 'GANADOR' => 'GANADOR', 'EMPATADO' => 'EMPATADO', 'PERDEDOR' => 'PERDEDOR'], 'TODOS', ['class'=>'form-control'])}}
        </div>

        <div class="col-lg-2">
            {{Form::label('Pago')}}
            {{Form::select('pago', ['TODOS' => 'TODOS', 'PAGADO' => 'PAGADO', 'NO-PAGADO' => 'NO-PAGADO', 'ANULADO' => 'ANULADO', 'VENCIDO' => 'VENCIDO', 'REPORTADO' => 'REPORTADO' ], 'TODOS', ['class'=>'form-control'])}}

        </div>

        <div class="col-lg-2">
            {{Form::label('Rango de monto (MIN)')}}
            {{Form::text('r1', Input::old('r1', '20'), ['class'=>'form-control'])}}
        </div>

        <div class="col-lg-2">
            {{Form::label('Rango de monto (MAX)')}}
            {{Form::text('r2', Input::old('r2', '3000'), ['class'=>'form-control'])}}
        </div>


        </div>
    <br/>
        <button class="btn btn-success">Generar informacion de tikets vendidos</button>

    {{Form::close()}}

        @if(isset($tikets))
        <br/>

        <div class="row">
                <div class="col-lg-12">
                <hr/>
                <table class="table">
                <tr>
                    <td style="text-align: left; font-weight: bold;">Numero de tiket</td>
                    <td style="text-align: left; font-weight: bold;">Fecha - Hora</td>
                    <td style="text-align: left; font-weight: bold;">Monto</td>
                    <td style="text-align: left; font-weight: bold;">Premio</td>
                    <td style="text-align: left; font-weight: bold;">Estado</td>
                    <td style="text-align: left; font-weight: bold;">Pago</td>
                    <td style="text-align: left; font-weight: bold;">Detalles</td>
                    <td style="text-align: left; font-weight: bold;">Opciones</td>
                </tr>

                @foreach($tikets as $tiket)
                <tr>
                    <td style="font-size: 12px; text-align: left;">{{$tiket->id}}</td>
                    <td style="font-size: 12px; text-align: left;">{{$tiket->created_at}}</td>
                    <td style="font-size: 12px; text-align: left;">{{number_format($tiket->monto)}} BSF</td>
                    <td style="font-size: 12px; text-align: left; font-weight: bold">{{number_format($tiket->premio)}} BSF</td>
                    <td style="font-size: 12px; text-align: left; font-weight: bold">{{$tiket->estado}}</td>
                    <td style="font-size: 12px; text-align: left; font-weight: bold">{{$tiket->pago}}</td>
                    <td style="font-size: 12px; text-align: left;">
                        <!-- Large modal -->
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg-{{$tiket->id}}">Detalles del tiket</button>

                        <div class="modal fade bs-example-modal-lg-{{$tiket->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Informacion del tiket</h4>
                              </div>
                              <div class="modal-body">
                                <table class="table table-striped">
                                <tr>
                                    <td style="text-align: left;">N</td>
                                    <td style="text-align: left;">Fecha</td>
                                    <td style="text-align: left;">Nombre del equipo</td>
                                    <td style="text-align: left;">Referencia <b>(EQUIPO)</b></td>
                                    <td style="text-align: left;">Referencia <b>(JUGADA)</b></td>
                                    <td style="text-align: left;">Logro</td>
                                    <td style="text-align: left;">Estado (Ganador / Perdedor)</td>
                                </tr>
                                @foreach(TiketsJugada::where('tiket_id', $tiket->id)->get() as $jugada)
                                    {{Resultado::information($jugada)}}
                                @endforeach
                                </table>
                              </div>
                              <div class="modal-footer" style="text-align: left">
                                <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Cerrar ventana</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </td>
                    <td style="font-size: 12px; text-align: left;">--</td>
                </tr>
                @endforeach
                </table>
                </div>
        </div>
        @endif


</div><!-- End .span12 -->
</div><!-- End .row -->
@stop