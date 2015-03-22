@extends("panel")

@section("web-titulo")

	@parent
	Mensajes

@stop

@section('mod-titulo')

	Mensajes

@stop

@section("web-contenido")

	<div class="col-lg-12">
		
		@if(Auth::user()->rol == 1)

			<a href="{{URL::to('/mensajes/create')}}" class="btn btn-warning">Nuevo Mensaje</a>

		@endif

		<hr />

		<div class="panel panel-default gradient">

				<div class="panel-body noPad clearfix">

					<table cellpadding="0" cellspacing="0" border="0" 
						class="dynamicTable display table table-bordered" width="100%">

						<thead>
							<tr>
								<th>Título</th>
								@if(Auth::user()->rol == 1)
									<th width="20%">Acciones</th>
								@endif
							</tr>
						</thead>

						<tbody>

							@foreach($msj as $m)

								<tr>
									@if(Auth::user()->rol == 1)

										<td>
											{{HTML::link("mensajes/$m->id/edit", $m->titulo)}}
										</td>

										<td width="20%">
											{{Form::open([
												"url" => "/mensajes/$m->id",
												"method" => "delete"
											])}}

												<button class="btn btn-danger ">
													&times;
												</button>

											{{Form::close()}}
										</td>

									@else

										@if($m->para_id == "todos" ||
											MensajesController::para($m->para_id, Auth::user()->id,
												Auth::user()->grupo_id))

											<td>
												{{HTML::link("mensajes/$m->id", $m->titulo)}}
											</td>

										@endif

									@endif
								</tr>

							@endforeach

							<tr>
								<td colspan="2">
									{{$msj->links()}}
								</td>
							</tr>

						</tbody>

					</table>

				</div>

			</div>

	</div>

@stop