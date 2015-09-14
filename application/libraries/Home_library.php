<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Home_library {

    protected $CI;

    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model("generico_model");      
    }
    
    public function actualizar($data_config) {
        $id = $this->CI->input->post("id");
        $ancho = $this->CI->input->post("ancho");
        $alto = $this->CI->input->post("alto");
        
        $errors = array(
            'upload_imagen' => '',
            'actualizar' => 0          
        );     

        $item_home = $this->CI->generico_model->get($id,$data_config['tabla']);
                
        $file_name = "home_".Date("YmdHis");
        $file_name_ext = "";      

        $config['upload_path'] = $data_config['carpeta_imagen'];
        $config['file_name'] = $file_name;
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
        $config['max_width'] = $ancho;
        $config['max_height'] = $alto;
        $config['min_width'] = $ancho;
        $config['min_height'] = $alto;
        
        $this->CI->load->library('upload', $config);

        if (!$this->CI->upload->do_upload("imagen")) {
            //*** ocurrio un error            
            $errors['upload_imagen'] =  $this->CI->upload->display_errors('','');           
        }else{
            $uploadSuccess = $this->CI->upload->data();
            $file_name_ext = $uploadSuccess['file_name'];   
            //borrar la imagen anterior
            @unlink($item_home['imagen']);
            
            $registro_update['imagen'] = $config['upload_path'].$file_name_ext;
            
            if($this->CI->generico_model->editar($id,$registro_update,$data_config['tabla'])){
                $errors['actualizar'] = 1;                
            }else{
                $errors['actualizar'] = 0;                
            }
        }
            
        echo json_encode($errors);        
    }   

    public function listado($data_config) {
        $header = array();
        $data = array(    );
        //SERVICIOS
        $data['serv1'] = $this->CI->generico_model->get(1,'home_contenido');
        $data['serv2'] = $this->CI->generico_model->get(2,'home_contenido');
        $data['serv3'] = $this->CI->generico_model->get(3,'home_contenido');
        //PORTAFOLIO
        $data['port1'] = $this->CI->generico_model->get(4,'home_contenido');
        $data['port2'] = $this->CI->generico_model->get(5,'home_contenido');     
        $data['port3'] = $this->CI->generico_model->get(6,'home_contenido');      
        
        $data = array_merge($data, $data_config); 
        
        $footer = array();        
        
        $this->CI->view_admin_library->plantilla("home/listado",$header,$data,$footer);       
    }   
    

}
