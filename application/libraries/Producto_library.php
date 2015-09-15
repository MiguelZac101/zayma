<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Producto_library {

    protected $CI;

    public function __construct(){
        $this->CI =& get_instance();
        
        $this->CI->load->model("generico_model");
//        $this->CI->load->model("producto_model");
        $this->CI->load->model("anexgrid_model");     
        $this->CI->load->library("anexgrid");    
        
    }
    
    //nuevo vista
    //se llama por js
    public function nuevo() { 
        $header = array();
        $data = array();                     
        $footer = array(); 
        
        $data['grupos'] = $this->CI->generico_model->listado("producto_grupo");
        
        $this->CI->view_admin_library->plantilla("producto/nuevo",$header,$data,$footer);       
    }   
     
    //editar vista  
    //se llama por js
    public function editar() {
        $id = $this->CI->input->post("id");
        
        $data_articulo = $this->CI->producto_model->get($id,$data['control']);
        
        $data['editores'] = $this->CI->editor_model->listado();       
        $data['categorias'] = $this->CI->producto_model->categoria_listado($data['tabla_categoria']); 
        
        $data = array_merge($data,$data_articulo);
        
        return $this->CI->load->view("admin/producto/editar",$data,true);
    }
    
    //esto viene de js que esta en la vista nuevo
    public function registrar() {
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
            $producto = array(
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
            
            if($this->CI->producto_model->nuevo($producto,$control)){
                $errors['registro'] = 1;                
            }else{
                $errors['registro'] = 0;                
            }            
            
        } 
        echo json_encode($errors);
        
    }
    
    public function actualizar() {
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
        
        //obtener el producto
        $producto = $this->CI->producto_model->get($id,$control);   
        $imagen_path_antiguo = $producto['imagen'];
        $imagen_thumbnail_path_antiguo = $producto['imagen_thumbnail'];
        
                
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
        $producto_update = array(
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
            $producto_update['imagen'] = $config['upload_path'].$file_name_ext;
            $producto_update['imagen_thumbnail'] =  $thumbnail_path;
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

        if($this->CI->producto_model->editar($id,$producto_update,$control)){
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
            
        );             
        
        $footer = array();        
        
        $this->CI->view_admin_library->plantilla("producto/listado",$header,$data,$footer);       
    }
    
//    public function anexgrid(){
//        $this->CI->producto_anexgrid->set();
//    }
    
    public function anexgrid(){
        
        
        
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
                SELECT * FROM producto
                WHERE $wh ORDER BY ".$this->CI->anexgrid->columna." ".$this->CI->anexgrid->columna_orden." 
                LIMIT ".$this->CI->anexgrid->pagina." , ".$this->CI->anexgrid->limite;          
            
            $registros = $this->CI->anexgrid_model->query_registros($query);
            
            $query = "
                SELECT COUNT(*) as Total
                FROM producto
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
    
    public function eliminar(){
        $id = $this->CI->input->post('id');        
        $producto = $this->CI->producto_model->get($id,$data['control']);
        //eliminar imagen
        @unlink($producto['imagen']);
        @unlink($producto['imagen_thumbnail']);
        
        //eliminar registro de base de datos
        $result = $this->CI->producto_model->eliminar($id,$data['control']);       
        
        echo json_encode(true);  
    }
    
    public function publicar(){
        $id = $this->CI->input->post('id'); 
        $publicar = ($this->CI->input->post('publicar')==1)?0:1;        
        $this->CI->producto_model->editar($id,array('publicar' =>$publicar),$data['control']);       
        
        echo json_encode(true);  
    }
    
    public function destacado(){
        $id = $this->CI->input->post('id'); 
        //todos los demas articulos poner a 0 su destacado
        $this->CI->producto_model->editar_todos(array('destacado' => 0 ),$data['control']);  
        //cambiar destacado a 1 solo a este articulo
        $this->CI->producto_model->editar($id,array('destacado' => 1 ),$data['control']);       
        
        echo json_encode(true);  
    }
    
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
