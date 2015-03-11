@extends('panel')

@section('web-titulo')
    @parent
    Informacion detallada de usuario
@stop

@section('mod-titulo')
	Informacion detallada de usuario ({{$id}})
@stop

@section('web-contenido')
<div class="row">
<div class="col-lg-12">
	@if(Auth::user()->rol == 1)
        {{HTML::link(URL::to('/admin-usuarios'), 'Ir a la pagina aterior', ['class'=>'btn btn-default'])}}
    @else
        {{HTML::link(URL::to('/'), 'Ir al inico', ['class'=>'btn btn-default'])}}
    @endif
	<hr>
    <div class="panel panel-default gradient">
        <div class="panel-heading">
            <h4>
                <span>Informacion del usuario</span>
            </h4>
        </div>
        <div class="panel-body noPad clearfix">
            <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cedula</th>
                        <th>Telefono</th>
                        <th>Dueno</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                @foreach($u = User::where('id',$id)->get() as $usuario)
					<tr>
						<td>{{$usuario->id}}</td>
						<td>{{$usuario->nombre}}</td>
						<td>{{$usuario->apellido}}</td>
						<td>{{$usuario->cedula}}</td>
						<td>{{$usuario->telefono}}</td>
						<td>{{$usuario->dueno}}</td>
						<td>{{$usuario->usuario}}</td>
						<td>{{$usuario->email}}</td>
						<td>{{User::getRol($usuario->rol)}}</td>
					</tr>
                @endforeach

                <thead>
                    <tr>
                        <th>Direccion</th>
                        <th>Ciudad</th>
                        <th>Banco</th>
                        <th colspan="6">Numero de cuenta</th>
                    </tr>
                </thead>
                @foreach($u = User::where('id',$id)->get() as $usuario)
					<tr>
						<td>{{$usuario->direccion}}</td>
						<td>{{$usuario->ciudad}}</td>
						<td>{{$usuario->banco}}</td>
						<td colspan="6">{{$usuario->numero_cuenta}}</td>
					</tr>
                @endforeach
            </table>
        </div>
    </div><!-- End .panel -->

    <div class="panel panel-default gradient">
        <div class="panel-heading">
            <h4>
                <span>Informacion de mis restricciones de parley</span>
            </h4>
        </div>
        <div class="panel-body noPad clearfix">
            <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
            <tr class="cabezera">
                <td class="cabezera">Nombre del usuario:</td>
                <td>Lista de restricciones actuales</td>
            </tr>
            @foreach($g = User::where('id', Auth::user()->id)->paginate(1) as $usuario)
            <tr>
                <td style="color:grey;">
                <a href="{{URL::to('/')}}/admin-usuarios-info/{{$usuario->id}}">
                    <div style="display: block; width: 200px; overflow: hidden;">{{$usuario->nombre}} {{$usuario->apellido}}</div>
                </a>

                <td>
                    @if(Restriccion::where('user_id', $usuario->id)->count() == 0)
                        <div class="label label-info">
                        No posee restricciones asignadas
                        </div>
                    @else
                        @foreach(Restriccion::where('user_id', $usuario->id)->get() as $res)
                        <span class="label label-success" style="margin: 2px; display: inline-block;">{{Restriccion::getNombre($res->restriccion)}} ({{Deporte::getInf($res->deporte_id)->nombre}}) </span>
                        @endforeach
                    @endif
                </td>
            </tr>
            @endforeach
            </table>
        </div>
    </div><!-- End .panel -->
</div><!-- End .span12 -->
</div><!-- End .row -->
@stop