	<button class="btn btn-default" data-toggle="modal" data-target="#n-pitcher">Nuevo pitcher</button>

	<div class="modal" id="n-pitcher" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Nuevo pitcher</h4>
	      </div>
	      <div class="modal-body">
			{{Form::open(['url' => '/pitchers/create', 'method' => 'POST', 'class' => 'form-horizontal'])}}
			<div class="row">
				<div class="col-lg-4">
					<label>Nombre del pitcher</label>
					{{Form::text('nombre', '', ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('nombre') }}</b></p>
				</div>
				<div class="col-lg-4">
					<label title="Deportes disponibles" class="tip">Selecciona el equipo</label>
					<select name="equipo" id="" class="form-control">
					@foreach(Deporte::where('nombre', 'Baseball')->orWhere('nombre', 'baseball')->get() as $deporte)

					@foreach(Liga::where('deporte_id',$deporte->id)->get() as $liga)
						<optgroup label="{{$liga->nombre}}">
							@if(Equipo::where('liga_id',$liga->id)->count() == 0)
								<option disabled="true">Esta liga no posee equipos</option>
							@endif
							@foreach(Equipo::where('liga_id',$liga->id)->get() as $equipo)
								<option value="{{$equipo->id}}">{{$equipo->nombre}}</option>
							@endforeach
						</optgroup>
					@endforeach

					@endforeach
					</select>
					<p class="text-danger"><b>{{ $errors->first('equipo') }}</b></p>
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