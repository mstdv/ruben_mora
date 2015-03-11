@extends('panel')

@section('web-titulo')
    @parent
    Configuracion de restricciones
@stop

@section('mod-titulo')
	Configuracion de restricciones
@stop

@section('web-contenido')
<div class="row">
<div class="col-lg-12">
	<style>
		.input {
			width: 83px !important;
			display: inline-block;
			margin: 0 auto;
			text-align: center;
		}
		.successtd {
			background: #E9FFE9 !important;
			font-weight: bold;
			color: green;
		}

		.successtd input {
			color: green !important;
			font-weight: bold;
			text-align: center;
		}

		.cabezera {
			background: #eee !important;
			color: #363636;
			text-align: center;
			font-weight: bold;
		}
	</style>
	<div class="well">
		A continuación se muestran los usuarios <b>(taquillas)</b> dentro del sistema, podrá gestionar su configuración de restricciones con las opciones que le parecen debajo.
	</div>

	<h3>Listado de usuarios <b>(Taquilla)</b></h3>
	<table class="table table-striped table-hover table-bordered">
		<tr class="cabezera">
			<td class="cabezera">Nombre del usuario:</td>
			<td class="cabezera">Agregar</td>
			<td>Lista de restricciones actuales</td>
			<td>Opciones</td>
		</tr>
		@foreach($g = User::where('rol', 3)->paginate(3) as $usuario)
		{{Form::open(['method'=>'PUT', 'url'=>'/restriccions/'.$usuario->id])}}
		<tr>
			<td style="color:grey;">
			<a href="{{URL::to('/')}}/admin-usuarios-info/{{$usuario->id}}">
				<div style="display: block; width: 200px; overflow: hidden;">{{$usuario->nombre}} {{$usuario->apellido}}</div>
			</a>

            <td>

                <select name="restricciones" id="" style="margin: 5px; text-transform: uppercase">
                    <option value="1">A ganar con A/B</option>
                    <option value="2">Runline con A/B</option>
                    <option value="3">SuperRunline con A/B</option>
                    <option value="4">Empate con A/B</option>
                    <option value="5">SI o NO con A/B</option>
                    <option value="6">Quien Anota Pr. con A/B</option>
                    <option value="7">Total CHE con equipo</option>
                    <option value="8">Q. Anota Pr. con Equipo</option>
                    <option value="9">Total CHE con A/B</option>
                    <option value="10">Total CHE y SI/NO</option>
                    <option value="11">Q. Anota Pr. con Equipo 1ra Mitad</option>
                    <option value="12">Q. Anota Pr. con Equipo 2da Mitad</option>
                    <option value="13">SI o NO con Equipo 1ra Mitad</option>
                    <option value="14">SI o NO con Equipo 2da Mitad</option>
                </select>

               <select name="deporte" style="margin: 5px;">
                   @foreach(Deporte::get() as $deporte)
                   <option value="{{$deporte->id}}">

                    {{strtoupper($deporte->nombre)}}

                   </option>
                   @endforeach
               </select>


            </td>

            <td>
                @if(Restriccion::where('user_id', $usuario->id)->count() == 0)
                    <div class="label label-info">
                    No posee restricciones asignadas
                    </div>
                @else
                    @foreach(Restriccion::where('user_id', $usuario->id)->get() as $res)
                    <span style="margin: 2px; display: inline-block; font-weight: bold; padding: 3px; font-size: 10px; text-transform: uppercase; border: 1px #EB9316 dotted;">
                        {{Restriccion::getNombre($res->restriccion)}} ({{Deporte::getInf($res->deporte_id)->nombre}})

                            <a href="{{URL::to('/restriccion/delete/'.$res->id)}}" class="btn btn-xs btn-warning" type="submit" style="display: block; width: 100%"><b>Eliminar - ID: {{$res->id}}</b></a>

                    </span>

                    @endforeach
                @endif
            </td>
            <td>
                <button class="btn btn-block btn-default" style="font-size: 13px; padding-left: 10px; padding-right: 10px;">Guardar cambios</button>
            </td>
		</tr>
		{{Form::close()}}
		@endforeach
	</table>

	<br>
	{{$g->links()}}

</div><!-- End .span12 -->
</div><!-- End .row -->
@stop