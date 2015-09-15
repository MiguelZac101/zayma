<?php

Class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct(); 
        
        $this->load->library("home_library");  
        $this->load->library("producto_categoria_library");
        $this->load->library("producto_subcategoria_library");
        $this->load->library("producto_library");
        
        if (is_logged()) {
//            echo "esta logueado";
            
        } else {
//            echo "NO esta logueado";
            redirect('auth/');
        }
    }

    public function index() {
        redirect("admin/home/listado");
    }   
    
    public function home($page){       
        $data = array(
            'funcion_nombre' => 'home', //el nombre del controlador y de la tabla debe ser la mismo carpeta de  la vista
            'titulo_modulo' => 'INICIO',
            'carpeta_imagen' => 'uploads/home/',
            'tabla' => 'home_contenido'
        );        
        $this->home_master($page,$data);        
    }
    
    public function home_master($page,$data){
        switch($page){
            case "listado":              
                $this->home_library->listado($data);
                break;            
            case "actualizar": 
                $this->home_library->actualizar($data); 
                break;  
                      
        }
    }
    
    //CATEGORIA DE PRODUCTOS
    public function producto_categoria($page){
        $data = array(
            'control' => 'producto_categoria', //el nombre del controlador y de la tabla debe ser el mismo carpeta de  la vista
            'titulo_modulo' => 'CATEGORIA',
            'carpeta_imagen' => 'uploads/producto/categoria/',
            'tabla' => 'producto_categoria'
        );
        
        switch($page){
            case "nuevo":                
                $this->producto_categoria_library->nuevo($data);
                break;
            case "registrar": 
                $this->producto_categoria_library->registrar($data);
                break;
            case "listado": 
                $this->producto_categoria_library->listado($data);
                break;
            case "editar": 
                $this->producto_categoria_library->editar($data);
                break;            
            case "actualizar": 
                $this->producto_categoria_library->actualizar($data); 
                break; 
            case "anexgrid": 
                $this->producto_categoria_library->anexgrid($data);
                break;          
            case "eliminar": 
                $this->producto_categoria_library->eliminar($data);
                break;
            case "publicar": 
                $this->producto_categoria_library->publicar($data);
                break;
            case "orden_arriba": 
                $this->producto_categoria_library->orden_arriba($data);
                break;
            case "orden_abajo": 
                $this->producto_categoria_library->orden_abajo($data);
                break;           
        }
    }
    
    //CATEGORIA DE PRODUCTOS
    public function producto_subcategoria($page){
        $data = array(
            'control' => 'producto_subcategoria', //el nombre del controlador y de la tabla debe ser el mismo carpeta de  la vista
            'titulo_modulo' => 'SUBCATEGORIA',
            'carpeta_imagen' => 'uploads/producto/subcategoria/',
            'tabla' => 'producto_subcategoria'
        );
        
        switch($page){
            case "nuevo":                
                $this->producto_subcategoria_library->nuevo($data);
                break;
            case "registrar": 
                $this->producto_subcategoria_library->registrar($data);
                break;
            case "listado": 
                $this->producto_subcategoria_library->listado($data);
                break;
            case "editar": 
                $this->producto_subcategoria_library->editar($data);
                break;            
            case "actualizar": 
                $this->producto_subcategoria_library->actualizar($data); 
                break; 
            case "anexgrid": 
                $this->producto_subcategoria_library->anexgrid($data);
                break;          
            case "eliminar": 
                $this->producto_subcategoria_library->eliminar($data);
                break;
            case "publicar": 
                $this->producto_subcategoria_library->publicar($data);
                break;
            case "orden_arriba": 
                $this->producto_subcategoria_library->orden_arriba($data);
                break;
            case "orden_abajo": 
                $this->producto_subcategoria_library->orden_abajo($data);
                break;           
        }
    }
    
    //PRODUCTOS
    public function producto($page){        
        
        switch($page){
            case "nuevo":                
                $this->producto_library->nuevo();
                break;
            case "registrar": 
                $this->producto_library->registrar();
                break;
            case "listado": 
                $this->producto_library->listado();
                break;
            case "editar": 
                $this->producto_library->editar();
                break;            
            case "actualizar": 
                $this->producto_library->actualizar(); 
                break; 
            case "anexgrid": 
                $this->producto_library->anexgrid();
                break;          
            case "eliminar": 
                $this->producto_library->eliminar();
                break;
            case "publicar": 
                $this->producto_library->publicar();
                break;
            case "orden_arriba": 
                $this->producto_library->orden_arriba();
                break;
            case "orden_abajo": 
                $this->producto_library->orden_abajo();
                break;           
        }
    }
    
    
    //COMBOS
    public function combo($funcion){
        switch($funcion){
            case "categorias_grupo"://lista de categorias por grupo
                $id_grupo = $this->input->post("id_grupo");
                $categorias = $this->generico_model->listadoCondicion(array("id_grupo"=>$id_grupo),"producto_categoria");
                $html_select = "<option value='0'>Seleccione Categoria</option>";
                if(count($categorias)){
                    foreach ($categorias as $cat) {
                        $html_select .= "<option value='".$cat['id']."'>".$cat['nombre']."</option>";
                    }
                }else{
                    
                }
                echo $html_select;
                break;
            case "subcategorias_categoria"://lista de categorias por grupo
                $id_categoria = $this->input->post("id_categoria");
                $subcategorias = $this->generico_model->listadoCondicion(array("id_categoria"=>$id_categoria),"producto_subcategoria");
                $html_select = "<option value='0'>Seleccione Subcategoria</option>";
                if(count($subcategorias)){
                    foreach ($subcategorias as $cat) {
                        $html_select .= "<option value='".$cat['id']."'>".$cat['nombre']."</option>";
                    }
                }else{
                    
                }
                echo $html_select;
                break;
        }
    }
}

