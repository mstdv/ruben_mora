	<button class="btn btn-default" data-toggle="modal" data-target="#n-deporte"> Nuevo Deporte</button>

	<div class="modal" id="n-deporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Nuevo Deporte</h4>
	      </div>
	      <div class="modal-body">
			{{Form::open(['url' => '/deportes/create', 'method' => 'POST', 'class' => 'form-horizontal'])}}
			<div class="row">
				<div class="col-lg-6">
					<label>Nombre de el deporte</label>
					{{Form::text('nombre', '', ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('nombre') }}</b></p>
				</div>
				<div class="col-lg-2">
					<label>Referencia</label>
					{{Form::text('ref', '', ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('ref') }}</b></p>
				</div>
				<div class="col-lg-4">
					<button type="submit" class="btn btn-info btn-block" style="margin-top: 23px"><span class="icon16 icomoon-icon-enter white"></span> Guardar cambios</button>
				</div>
			</div>
			{{Form::close()}}
	      </div>
	    </div>
	  </div>
	</div>