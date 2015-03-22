@extends('panel')

@section('web-titulo')

	@parent
	Crear un nuevo gasto

@stop

@section('web-contenido')

	<div class="row">
		<div class="col-lg-12">
			<h3>Crear un nuevo Gasto</h3>

			@if(Session::get("msj") != null)

				<div class="alert alert-danger">
					@foreach(Session::get("msj") as $m)

						<p>{{$m}}</p>

					@endforeach
				</div>

			@endif
			
			{{Form::open([
				"url" => "gastos",
				"autocomplete" => "off"
			])}}

				<div class="form-group col-lg-3">
					{{Form::text("tipo_gasto", Input::old('tipo_gasto'), [
						"placeholder" => "Tipo de Gasto",
						"class" => "form-control"
					])}}
				</div>

				<div class="form-group col-lg-3">
					{{Form::text("fecha", Input::old('fecha'), [
						"placeholder" => "mm/dd/aaaa",
						"class" => "form-control fecha"
					])}}
				</div>

				<div class="form-group col-lg-3">
					{{Form::text("n_factura", Input::old('n_factura'), [
						"placeholder" => "Nº Factura",
						"class" => "form-control"
					])}}
				</div>

				<div class="form-group col-lg-3">
					{{Form::text("monto", Input::old('monto'), [
						"placeholder" => "Monto",
						"class" => "form-control"
					])}}
				</div>

				<div class="form-group col-lg-6">

					{{Form::hidden("status", 1)}}
					<button type="submit" class="btn btn-success btn-block">Guardar Gasto</button>
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