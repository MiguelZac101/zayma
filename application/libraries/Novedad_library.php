<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Novedad_library {

    protected $CI;

    public function __construct(){
        $this->CI =& get_instance();   
        $this->CI->load->model("generico_model");
        $this->CI->load->model("anexgrid_model"); 
        $this->CI->load->library("anexgrid");
        
        $this->CI->load->library('upload');
    }
    
    //nuevo vista
    public function nuevo() {
        $data = array();
        echo $this->CI->load->view("admin/novedad/nuevo",$data,true);     
    }   
     
    //editar vista  
    public function editar() {
        $id = $this->CI->input->post("id");
        $data = $this->CI->generico_model->get($id,"novedad");
        echo $this->CI->load->view("admin/novedad/editar",$data,true);
    }
    
    public function registrar() {
        $errors = array(
//            'upload_imagen' => '',
            'registro' => ''
        );
        $titulo = $this->CI->input->post("titulo");
        $descripcion = $this->CI->input->post("descripcion");        

        //$url = codificarURL($nombre);
        
        $config['upload_path'] = "./temp/";
        $config['file_name'] = "novedad_".Date("YmdHis");
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
//            $config['max_size'] = '100';
        $config['max_width'] = '600';
        $config['max_height'] = '270';
        $config['min_width'] = '600';
        $config['min_height'] = '270';

        $this->CI->upload->initialize($config);
        
        /////////////////////////////////////////
        if (!$this->CI->upload->do_upload("imagen")) {
            //*** ocurrio un error            
            $errors['upload_imagen'] =  $this->CI->upload->display_errors('','');            
            
        }else{
            $uploadSuccess = $this->CI->upload->data();
            $file_name_ext = $uploadSuccess['file_name']; 
            
            //registrar
            $novedad = array(
                'titulo' => $titulo,
                'descripcion' => $descripcion,            
                'orden' => $this->CI->orden_library->getOrdenxTabla("novedad"),
                'imagen' => $config['upload_path'].$file_name_ext
            );
            
            if($this->CI->generico_model->nuevo($novedad,"novedad")){
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
        $titulo = $this->CI->input->post("titulo");
        $descripcion = $this->CI->input->post("descripcion"); 
        
        $errors = array(
            'upload_imagen' => '',
            'actualizar' => 0
        );       
        
        //obtener el novedad
        $novedad = $this->CI->generico_model->get($id,"novedad");
        $imagen_path_antiguo = $novedad['imagen'];
        
        $config['upload_path'] = "uploads/novedad/";
        $config['file_name'] = "novedad_".Date("YmdHis");
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
//      $config['max_size'] = '100';
        $config['max_width'] = '556';
        $config['max_height'] = '270';
        $config['min_width'] = '556';
        $config['min_height'] = '270';

        
        $this->CI->upload->initialize($config);
        
        //update
        $novedad_update = array(
            'titulo' => $titulo,
            'descripcion' => $descripcion                       
        );
        
        if (!$this->CI->upload->do_upload("imagen")) {
            //*** ocurrio un error            
            $errors['upload_imagen'] =  $this->CI->upload->display_errors('','').$config['upload_path'];
        }else{
            //como cargo una imagen, primero borramos las imagenes antiguas
            @unlink($imagen_path_antiguo);
            $uploadSuccess = $this->CI->upload->data();
            $file_name_ext = $uploadSuccess['file_name'];
            //borrar la imagen anterior
            $novedad_update['imagen'] = $config['upload_path'].$file_name_ext;
           
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

        if($this->CI->generico_model->editar($id,$novedad_update,"novedad")){
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
        
        $this->CI->view_admin_library->plantilla("novedad/listado",$header,$data,$footer);       
    }
    
    public function anexgrid(){
//        $this->CI->novedad_anexgrid->set();
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
                SELECT * FROM novedad
                WHERE $wh ORDER BY ".$this->CI->anexgrid->columna." ".$this->CI->anexgrid->columna_orden." 
                LIMIT ".$this->CI->anexgrid->pagina." , ".$this->CI->anexgrid->limite;          
            
            $registros = $this->CI->anexgrid_model->query_registros($query);
            
            $query = "
                SELECT COUNT(*) as Total
                FROM novedad
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
        $data_error = array("error" => 1); 
        
        //VERIFICAR DEPENDIENTES NOVEDAD_CARRUSEL
        if(!$this->CI->generico_model->getCondicion(array('id_novedad'=> $id ),"novedad_carrusel")){
            $novedad = $this->CI->generico_model->get($id,"novedad");
            //eliminar imagen
            @unlink($novedad['imagen']);
            //eliminar registro de base de datos
            $result = $this->CI->generico_model->eliminar($id,"novedad");       
            $data_error["error"] = 0;            
        } 
        echo json_encode($data_error);  
         
    }
    
    public function publicar(){
        $id = $this->CI->input->post('id'); 
        $publicar = ($this->CI->input->post('publicar')==1)?0:1;
        $data_error = array("error" => 0); 
        
        if($publicar == 1){//quiere publicarlo
            //revisar si ya tiene las 4 imagenes del carrusel
            if(count($this->CI->generico_model->listadoCondicion(array("id_novedad"=>$id),"novedad_carrusel"))==3){
                $this->CI->generico_model->editar($id,array('publicar' =>$publicar),"novedad");
            }else{
                $data_error["error"] = 1;
                $data_error["mensaje"] = "Esta novedad no tiene todas las imagenes para su carrusel, por ese  motivo no es posible publicarlo.";
            }
            
        }else{//despublicar
            $this->CI->generico_model->editar($id,array('publicar' =>$publicar),"novedad");
        }
        
        echo json_encode($data_error);  
    }
    
    public function orden_arriba(){
        $id = $this->CI->input->post('id'); 
                
        if($this->CI->orden_library->orden_arriba_tabla($id,"novedad")){
            //intercambio bien
            echo json_encode(array("arriba"=> 1)); 
        }else{
            //sino es el primero
            echo json_encode(array("arriba"=> 0)); 
        }        
    }
    
    public function orden_abajo(){
        $id = $this->CI->input->post('id'); 
                
        if($this->CI->orden_library->orden_abajo_tabla($id,"novedad")){
            //intercambio bien
            echo json_encode(array("abajo"=> 1)); 
        }else{
            //sino es el primero
            echo json_encode(array("abajo"=> 0)); 
        }        
    }
    
    public function destacado(){
        $id = $this->CI->input->post('id'); 
        //todos poner a 0 su destacado
        $this->CI->generico_model->editar_todos(array('destacado' => 0 ),"novedad");  
        //cambiar destacado a 1 solo a este item
        $this->CI->generico_model->editar($id,array('destacado' => 1 ),"novedad");     
        
        echo json_encode(true);  
    }
    

}
