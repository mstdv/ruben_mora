@extends('panel')

@section('web-titulo')
    @parent
    Agregar nuevo integrante al grupo [{{$data->nombre}}]
@stop

@section('mod-titulo')
	Agregar nuevo integrante al grupo [{{$data->nombre}}]
@stop

@section('web-contenido')

<div class="row">
	<div class="col-lg-12">
		<h4>Seleccione el usuario y precione continuar</h4>
		{{Form::open(['url' => '/grupos/newuser/'.$data->id, 'method' => 'post'])}}
		{{Form::label('user', 'Usuario')}}
		  <select name="user" class="form-control">
		    @foreach(User::where('grupo_id','!=',$data->id)->get() as $admin)
		      <option value="{{$admin->id}}"> {{$admin->nombre.' '.$admin->apellido.'
		      <b>['.User::getRol($admin->rol)}}]</b> </option>
		    @endforeach
		  </select>
		  <p class="text-danger"><b>{{ $errors->first('user') }}</b></p>
		  <button type="submit" class="btn btn-info" ><span class="icon16 icomoon-icon-enter white"></span> Agregar el usuario al grupo</button>
		{{Form::close()}}
	</div>
</div>

@stop