<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Galeria_videos_library {

    protected $CI;

    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model("generico_model");//base de datos generico
        $this->CI->load->model("anexgrid_model");        
        $this->CI->load->library("anexgrid");
    }
    
    //nuevo vista
    public function nuevo() {       
        echo $this->CI->load->view("admin/galeria_videos/nuevo",'',true);     
    }   
     
    //editar vista  
    public function editar() {
        $id = $this->CI->input->post("id");
        $registro = $this->CI->generico_model->get($id,'galeria_videos');
        echo $this->CI->load->view("admin/galeria_videos/editar",$registro,true);
    }
    
    public function registrar() {
        $titulo = $this->CI->input->post("titulo");
        $url = $this->CI->input->post("url");      
        
        $codigo_youtube = getCodigoYoutube($url);
                
        //registrar
        $registro_nuevo = array(
            'titulo' => $titulo,
            'url' => $url,
            'codigo_youtube' => $codigo_youtube
        );

        if($this->CI->generico_model->nuevo($registro_nuevo,'galeria_videos')){
            $errors['registro'] = 1;                
        }else{
            $errors['registro'] = 0;                
        }
        
        echo json_encode($errors);
        
    }
    
    public function actualizar() {
        $id = $this->CI->input->post("id");
        $titulo = $this->CI->input->post("titulo");
        $url = $this->CI->input->post("url");    
        $codigo_youtube = getCodigoYoutube($url);
        
        //update
        $update = array(
            'titulo' => $titulo  ,
            'url' => $url,
            'codigo_youtube' => $codigo_youtube
        );    
        

        if($this->CI->generico_model->editar($id,$update,'galeria_videos')){
            $errors['actualizar'] = 1;                
        }else{
            $errors['actualizar'] = 0;                
        }
            
        echo json_encode($errors);
        
    }
    
    public function listado() {
        $header = array();
        $data = array(
            "pagina" => $this->CI->load->view("admin/galeria_videos/nuevo",'',true)
        );
        $footer = array();        
        
        $this->CI->view_admin_library->plantilla("galeria_videos/listado",$header,$data,$footer);       
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
                SELECT * FROM galeria_videos
                WHERE $wh ORDER BY ".$this->CI->anexgrid->columna." ".$this->CI->anexgrid->columna_orden." 
                LIMIT ".$this->CI->anexgrid->pagina." , ".$this->CI->anexgrid->limite;          
            
            $registros = $this->CI->anexgrid_model->query_registros($query);
            
            $query = "
                SELECT COUNT(*) as Total
                FROM galeria_videos
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
        $registro = $this->CI->generico_model->get($id,'galeria_videos');
        //eliminar imagen
        @unlink($registro['imagen']);
        
        //eliminar registro de base de datos
        $result = $this->CI->generico_model->eliminar($id,'galeria_videos');       
        
        echo json_encode(true);  
    }
    
    public function destacado(){
        $id = $this->CI->input->post('id'); 
        //todos los demas articulos poner a 0 su destacado
        $this->CI->generico_model->editar_todos(array('destacado' => 0 ),'galeria_videos');  
        //cambiar destacado a 1 solo a este articulo
        $this->CI->generico_model->editar($id,array('destacado' => 1 ),'galeria_videos');       
        
        echo json_encode(true);  
    }
    

}
