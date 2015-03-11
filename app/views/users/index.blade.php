@extends('panel')

@section('web-titulo')
    @parent
    Gestion y control de usuarios
@stop

@section('mod-titulo')
	Gestion y control de usuarios
@stop

@section('web-contenido')
<div class="row">
<div class="col-lg-12">
<div class="well">
	Es importante que al momento de crear un nuevo usuario <b>(Taquilla)</b>, configure sus limites al momento de realizar apuestas!.
</div>
	@include('users.create')
	@include('grupos.create')
	<hr>
	@include('users.show')
</div><!-- End .span12 -->
</div><!-- End .row -->
@stop