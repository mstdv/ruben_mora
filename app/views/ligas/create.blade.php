	<button class="btn btn-default" data-toggle="modal" data-target="#n-liga"> Nueva Liga</button>

	<div class="modal" id="n-liga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Nueva Liga</h4>
	      </div>
	      <div class="modal-body">
			{{Form::open(['url' => '/ligas/create', 'method' => 'POST', 'class' => 'form-horizontal'])}}
			<div class="row">
				<div class="col-lg-4">
					<label>Nombre de la liga</label>
					{{Form::text('nombre', '', ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('nombre') }}</b></p>
				</div>
				<div class="col-lg-4">
					<label title="Deportes disponibles" class="tip">Seleccione Deporte</label>
					<select name="deporte" id="" class="form-control">
						<optgroup label="Seleccione el deporte">
                           @foreach(Deporte::get() as $deporte)
								<option value="{{$deporte->id}}">{{$deporte->nombre}}</option>
                           @endforeach
                       </optgroup>
					</select>
					<p class="text-danger"><b>{{ $errors->first('deporte') }}</b></p>
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