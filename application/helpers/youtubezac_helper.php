<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getCodigoYoutube'))
{    
    //01/07/2015
    function getCodigoYoutube($url) {
        
        if(strstr($url,'embed')){
            $codigo = substr($url,30);
        }else{
            $codigo = substr($url,32);
        }
        
        return $codigo;
    }   
}
