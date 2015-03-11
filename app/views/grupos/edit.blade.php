@extends('panel')

@section('web-titulo')
    @parent
    Modificar grupo [{{$data->nombre}}]
@stop

@section('mod-titulo')
	Modificar grupo [{{$data->nombre}}]
@stop

@section('web-contenido')
{{Form::open(['url' => '/grupos/'.$data->id, 'method' => 'put'])}}
<div class="row">
<div class="col-md-6">
  {{Form::label('nombre', 'Nombre del grupo')}}
  {{Form::text('nombre', $data->nombre, ['class'=>'form-control'])}}
  <p class="text-danger"><b>{{ $errors->first('nombre') }}</b></p>
</div>

<div class="col-md-6">
  {{Form::label('admin', 'Administrador del grupo')}}
  <select name="admin" class="form-control">
  	<option value="{{$data->user_id}}" selected="true">{{User::getInf($data->user_id)->nombre}} {{User::getInf($data->user_id)->apellido}} [Administrador actual]</option>
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
  {{Form::textarea('descripcion', $data->descripcion, ['class'=>'form-control'])}}
  <p class="text-danger"><b>{{ $errors->first('descripcion') }}</b></p>

  <br>
  <button type="submit" class="btn btn-info" ><span class="icon16 icomoon-icon-enter white"></span> Modificar grupo</button>
</div>
</div>

{{Form::close()}}
@stop