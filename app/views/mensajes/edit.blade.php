@extends("panel")

@section("web-titulo")

	@parent
	Mensajes

@stop

@section('mod-titulo')

	Editar Mensaje

@stop

@section("web-contenido")

	<div class="col-lg-6">

		{{Form::open([
			"method" => "PUT",
			"url" => "mensajes/$msj->id",
			"autocomplete" => "off"
		])}}

			<div class="form-group">
				{{Form::label("para", "Para")}}
				{{Form::select("para", [
					"1" => "Todos",
					"2" => "Grupo",
					"3" => "Usuario"
				],
				"",
				[
					"class" => "form-control",
					"onchange" => "cambioMsj(this)"
				])}}
			</div>

			<div class="form-group hide" id="grupos">
				{{Form::label("", "Seleccionar Grupo")}}
				<select name="grupos" class="form-control" id="selectGrupos">

					<option value="0">Seleccionar</option>
					
					@foreach($grupos as $g)

						<option value="{{$g->id}}">{{$g->nombre}}</option>

					@endforeach

				</select>

			</div>

			<div class="form-group hide" id="todos">
				{{Form::label("", "Seleccionar Usuario")}}
				<select name="todos[]" class="form-control" id="selectTodos" multiple="true" >

					<option value="0">Seleccionar</option>
					
					@foreach($todos as $t)

						<option value="{{$t->id}}">{{$t->nombre." ".$t->apellido}}</option>

					@endforeach

				</select>

			</div>

			<div class="form-group">
				{{Form::label("titulo", "Título")}}
				{{Form::text("titulo", $msj->titulo, ["class" => "form-control"])}}
			</div>

			<div class="form-group">
				{{Form::label("msj", "Mensaje")}}
				{{Form::textarea("msj", $msj->msj, ["class" => "form-control"])}}
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block">Enviar</button>
			</div>

		{{Form::close()}}

	</div>

@stop