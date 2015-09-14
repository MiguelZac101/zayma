<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Galeria_fotos_library {

    protected $CI;
    private $imagen_ancho = "870";
    private $imagen_alto = "600";

    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model("generico_model");//base de datos generico
        $this->CI->load->model("anexgrid_model");        
        $this->CI->load->library("anexgrid");
    }
    
    //nuevo vista
    public function nuevo() {       
        echo $this->CI->load->view("admin/galeria_fotos/nuevo",'',true);     
    }   
     
    //editar vista  
    public function editar() {
        $id = $this->CI->input->post("id");
        $registro = $this->CI->generico_model->get($id,'galeria_fotos');
        echo $this->CI->load->view("admin/galeria_fotos/editar",$registro,true);
    }
    
    public function registrar() {
        $errors = array(
            'upload_imagen' => '',
            'registro' => ''
        );
        $titulo = $this->CI->input->post("titulo");
        
        $file_name = "galeria_".Date("YmdHis");
        $file_name_ext = "";   

        $config['upload_path'] = "uploads/galeria_fotos/";
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
            $registro_nuevo = array(
                'titulo' => $titulo,
                'imagen' => "uploads/galeria_fotos/".$file_name_ext                             
            );
            
            if($this->CI->generico_model->nuevo($registro_nuevo,'galeria_fotos')){
                $errors['registro'] = 1;                
            }else{
                $errors['registro'] = 0;                
            }
            
            
        } 
        echo json_encode($errors);
        
    }
    
    public function actualizar() {
        $id = $this->CI->input->post("id");
        $titulo = $this->CI->input->post("titulo");
        
        $errors = array(
            'upload_imagen' => '',
            'actualizar' => ''
        );        
        
        //obtener el editor
        $editor = $this->CI->generico_model->get($id,'galeria_fotos');
                
        $file_name = "editor_".Date("YmdHis");
        $file_name_ext = "";

        $config['upload_path'] = "uploads/galeria_fotos/";
        $config['file_name'] = $file_name;
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
//            $config['max_size'] = '100';
        $config['max_width'] = $this->imagen_ancho;
        $config['max_height'] = $this->imagen_alto;
        $config['min_width'] = $this->imagen_ancho;
        $config['min_height'] = $this->imagen_alto;

        $this->CI->load->library('upload', $config);
        
        //update
        $update = array(
            'titulo' => $titulo              
        );
        
        if (!$this->CI->upload->do_upload("imagen")) {
            //*** ocurrio un error            
            $errors['upload_imagen'] =  $this->CI->upload->display_errors('',''); 
            
            
        }else{
            $uploadSuccess = $this->CI->upload->data();
            $file_name_ext = $uploadSuccess['file_name'];   
            //borrar la imagen anterior
            $update['imagen'] = "uploads/galeria_fotos/".$file_name_ext;
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
        

        if($this->CI->generico_model->editar($id,$update,'galeria_fotos')){
//            $errors['db'] = $this->CI->db->last_query();
            $errors['actualizar'] = 1;                
        }else{
            $errors['actualizar'] = 0;                
        }
            
        echo json_encode($errors);
        
    }
    
    public function listado() {
        $header = array();
        $data = array(
            "pagina" => $this->CI->load->view("admin/galeria_fotos/nuevo",'',true)
        );
        $footer = array();        
        
        $this->CI->view_admin_library->plantilla("galeria_fotos/listado",$header,$data,$footer);       
    }
    
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
                SELECT * FROM galeria_fotos
                WHERE $wh ORDER BY ".$this->CI->anexgrid->columna." ".$this->CI->anexgrid->columna_orden." 
                LIMIT ".$this->CI->anexgrid->pagina." , ".$this->CI->anexgrid->limite;          
            
            $registros = $this->CI->anexgrid_model->query_registros($query);
            
            $query = "
                SELECT COUNT(*) as Total
                FROM galeria_fotos
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
        $registro = $this->CI->generico_model->get($id,'galeria_fotos');
        //eliminar imagen
        @unlink($registro['imagen']);
        
        //eliminar registro de base de datos
        $result = $this->CI->generico_model->eliminar($id,'galeria_fotos');       
        
        echo json_encode(true);  
    }
    
    public function destacado(){
        $id = $this->CI->input->post('id'); 
        //todos los demas articulos poner a 0 su destacado
        $this->CI->generico_model->editar_todos(array('destacado' => 0 ),'galeria_fotos');  
        //cambiar destacado a 1 solo a este articulo
        $this->CI->generico_model->editar($id,array('destacado' => 1 ),'galeria_fotos');       
        
        echo json_encode(true);  
    }
    

}
