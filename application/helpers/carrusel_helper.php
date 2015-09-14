<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getCarrusel'))
{
    function getCarrusel($tabla){
        $CI =& get_instance();               
        $query = $CI->db->get($tabla);       
        $registros = $query->result_array();
        
        if(count($registros)>0){
            return $CI->load->view("carrusel",array("registros" => $registros),true);
        }else{
            return "";
        }
        
        
    }
}