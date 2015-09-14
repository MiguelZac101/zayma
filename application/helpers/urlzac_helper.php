<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('codificarURL'))
{    
    function codificarURL($string) {
        $string = strtolower($string);

        $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
        $replace = array('a', 'e', 'i', 'o', 'u', 'n');
        $string = str_replace($find, $replace, $string);

        $find = array(' ', '&', '\r\n', '\n', '+');
        $string = str_replace($find, '-', $string);

        $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
        $replace = array('', '-', '');

        $string = preg_replace($find, $replace, $string);
        return $string;
    }
}





