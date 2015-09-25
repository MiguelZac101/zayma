<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Promocion_library {

    protected $CI;
    private $img_lg_width = 1075;
    private $img_lg_height = 515;
    private $img_xs_width = 556;
    private $img_xs_height = 270;

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
        echo $this->CI->load->view("admin/promocion/nuevo",$data,true);     
    }   
     
    //editar vista  
    public function editar() {
        $id = $this->CI->input->post("id");
        $data = $this->CI->generico_model->get($id,"promocion");
        echo $this->CI->load->view("admin/promocion/editar",$data,true);
    }
    
    public function registrar() {
        $errors = array(
            'db_error' => '',
            'upload_imagen' => '',
            'registro' => 1
        );
        
        $titulo = $this->CI->input->post("titulo");
        $descripcion = $this->CI->input->post("descripcion");  
        $precio_normal = $this->CI->input->post("precio_normal");
        $precio_promocion = $this->CI->input->post("precio_promocion");

        //IMAGEN GRANDE
        
        $config['upload_path'] = "uploads/promocion/";
        $config['file_name'] = "promocion_lg_".Date("YmdHis");
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
//      $config['max_size'] = '100';
        $config['min_width'] = $config['max_width'] = $this->img_lg_width;
        $config['min_height'] = $config['max_height'] = $this->img_lg_height;        
        
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
        
        $config['upload_path'] = "uploads/promocion/";
        $config['file_name'] = "promocion_xs_".Date("YmdHis");
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
//            $config['max_size'] = '100';
        $config['min_width'] = $config['max_width'] = $this->img_xs_width;
        $config['min_height'] = $config['max_height'] = $this->img_xs_height; 
        
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
            $promocion = array(  
                'titulo'            => $titulo,
                'descripcion'       => $descripcion,
                'precio_normal'     => $precio_normal,
                'precio_promocion'  => $precio_promocion,
                'orden'             => $this->CI->orden_library->getOrdenxTabla("promocion"),
                'imagen_lg'         => $path_imagen_lg,
                'imagen_xs'         => $path_imagen_xs                
            );            

            if($this->CI->generico_model->nuevo($promocion,"promocion")){
                $errors['registro'] = 1;                
            }else{
                //$errors['db_error'] = $this->CI->db->last_query();
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
        $precio_normal = $this->CI->input->post("precio_normal");
        $precio_promocion = $this->CI->input->post("precio_promocion");
        
        $errors = array(
            'upload_imagen' => '',
            'actualizar' => 0
        );       
        
        $errors['upload_imagen_lg']="";
        $errors['upload_imagen_xs']="";
        
        //obtener item de carrusel
        $promocion = $this->CI->generico_model->get($id,"promocion");
        $imagen_path_antiguo_xs = $promocion['imagen_xs'];
        $imagen_path_antiguo_lg = $promocion['imagen_lg'];        
        
        //nuevos path
        $path_imagen_lg = "";
        $path_imagen_xs = "";
        
        
        //NINGUNA IMAGEN
//        if($_FILES['imagen_lg']['tmp_name']=='' && $_FILES['imagen_xs']['tmp_name']==''){
//            $errors['actualizar'] = 0;
//            $errors['upload_imagen'] = "Debe seleccionar alguna imagen.";
//            echo json_encode($errors);
//            exit();
//        }
        
        ////////////////////////////
        //IMAGEN GRANDE
        
        $config['upload_path'] = "uploads/promocion/";
        $config['file_name'] = "promocion_lg_".Date("YmdHis");
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
//      $config['max_size'] = '100';
        $config['min_width'] = $config['max_width'] = $this->img_lg_width;
        $config['min_height'] = $config['max_height'] = $this->img_lg_height;        
        
        $this->CI->upload->initialize($config);
        
        if (!$this->CI->upload->do_upload("imagen_lg")) {
            //*** ocurrio un error            
            $errors['upload_imagen_lg'] =  $this->CI->upload->display_errors('','');    
            $errors['actualizar'] = 0;
            
        }else{
            @unlink($imagen_path_antiguo_lg);
            $uploadSuccess = $this->CI->upload->data();
            $file_name_ext = $uploadSuccess['file_name']; 
            $path_imagen_lg = $config['upload_path'].$file_name_ext;
        } 
        ////////////////////////////
        //IMAGEN PEQUEÑA
        
        $config['upload_path'] = "uploads/novedad_carrusel/";
        $config['file_name'] = "carrusel_xs_".Date("YmdHis");
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
//            $config['max_size'] = '100';
        $config['min_width'] = $config['max_width'] = $this->img_xs_width;
        $config['min_height'] = $config['max_height'] = $this->img_xs_height;
        
        $this->CI->upload->initialize($config);        
        
        if (!$this->CI->upload->do_upload("imagen_xs")) {
            //*** ocurrio un error            
            $errors['upload_imagen_xs'] =  $this->CI->upload->display_errors('','');            
            $errors['actualizar'] = 0;
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
        
        $promocion_update = array( 
            'titulo'            => $titulo,
            'descripcion'       => $descripcion,
            'precio_normal'     => $precio_normal,
            'precio_promocion'  => $precio_promocion           
        );
        
        if($path_imagen_lg!=""){
            $promocion_update["imagen_lg"] = $path_imagen_lg;
        }
        if($path_imagen_xs!=""){
            $promocion_update["imagen_xs"] = $path_imagen_xs;
        }
        
        
        if($this->CI->generico_model->editar($id,$promocion_update,"promocion")){
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
        
        $this->CI->view_admin_library->plantilla("promocion/listado",$header,$data,$footer);       
    }
    
    public function anexgrid(){
//        $this->CI->promocion_anexgrid->set();
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
                SELECT * FROM promocion
                WHERE $wh ORDER BY ".$this->CI->anexgrid->columna." ".$this->CI->anexgrid->columna_orden." 
                LIMIT ".$this->CI->anexgrid->pagina." , ".$this->CI->anexgrid->limite;          
            
            $registros = $this->CI->anexgrid_model->query_registros($query);
            
            $query = "
                SELECT COUNT(*) as Total
                FROM promocion
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
      
        $promocion = $this->CI->generico_model->get($id,"promocion");
        //eliminar imagen
        @unlink($promocion['imagen_lg']);
        @unlink($promocion['imagen_xs']);
        //eliminar registro de base de datos
        $this->CI->generico_model->eliminar($id,"promocion");       
        $data_error["error"] = 0;            
       
        echo json_encode($data_error);  
         
    }
    
    public function publicar(){
        $id = $this->CI->input->post('id'); 
        $publicar = ($this->CI->input->post('publicar')==1)?0:1;
        $data_error = array("error" => 0); 
      
        $this->CI->generico_model->editar($id,array('publicar' =>$publicar),"promocion");
        
        echo json_encode($data_error);  
    }
    
    public function orden_arriba(){
        $id = $this->CI->input->post('id'); 
                
        if($this->CI->orden_library->orden_arriba_tabla($id,"promocion")){
            //intercambio bien
            echo json_encode(array("arriba"=> 1)); 
        }else{
            //sino es el primero
            echo json_encode(array("arriba"=> 0)); 
        }        
    }
    
    public function orden_abajo(){
        $id = $this->CI->input->post('id'); 
                
        if($this->CI->orden_library->orden_abajo_tabla($id,"promocion")){
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
        $this->CI->generico_model->editar_todos(array('destacado' => 0 ),"promocion");  
        //cambiar destacado a 1 solo a este item
        $this->CI->generico_model->editar($id,array('destacado' => 1 ),"promocion");     
        
        echo json_encode(true);  
    }
    

}
