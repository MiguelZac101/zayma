<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Producto_library {

    protected $CI;

    public function __construct(){
        $this->CI =& get_instance();
        
        $this->CI->load->model("generico_model");
        $this->CI->load->model("anexgrid_model");     
        $this->CI->load->library("anexgrid");
        $this->CI->load->library('upload');
    }
    
    //nuevo vista
    //se llama por js
    public function nuevo() { 
        $data = array();  
        $data['grupos'] = $this->CI->generico_model->listado("producto_grupo");
        echo $this->CI->load->view("admin/producto/nuevo",$data,true);       
    }   
     
    //editar vista  
    //se llama por js
    public function editar() { 
        $id_producto = $this->CI->input->post("id");
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
//        $data['producto_imagen'] = $this->CI->generico_model->listadoCondicion(array("id_producto"=>$id_producto),"producto_imagen"); 
        
        echo $this->CI->load->view("admin/producto/editar",$data,true); 
    }
    
    //esto viene de js que esta en la vista nuevo
    public function registrar() {
        ///////////////////////////////////
        $errors = array(
            'upload_imagen' => '',
            'registro' => 0           
        );
        
        //datos del formulario
        $nombre = $this->CI->input->post("nombre");      
        $id_subcategoria = $this->CI->input->post("id_subcategoria");     
        $url = codificarURL($nombre);
        
        $config['upload_path'] = "uploads/productos/";
        $config['file_name'] = "producto_".Date("YmdHis");
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
//            $config['max_size'] = '100';
//        $config['max_width'] = '600';
//        $config['max_height'] = '270';
//        $config['min_width'] = '600';
//        $config['min_height'] = '270';

        $this->CI->upload->initialize($config);
        
        /////////////////////////////////////////
        if (!$this->CI->upload->do_upload("imagen")) {
            //*** ocurrio un error            
            $errors['upload_imagen'] =  $this->CI->upload->display_errors('','');            
            
        }else{
            $uploadSuccess = $this->CI->upload->data();
            $file_name_ext = $uploadSuccess['file_name']; 
            
            //REGISTRAR PRODUCTO
            $producto = array(
                'nombre' => $nombre,           
                'url' => $url ,          
                'id_subcategoria' => $id_subcategoria,
                'imagen' => $config['upload_path'].$file_name_ext
            );
        
            if($this->CI->generico_model->nuevo($producto,"producto")){
                $errors['registro'] = 1;                
            }else{
                $errors['registro'] = 0;                
            }            
            
        } 
        echo json_encode($errors);
        ///////////////////////////////////////  
        
    }
    
    public function actualizar() {
        $id = $this->CI->input->post("id");
        $nombre = $this->CI->input->post("nombre");
        
        $errors = array(
            'upload_imagen' => '',
            'actualizar' => 0
        );       
        
        //obtener el novedad
        $producto = $this->CI->generico_model->get($id,"producto");
        $imagen_path_antiguo = $producto['imagen'];
        
        $config['upload_path'] = "uploads/productos/";
        $config['file_name'] = "producto_".Date("YmdHis");
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
//      $config['max_size'] = '100';
//        $config['max_width'] = '556';
//        $config['max_height'] = '270';
//        $config['min_width'] = '556';
//        $config['min_height'] = '270';

        
        $this->CI->upload->initialize($config);
        
        //update
        $producto_update = array(
            'nombre' => $nombre
        );
        
        if (!$this->CI->upload->do_upload("imagen")) {
            //*** ocurrio un error            
            $errors['upload_imagen'] =  $this->CI->upload->display_errors('','');
        }else{
            //como cargo una imagen, primero borramos las imagenes antiguas
            @unlink($imagen_path_antiguo);
            $uploadSuccess = $this->CI->upload->data();
            $file_name_ext = $uploadSuccess['file_name'];
            //borrar la imagen anterior
            $producto_update['imagen'] = $config['upload_path'].$file_name_ext;
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

        if($this->CI->generico_model->editar($id,$producto_update,"producto")){
            $errors['actualizar'] = 1;                
        }else{
            $errors['actualizar'] = 0;                
        }
            
        echo json_encode($errors);        
    }
    
    public function listado() {
        $header = array();
             
        ob_start();
        $this->nuevo();
        $nuevo = ob_get_contents();
        ob_end_clean();
        
        $data = array(
            "pagina" => $nuevo
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
        $id_producto = $this->CI->input->post('id');        
        $imagenes = $this->CI->generico_model->listadoCondicion(array("id_producto"=>$id_producto),"producto_imagen");
        
        if(count($imagenes)>0){
            foreach ($imagenes as $img) {
                //eliminar imagen
                @unlink($img['imagen']);
                $this->CI->generico_model->eliminar($img['id'],"producto_imagen");       
            }
        }        
        
        //eliminar la imagen del producto
        $producto = $this->CI->generico_model->get($id_producto,"producto");
        @unlink($producto['imagen']);
        //eliminar registro de base de datos
        $this->CI->generico_model->eliminar($id_producto,"producto");       
        
        echo json_encode(true);  
    }
    
    public function publicar(){
        $id = $this->CI->input->post('id'); 
        $publicar = ($this->CI->input->post('publicar')==1)?0:1;        
        $this->CI->generico_model->editar($id,array('publicar' =>$publicar),"producto");       
        
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
