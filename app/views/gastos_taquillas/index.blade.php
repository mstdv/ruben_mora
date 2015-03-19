@extends('panel')

@section('web-titulo')
    @parent
    Gastos de Taquilla
@stop

@section('mod-titulo')

	<h2>
		Gastos de Taquilla
	</h2>

@stop

@section('web-contenido')

	<div class="row">
		@if(Session::get("msj") != null)

			<div class="alert alert-danger">
				@foreach(Session::get("msj") as $m)

					<p>{{$m}}</p>

				@endforeach
			</div>

		@endif
		<div class="col-lg-12">
			@if(Auth::user()->rol == 3)
				{{Form::open([
					"url" 			=> "gastos/fecha",
					"autocomplete" 	=> "off",
					"class"			=> "row"
				])}}


					<div class="col-lg-3">
						<div class="form-group">
							{{Form::text("f1", Input::old("f1"), [
								"class" => "form-control fecha",
								"placeholder" => "Desde dd/mm/aaaa"
							])}}
						</div>
					</div>

					<div class="col-lg-3">
						<div class="form-group">
							{{Form::text("f2", Input::old("f2"), [
								"class" => "form-control fecha",
								"placeholder" => "Hasta dd/mm/aaaa"
							])}}
						</div>
					</div>
					<div class="col-lg-3">
						<button class="btn btn-primary">Buscar</button>
					</div>


					<a href="{{URL::to('gastos/create')}}" class="btn btn-warning">Nuevo Gasto</a>


				{{Form::close()}}
			@endif

			<hr />
			
			<div class="panel panel-default gradient">

				<div class="panel-body noPad clearfix">

					<table cellpadding="0" cellspacing="0" border="0" 
						class="dynamicTable display table table-bordered" width="100%">

						<thead>
							<tr>
								<th>Tipo de Gasto</th>
								<th>Fecha</th>
								<th>Nº Factura</th>
								<th>Monto</th>
								<th>Estatus</th>
								@if(Auth::user()->rol == 3)

									<th>Acciones</th>

								@endif
							</tr>
						</thead>

						<tbody>
							
						@if(Auth::user()->rol == 2)

							@foreach($taquillas as $u)

								<tr>
									<th class="text-center" colspan="5">Taquilla de: {{$u->nombre." ".$u->apellido}}</th>
								</tr>

								@foreach(GastosTaquilla::where("user_id", $u->id)->orderBy("fecha", "desc")->get() as $g)

									<tr>
										<td>{{$g->tipo_gasto}}</td>
										<td>{{$g->fecha}}</td>
										<td>{{$g->n_factura}}</td>
										<td>{{$g->monto}}</td>
										<td>
											@if($g->status == 0)
												Anulado
											@elseif($g->status == 1)
												Activo
											@endif
										</td>
									</tr>

								@endforeach

							@endforeach

						@elseif(Auth::user()->rol == 3)

							@foreach($gastos as $g)

								<tr>
									<td>{{$g->tipo_gasto}}</td>
									<td>{{$g->fecha}}</td>
									<td>{{$g->n_factura}}</td>
									<td>{{$g->monto}}</td>
									<td>
										@if($g->status == 0)
											Anulado
										@elseif($g->status == 1)
											Activo
										@endif
									</td>
									@if(Auth::user()->rol == 3)

										<td>
											<a href="{{URL::to('gastos/'.$g->id.'/edit')}}">Editar</a>
											/
											<a href="{{URL::to('gastos/change/'.$g->id)}}">Estatus</a>
										</td>
									@endif
								</tr>

						@endforeach

						@endif

							<tr>
								<td colspan="2">
									Total de gastos hoy: <b>{{$totalHoy}}</b>
									<small>Solo se suman los gastos <b>Activos</b></small>
								</td>
								<td colspan="3">
									@if(Auth::user()->rol == 2)

										Total de gastos de todas las taquillas: <b>{{$total}}</b>

									@elseif(Auth::user()->rol == 3)

										Total de gastos de la taquilla: <b>{{$total}}</b>

									@endif
								</td>
							</tr>

						</tbody>

					</table>

				</div>

			</div>

		</div>
	</div>

@stop