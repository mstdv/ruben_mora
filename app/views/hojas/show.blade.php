@include('hojas.partes.header', ['fecha' => $fecha])
<?php $u = 0; ?>
@foreach($ligas as $liga)
	@foreach(Logro::where('liga_id', $liga)->where('fecha_partido', $fecha)->get() as $logro)
		@if(!array_key_exists('op_2', $opciones_list))
			<?php $logro->mitad_aganar_a = '--'; ?>
			<?php $logro->mitad_aganar_b = '--'; ?>
			<?php $logro->mitad_runline_a = '--'; ?>
			<?php $logro->mitad_runline_b = '--'; ?>
			<?php $logro->mitad_runline_c = '--'; ?>
			<?php $logro->mitad_runline_d = '--'; ?>
			<?php $logro->mitad_altabaja_a = '--'; ?>
			<?php $logro->mitad_altabaja_b = '--'; ?>
			<?php $logro->mitad_altabaja_c = '--'; ?>
			<?php $logro->mitad_empate = '--'; ?>
		@endif

		@if(!array_key_exists('op_3', $opciones_list))
			<?php $logro->completo_super_runline_a = '--'; ?>
			<?php $logro->completo_super_runline_b = '--'; ?>
			<?php $logro->completo_super_runline_c = '--'; ?>
			<?php $logro->completo_super_runline_d = '--'; ?>
		@endif

		@if(!array_key_exists('op_4', $opciones_list))
			<?php $logro->exoticas_ab_visitante_a = '--'; ?>
			<?php $logro->exoticas_ab_visitante_b = '--'; ?>
			<?php $logro->exoticas_ab_visitante_c = '--'; ?>
			<?php $logro->exoticas_ab_home_a = '--'; ?>
			<?php $logro->exoticas_ab_home_b = '--'; ?>
			<?php $logro->exoticas_ab_home_c = '--'; ?>
			<?php $logro->exoticas_quienanotaprimero_a = '--'; ?>
			<?php $logro->exoticas_quienanotaprimero_b = '--'; ?>
			<?php $logro->exoticas_totalche_a = '--'; ?>
			<?php $logro->exoticas_totalche_b = '--'; ?>
			<?php $logro->exoticas_totalche_c = '--'; ?>
		@endif

		@if(strtolower(Deporte::getInf($logro->deporte_id)->nombre) == 'baseball')
			<tr><th colspan='14' class='leanam'>{{Liga::getInf($logro->liga_id)->nombre}} ({{Deporte::getInf($logro->deporte_id)->nombre}})</th></tr>  <tr class='first'>
			@include('logros.baseball.list-form-pdf', ['data'=>$logro, 'opciones_list' => $opciones_list])
			<?php $u+=1; ?>
		@else
			<tr><th colspan='14' class='leanam'>{{Liga::getInf($logro->liga_id)->nombre}} ({{Deporte::getInf($logro->deporte_id)->nombre}})</th></tr>  <tr class='first'>
			@include('logros.no-baseball.list-form-pdf', ['data'=>$logro, 'opciones_list' => $opciones_list])
			<?php $u+=1; ?>
		@endif

	@endforeach
@endforeach
@include('hojas.partes.footer', ['u' => $u])