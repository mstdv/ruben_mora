<div class="row">
	<div class="col-lg-12">
	<h3>Ligas <br> <small>
		Seleccione la liga que desea modificar o eliminar.
	</small></h3>
	@foreach(Liga::get() as $liga)
	<a data-toggle="modal" data-target="#m-liga{{$liga->id}}" class="badge" style="color:#fff;"> {{$liga->nombre}} </a>
	<div class="modal" id="m-liga{{$liga->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Gestionar "{{$liga->nombre}}" </h4>
	      </div>
	      <div class="modal-body">
			{{Form::open(['url' => '/ligas/update', 'method' => 'POST', 'class' => 'form-horizontal'])}}
			<div class="row">
				<div class="col-lg-6">
					<label>Nombre la liga</label>
					{{Form::hidden('id', $liga->id)}}
					{{Form::text('nombre', $liga->nombre, ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('nombre') }}</b></p>
				</div>
				<div class="col-lg-6">
					<label title="Deportes disponibles" class="tip">Seleccione Deporte</label>
					<select name="deporte" id="" class="form-control">
						<optgroup label="Seleccione el deporte">
						  <option value="{{$liga->deporte_id}}" selected="true">
							@if($nombre_deporte = Deporte::where('id',$liga->deporte_id)->get())
								{{$nombre_deporte[0]->nombre}}
							@endif
						  </option>
                           @foreach(Deporte::get() as $deporte)
								<option value="{{$deporte->id}}">{{$deporte->nombre}}</option>
                           @endforeach
                       </optgroup>
					</select>
					<p class="text-danger"><b>{{ $errors->first('deporte') }}</b></p>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<button type="submit" class="btn btn-info btn-block" style="margin-top: 23px"><span class="icon16 icomoon-icon-enter white"></span>Guardar cambios</button>
				</div>
				<div class="col-lg-6">
					<a href="{{URL::to('/ligas/destroy/'.$liga->id)}}" class="btn btn-danger btn-block" style="margin-top: 23px"><span class="icon16 icomoon-icon-enter white"></span>Eliminar liga</a>
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