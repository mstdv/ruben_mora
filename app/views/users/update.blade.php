@extends('panel')

@section('web-titulo')
    @parent
    Gestion y control de usuarios
@stop

@section('mod-titulo')
    Gestion y control de usuarios
@stop

@section('web-contenido')
<div class="row">
<div class="col-lg-12">

<!-- Modal -->
@if($usuarion=User::where('id',$id)->get())

{{HTML::link(URL::to('/admin-usuarios'), 'Ir a la pagina aterior', ['class'=>'btn btn-default'])}}
    <hr>
        {{Form::open(['url' => 'admin-usuarios-modificar', 'method' => 'POST'])}}

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
                    {{Form::text('Usuario', $usuarion[0]->usuario, ['class'=>'form-control'])}}
                    <p class="text-danger"><b>{{ $errors->first('Usuario') }}</b></p>

                    {{ Form::hidden('id', $usuarion[0]->id) }}

                </div>
                <div class="col-md-6">
                    <label>Email</label>
                    {{Form::text('Email', $usuarion[0]->email, ['class'=>'form-control'])}}
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
                    <select name="rol" class="form-control">
                        <option value="{{$usuarion[0]->rol}}" selected="true">{{User::getRol($usuarion[0]->rol)}}</option>
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
                    {{Form::text('Nombre', $usuarion[0]->nombre, ['class'=>'form-control'])}}
                    <p class="text-danger"><b>{{ $errors->first('Nombre') }}</b></p>
                </div>
                <div class="col-md-6">
                    <label>Apellido</label>
                    {{Form::text('Apellido', $usuarion[0]->apellido, ['class'=>'form-control'])}}
                    <p class="text-danger"><b>{{ $errors->first('Apellido') }}</b></p>
                </div>
                </div>

                <div class="row">
                <div class="col-md-6">
                    <label>Cedula</label>
                    {{Form::text('Cedula', $usuarion[0]->cedula, ['class'=>'form-control'])}}
                    <p class="text-danger"><b>{{ $errors->first('Cedula') }}</b></p>
                </div>
                <div class="col-md-6">
                    <label>Direccion</label>
                    {{Form::text('Direccion', $usuarion[0]->direccion, ['class'=>'form-control'])}}
                    <p class="text-danger"><b>{{ $errors->first('Direccion') }}</b></p>
                </div>
                </div>

                <div class="row">
                <div class="col-md-6">
                    <label>Ciudad</label>
                    {{Form::text('Ciudad', $usuarion[0]->ciudad, ['class'=>'form-control'])}}
                    <p class="text-danger"><b>{{ $errors->first('Ciudad') }}</b></p>
                </div>
                <div class="col-md-6">
                    <label>Telefono</label>
                    {{Form::text('Telefono', $usuarion[0]->telefono, ['class'=>'form-control'])}}
                    <p class="text-danger"><b>{{ $errors->first('Telefono') }}</b></p>
                </div>
                </div>

                <div class="row">
                <div class="col-md-6">
                    <label>Due&ntilde;o</label>
                    {{Form::text('Dueno', $usuarion[0]->dueno, ['class'=>'form-control'])}}
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
                    {{Form::text('banco', $usuarion[0]->banco, ['class'=>'form-control'])}}
                    <p class="text-danger"><b>{{ $errors->first('banco') }}</b></p>
                </div>
                <div class="col-md-12">
                    <label>Numero de cuenta</label>
                    {{Form::text('numero_cuenta', $usuarion[0]->numero_cuenta, ['class'=>'form-control'])}}
                    <p class="text-danger"><b>{{ $errors->first('numero_cuenta') }}</b></p>
                </div>
                </div>

            </div>
        </div>

        <br>
        <button type="submit" class="btn btn-info" ><span class="icon16 icomoon-icon-enter white"></span> Modificar Usuario</button>

        {{Form::close()}}


@endif

</div><!-- End .span12 -->
</div><!-- End .row -->

@stop