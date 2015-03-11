@extends('panel')

@section('web-titulo')
    @parent
    Gestion de deportes, equipos y ligas
@stop

@section('mod-titulo')
	Gestion de deportes, equipos y ligas
@stop

@section('web-contenido')
<div class="row">
<div class="col-lg-12">
	<div class="alert alert-info">
		<b>Instrucciones y orden para crear cada uno: </b> <br>
		Primero se crea el <b>deporte</b> para luego crear una liga, Al crear una <b>liga</b> tendrá que ingresar un equipo que pertenezca a una liga en específico, cuando cree un <b>equipo</b> este necesitara estar dentro de una liga.
	</div>
	<h3>Seleccione la opcion de su preferencia <br> <small>
		Con las siguientes opciones podra crear deportes, ligas y equipos.
	</small></h3>
	<div class="well">
		@include('deportes.create')
		@include('ligas.create')
		@include('equipos.create')
		@include('pitchers.create')
	</div>
	<hr>

</div><!-- End .span12 -->
</div><!-- End .row -->

	@include('deportes.edit')
	@include('ligas.edit')
	@include('equipos.edit')
	@include('pitchers.edit')

@stop