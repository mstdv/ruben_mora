<?php

class Apuestas extends \Eloquent {
	protected $fillable = [];

  public static function nombreLogro($a,$b)
  {
    if (''.$a == $b) {
      echo 'A Ganar <b>(JUEGO COMPLETO)</b>';
    } elseif ('1'.$a == $b) {
      echo 'Runline <b>(JUEGO COMPLETO)</b>';
    } elseif ('2'.$a == $b) {
      echo 'Super Runline <b>(JUEGO COMPLETO)</b>';
    } elseif ('A'.$a == $b) {
      echo 'Alta  <b>(JUEGO COMPLETO)</b>';
    } elseif ('B'.$a == $b) {
      echo 'Baja  <b>(JUEGO COMPLETO)</b>';
    } elseif ('E'.$a == $b) {
      echo 'Empate <b>(JUEGO COMPLETO)</b>';
    } elseif ('5'.$a == $b) {
      echo 'A ganar <b>(MEDIO JUEGO)</b>';
    } elseif ('6'.$a == $b) {
      echo 'Runline  <b>(MEDIO JUEGO)</b>';
    } elseif ('A5'.$a == $b) {
      echo 'Alta <b>(MEDIO JUEGO)</b>';
    } elseif ('B5'.$a == $b) {
      echo 'Baja <b>(MEDIO JUEGO)</b>';
    } elseif ('E5'.$a == $b) {
      echo 'Empate <b>(MEDIO JUEGO)</b>';
    } elseif ('S'.$a == $b) {
      echo 'Si hay Carreras <b>(EXÓTICAS)</b>';
    } elseif ('N'.$a == $b) {
      echo 'No hay Carreras  <b>(EXÓTICAS)</b>';
    } elseif ('AV'.$a == $b) {
      echo 'Alta Visitante  <b>(EXÓTICAS)</b>';
    } elseif ('BV'.$a == $b) {
      echo 'Baja Visitante  <b>(EXÓTICAS)</b>';
    } elseif ('AH'.$a == $b) {
      echo 'Alta HomeClub <b>(EXÓTICAS)</b>';
    } elseif ('BH'.$a == $b) {
      echo 'Baja HomeClub  <b>(EXÓTICAS)</b>';
    } elseif ('V'.$a == $b) {
      echo 'Anota Primero Visitante  <b>(EXÓTICAS)</b>';
    } elseif ('H'.$a == $b) {
      echo 'Anota Primero Home Club <b>(EXÓTICAS)</b>';
    } elseif ('O'.$a == $b) {
      echo 'CHE Alta <b>(EXÓTICAS)</b>';
    } elseif ('U'.$a == $b) {
      echo 'CHE Baja <b>(EXÓTICAS)</b>';
    }
  }

    public static function xLogro($valor)
	{
        $nv = $valor;

        if ($nv<0)
        { return -(100-$nv)/$nv; }
        else
        { return (100+$nv)/100; }
    }

    public static function CalcularParlay($form, $monto)
    {
        $monto_sep = array();

        foreach($form as $key => $value){
            array_push($monto_sep, self::xLogro($value));
        }

        $x  = 1;
        foreach ($monto_sep as $mont) {
            $x *= $mont;
        }

        return ($x) * $monto;
    }

}