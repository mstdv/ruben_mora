
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="keywords" content="">
<meta name="description" content="">
<title>{{WEB_EMPRESA_NOMBRE}} Hoja de logros</title>
<style>
  body {
  	font-family: arial;
  	font-size: 8px;
  	text-transform: uppercase;
  }
  #all{
    color: #000000;
    font-family: Verdana;
    margin-top: 1px;
    font-size: 7pt; /*12pt*/
    width: 1100px; /* 1100 px*/
    border: 1px solid black;
  }
  #centerName{
    font-weight:bold;
    font-size: 120%;
    border: 1px dotted black;
    text-align: center;
    padding: 2px;
    margin: 2px;
  }
  #foot{
    font-style: italic;
    border-top: 1px dashed black;
    text-align: center;
    padding-top: 2px;
    margin-top: 2px;
  }
</style>
<script  type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
// $(function(){
//   print()
// });
</script>

</head>
<body class="body">
<div id="all">
  <?php $fecha = explode('-', $fecha); $fecha = $fecha[2].'/'.$fecha[1].'/'.$fecha[0]; ?>

  <div id="centerName" >{{WEB_EMPRESA_NOMBRE}} Hoja de logros de la fecha: <i>{{$fecha}}</i></div>
  <div id="centerName" >
    <i>
            Fecha: {{Carbon::now('America/Caracas')->format('d/m/Y h:i a')}}</i>
  </div>
  @include('hojas.partes.css')
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

<table cellpadding="0" cellspacing="0" id ='odd_sheet' >
<tr>
  <th rowspan="2" width='50px'>HORA</th>
  <th rowspan="2" width='135px'>EQUIPOS</th>
  <th colspan='4'>COMPLETO</th><th colspan='3' class="mitad">MITAD</th><th colspan='4'>EXOTICAS</th></tr>
<tr>
  <th width='65px'>A Ganar</th><th width='65px'>Runline</th><th width='65px'>SupRline</th><th width='65px'>A/B - Empate</th><th width='65px' class="border1">A Ganar</th><th width='65px' class="bg">Runline</th><th width='65px' class="border2">A/B - Empate</th><th width='100px'>A/B Indiv</th><th width='60px'>Carr 1er Inn</th><th width='60px'>Anota 1ro</th><th width='65px'>Total CHE</th></tr>
