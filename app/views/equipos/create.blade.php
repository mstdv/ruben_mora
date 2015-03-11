	<button class="btn btn-default" data-toggle="modal" data-target="#n-equipo"> Nuevo Equipo</button>

	<div class="modal" id="n-equipo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Nuevo equipo</h4>
	      </div>
	      <div class="modal-body">
			{{Form::open(['url' => '/equipos/create', 'method' => 'POST', 'class' => 'form-horizontal'])}}
			<div class="row">
				<div class="col-lg-4">
					<label>Nombre del equipo</label>
					{{Form::text('nombre', '', ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('nombre') }}</b></p>
				</div>
				<div class="col-lg-4">
					<label title="Deportes disponibles" class="tip">Seleccione la Liga</label>
					<select name="liga" id="" class="form-control">

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
				<div class="col-lg-4">
					<button type="submit" class="btn btn-info btn-block" style="margin-top: 23px"><span class="icon16 icomoon-icon-enter white"></span> Guardar cambios</button>
				</div>
			</div>
			{{Form::close()}}
	      </div>
	    </div>
	  </div>
	</div>