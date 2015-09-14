<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('fechaNaturalAMysql'))
{    
    //01/07/2015
    function fechaNaturalAMysql($fecha) {
        list($dia,$mes,$year) = explode('/', $fecha);        
        return $year."-".$mes."-".$dia;
    }   
}

if ( ! function_exists('fechaMysqlANatural'))
{    
    //2015-07-01
    function fechaMysqlANatural($fecha) {
        list($year,$mes,$dia) = explode('-', $fecha);        
        return $dia."/".$mes."/".$year;
    }    
}

if ( ! function_exists('fechaMysqlABlog'))
{    
    //2015-07-01
    function fechaMysqlABlog($fecha) {
        list($year,$mes,$dia) = explode('-', $fecha);
        
        switch($mes){
            case 1: $mes = "enero"; break;
            case 2: $mes = "febrero"; break;
            case 3: $mes = "marzo"; break;
            case 4: $mes = "abril"; break;
            case 5: $mes = "mayo"; break;
            case 6: $mes = "junio"; break;
            case 7: $mes = "julio"; break;
            case 8: $mes = "agosto"; break;
            case 9: $mes = "setiembre"; break;
            case 10: $mes = "octubre"; break;
            case 11: $mes = "noviembre"; break;
            case 12: $mes = "diciembre"; break;          
            
        }
        
        return $dia." de ".$mes." de ".$year;
    }    
}

