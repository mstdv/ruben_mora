@extends('panel')

@section('web-titulo')
    @parent
    Mover usuario de grupo [{{$data->nombre}} {{$data->apellido}}]
@stop

@section('mod-titulo')
	Mover usuario de grupo [{{$data->nombre}} {{$data->apellido}}]
@stop

@section('web-contenido')

<div class="row">
	<div class="col-lg-12">
		<h4>Seleccione el usuario y precione continuar</h4>
		{{Form::open(['url' => '/grupos/move/'.$data->id, 'method' => 'post'])}}
		{{Form::label('grupo', $data->nombre.' '.$data->apellido.' Se movera al siguiente grupo: ')}}
		<select name="grupo" class="form-control">
		@foreach($u = Grupo::where('id', '!=', $data->grupo_id)->orderBy('created_at', 'DESC')->get() as $grupo)
			<option value="{{$grupo->id}}">{{$grupo->nombre}}</option>
		@endforeach
		</select>
		 <p class="text-danger"><b>{{ $errors->first('grupo') }}</b></p>

		  <button type="submit" class="btn btn-info" ><span class="icon16 icomoon-icon-enter white"></span> Agregar el usuario al grupo</button>
		{{Form::close()}}
	</div>
</div>

@stop