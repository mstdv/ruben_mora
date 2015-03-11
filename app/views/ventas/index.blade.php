@extends('panel')

@section('web-titulo')
    @parent
    Ventas
@stop

@section('mod-titulo')
	Ventas
@stop

@section('web-contenido')
<div class="row">
<div class="col-lg-12">
	<h3>Seleccione el rango de fechas <br> <small>
		para el cual desea generar informacion sobre ventas.
	</small></h3>

    {{Form::open(['method'=>'post', 'url'=>'/ventas/search'])}}
        <div class="row"><div class="col-lg-3">
            {{Form::label('Desde')}}
            {{Form::text('desde', Input::old('desde', \Carbon\Carbon::now()->format('d/m/Y')), ['class'=>'form-control fecha'])}}
        </div><div class="col-lg-3">
            {{Form::label('Hasta')}}
            {{Form::text('hasta', Input::old('hasta', \Carbon\Carbon::now()->format('d/m/Y')), ['class'=>'form-control', 'id'=>'fecha2'])}}
        </div>

        </div>
        <br/>
        <button class="btn btn-success">Generar informacion de ventas</button>
        <div class="row">
                <div class="col-lg-12">
                <hr/>
                    {{Form::label('Resultado')}}
                    @if(isset($ventas))
                    <table width="500px" style="text-align: left;">
                        <tr style="text-align: left">
                            <td style="float: right; padding: 5px;"><b>Apostados: </b></td>
                            <td style="background: #d0d0d0; padding: 5px;">
                                {{number_format($apostados)}} BSF
                            </td>
                            <td style="float: right; padding: 5px;"><b>Ganadores: </b></td>
                            <td style="background: #d0d0d0; padding: 5px;">
                            {{number_format($ganadores)}} BSF
                            </td>
                            <td style="float: right; padding: 5px;"><b>Saldo: </b></td>
                            <td style="background: #d0d0d0; padding: 5px;">
                            {{number_format($saldo)}} BSF
                            </td>
                        </tr>
                    </table>
                    @else
                        <div class="well">No hay ventas a mostrar, porfavor intenta con otro rango de fechas...</div>
                    @endif
                </div>
        </div>
        <hr/>
    {{Form::close()}}
</div><!-- End .span12 -->
</div><!-- End .row -->
@stop