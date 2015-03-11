<div class="row">
	<div class="col-lg-12">
	<h3>Equipo <br> <small>
		Seleccione el equipo que desea modificar o eliminar.
	</small></h3>
	@foreach(Equipo::get() as $equipo)
	<a data-toggle="modal" data-target="#m-equipo{{$equipo->id}}" class="badge" style="color:#fff;"> {{$equipo->nombre}} </a>
	<div class="modal" id="m-equipo{{$equipo->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Gestionar "{{$equipo->nombre}}" </h4>
	      </div>
	      <div class="modal-body">
			{{Form::open(['url' => '/equipos/update', 'method' => 'POST', 'class' => 'form-horizontal'])}}
			<div class="row">
				<div class="col-lg-6">
					<label>Nombre del equipo</label>
					{{Form::hidden('id', $equipo->id)}}
					{{Form::text('nombre', $equipo->nombre, ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('nombre') }}</b></p>
				</div>
				<div class="col-lg-6">
					<label title="Deportes disponibles" class="tip">Seleccione la liga</label>
					<select name="liga" id="" class="form-control">
					@if($nombre_liga = Liga::where('id',$equipo->liga_id)->get())
						<option selected="true" value="{{$equipo->liga_id}}">{{$nombre_liga[0]->nombre}}</option>
					@endif
					@foreach(Deporte::get() as $deporte)
					<optgroup label="{{$deporte->nombre}}">
						@if(Liga::where('deporte_id',$deporte->id)->count() == 0)
							<option disabled="true">Sin liga asignada</option>
						@endif
						@foreach(Liga::where('deporte_id',$deporte->id)->get() as $liga)
							<option value="{{$liga->id}}">{{$liga->nombre}}</option>
						@endforeach
					</optgroup>
					@endforeach

					</select>
					<p class="text-danger"><b>{{ $errors->first('liga') }}</b></p>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<button type="submit" class="btn btn-info btn-block" style="margin-top: 23px"><span class="icon16 icomoon-icon-enter white"></span>Guardar cambios</button>
				</div>
				<div class="col-lg-6">
					<a href="{{URL::to('/equipos/destroy/'.$equipo->id)}}" class="btn btn-danger btn-block" style="margin-top: 23px"><span class="icon16 icomoon-icon-enter white"></span>Eliminar deporte</a>
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