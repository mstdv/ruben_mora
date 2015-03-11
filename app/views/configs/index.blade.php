@extends('panel')

@section('web-titulo')
    @parent
    Configuraciones generales
@stop

@section('mod-titulo')
	Configuraciones generales
@stop

@section('web-contenido')
<style>

table {
  border-collapse: collapse;
  border-spacing: 0;
}
td,
th {
  padding: 0;
}
table {
  background-color: transparent;
}
th {
  text-align: left;
}
.tablea {
  width: 60%;
  max-width: 60%;
  margin-bottom: 21px;
}
.tablea > thead > tr > th,
.tablea > tbody > tr > th,
.tablea > tfoot > tr > th,
.tablea > thead > tr > td,
.tablea > tbody > tr > td,
.tablea > tfoot > tr > td {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 1px solid #ecf0f1;
}
.tablea > thead > tr > th {
  vertical-align: bottom;
  border-bottom: 2px solid #ecf0f1;
}
.tablea > caption + thead > tr:first-child > th,
.tablea > colgroup + thead > tr:first-child > th,
.tablea > thead:first-child > tr:first-child > th,
.tablea > caption + thead > tr:first-child > td,
.tablea > colgroup + thead > tr:first-child > td,
.tablea > thead:first-child > tr:first-child > td {
  border-top: 0;
}
.tablea > tbody + tbody {
  border-top: 2px solid #ecf0f1;
}
.tablea .tablea {
  background-color: #ffffff;
}
</style>
<div class="row">
<div class="col-lg-12">
	<h3>Seleccione la opcion de su preferencia <br> <small>
		Con las siguientes opciones podra generar guardar una configuracion especifica para ciertos parametros.
	</small></h3>

	{{Form::open(['url' => '/configs/'.Auth::user()->id , 'method' => 'PUT'])}}
		<h4>Configuraciones Generales del Centro</h4>

		<table class="tablea">
			<tr>
				<td><b>Permitir 2a Mitad hasta su bloqueo </b></td>
				<td>
					<table class="tablea">
						<tr>
							<td>{{Form::radio('p2mitad', 'si')}}</td>
							<td>SI</td>
							<td>{{Form::radio('p2mitad', 'no')}}</td>
							<td>NO</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td><b>Nota de Ticket</b> </td>
				<td>
					<table>
						<tr>
							<td>{{Form::textarea('notatikect')}}</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td><b>Vencimiento del Ticket</b> </td>
				<td>
					<table>
						<tr>
							<td>{{Form::text('vencimiento')}} (dias)</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td><b>Max Consulta Taquillas</b>	</td>
				<td>
					<table>
						<tr>
							<td>{{Form::text('maxconsultas')}} (dias)</td>
						</tr>
					</table>
				</td>
			</tr>

		</table>

	<hr>
	<button class="btn btn-success" type="submit">Guardar Cambios</button>
	{{Form::close()}}

</div><!-- End .span12 -->
</div><!-- End .row -->
@stop