<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Producto_imagen_library {

    protected $CI;

    public function __construct(){
        $this->CI =& get_instance();        
        $this->CI->load->model("generico_model");        
    }
    
    public function eliminar(){
        $id = $this->CI->input->post('id');        
        $pi = $this->CI->generico_model->get($id,"producto_imagen");
        //eliminar imagen
        @unlink($pi['imagen']);      
        
        //eliminar registro de base de datos
        $result = $this->CI->generico_model->eliminar($id,"producto_imagen");       
        
        echo json_encode(true);  
    }    
 
//    public function destacado(){
//        $id = $this->CI->input->post('id'); 
//        //todos los demas articulos poner a 0 su destacado
//        $this->CI->producto_model->editar_todos(array('destacado' => 0 ),$data['control']);  
//        //cambiar destacado a 1 solo a este articulo
//        $this->CI->producto_model->editar($id,array('destacado' => 1 ),$data['control']);       
//        
//        echo json_encode(true);  
//    }
    
//    public function orden_arriba(){
//        $id = $this->CI->input->post('id'); 
//                
//        if($this->CI->orden_library->orden_arriba_tabla($id,'producto')){
//            //intercambio bien
//            echo json_encode(array("arriba"=> 1)); 
//        }else{
//            //sino es el primero
//            echo json_encode(array("arriba"=> 0)); 
//        }        
//    }
//    
//    public function orden_abajo(){
//        $id = $this->CI->input->post('id'); 
//                
//        if($this->CI->orden_library->orden_abajo_tabla($id,'producto')){
//            //intercambio bien
//            echo json_encode(array("abajo"=> 1)); 
//        }else{
//            //sino es el primero
//            echo json_encode(array("abajo"=> 0)); 
//        }        
//    }
    

}
