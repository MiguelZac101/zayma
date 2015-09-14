<?php

Class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        $this->load->library("view_admin_library");
        $this->load->library("editor_library");
        $this->load->library("noticia_categoria_library");
        $this->load->library("noticia_articulo_library");
        
        $this->load->library("carrusel_library");   
        
        $this->load->library("home_library");
        $this->load->library("galeria_fotos_library");
        $this->load->library("galeria_videos_library");
        
        
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
    
    public function editor($page,$id=""){
        switch($page){
            case "nuevo":                
                $this->editor_library->nuevo();
                break;
            case "registrar": 
                $this->editor_library->registrar();
                break;
            case "listado": 
                $this->editor_library->listado();
                break;
            case "editar": 
                $this->editor_library->editar();
                break;            
            case "actualizar": 
                $this->editor_library->actualizar(); 
                break; 
            case "anexgrid": 
                $this->editor_library->anexgrid();
                break;          
            case "eliminar": 
                $this->editor_library->eliminar();
                break;
        }
        
    }
    
    ///GALERIA - FOTOS
    public function galeria_fotos($page){
        switch($page){
            case "nuevo":                
                $this->galeria_fotos_library->nuevo();
                break;
            case "registrar": 
                $this->galeria_fotos_library->registrar();
                break;
            case "listado": 
                $this->galeria_fotos_library->listado();
                break;
            case "editar": 
                $this->galeria_fotos_library->editar();
                break;            
            case "actualizar": 
                $this->galeria_fotos_library->actualizar(); 
                break; 
            case "anexgrid": 
                $this->galeria_fotos_library->anexgrid();
                break;          
            case "eliminar": 
                $this->galeria_fotos_library->eliminar();
                break;
            case "destacado": 
                $this->galeria_fotos_library->destacado();
                break;
        }
        
    }
    
    //GALERIA VIDEOS
    public function galeria_videos($page){
        switch($page){
            case "nuevo":                
                $this->galeria_videos_library->nuevo();
                break;
            case "registrar": 
                $this->galeria_videos_library->registrar();
                break;
            case "listado": 
                $this->galeria_videos_library->listado();
                break;
            case "editar": 
                $this->galeria_videos_library->editar();
                break;            
            case "actualizar": 
                $this->galeria_videos_library->actualizar(); 
                break; 
            case "anexgrid": 
                $this->galeria_videos_library->anexgrid();
                break;          
            case "eliminar": 
                $this->galeria_videos_library->eliminar();
                break;
            case "destacado": 
                $this->galeria_videos_library->destacado();
                break;
        }
        
    }
    
    //CATEGORIAS DE ARTICULOS
    public function noticia_categoria($page){
        
        $data = array(
            'control' => 'noticia_categoria', //el nombre del controlador y de la tabla debe ser el mismo carpeta de  la vista
            'titulo_modulo' => 'Noticia / Categoria',
            'carpeta_imagen' => 'uploads/noticia/categoria/'
        );
        
        $this->categoria_master($page, $data);       
    }
    
    public function categoria_master($page,$data){
        switch($page){
            case "nuevo":                
                $this->noticia_categoria_library->nuevo($data);
                break;
            case "registrar": 
                $this->noticia_categoria_library->registrar($data);
                break;
            case "listado": 
                $this->noticia_categoria_library->listado($data);
                break;
            case "editar": 
                $this->noticia_categoria_library->editar($data);
                break;            
            case "actualizar": 
                $this->noticia_categoria_library->actualizar($data); 
                break; 
            case "anexgrid": 
                $this->noticia_categoria_library->anexgrid($data);
                break;          
            case "eliminar": 
                $this->noticia_categoria_library->eliminar($data);
                break;
            case "publicar": 
                $this->noticia_categoria_library->publicar($data);
                break;
            case "orden_arriba": 
                $this->noticia_categoria_library->orden_arriba($data);
                break;
            case "orden_abajo": 
                $this->noticia_categoria_library->orden_abajo($data);
                break;           
        }
    }
    
    public function ideologia_categoria($page){
        
        $data = array(
            'control' => 'ideologia_categoria', //el nombre del controlador y de la tabla debe ser el mismo carpeta de  la vista
            'titulo_modulo' => 'Ideologia / Categoria',
            'carpeta_imagen' => 'uploads/ideologia/categoria/'
        );
        
        $this->categoria_master($page, $data);
    }
    
    public function logros_categoria($page){
        
        $data = array(
            'control' => 'logros_categoria', //el nombre del controlador y de la tabla debe ser el mismo carpeta de  la vista
            'titulo_modulo' => 'Logros / Categoria',
            'carpeta_imagen' => 'uploads/logros/categoria/'
        );
        
        $this->categoria_master($page, $data);
    }
    
    public function documentos_categoria($page){
        
        $data = array(
            'control' => 'documentos_categoria', //el nombre del controlador y de la tabla debe ser el mismo carpeta de  la vista
            'titulo_modulo' => 'Documentos / Categoria',
            'carpeta_imagen' => 'uploads/documentos/categoria/'
        );
        
        $this->categoria_master($page, $data);
    }
    
    public function kausachun_categoria($page){
        
        $data = array(
            'control' => 'kausachun_categoria', //el nombre del controlador y de la tabla debe ser el mismo carpeta de  la vista
            'titulo_modulo' => 'Kausachun / Categoria',
            'carpeta_imagen' => 'uploads/kausachun/categoria/'
        );
        
        $this->categoria_master($page, $data);
    }
    
    public function lideres_categoria($page){
        
        $data = array(
            'control' => 'lideres_categoria', //el nombre del controlador y de la tabla debe ser el mismo carpeta de  la vista
            'titulo_modulo' => 'Lideres / Categoria',
            'carpeta_imagen' => 'uploads/lideres/categoria/'
        );
        
        $this->categoria_master($page, $data);
    }
    
    
    
    public function noticia_articulo($page){
            
        $data = array(
            'control' => 'noticia_articulo', //el nombre del controlador y de la tabla debe ser el mismo carpeta de  la vista
            'titulo_modulo' => 'Noticia / Articulo',
            'carpeta_imagen' => 'uploads/noticia/articulo/',
//            'carpeta_imagen_thumbnail' => 'uploads/noticia/articulo/thumbnail/',
            'tabla_categoria' => "noticia_categoria"
        );
       
        $this->articulo_master($page, $data);
        
    }
    
    public function articulo_master($page,$data){
        switch($page){
            case "nuevo":                
                echo $this->noticia_articulo_library->nuevo($data);
                break;
            case "registrar": 
                $this->noticia_articulo_library->registrar($data);
                break;
            case "listado": 
                $this->noticia_articulo_library->listado($data);
                break;
            case "editar": 
                echo $this->noticia_articulo_library->editar($data);
                break;            
            case "actualizar": 
                $this->noticia_articulo_library->actualizar($data); 
                break; 
            case "anexgrid": 
                $this->noticia_articulo_library->anexgrid($data);
                break;          
            case "eliminar": 
                $this->noticia_articulo_library->eliminar($data);
                break;
            case "publicar": 
                $this->noticia_articulo_library->publicar($data);
                break;
            case "destacado": 
                $this->noticia_articulo_library->destacado($data);
                break;
        }
    }
    
    public function ideologia_articulo($page){
            
        $data = array(
            'control' => 'ideologia_articulo', //el nombre del controlador y de la tabla debe ser el mismo carpeta de  la vista
            'titulo_modulo' => 'Ideologia / Articulo',
            'carpeta_imagen' => 'uploads/ideologia/articulo/',
            'tabla_categoria' => "ideologia_categoria"
        );
       
        $this->articulo_master($page, $data);         
    }
    
    public function logros_articulo($page){
            
        $data = array(
            'control' => 'logros_articulo', //el nombre del controlador y de la tabla debe ser el mismo carpeta de  la vista
            'titulo_modulo' => 'Logros / Articulo',
            'carpeta_imagen' => 'uploads/logros/articulo/',
            'tabla_categoria' => "logros_categoria"
        );
       
        $this->articulo_master($page, $data);         
    }
    
    public function documentos_articulo($page){
            
        $data = array(
            'control' => 'documentos_articulo', //el nombre del controlador y de la tabla debe ser el mismo carpeta de  la vista
            'titulo_modulo' => 'Documentos / Articulo',
            'carpeta_imagen' => 'uploads/documentos/articulo/',
            'tabla_categoria' => "documentos_categoria"
        );
       
        $this->articulo_master($page, $data);         
    }
    
    public function kausachun_articulo($page){
            
        $data = array(
            'control' => 'kausachun_articulo', //el nombre del controlador y de la tabla debe ser el mismo carpeta de  la vista
            'titulo_modulo' => 'Kausachun Perú / Articulo',
            'carpeta_imagen' => 'uploads/kausachun/articulo/',
            'tabla_categoria' => "kausachun_categoria"
        );
       
        $this->articulo_master($page, $data);         
    }
    
    public function lideres_articulo($page){
            
        $data = array(
            'control' => 'lideres_articulo', //el nombre del controlador y de la tabla debe ser el mismo carpeta de  la vista
            'titulo_modulo' => 'Grandes Lideres / Biografía',
            'carpeta_imagen' => 'uploads/lideres/articulo/',
            'tabla_categoria' => "lideres_categoria"
        );
       
        $this->articulo_master($page, $data);         
    }
    
    //CARRUSEL
    //CARRUSEL
    //CARRUSEL
    public function noticia_carrusel($page){        
        $data = array(
            'funcion_nombre' => 'noticia_carrusel', //el nombre del controlador y de la tabla debe ser la mismo carpeta de  la vista
            'titulo_modulo' => 'Noticia / Carrusel',
            'carpeta_imagen' => 'uploads/carrusel/noticia/',
            'tabla' => 'noticia_carrusel'
        );        
        $this->carrusel_master($page, $data);        
    }
    
    public function home_carrusel($page){        
        $data = array(
            'funcion_nombre' => 'home_carrusel', //el nombre del controlador y de la tabla debe ser la mismo carpeta de  la vista
            'titulo_modulo' => 'Home / Carrusel',
            'carpeta_imagen' => 'uploads/carrusel/home/',
            'tabla' => 'home_carrusel'
        );        
        $this->carrusel_master($page,$data);        
    }
    
    public function ideologia_carrusel($page){        
        $data = array(
            'funcion_nombre' => 'ideologia_carrusel', //el nombre del controlador y de la tabla debe ser la mismo carpeta de  la vista
            'titulo_modulo' => 'Ideologia / Carrusel',
            'carpeta_imagen' => 'uploads/carrusel/ideologia/',
            'tabla' => 'ideologia_carrusel'
        );        
        $this->carrusel_master($page,$data);        
    }
    
    public function logros_carrusel($page){        
        $data = array(
            'funcion_nombre' => 'logros_carrusel', //el nombre del controlador y de la tabla debe ser la mismo carpeta de  la vista
            'titulo_modulo' => 'Logros / Carrusel',
            'carpeta_imagen' => 'uploads/carrusel/logros/',
            'tabla' => 'logros_carrusel'
        );        
        $this->carrusel_master($page,$data);        
    }
    
    public function documentos_carrusel($page){        
        $data = array(
            'funcion_nombre' => 'documentos_carrusel', //el nombre del controlador y de la tabla debe ser la mismo carpeta de  la vista
            'titulo_modulo' => 'Documentos / Carrusel',
            'carpeta_imagen' => 'uploads/carrusel/documentos/',
            'tabla' => 'documentos_carrusel'
        );        
        $this->carrusel_master($page,$data);        
    }
    
    public function kausachun_carrusel($page){        
        $data = array(
            'funcion_nombre' => 'kausachun_carrusel', //el nombre del controlador y de la tabla debe ser la mismo carpeta de  la vista
            'titulo_modulo' => 'Kausachun Perú / Carrusel',
            'carpeta_imagen' => 'uploads/carrusel/kausachun/',
            'tabla' => 'kausachun_carrusel'
        );        
        $this->carrusel_master($page,$data);        
    }
    
    public function lideres_carrusel($page){        
        $data = array(
            'funcion_nombre' => 'lideres_carrusel', //el nombre del controlador y de la tabla debe ser la mismo carpeta de  la vista
            'titulo_modulo' => 'Grandes Lideres / Carrusel',
            'carpeta_imagen' => 'uploads/carrusel/lideres/',
            'tabla' => 'lideres_carrusel'
        );        
        $this->carrusel_master($page,$data);        
    }
    
    public function carrusel_master($page,$data){
        switch($page){
            case "nuevo":                
                $this->carrusel_library->nuevo($data);
                break;
            case "registrar": 
                $this->carrusel_library->registrar($data);
                break;
            case "listado":                
                $this->carrusel_library->listado($data);
                break;
            case "editar": 
                $this->carrusel_library->editar($data);
                break;            
            case "actualizar": 
                $this->carrusel_library->actualizar($data); 
                break; 
            case "anexgrid": 
                $this->carrusel_library->anexgrid($data);
                break;     
                      
        }
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

}

