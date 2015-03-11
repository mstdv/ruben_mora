<?php

class Restriccion extends \Eloquent {
	protected $fillable = [];
    public static function getNombre($num)
    {
        if($num=="1")
            return "A ganar con A/B";
        elseif($num=="2")
            return "Runline con A/B";
        elseif($num=="3")
            return "SuperRunline con A/B";
        elseif($num=="4")
            return "Empate con A/B";
        elseif($num=="5")
            return "SI o NO con A/B";
        elseif($num=="6")
            return "Quien Anota Pr. con A/B";
        elseif($num=="7")
            return "Total CHE con equipo";
        elseif($num=="8")
            return "Q. Anota Pr. con Equipo";
        elseif($num=="9")
            return "Total CHE con A/B";
        elseif($num=="10")
            return "Total CHE y SI/NO";
        elseif($num=="11")
            return "Q. Anota Pr. con Equipo 1ra Mitad";
        elseif($num=="12")
            return "Q. Anota Pr. con Equipo 2da Mitad";
        elseif($num=="13")
            return "SI o NO con Equipo 1ra Mitad";
        elseif($num=="14")
            return "SI o NO con Equipo 2da Mitad";
    }
}