@extends('panel')

@section('web-titulo')

	@parent
	Editar Gasto

@stop

@section('web-contenido')

	<div class="row">
		<div class="col-lg-12">
			<h3>Editar Gasto</h3>

			@if(Session::get("msj") != null)

				<div class="alert alert-danger">
					@foreach(Session::get("msj") as $m)

						<p>{{$m}}</p>

					@endforeach
				</div>

			@endif
			
			{{Form::open([
				"url" => "/gastos/".$g->id,
				"autocomplete" => "off",
				"method" => "PUT"
			])}}

				<div class="form-group col-lg-3">
					{{Form::text("tipo_gasto", $g->tipo_gasto, [
						"placeholder" => "Tipo de Gasto",
						"class" => "form-control"
					])}}
				</div>

				<div class="form-group col-lg-3">
					{{Form::text("fecha", $g->fecha, [
						"placeholder" => "Fecha",
						"class" => "form-control fecha"
					])}}
				</div>

				<div class="form-group col-lg-3">
					{{Form::text("n_factura", $g->n_factura, [
						"placeholder" => "Nº Factura",
						"class" => "form-control"
					])}}
				</div>

				<div class="form-group col-lg-3">
					{{Form::text("monto", $g->monto, [
						"placeholder" => "Monto",
						"class" => "form-control"
					])}}
				</div>

				<div class="form-group col-lg-6">

					<button type="submit" class="btn btn-success btn-block">Actualizar</button>
				</div>

			{{Form::close()}}

			<script type="text/javascript">
				$(function() {
					$(".fecha").datepicker({
					changeMonth: true,
					changeYear: true
					});
				});
			</script>

		</div>
	</div>

@stop