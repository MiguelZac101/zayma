<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Validar_imagen_library {

    protected $CI;

    public function __construct(){
        $this->CI =& get_instance();
//        $this->CI->load->library("view_admin_library");
//        $this->CI->load->model("editor_model");
//        $this->CI->load->model("anexgrid_model"); 
//        $this->CI->load->library("editor_anexgrid");
    }
    
 
     
    //validar el ancho y alto
    public function ancho_alto() {
        $ancho_deseado = $this->CI->input->post("ancho");
        $alto_deseado = $this->CI->input->post("alto");
        
        //validar imagen
        list($ancho_original, $alto_original, $tipo, $atributos) = getimagesize($_FILES['imagen']['tmp_name']); 
        
        if($ancho_deseado == $ancho_original && $alto_deseado == $alto_original){
            return 1;
        }else{
            return 0;
        }
        
    }
    
    
 
    
 
    

}
