@extends('panel')

@section('web-titulo')
    @parent
    Pitchers
@stop

@section('mod-titulo')
	Pitchers
@stop

@section('web-contenido')
<div class="row">
<div class="col-lg-12">
	<h3>Gestion y control de pitchers dentro de Baseball</h3>
	<table class="table table-bordered">
		<tr>
			<td>Liga</td>
			<td>Equipos</td>
			<td>Pitcher Asignado</td>
		</tr>
	</table>
</div><!-- End .span12 -->
</div><!-- End .row -->
@stop