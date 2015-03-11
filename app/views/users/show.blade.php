    <style>
    .icon24, .icomoon-icon-unlocked, .icomoon-icon-lock-2 { font-size: 20px; display: inline-block !important; text-decoration: none;}
    </style>
    <div class="panel panel-default gradient">
        <div class="panel-heading">
            <h4>
                <span>Listado de usuarios</span>
            </h4>
        </div>
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
                        <td width="190px"></td>
                    </tr>
                </thead>
                @foreach($u = User::orderBy('created_at', 'DESC')->paginate(5) as $usuario)
                    <tr>
                        <td>{{$usuario->id}}</td>
                        <td>{{$usuario->nombre}}
                        {{$usuario->apellido}}</td>
                        <td>{{($usuario->cedula)?$usuario->cedula:'No posee'}}</td>
                        <td>{{($usuario->telefono)?$usuario->telefono: 'No posee'}}</td>
                        <td>{{($usuario->usuario)?$usuario->usuario: 'No posee'}}</td>
                        <td>{{($usuario->email)?$usuario->email: 'No posee'}}</td>
                        <td>{{User::getRol($usuario->rol)}}</td>
                        <td><a href="{{URL::to('/grupos/'.$usuario->grupo_id)}}">{{Grupo::getInf($usuario->grupo_id)->nombre}}</a>

                        <a href="{{URL::to('/grupos/move/'.$usuario->id)}}" class="btn btn-xs btn-default btn-block">Mover</a>

                        </td>
                        <td>

                            <a href="{{URL::to('/admin-usuarios-info/'.$usuario->id)}}" title="Informacion Detallada"><span class="icon24 icomoon-icon-stack"></span></a>

                            <a href="{{URL::to('/admin-usuarios-eliminar/'.$usuario->id)}}" title="Eliminar"><span class="icon24 typ-icon-cancel"></span></a>

                            <a href="{{URL::to('/admin-usuarios-modificar/'.$usuario->id)}}" title="Modificar"><span class="icon24 typ-icon-cog"></span></a>

                            @if($usuario->estado == 1)
                                <a href="{{URL::to('/users/changeState/'.$usuario->id)}}" title="Suspender" class="icon24 icomoon-icon-lock-2"></a>
                            @else
                                <a href="{{URL::to('/users/changeState/'.$usuario->id)}}" title="Activar Cuenta" class="icon24 icomoon-icon-unlocked"></a>
                            @endif

                        </td>
                    </tr>



                @endforeach
            </table>
        </div>
    </div><!-- End .panel -->
    {{ $u->links() }}


    <div class="panel panel-default gradient">
        <div class="panel-heading">
            <h4>
                <span>Listado de grupos usuarios</span>
            </h4>
        </div>
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
                @foreach($j = Grupo::orderBy('created_at')->paginate(5) as $grupo)
                    <tr>
                        <td>{{$grupo->id}}</td>
                        <td><a href="{{URL::to('/grupos/'.$grupo->id)}}"> {{$grupo->nombre}} </a> </td>
                        <td>{{$grupo->descripcion}}</td>
                        <td>{{User::getInf($grupo->user_id)->nombre}}
                        {{User::getInf($grupo->user_id)->apellido}} <b> [
                        {{User::getRol(User::getInf($grupo->user_id)->rol)}} ] </b></td>
                        <td>
                            <a href="{{URL::to('/grupos/'.$grupo->id)}}" title="Informacion Detallada"><span class="icon24 icomoon-icon-stack"></span></a>
                        </td>
                    </tr>



                @endforeach
            </table>
        </div>
    </div><!-- End .panel -->
    {{ $j->links() }}