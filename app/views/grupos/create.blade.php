<button data-toggle="modal" data-target=".grupos-users-create" class="btn btn-default btn-small"><span class="entypo-icon-contact"></span>Crear nuevo grupo de usuario</button>


<!-- Modal -->
<div class="modal grupos-users-create" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-body">
        <p><span class="entypo-icon-contact"></span><b>Crear nuevo grupo de usuario</b></p>
        <hr>

    		{{Form::open(['url' => '/grupos', 'method' => 'POST'])}}
          <div class="row">
            <div class="col-md-6">
              {{Form::label('nombre', 'Nombre del grupo')}}
              {{Form::text('nombre', '', ['class'=>'form-control'])}}
              <p class="text-danger"><b>{{ $errors->first('nombre') }}</b></p>
            </div>

            <div class="col-md-6">
              {{Form::label('admin', 'Administrador del grupo')}}
              <select name="admin" class="form-control">
                @foreach(User::get() as $admin)
                  <option value="{{$admin->id}}"> {{$admin->nombre.' '.$admin->apellido.'
                  <b>['.User::getRol($admin->rol)}}]</b> </option>
                @endforeach
              </select>
              <p class="text-danger"><b>{{ $errors->first('admin') }}</b></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              {{Form::label('descripcion', 'Descripcion del grupo')}}
              {{Form::textarea('descripcion', '', ['class'=>'form-control'])}}
              <p class="text-danger"><b>{{ $errors->first('descripcion') }}</b></p>

              <br>
              <button type="submit" class="btn btn-info" ><span class="icon16 icomoon-icon-enter white"></span> Crear grupo</button>
            </div>
          </div>

    		{{Form::close()}}

      </div>

    </div>
  </div>
</div>