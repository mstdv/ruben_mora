<div class="row">
	<div class="col-lg-12">
	<h3>Deportes <br> <small>
		Seleccione el deporte que desea modificar o eliminar.
	</small></h3>
	@foreach(Deporte::get() as $deporte)
	<a data-toggle="modal" data-target="#m-deporte{{$deporte->id}}" class="badge" style="color:#fff;"> {{$deporte->nombre}} </a>
	<div class="modal" id="m-deporte{{$deporte->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Gestionar "{{$deporte->nombre}}" </h4>
	      </div>
	      <div class="modal-body">
			{{Form::open(['url' => '/deportes/update', 'method' => 'POST', 'class' => 'form-horizontal'])}}
			<div class="row">
				<div class="col-lg-4">
					<label>Nombre de el deporte</label>
					{{Form::hidden('id', $deporte->id)}}
					{{Form::text('nombre', $deporte->nombre, ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('nombre') }}</b></p>
				</div>
				<div class="col-lg-2">
					<label>Referencia</label>
					{{Form::text('ref', $deporte->logro_referencia, ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('ref') }}</b></p>
				</div>
				<div class="col-lg-3">
					<button type="submit" class="btn btn-info btn-block" style="margin-top: 23px"><span class="icon16 icomoon-icon-enter white"></span>Guardar cambios</button>
				</div>
				<div class="col-lg-3">
					<a href="{{URL::to('/deportes/destroy/'.$deporte->id)}}" class="btn btn-danger btn-block" style="margin-top: 23px"><span class="icon16 icomoon-icon-enter white"></span>Eliminar deporte</a>
				</div>
			</div>
			{{Form::close()}}
	      </div>
	    </div>
	  </div>
	</div>
	@endforeach
	<hr>
	</div>
</div>