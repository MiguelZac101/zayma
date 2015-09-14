<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Editor_library {

    protected $CI;
    private $imagen_ancho = "100";
    private $imagen_alto = "100";
    
    public function __construct(){
        $this->CI =& get_instance();
//        $this->CI->load->library("view_admin_library");
        $this->CI->load->model("editor_model");
        $this->CI->load->model("anexgrid_model"); 
        $this->CI->load->library("editor_anexgrid");
    }
    
    //nuevo vista
    public function nuevo() {       
        echo $this->CI->load->view("admin/editor/nuevo",'',true);     
    }   
     
    //editar vista  
    public function editar() {
        $id = $this->CI->input->post("id");
        $editor = $this->CI->editor_model->get($id);
        echo $this->CI->load->view("admin/editor/editar",$editor,true);
    }
    
    public function registrar() {
        $errors = array(
            'upload_imagen' => '',
            'registro' => ''
        );
        $nombre = $this->CI->input->post("nombre");
        
        $file_name = "editor_".Date("YmdHis");
        $file_name_ext = "";
        $url = codificarURL($nombre);

        $config['upload_path'] = "uploads/editor/";
        $config['file_name'] = $file_name;
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
//            $config['max_size'] = '100';
        $config['max_width'] = $this->imagen_ancho;
        $config['max_height'] = $this->imagen_alto;
        $config['min_width'] = $this->imagen_ancho;
        $config['min_height'] = $this->imagen_alto;

        $this->CI->load->library('upload', $config);

        if (!$this->CI->upload->do_upload("imagen")) {
            //*** ocurrio un error            
            $errors['upload_imagen'] =  $this->CI->upload->display_errors('','');            
            
        }else{
            $uploadSuccess = $this->CI->upload->data();
            $file_name_ext = $uploadSuccess['file_name'];          
            
            //registrar
            $editor = array(
                'nombre' => $nombre,
                'imagen' => "uploads/editor/".$file_name_ext,
                'url' => $url                
            );
            
            if($this->CI->editor_model->nuevo($editor)){
                $errors['registro'] = 1;                
            }else{
                $errors['registro'] = 0;                
            }
            
            
        } 
        echo json_encode($errors);
        
    }
    
    public function actualizar() {
        $id = $this->CI->input->post("id");
        $nombre = $this->CI->input->post("nombre");
        
        $errors = array(
            'upload_imagen' => '',
            'actualizar' => ''
        );        
        
        //obtener el editor
        $editor = $this->CI->editor_model->get($id);
                
        $file_name = "editor_".Date("YmdHis");
        $file_name_ext = "";
        $url = codificarURL($nombre);

        $config['upload_path'] = "uploads/editor/";
        $config['file_name'] = $file_name;
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
//            $config['max_size'] = '100';
        $config['max_width'] = $this->imagen_ancho;
        $config['max_height'] = $this->imagen_alto;
        $config['min_width'] = $this->imagen_ancho;
        $config['min_height'] = $this->imagen_alto;

        $this->CI->load->library('upload', $config);
        
        //update
        $editor_update = array(
            'nombre' => $nombre,
//            'imagen' => "uploads/editor/".$file_name_ext,
            'url' => $url                
        );
        
        if (!$this->CI->upload->do_upload("imagen")) {
            //*** ocurrio un error            
            $errors['upload_imagen'] =  $this->CI->upload->display_errors('',''); 
            
            
        }else{
            $uploadSuccess = $this->CI->upload->data();
            $file_name_ext = $uploadSuccess['file_name'];   
            //borrar la imagen anterior
            $editor_update['imagen'] = "uploads/editor/".$file_name_ext;
        } 
        
        //envia imagen
        if($_FILES['imagen']['tmp_name']!=''){//que esta llegando una imagen
            if($errors['upload_imagen']!=''){//hay errores al cargar
                $errors['actualizar'] = 0; 
                echo json_encode($errors);
                exit();
            }else{
                                
            }
        }else{//no envia nada
            
        }

        if($this->CI->editor_model->editar($id,$editor_update)){
            $errors['db'] = $this->CI->db->last_query();
            $errors['actualizar'] = 1;                
        }else{
            $errors['actualizar'] = 0;                
        }
            
        echo json_encode($errors);
        
    }
    
    public function listado() {
        $header = array();
        $data = array(
            "pagina" => $this->CI->load->view("admin/editor/nuevo",'',true)
        );
        $footer = array();        
        
        $this->CI->view_admin_library->plantilla("editor/listado",$header,$data,$footer);       
    }
    
    public function anexgrid(){
        $this->CI->editor_anexgrid->set();
    }
    
    public function eliminar(){
        $id = $this->CI->input->post('id');        
        $editor = $this->CI->editor_model->get($id);
        //eliminar imagen
        @unlink($editor['imagen']);
        
        //eliminar registro de base de datos
        $result = $this->CI->editor_model->eliminar($id);       
        
        echo json_encode(true);  
    }
    

}
