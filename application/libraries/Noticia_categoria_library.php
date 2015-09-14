<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Noticia_categoria_library {

    protected $CI;

    public function __construct(){
        $this->CI =& get_instance();
//        $this->CI->load->library("view_admin_library");
        $this->CI->load->model("noticia_categoria_model");
        $this->CI->load->model("anexgrid_model"); 
//        $this->CI->load->library("noticia_categoria_anexgrid");
    }
    
    //nuevo vista
    public function nuevo($data_config) {       
        echo $this->CI->load->view("admin/noticia_categoria/nuevo",$data_config,true);     
    }   
     
    //editar vista  
    public function editar($data_config) {
        $id = $this->CI->input->post("id");
        $data = $this->CI->noticia_categoria_model->get($id,$data_config['control']);
        
        $data = array_merge($data,$data_config);
        
        echo $this->CI->load->view("admin/noticia_categoria/editar",$data,true);
    }
    
    public function registrar($data_config) {
        $errors = array(
//            'upload_imagen' => '',
            'registro' => ''
        );
        $nombre = $this->CI->input->post("nombre");
        
//        $file_name = "categoria_".Date("YmdHis");
//        $file_name_ext = "";
        $url = codificarURL($nombre);

//        $config['upload_path'] = $data_config['carpeta_imagen'];
//        $config['file_name'] = $file_name;
//        $config['allowed_types'] = "gif|jpg|jpeg|png";  
////            $config['max_size'] = '100';
////            $config['max_width'] = '1024';
////            $config['max_height'] = '768';
//
//        $this->CI->load->library('upload', $config);
//
//        if (!$this->CI->upload->do_upload("imagen")) {                   
//            $errors['upload_imagen'] =  $this->CI->upload->display_errors('','');          
//            
//        }else{
//            $uploadSuccess = $this->CI->upload->data();
//            $file_name_ext = $uploadSuccess['file_name'];  
//            $full_path = $uploadSuccess['full_path']; 
//            
//            //registrar
//            $noticia_categoria = array(
//                'nombre' => $nombre,
//                'imagen' => $config['upload_path'].$file_name_ext,
//                'url' => $url ,
//                'orden' => $this->CI->orden_library->getOrdenxTabla($data_config['control'])
//            );
//            
//            if($this->CI->noticia_categoria_model->nuevo($noticia_categoria,$data_config['control'])){
//                $errors['registro'] = 1;                
//            }else{
//                $errors['registro'] = 0;                
//            }
//            
//            
//        }
//        
        //registrar
        $noticia_categoria = array(
            'nombre' => $nombre,            
            'url' => $url ,
            'orden' => $this->CI->orden_library->getOrdenxTabla($data_config['control'])
        );

        if($this->CI->noticia_categoria_model->nuevo($noticia_categoria,$data_config['control'])){
            $errors['registro'] = 1;                
        }else{
            $errors['registro'] = 0;                
        }
            
        echo json_encode($errors);
        
    }
    
    public function actualizar($data_config) {
        $id = $this->CI->input->post("id");
        $nombre = $this->CI->input->post("nombre");
        
        $errors = array(
//            'upload_imagen' => '',
            'actualizar' => ''
        );        
        
        //obtener el noticia_categoria
        $noticia_categoria = $this->CI->noticia_categoria_model->get($id,$data_config['control']);
                
//        $file_name = "noticia_categoria_".Date("YmdHis");
//        $file_name_ext = "";
        $url = codificarURL($nombre);

//        $config['upload_path'] = $data_config['carpeta_imagen'];
//        $config['file_name'] = $file_name;
//        $config['allowed_types'] = "gif|jpg|jpeg|png";
//        
//        $this->CI->load->library('upload', $config);
        
        //update
        $noticia_categoria_update = array(
            'nombre' => $nombre,
            'url' => $url                
        );
        
//        if (!$this->CI->upload->do_upload("imagen")) {
//            //*** ocurrio un error            
//            //$errors['upload_imagen'] =  $this->CI->upload->display_errors('','');           
//        }else{
//            $uploadSuccess = $this->CI->upload->data();
//            $file_name_ext = $uploadSuccess['file_name'];   
//            //borrar la imagen anterior
//            $noticia_categoria_update['imagen'] = $config['upload_path'].$file_name_ext;
//        }        

        if($this->CI->noticia_categoria_model->editar($id,$noticia_categoria_update,$data_config['control'])){
//            $errors['db'] = $this->CI->db->last_query();
            $errors['actualizar'] = 1;                
        }else{
            $errors['actualizar'] = 0;                
        }
            
        echo json_encode($errors);
        
    }
    
    public function listado($data_config) {
        $header = array();
        $data = array(
            "pagina" => $this->CI->load->view("admin/noticia_categoria/nuevo",$data_config,true)
        );
        
        $data = array_merge($data, $data_config); 
        
        $footer = array();        
        
        $this->CI->view_admin_library->plantilla("noticia_categoria/listado",$header,$data,$footer);       
    }
    
    public function anexgrid($data_config){
//        $this->CI->noticia_categoria_anexgrid->set();
        try
        {
            $this->CI->anexgrid->set();

            /* Si es que hay filtro, tenemos que crear un WHERE dinÃ¡mico */
            $wh = "id > 0";

            foreach($this->CI->anexgrid->filtros as $f)
            {
//                if($f['columna'] == 'nombre') $wh .= " AND nombre LIKE '%" . addslashes ($f['valor']) . "%'";
//                if($f['columna'] == 'estado') $wh .= " AND estado LIKE '%" . addslashes ($f['valor']) . "%'";            
            }
            
            $query = "
                SELECT * FROM ".$data_config['control']."
                WHERE $wh ORDER BY ".$this->CI->anexgrid->columna." ".$this->CI->anexgrid->columna_orden." 
                LIMIT ".$this->CI->anexgrid->pagina." , ".$this->CI->anexgrid->limite;          
            
            $registros = $this->CI->anexgrid_model->query_registros($query);
            
            $query = "
                SELECT COUNT(*) as Total
                FROM ".$data_config['control']."
                WHERE $wh";
            
            $total = $this->CI->anexgrid_model->query_total($query);       

            header('Content-type: application/json');
            print_r($this->CI->anexgrid->responde($registros, $total));
        }
        catch(PDOException $e)
        {
            echo "error : ".$e->getMessage();
        }
    }
    
    public function eliminar($data_config){
        $id = $this->CI->input->post('id');        
        $noticia_categoria = $this->CI->noticia_categoria_model->get($id,$data_config['control']);
        //eliminar imagen
        @unlink($noticia_categoria['imagen']);
        
        //eliminar registro de base de datos
        $result = $this->CI->noticia_categoria_model->eliminar($id,$data_config['control']);       
        
        echo json_encode(true);  
    }
    
    public function publicar($data_config){
        $id = $this->CI->input->post('id'); 
        $publicar = ($this->CI->input->post('publicar')==1)?0:1;        
        $this->CI->noticia_categoria_model->editar($id,array('publicar' =>$publicar),$data_config['control']);       
        
        echo json_encode(true);  
    }
    
    public function orden_arriba($data_config){
        $id = $this->CI->input->post('id'); 
                
        if($this->CI->orden_library->orden_arriba_tabla($id,$data_config['control'])){
            //intercambio bien
            echo json_encode(array("arriba"=> 1)); 
        }else{
            //sino es el primero
            echo json_encode(array("arriba"=> 0)); 
        }        
    }
    
    public function orden_abajo($data_config){
        $id = $this->CI->input->post('id'); 
                
        if($this->CI->orden_library->orden_abajo_tabla($id,$data_config['control'])){
            //intercambio bien
            echo json_encode(array("abajo"=> 1)); 
        }else{
            //sino es el primero
            echo json_encode(array("abajo"=> 0)); 
        }        
    }
    

}
