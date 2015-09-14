<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Noticia_articulo_library {

    protected $CI;

    public function __construct(){
        $this->CI =& get_instance();
//        $this->CI->load->library("view_admin_library");
        $this->CI->load->model("noticia_articulo_model");
        $this->CI->load->model("anexgrid_model");//generico para todas las consultas
//      $this->CI->load->library("noticia_articulo_anexgrid");        
        $this->CI->load->model("editor_model");        
        $this->CI->load->library("anexgrid");
        
        

    }
    
    //nuevo vista
    //se llama por js
    public function nuevo($data) {   
        //cargar los editores
        $data_nuevo['editores'] = $this->CI->editor_model->listado();       
        $data_nuevo['categorias'] = $this->CI->noticia_articulo_model->categoria_listado($data['tabla_categoria']);         
        $data = array_merge($data,$data_nuevo);

        return $this->CI->load->view("admin/noticia_articulo/nuevo",$data,true);     
    }   
     
    //editar vista  
    //se llama por js
    public function editar($data) {
        $id = $this->CI->input->post("id");
        
        $data_articulo = $this->CI->noticia_articulo_model->get($id,$data['control']);
        
        $data['editores'] = $this->CI->editor_model->listado();       
        $data['categorias'] = $this->CI->noticia_articulo_model->categoria_listado($data['tabla_categoria']); 
        
        $data = array_merge($data,$data_articulo);
        
        return $this->CI->load->view("admin/noticia_articulo/editar",$data,true);
    }
    
    //esto viene de js que esta en la vista nuevo
    public function registrar($data_config) {
        $errors = array(
            'upload_imagen' => '',
            'registro' => 0
        );
        //datos del formulario
        $titulo = $this->CI->input->post("titulo");
        $fecha = fechaNaturalAMysql($this->CI->input->post("fecha"));
        $descripcion = $this->CI->input->post("descripcion");
        $contenido = $this->CI->input->post("contenido");
        $id_editor = $this->CI->input->post("id_editor");
        $id_categoria = $this->CI->input->post("id_categoria");
     
        $control = $data_config['control'];
        $carpeta_imagen = $data_config['carpeta_imagen'];
        
        $file_name = "articulo_".Date("YmdHis");
        $file_name_ext = "";
        $url = codificarURL($titulo);

        $config['upload_path'] = $carpeta_imagen;//"uploads/noticia/categoria/";
        $config['file_name'] = $file_name;
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
//            $config['max_size'] = '100';
        $config['max_width'] = '850';
        $config['max_height'] = '500';
        $config['min_width'] = '850';
        $config['min_height'] = '500';

        $this->CI->load->library('upload', $config);

        if (!$this->CI->upload->do_upload("imagen")) {
            //*** ocurrio un error            
            $errors['upload_imagen'] =  $this->CI->upload->display_errors('','');            
            
        }else{
            $uploadSuccess = $this->CI->upload->data();
            $file_name_ext = $uploadSuccess['file_name'];  
            $full_path = $uploadSuccess['full_path']; 
            
            $thumbnail_path = $carpeta_imagen."thumbnail/".$file_name_ext;
            //CREAR MINIATURA PARA COMPARTIR EN FB
            imagen_crear_miniatura($full_path, $thumbnail_path ,200, 200);
            
            //registrar
            $noticia_articulo = array(
                'titulo' => $titulo,
                'imagen' => $config['upload_path'].$file_name_ext,
                'imagen_thumbnail' => $thumbnail_path,
//                'imagen' => $full_path,
                'url' => $url ,
                'fecha' => $fecha,
                'descripcion' => $descripcion,
                'contenido' => $contenido,
                'id_editor' => $id_editor,
                'id_categoria' => $id_categoria
            );
            
            if($this->CI->noticia_articulo_model->nuevo($noticia_articulo,$control)){
                $errors['registro'] = 1;                
            }else{
                $errors['registro'] = 0;                
            }            
            
        } 
        echo json_encode($errors);
        
    }
    
    public function actualizar($data) {
        $id = $this->CI->input->post("id");
        
        //datos del formulario
        $titulo = $this->CI->input->post("titulo");
        $fecha = fechaNaturalAMysql($this->CI->input->post("fecha"));
        $descripcion = $this->CI->input->post("descripcion");
        $contenido = $this->CI->input->post("contenido");
        $id_editor = $this->CI->input->post("id_editor");
        $id_categoria = $this->CI->input->post("id_categoria");
        
        //datos agregados en la vista nuevo , js
        $control = $data['control'];
        $carpeta_imagen = $data['carpeta_imagen'];
        
        $errors = array(
            'upload_imagen' => '',
            'actualizar' => 0
        );        
        
        //obtener el noticia_articulo
        $noticia_articulo = $this->CI->noticia_articulo_model->get($id,$control);   
        $imagen_path_antiguo = $noticia_articulo['imagen'];
        $imagen_thumbnail_path_antiguo = $noticia_articulo['imagen_thumbnail'];
        
                
        $file_name = "articulo_".Date("YmdHis");
        $file_name_ext = "";
        $url = codificarURL($titulo);

        $config['upload_path'] = $carpeta_imagen;
        $config['file_name'] = $file_name;
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
//      $config['max_size'] = '100';
        $config['max_width'] = '850';
        $config['max_height'] = '500';
        $config['min_width'] = '850';
        $config['min_height'] = '500';

        $this->CI->load->library('upload', $config);
        
        //update
        $noticia_articulo_update = array(
            'titulo' => $titulo,   
            'url' => $url ,
            'fecha' => $fecha,
            'descripcion' => $descripcion,
            'contenido' => $contenido,
            'id_editor' => $id_editor,
            'id_categoria' => $id_categoria              
        );
        
        if (!$this->CI->upload->do_upload("imagen")) {
            //*** ocurrio un error            
            //$errors['upload_imagen'] =  $this->CI->upload->display_errors('',''); 
            
            
        }else{
            //como cargo una imagen, primero borramos las imagenes antiguas
            @unlink($imagen_path_antiguo);
            @unlink($imagen_thumbnail_path_antiguo);
            
            $uploadSuccess = $this->CI->upload->data();
            $file_name_ext = $uploadSuccess['file_name'];
            $full_path = $uploadSuccess['full_path'];
            
            //crear la nueva miniatura
            $thumbnail_path = $carpeta_imagen."thumbnail/".$file_name_ext;
            imagen_crear_miniatura($full_path, $thumbnail_path ,200, 200);
            
            
            //borrar la imagen anterior
            $noticia_articulo_update['imagen'] = $config['upload_path'].$file_name_ext;
            $noticia_articulo_update['imagen_thumbnail'] =  $thumbnail_path;
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

        if($this->CI->noticia_articulo_model->editar($id,$noticia_articulo_update,$control)){
            $errors['db'] = $this->CI->db->last_query();
            $errors['actualizar'] = 1;                
        }else{
            $errors['actualizar'] = 0;                
        }
            
        echo json_encode($errors);
        
    }
    
    public function listado($data_general) {
        $header = array();
        $data = array(
//            "pagina" => $this->CI->load->view("admin/noticia_articulo/nuevo",$data_general,true)
            "pagina" => $this->nuevo($data_general)
            
        );
        $data = array_merge($data, $data_general);        
        
        $footer = array();        
        
        $this->CI->view_admin_library->plantilla("noticia_articulo/listado",$header,$data,$footer);       
    }
    
//    public function anexgrid(){
//        $this->CI->noticia_articulo_anexgrid->set();
//    }
    
    public function anexgrid($data){
        
        
        
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
                SELECT * FROM ".$data['control']."
                WHERE $wh ORDER BY ".$this->CI->anexgrid->columna." ".$this->CI->anexgrid->columna_orden." 
                LIMIT ".$this->CI->anexgrid->pagina." , ".$this->CI->anexgrid->limite;          
            
            $registros = $this->CI->anexgrid_model->query_registros($query);
            
            $query = "
                SELECT COUNT(*) as Total
                FROM ".$data['control']."
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
    
    public function eliminar($data){
        $id = $this->CI->input->post('id');        
        $noticia_articulo = $this->CI->noticia_articulo_model->get($id,$data['control']);
        //eliminar imagen
        @unlink($noticia_articulo['imagen']);
        @unlink($noticia_articulo['imagen_thumbnail']);
        
        //eliminar registro de base de datos
        $result = $this->CI->noticia_articulo_model->eliminar($id,$data['control']);       
        
        echo json_encode(true);  
    }
    
    public function publicar($data){
        $id = $this->CI->input->post('id'); 
        $publicar = ($this->CI->input->post('publicar')==1)?0:1;        
        $this->CI->noticia_articulo_model->editar($id,array('publicar' =>$publicar),$data['control']);       
        
        echo json_encode(true);  
    }
    
    public function destacado($data){
        $id = $this->CI->input->post('id'); 
        //todos los demas articulos poner a 0 su destacado
        $this->CI->noticia_articulo_model->editar_todos(array('destacado' => 0 ),$data['control']);  
        //cambiar destacado a 1 solo a este articulo
        $this->CI->noticia_articulo_model->editar($id,array('destacado' => 1 ),$data['control']);       
        
        echo json_encode(true);  
    }
    
//    public function orden_arriba(){
//        $id = $this->CI->input->post('id'); 
//                
//        if($this->CI->orden_library->orden_arriba_tabla($id,'noticia_articulo')){
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
//        if($this->CI->orden_library->orden_abajo_tabla($id,'noticia_articulo')){
//            //intercambio bien
//            echo json_encode(array("abajo"=> 1)); 
//        }else{
//            //sino es el primero
//            echo json_encode(array("abajo"=> 0)); 
//        }        
//    }
    

}
