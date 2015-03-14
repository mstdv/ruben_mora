@extends('panel')

@section('web-titulo')
    @parent
    Gastos de Taquilla
@stop

@section('web-contenido')

	<div class="row">
		<div class="col-lg-12">

		<a href="{{URL::to('gastos/create')}}" class="btn btn-warning">Nuevo Gasto</a>

			<hr />
			
			<div class="panel panel-default gradient">

				<div class="panel-heading">
					<h4>
						<span>Gastos de Taquilla</span>
					</h4>
				</div>

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
								<th>Acciones</th>
							</tr>
						</thead>

						<tbody>
							
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
								<td>
									<a href="{{URL::to('gastos/'.$g->id.'/edit')}}">Editar</a>
									/
									<a href="{{URL::to('gastos/change/'.$g->id)}}">Estatus</a>
								</td>
							</tr>

						@endforeach

							<tr>
								<td colspan="6">
									Total de gastos hoy: <b>{{$total}}</b>
								</td>
							</tr>

						</tbody>

					</table>

				</div>

			</div>

		</div>
	</div>

@stop