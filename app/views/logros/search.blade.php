@extends('panel')

@section('web-titulo')
    @parent
    Logros para la liga: {{Liga::getInf($liga)->nombre}}
@stop

@section('mod-titulo')
	Logros para la liga: {{Liga::getInf($liga)->nombre}}
@stop

@section('web-contenido')
<div class="row">
<div class="col-lg-12">


@foreach($u = Logro::where('liga_id', $liga)->whereBetween('fecha_partido',array(e($fecha1), e($fecha2)))->orderBy('created_at')->paginate(5) as $logro)
{{Form::open(['url' => '/logros/update', 'method' => 'POST', 'class' => 'form-horizontal'])}}

@if(strtolower(Deporte::getInf($logro->deporte_id)->nombre) == 'baseball')
	<h3>{{Equipo::getInf($logro->equipo1)->nombre}}  (VS)  {{Equipo::getInf($logro->equipo2)->nombre}}</h3>
	@include('logros.baseball.list-form', ['data'=>$logro])
@else
	<h3>{{Equipo::getInf($logro->equipo1)->nombre}}  (VS)  {{Equipo::getInf($logro->equipo2)->nombre}}</h3>
	@include('logros.no-baseball.list-form', ['data'=>$logro])
@endif

{{Form::close()}}
@endforeach

{{ $u->links() }}

</div><!-- End .span12 -->
</div><!-- End .row -->
@stop