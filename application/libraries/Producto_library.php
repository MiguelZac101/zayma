<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Producto_library {

    protected $CI;

    public function __construct(){
        $this->CI =& get_instance();
        
        $this->CI->load->model("generico_model");
//        $this->CI->load->model("producto_model");
        $this->CI->load->model("anexgrid_model");     
        $this->CI->load->library("anexgrid");    
//        $this->CI->load->library("session"); 
        
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
    public function editar($id_producto) { 
        $header = array();
        $data = array();                     
        $footer = array();
        
        $producto = $this->CI->generico_model->get($id_producto,"producto"); 
        
        //subcategoria a la cual pertenece
        $subcategoria = $this->CI->generico_model->get($producto['id_subcategoria'],"producto_subcategoria");
        //categoria a la cual pertenece
        $categoria = $this->CI->generico_model->get($subcategoria['id_categoria'],"producto_categoria");
        $producto['id_categoria'] = $categoria['id'];
        //grupo al cual pertenece
        $grupo = $this->CI->generico_model->get($categoria['id_grupo'],"producto_grupo");
        $producto['id_grupo'] = $grupo['id'];
        
        //cargar datos del producto
        $data['producto'] = $producto;
        
        $data['grupos'] = $this->CI->generico_model->listado("producto_grupo"); 
        $data['categorias'] = $this->CI->generico_model->listadoCondicion(array("id_grupo"=>$grupo['id']),"producto_categoria"); 
        $data['subcategorias'] = $this->CI->generico_model->listadoCondicion(array("id_categoria"=>$categoria['id']),"producto_subcategoria"); 
        
        //cargar las imagenes
        $data['producto_imagen'] = $this->CI->generico_model->listadoCondicion(array("id_producto"=>$id_producto),"producto_imagen"); 
        
        $this->CI->view_admin_library->plantilla("producto/editar",$header,$data,$footer); 
    }
    
    //esto viene de js que esta en la vista nuevo
    public function registrar() {
        $errors = array(
            'upload_imagen' => '',
            'registro' => 0,
            'registro_imagenes' => 0
        );
        //datos del formulario
        $nombre = $this->CI->input->post("nombre");      
        $id_subcategoria = $this->CI->input->post("id_subcategoria");     
        $url = codificarURL($nombre);
        
        //REGISTRAR PRODUCTO
        $producto = array(
            'nombre' => $nombre,           
            'url' => $url ,          
            'id_subcategoria' => $id_subcategoria
        );
        $id_producto = $this->CI->generico_model->nuevo($producto,"producto");
        
        if($id_producto){
            $errors['registro'] = 1;            
               
            ///////////////////////
             // retrieve the number of images uploaded;
            $number_of_files = sizeof($_FILES['imagen']['tmp_name']);
            // considering that do_upload() accepts single files, we will have to do a small hack so that we can upload multiple files. For this we will have to keep the data of uploaded files in a variable, and redo the $_FILE.
            $files = $_FILES['imagen'];
            
            // we first load the upload library
            $this->CI->load->library('upload');
            //REGISTRAR IMAGENES 
            // next we pass the upload path for the images
            $config['upload_path'] = "uploads/productos/";
            $config['file_name'] = "producto_" . Date("YmdHis");
            $config['allowed_types'] = "gif|jpg|jpeg|png";
                //            $config['max_size'] = '100';
    //        $config['max_width'] = '400';
    //        $config['max_height'] = '400';
    //        $config['min_width'] = '400';
    //        $config['min_height'] = '400';           
            
            for ($i = 0; $i < $number_of_files; $i++) {
                $_FILES['img']['name'] = $files['name'][$i];
                $_FILES['img']['type'] = $files['type'][$i];
                $_FILES['img']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['img']['error'] = $files['error'][$i];
                $_FILES['img']['size'] = $files['size'][$i];
                //now we initialize the upload library
                $this->CI->upload->initialize($config);
                // we retrieve the number of files that were uploaded
                if ($this->CI->upload->do_upload('img')) {
                    $uploads[$i] = $this->CI->upload->data();
                } else {
                    $upload_errors[$i] = $this->CI->upload->display_errors();
                }
            }
            
            if ( isset($uploads) && count($uploads)> 0 ) {//no hay errores
//                if(sizeof($_FILES['imagen']['tmp_name'])>1){//numero de imagenes
                foreach ($uploads as $regimg) {
                    $producto_imagen = array(
                        'imagen' => $config['upload_path'] . $regimg['file_name'],
                        'id_producto' => $id_producto
                    );
                    $this->CI->generico_model->nuevo($producto_imagen, "producto_imagen");
                }
            } else {//hay errores
                $errors['upload_imagen'] = "problema no se puede subir algunas imagenes";
            }
            /////////////////////////
        }        
    
        
        echo json_encode($errors);
        
    }
    
    public function actualizar() {
        $id_producto = $this->CI->input->post("id");
                
        //datos del formulario
        $nombre = $this->CI->input->post("nombre");      
        $id_subcategoria = $this->CI->input->post("id_subcategoria");     
        $url = codificarURL($nombre);
        
        //ACTUALIZAR PRODUCTO
        $producto = array(
            'nombre' => $nombre,           
            'url' => $url ,          
            'id_subcategoria' => $id_subcategoria
        );
        $this->CI->generico_model->editar($id_producto,$producto,"producto");
        /////////////////////////
        
        $errors = array(
            'actualizar' => 1,
            'mensaje' => "Registro Actualizado!."
        );        
        
        if(sizeof($_FILES['imagen']['tmp_name'])>0){                       
            $uploads = array();   
            ///////////////////////
             // retrieve the number of images uploaded;
            $number_of_files = sizeof($_FILES['imagen']['tmp_name']);
            // considering that do_upload() accepts single files, we will have to do a small hack so that we can upload multiple files. For this we will have to keep the data of uploaded files in a variable, and redo the $_FILE.
            $files = $_FILES['imagen'];
            
            // we first load the upload library
            $this->CI->load->library('upload');
            //REGISTRAR IMAGENES 
            // next we pass the upload path for the images
            $config['upload_path'] = "uploads/productos/";
            $config['file_name'] = "producto_" . Date("YmdHis");
            $config['allowed_types'] = "gif|jpg|jpeg|png";
                //            $config['max_size'] = '100';
    //        $config['max_width'] = '400';
    //        $config['max_height'] = '400';
    //        $config['min_width'] = '400';
    //        $config['min_height'] = '400';           
            
            for ($i = 0; $i < $number_of_files; $i++) {
                $_FILES['img']['name'] = $files['name'][$i];
                $_FILES['img']['type'] = $files['type'][$i];
                $_FILES['img']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['img']['error'] = $files['error'][$i];
                $_FILES['img']['size'] = $files['size'][$i];
                //now we initialize the upload library
                $this->CI->upload->initialize($config);
                // we retrieve the number of files that were uploaded
                if ($this->CI->upload->do_upload('img')) {
                    $uploads[$i] = $this->CI->upload->data();
                } else {
                    $upload_errors[$i] = $this->CI->upload->display_errors();
                }
            }
            
            if ( isset($uploads) && count($uploads)> 0 ) {//no hay errores
//                if(sizeof($_FILES['imagen']['tmp_name'])>1){//numero de imagenes
                foreach ($uploads as $regimg) {
                    $producto_imagen = array(
                        'imagen' => $config['upload_path'] . $regimg['file_name'],
                        'id_producto' => $id_producto
                    );
                    $this->CI->generico_model->nuevo($producto_imagen, "producto_imagen");
                }
            } else {//hay errores
                $errors['actualizar'] = 0;
                $errors['mensaje'] = "Hubo un problema no se puede subir algunas imagenes";
            }
            /////////////////////////
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
