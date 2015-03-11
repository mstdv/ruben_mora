<button data-toggle="modal" data-target=".users-create" class="btn btn-default btn-small"><span class="entypo-icon-contact"></span>Crear nuevo usuario</button>


<!-- Modal -->
<div class="modal users-create" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-body">
        <p><span class="entypo-icon-contact"></span><b>Crear nuevo usuario</b></p>
        <div class="well">
        	<b>
        		Si desea dejar algún campo vacío puede dejarlo vacío, tome en cuenta que algunos campos son requeridos.
        	</b>
        </div>
        <hr>

		{{Form::open(['url' => 'admin-usuarios-crear', 'method' => 'POST'])}}

		<div class="panel panel-default hover">
			<div class="panel-heading">
				<h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Informacion de Usuario</span>
                </h4>
			</div>
			<div class="panel-body">
				<div class="row">
				<div class="col-md-6">
					<label>Usuario</label>
					{{Form::text('Usuario', '', ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('Usuario') }}</b></p>

				</div>
				<div class="col-md-6">
					<label>Email</label>
					{{Form::text('Email', '', ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('Email') }}</b></p>
				</div>
				</div>

				<div class="row">
				<div class="col-md-6">
					<label>Clave</label>
					{{Form::text('password', '', ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('password') }}</b></p>
				</div>
				<div class="col-md-6">
					<label>Rol</label>
					<select name="rol" id="" class="form-control">
						<option value="2">Promotor</option>
						<option value="3">Agencia</option>
						<option value="4">Taquilla</option>
						<option value="5">Usuario</option>
					</select>
					<p class="text-danger"><b>{{ $errors->first('rol') }}</b></p>
				</div>

				</div>

			</div>
		</div>

		<div class="panel panel-default hover">
			<div class="panel-heading">
				<h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Informacion basica</span>
                </h4>
			</div>
			<div class="panel-body">
				<div class="row">
				<div class="col-md-6">
					<label>Nombre</label>
					{{Form::text('Nombre', '', ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('Nombre') }}</b></p>
				</div>
				<div class="col-md-6">
					<label>Apellido</label>
					{{Form::text('Apellido', '', ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('Apellido') }}</b></p>
				</div>
				</div>

				<div class="row">
				<div class="col-md-6">
					<label>Cedula</label>
					{{Form::text('Cedula', '', ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('Cedula') }}</b></p>
				</div>
				<div class="col-md-6">
					<label>Direccion</label>
					{{Form::text('Direccion', '', ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('Direccion') }}</b></p>
				</div>
				</div>

				<div class="row">
				<div class="col-md-6">
					<label>Ciudad</label>
					{{Form::text('Ciudad', '', ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('Ciudad') }}</b></p>
				</div>
				<div class="col-md-6">
					<label>Telefono</label>
					{{Form::text('Telefono', '', ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('Telefono') }}</b></p>
				</div>
				</div>

				<div class="row">
				<div class="col-md-3">
					<label>Grupo</label>
					<select name="Dueno" class="form-control">
						@foreach(Grupo::get() as $grupo)
							<option value="{{$grupo->id}}">{{$grupo->nombre}}</option>
						@endforeach
					</select>
					<p class="text-danger"><b>{{ $errors->first('Dueno') }}</b></p>
				</div>
				</div>
			</div>
		</div>

		<div class="panel panel-default hover">
			<div class="panel-heading">
				<h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Informacion bancaria</span>
                </h4>
			</div>
			<div class="panel-body">
				<div class="row">
				<div class="col-md-12">
					<label>Banco</label>
					{{Form::text('banco', '', ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('banco') }}</b></p>
				</div>
				<div class="col-md-12">
					<label>Numero de cuenta</label>
					{{Form::text('numero_cuenta', '', ['class'=>'form-control'])}}
					<p class="text-danger"><b>{{ $errors->first('numero_cuenta') }}</b></p>
				</div>
				</div>

			</div>
		</div>

		<br>
		<button type="submit" class="btn btn-info" ><span class="icon16 icomoon-icon-enter white"></span> Crear Usuario</button>

		{{Form::close()}}

      </div>

    </div>
  </div>
</div>