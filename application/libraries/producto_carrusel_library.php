<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Producto_carrusel_library {

    protected $CI;

    public function __construct(){
        $this->CI =& get_instance();   
        $this->CI->load->model("generico_model");
        $this->CI->load->model("anexgrid_model"); 
        $this->CI->load->library("anexgrid");
        
        $this->CI->load->library('upload');
    }
    
    //VISTA MODAL
    public function vista_modal(){
        $this->CI->session->set_userdata('id_novedad',$this->CI->input->post("id"));
        ob_start();
        $this->nuevo();
        $vista_nuevo = ob_get_contents();
        ob_clean();
        $this->listado();
        $vista_listado = ob_get_contents(); 
        ob_end_clean();
        
        $data["listado"] = $vista_listado;        
        $data["nuevo"] = $vista_nuevo;        
        echo json_encode($data);
    }
    //nuevo vista
    public function nuevo() {
        $data = array();
        echo $this->CI->load->view("admin/producto_carrusel/nuevo",$data,true);     
    }   
     
    //editar vista  
    public function editar() {
        $id = $this->CI->input->post("id");
        $data["producto_carrusel"] = $this->CI->generico_model->get($id,"producto_carrusel");
        echo $this->CI->load->view("admin/producto_carrusel/editar",$data,true);
    }
    
    public function registrar() {
        $id_novedad = $this->CI->input->post("id_novedad");
        
        $errors = array(
            'registro' => 1
        );
        
        //IMAGEN GRANDE
        
        $config['upload_path'] = "uploads/producto_carrusel/";
        $config['file_name'] = "carrusel_lg_".Date("YmdHis");
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
//      $config['max_size'] = '100';
//      $config['max_width'] = '600';
//        $config['max_height'] = '270';
//        $config['min_width'] = '600';
//        $config['min_height'] = '270';
        
        $this->CI->upload->initialize($config);
        
        
        if (!$this->CI->upload->do_upload("imagen_lg")) {
            //*** ocurrio un error            
            $errors['upload_imagen_lg'] =  $this->CI->upload->display_errors('','');    
            $errors['registro'] = 0;
            
        }else{
            $uploadSuccess = $this->CI->upload->data();
            $file_name_ext = $uploadSuccess['file_name']; 
            $path_imagen_lg = $config['upload_path'].$file_name_ext;
        } 
        
        //IMAGEN PEQUEÑA
        
        $config['upload_path'] = "uploads/producto_carrusel/";
        $config['file_name'] = "carrusel_xs_".Date("YmdHis");
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
//            $config['max_size'] = '100';
//        $config['max_width'] = '600';
//        $config['max_height'] = '270';
//        $config['min_width'] = '600';
//        $config['min_height'] = '270';
        
        $this->CI->upload->initialize($config);        
        
        if (!$this->CI->upload->do_upload("imagen_xs")) {
            //*** ocurrio un error            
            $errors['upload_imagen_xs'] =  $this->CI->upload->display_errors('','');            
            $errors['registro'] = 0;
        }else{
            $uploadSuccess = $this->CI->upload->data();
            $file_name_ext = $uploadSuccess['file_name'];
            $path_imagen_xs = $config['upload_path'].$file_name_ext;
        } 
        
        if($errors['registro']!=0){
            //REGISTRO DE LOS DATOS     
            $producto_carrusel = array(                
                'imagen_lg' => $path_imagen_lg,
                'imagen_xs' => $path_imagen_xs,
                'id_novedad' => $id_novedad
            );            

            if($this->CI->generico_model->nuevo($producto_carrusel,"producto_carrusel")){
                $errors['registro'] = 1;                
            }else{
                $errors['registro'] = 0;                
            } 
        }
            
        echo json_encode($errors);
        ///////////////////////////////////////  
        
    }
    
    public function actualizar() {
        $id_novedad = $this->CI->input->post("id_novedad");
        $id = $this->CI->input->post("id");//id del item de carrusel 
        
        $errors = array(
            'upload_imagen' => '',
            'actualizar' => 0
        );       
        
        $errors['upload_imagen_lg']="";
        $errors['upload_imagen_xs']="";
        
        //obtener item de carrusel
        $icarrusel = $this->CI->generico_model->get($id,"producto_carrusel");
        $imagen_path_antiguo_xs = $icarrusel['imagen_xs'];
        $imagen_path_antiguo_lg = $icarrusel['imagen_lg'];        
        
        //nuevos path
        $path_imagen_lg = "";
        $path_imagen_xs = "";
        
        
        //NINGUNA IMAGEN
        if($_FILES['imagen_lg']['tmp_name']=='' && $_FILES['imagen_xs']['tmp_name']==''){
            $errors['actualizar'] = 0;
            $errors['upload_imagen'] = "Debe seleccionar alguna imagen.";
            echo json_encode($errors);
            exit();
        }
        
        ////////////////////////////
        //IMAGEN GRANDE
        
        $config['upload_path'] = "uploads/producto_carrusel/";
        $config['file_name'] = "carrusel_lg_".Date("YmdHis");
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
//      $config['max_size'] = '100';
//      $config['max_width'] = '600';
//        $config['max_height'] = '270';
//        $config['min_width'] = '600';
//        $config['min_height'] = '270';
        
        $this->CI->upload->initialize($config);
        
        
        if (!$this->CI->upload->do_upload("imagen_lg")) {
            //*** ocurrio un error            
            $errors['upload_imagen_lg'] =  $this->CI->upload->display_errors('','');    
            $errors['registro'] = 0;
            
        }else{
            @unlink($imagen_path_antiguo_lg);
            $uploadSuccess = $this->CI->upload->data();
            $file_name_ext = $uploadSuccess['file_name']; 
            $path_imagen_lg = $config['upload_path'].$file_name_ext;
        } 
        ////////////////////////////
        //IMAGEN PEQUEÑA
        
        $config['upload_path'] = "uploads/producto_carrusel/";
        $config['file_name'] = "carrusel_xs_".Date("YmdHis");
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
//            $config['max_size'] = '100';
//        $config['max_width'] = '600';
//        $config['max_height'] = '270';
//        $config['min_width'] = '600';
//        $config['min_height'] = '270';
        
        $this->CI->upload->initialize($config);        
        
        if (!$this->CI->upload->do_upload("imagen_xs")) {
            //*** ocurrio un error            
            $errors['upload_imagen_xs'] =  $this->CI->upload->display_errors('','');            
            $errors['registro'] = 0;
        }else{
            @unlink($imagen_path_antiguo_xs);
            $uploadSuccess = $this->CI->upload->data();
            $file_name_ext = $uploadSuccess['file_name'];
            $path_imagen_xs = $config['upload_path'].$file_name_ext;
        } 
        ////////////////////////////////
        
        //envia imagen LG
        if($_FILES['imagen_lg']['tmp_name']!=''){//que esta llegando una imagen
            if($errors['upload_imagen_lg']!=''){//hay errores al cargar
                $errors['actualizar'] = 0; 
                $errors['upload_imagen'] = $errors['upload_imagen_lg'];
                echo json_encode($errors);
                exit();
            }else{
                                
            }
        }else{//no envia nada
            
        }
        
        //envia imagen XS
        if($_FILES['imagen_xs']['tmp_name']!=''){//que esta llegando una imagen
            if($errors['upload_imagen_xs']!=''){//hay errores al cargar
                $errors['actualizar'] = 0; 
                $errors['upload_imagen'] = $errors['upload_imagen_xs'];
                echo json_encode($errors);
                exit();
            }else{
                                
            }
        }else{//no envia nada
            
        }
        
        $carrusel_update = array( );
        if($path_imagen_lg!=""){
            $carrusel_update["imagen_lg"] = $path_imagen_lg;
        }
        if($path_imagen_xs!=""){
            $carrusel_update["imagen_xs"] = $path_imagen_xs;
        }
        
        
        if($this->CI->generico_model->editar($id,$carrusel_update,"producto_carrusel")){
            $errors['actualizar'] = 1;                
        }else{
            $errors['actualizar'] = 0;                
        }
            
        echo json_encode($errors);
        
    }
    
    public function listado() {        
        $data = array( );
        echo $this->CI->load->view("admin/producto_carrusel/listado",$data,true);       
    }
    
    public function anexgrid(){
        $id_novedad = $this->CI->session->userdata('id_novedad');
//        $this->CI->novedad_anexgrid->set();
        try
        {
            $this->CI->anexgrid->set();

            /* Si es que hay filtro, tenemos que crear un WHERE dinÃ¡mico */
            $wh = "id > 0 and id_novedad = ".$id_novedad;

            foreach($this->CI->anexgrid->filtros as $f)
            {
//                if($f['columna'] == 'nombre') $wh .= " AND nombre LIKE '%" . addslashes ($f['valor']) . "%'";
//                if($f['columna'] == 'estado') $wh .= " AND estado LIKE '%" . addslashes ($f['valor']) . "%'";            
            }
            
            $query = "
                SELECT * FROM producto_carrusel
                WHERE $wh ORDER BY ".$this->CI->anexgrid->columna." ".$this->CI->anexgrid->columna_orden." 
                LIMIT ".$this->CI->anexgrid->pagina." , ".$this->CI->anexgrid->limite;          
            
            $registros = $this->CI->anexgrid_model->query_registros($query);
            
            $query = "
                SELECT COUNT(*) as Total
                FROM producto_carrusel
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
        $data_error = array("error" => 0); 
        
        $novedad = $this->CI->generico_model->get($id,"producto_carrusel");
        //eliminar imagen
        @unlink($novedad['imagen_lg']);
        @unlink($novedad['imagen_xs']);
        
        //eliminar registro de base de datos
        $result = $this->CI->generico_model->eliminar($id,"producto_carrusel");                            
        
        echo json_encode($data_error);  
         
    }
    
    public function publicar(){
        $id = $this->CI->input->post('id'); 
        $publicar = ($this->CI->input->post('publicar')==1)?0:1;
        $data_error = array("error" => 0); 
        
        if($publicar == 1){//quiere publicarlo
            //revisar si ya tiene las 4 imagenes del carrusel
            if(count($this->CI->generico_model->listadoCondicion(array("id_novedad"=>$id),"producto_carrusel"))==3){
                $this->CI->generico_model->editar($id,array('publicar' =>$publicar),"producto_carrusel");
            }else{
                $data_error["error"] = 1;
                $data_error["mensaje"] = "Esta novedad no tiene todas las imagenes para su carrusel, por ese  motivo no es posible publicarlo.xxxxx";
            }
            
        }else{//despublicar
            $this->CI->generico_model->editar($id,array('publicar' =>$publicar),"producto_carrusel");
        }
        
        echo json_encode($data_error);  
    }
    
    public function orden_arriba(){
        $id = $this->CI->input->post('id'); 
                
        if($this->CI->orden_library->orden_arriba_tabla($id,"producto_carrusel")){
            //intercambio bien
            echo json_encode(array("arriba"=> 1)); 
        }else{
            //sino es el primero
            echo json_encode(array("arriba"=> 0)); 
        }        
    }
    
    public function orden_abajo(){
        $id = $this->CI->input->post('id'); 
                
        if($this->CI->orden_library->orden_abajo_tabla($id,"producto_carrusel")){
            //intercambio bien
            echo json_encode(array("abajo"=> 1)); 
        }else{
            //sino es el primero
            echo json_encode(array("abajo"=> 0)); 
        }        
    }
    

}
