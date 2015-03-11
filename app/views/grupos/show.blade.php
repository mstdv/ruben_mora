@extends('panel')

@section('web-titulo')
    @parent
    Gestion y control del grupo [{{$data->nombre}}]
@stop

@section('mod-titulo')
	Gestion y control del grupo [{{$data->nombre}}]
@stop

@section('web-contenido')
<div class="row">
<div class="col-lg-12">

<h3> Informacion del grupo </h3>
        <div class="panel-body noPad clearfix">
            <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Lider del grupo [ROL]</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach($j = Grupo::orderBy('created_at')->where('id', $data->id)->get() as $grupo)
                    <tr>
                        <td>{{$grupo->id}}</td>
                        <td><a href="{{URL::to('/grupos/'.$grupo->id)}}"> {{$grupo->nombre}} </a> </td>
                        <td>{{$grupo->descripcion}}</td>
                        <td>
						<a href="{{URL::to('/admin-usuarios-info/'.$grupo->user_id)}}">
                        {{User::getInf($grupo->user_id)->nombre}}
                        {{User::getInf($grupo->user_id)->apellido}} <b> [
                        {{User::getRol(User::getInf($grupo->user_id)->rol)}} ] </b>
                        </a> </td>
                        <td>
	                        {{ Form::open(array('url' => '/grupos/'.$grupo->id, 'method' => 'delete')) }}
						        <button type="submit" href="{{ URL::route('grupos.destroy', $grupo->id) }}" style="display:block; margin: 5px;" class="btn btn-xs btn-default btn-block">Eliminar</button>
						    {{ Form::close() }}

						        <a href="{{ URL::to('/grupos/'.$grupo->id.'/edit') }}" style="display:block; margin: 5px;" class="btn btn-xs btn-default btn-block">Modificar</a>

                        </td>
                    </tr>
                @endforeach
            </table>
        </div>


		<h3> Integrates del grupo <a href="{{URL::to('/grupos/newuser/'.$data->id)}}" class="btn btn-xs btn-success">Agregar nuevo</a> </h3>

		<div class="panel-body noPad clearfix">
            <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre
                        y apellido</th>
                        <th>Cedula</th>
                        <th>Telefono</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Grupo</th>
                        <td></td>
                    </tr>
                </thead>
                @foreach($u = User::where('grupo_id', $data->id)->get() as $usuario)
                    <tr>
                        <td>{{$usuario->id}}</td>
                        <td>{{$usuario->nombre}}
                        {{$usuario->apellido}}</td>
                        <td>{{($usuario->cedula)?$usuario->cedula:'No posee'}}</td>
                        <td>{{($usuario->telefono)?$usuario->telefono: 'No posee'}}</td>
                        <td>{{($usuario->usuario)?$usuario->usuario: 'No posee'}}</td>
                        <td>{{($usuario->email)?$usuario->email: 'No posee'}}</td>
                        <td>{{User::getRol($usuario->rol)}}</td>
                        <td><a href="{{URL::to('/grupos/'.$usuario->grupo_id)}}">{{Grupo::getInf($usuario->grupo_id)->nombre}}</a></td>
                        <td>

                            <a href="{{URL::to('/admin-usuarios-info/'.$usuario->id)}}" title="Informacion Detallada"><span class="icon24 icomoon-icon-stack"></span></a>

                            <a href="{{URL::to('/admin-usuarios-eliminar/'.$usuario->id)}}" title="Eliminar"><span class="icon24 typ-icon-cancel"></span></a>

                            <a href="{{URL::to('/admin-usuarios-modificar/'.$usuario->id)}}" title="Modificar"><span class="icon24  typ-icon-cog"></span></a>

                        </td>
                    </tr>



                @endforeach
            </table>
        </div>

</div><!-- End .span12 -->
</div><!-- End .row -->
@stop