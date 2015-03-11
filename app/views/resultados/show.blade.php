@extends('panel')

@section('web-titulo')
    @parent
    Gestionar resultados
@stop

@section('mod-titulo')
	Gestionar resultados
@stop

@section('web-contenido')
<div class="row">
<div class="col-lg-12">
	<h3>Gestion de resultados ya publicados</h3>
	<hr>
	@foreach($data as $resultado)
	<table class="table">
		<tr>
			<td><b>Juegos</b></td>
			<td><b>Puntos mitad & completo</b></td>
			<td><b>Exoticas</b></td>
		</tr>
		<tr>
			<td> <b>
				@foreach(Logro::where('id', $resultado->logro_id)->get() as $logro)

				 {{$logro->referencia_equipo1}}:	{{Equipo::getInf($logro->equipo1)->nombre}} <br>
				 {{$logro->referencia_equipo2}}:	{{Equipo::getInf($logro->equipo2)->nombre}} <br>
				@endforeach

			</b> </td>
		</tr>
	</table>
	@endforeach


</div><!-- End .span12 -->
</div><!-- End .row -->
@stop