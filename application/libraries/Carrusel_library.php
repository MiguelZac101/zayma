<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Carrusel_library {

    protected $CI;

    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model("noticia_categoria_model");
//        $this->CI->load->model("anexgrid_model");
    }
    
    //nuevo vista
    public function nuevo($data_config) {       
        echo $this->CI->load->view("admin/carrusel/nuevo",$data_config,true);     
    }   
     
    //editar vista  
    public function editar($data_config) {
        $id = $this->CI->input->post("id");
        $data = $this->CI->noticia_categoria_model->get($id,$data_config['tabla']);        
        $data = array_merge($data,$data_config);        
        echo $this->CI->load->view("admin/carrusel/editar",$data,true);
    }
    
    public function registrar($data_config) {
        $errors = array(
            'upload_imagen' => '',
            'registro' => '',
            'limite_registros'    => ''
        );
        //verificar si ya tiene 3 registros, si los tiene enviar mensaje indicando que puede subir mas
        
        if($this->CI->noticia_categoria_model->numero_registros($data_config['tabla'])==3){
            //se lleno
            $errors['limite_registros'] = "LLego al maximo de registros.";
        }else{
            //sino se puede registrar mas
            $titulo = $this->CI->input->post("titulo");
            $url = $this->CI->input->post("url");        

            $file_name = "carrusel_".Date("YmdHis");
            $file_name_ext = "";        

            $config['upload_path'] = $data_config['carpeta_imagen'];
            $config['file_name'] = $file_name;
            $config['allowed_types'] = "gif|jpg|jpeg|png";  
            $config['max_width'] = '1920';
            $config['max_height'] = '450';
            $config['min_width'] = '1920';
            $config['min_height'] = '450';

            $this->CI->load->library('upload', $config);

            if (!$this->CI->upload->do_upload("imagen")) {                   
                $errors['upload_imagen'] =  $this->CI->upload->display_errors('','');           
            }else{
                $uploadSuccess = $this->CI->upload->data();
                $file_name_ext = $uploadSuccess['file_name'];  
                $full_path = $uploadSuccess['full_path']; 

                //registrar
                $carrusel = array(
                    'titulo' => $titulo,
                    'imagen' => $config['upload_path'].$file_name_ext,
                    'url' => $url                 
                );

                if($this->CI->noticia_categoria_model->nuevo($carrusel,$data_config['tabla'])){
                    $errors['registro'] = 1;                
                }else{
                    $errors['registro'] = 0;                
                }           
            } 
        }
        
                   
        echo json_encode($errors);        
    }
    
    public function actualizar($data_config) {
        $id = $this->CI->input->post("id");
        
        $titulo = $this->CI->input->post("titulo");
        $url = $this->CI->input->post("url"); 
        
        $errors = array(
            'upload_imagen' => '',
            'actualizar' => 0          
        );     
        
        //obtener el noticia_categoria
        $carrusel = $this->CI->noticia_categoria_model->get($id,$data_config['tabla']);
                
        $file_name = "carrusel_".Date("YmdHis");
        $file_name_ext = "";      

        $config['upload_path'] = $data_config['carpeta_imagen'];
        $config['file_name'] = $file_name;
        $config['allowed_types'] = "gif|jpg|jpeg|png";  
        $config['max_width'] = '1920';
        $config['max_height'] = '450';
        $config['min_width'] = '1920';
        $config['min_height'] = '450';
        
        $this->CI->load->library('upload', $config);
        
        //update
        $carrusel_update = array(
            'titulo' => $titulo,
            'url' => $url                
        );
        
        if (!$this->CI->upload->do_upload("imagen")) {
            //*** ocurrio un error            
            $errors['upload_imagen'] =  $this->CI->upload->display_errors('','');           
        }else{
            $uploadSuccess = $this->CI->upload->data();
            $file_name_ext = $uploadSuccess['file_name'];   
            //borrar la imagen anterior
            $carrusel_update['imagen'] = $config['upload_path'].$file_name_ext;
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
        
        if($this->CI->noticia_categoria_model->editar($id,$carrusel_update,$data_config['tabla'])){
            $errors['actualizar'] = 1;                
        }else{
            $errors['actualizar'] = 0;                
        }
            
        echo json_encode($errors);        
    }
    
    public function listado($data_config) {
        $header = array();
        $data = array(
            "pagina" => $this->CI->load->view("admin/carrusel/nuevo",$data_config,true)
        );
        
        $data = array_merge($data, $data_config); 
        
        $footer = array();        
        
        $this->CI->view_admin_library->plantilla("carrusel/listado",$header,$data,$footer);       
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
                SELECT * FROM ".$data_config['tabla']."
                WHERE $wh ORDER BY ".$this->CI->anexgrid->columna." ".$this->CI->anexgrid->columna_orden." 
                LIMIT ".$this->CI->anexgrid->pagina." , ".$this->CI->anexgrid->limite;          
            
            $registros = $this->CI->anexgrid_model->query_registros($query);
            
            $query = "
                SELECT COUNT(*) as Total
                FROM ".$data_config['tabla']."
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
    
    

}
