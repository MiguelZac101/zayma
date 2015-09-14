<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class View_admin_library {

    protected $CI;

    public function __construct(){
        $this->CI =& get_instance();
    }
    
    public function plantilla($page,$header,$data,$footer){        
        $this->CI->load->view("admin/templates/header",$header);        
        $this->CI->load->view("admin/".$page,$data);
        $this->CI->load->view("admin/templates/footer",$footer);
    }
    

}
