<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('is_logged'))
{
    function is_logged(){
        $CI =& get_instance();
        $CI->load->library("auth_library"); 
        return $CI->auth_library->is_logged();        
    }
}


