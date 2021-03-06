<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Frontend extends CI_Controller {

    public function __construct() {
        parent::__construct();   
        
        $this->load->model("generico_model");
    }

//    public function index() {        
//        $this->home();
//    }
    
    public function ruteador() {   
        $uri1 = $this->uri->segment(1, false);
        $uri2 = $this->uri->segment(2, false);
        $uri3 = $this->uri->segment(3, false);
        
        if($uri1 && !$uri2 && !$uri3){            
            switch($uri1){     
                case "home"     : $this->home(); break;
                case "nosotros"  : $this->nosotros(); break;
                case "novedades"  : $this->novedades(); break;
                case "promociones"  : $this->promociones(); break;
                case "contacto"  : $this->contacto(); break;
                case "fuentedem"  : $this->load->view("fuentedem",null); break;
                default : 
                    //REDIRECCION LISTA DE PRODUCTOS
                    $grupo = $this->generico_model->getCondicion(array("url"=>$uri1),"producto_grupo");
                    if($grupo){
                        
                        //mostrar categoria y subcategoria por defecto
                        $categoria_condicion = array(
                            "id_grupo" => $grupo['id'],
                            "order_by" => array(
                                "columna" => "orden",
                                "ordenar" => "ASC"
                            )
                        );
                        $categoria_default = $this->generico_model->getCondicion($categoria_condicion,"producto_categoria");
                        
                        //mostrar la subcategoria por defecto
                        $subcategoria_condicion = array(
                            "id_categoria" => $categoria_default['id'],
                            "order_by" => array(
                                "columna" => "orden",
                                "ordenar" => "ASC"
                            )
                        );
                        $subcategoria_default = $this->generico_model->getCondicion($subcategoria_condicion,"producto_subcategoria");
                        
                        if(!$categoria_default || !$subcategoria_default ){
                            echo "404";
                        }else{
                            redirect($grupo['url']."/".$categoria_default['url']."/".$subcategoria_default['url']."/");
                        }                        
                        
                    }else{
                        echo "404";
                    }
                break;
            }
        }
        else if($uri1 && $uri2 && $uri3){
            //LISTA DE PRODUCTOS
            $grupo = $this->generico_model->getCondicion(array("url"=>$uri1),"producto_grupo");
            if($grupo){

                //mostrar categoria
                $categoria_condicion = array(
                    "id_grupo" => $grupo['id'],
                    "url" => $uri2                    
                );
                $categoria = $this->generico_model->getCondicion($categoria_condicion,"producto_categoria");

                //mostrar la subcategoria
                $subcategoria_condicion = array(
                    "id_categoria" => $categoria['id'],
                    "url" => $uri3
                );
                $subcategoria = $this->generico_model->getCondicion($subcategoria_condicion,"producto_subcategoria");

                if(!$categoria || !$subcategoria ){
                    echo "404";
                }else{
                    //LISTADO DE LOS PRODUCTOS DENTRO DE UNA SUBCATEGORIA
//                    echo $grupo['url']."/".$categoria['url']."/".$subcategoria['url'];
                    $productos = $this->generico_model->listadoCondicion(array("id_subcategoria"=>$subcategoria['id']),"producto");
//                    echo "<pre>";
//                    print_r($productos);
//                    echo "</pre>";
                    
                    $grupos = $this->generico_model->listado("producto_grupo");
                    
                    $categorias = $this->generico_model->listadoCondicion(array("id_grupo"=>$grupo["id"]),"producto_categoria");
                    
                    $subcategorias = $this->generico_model->listadoCondicion(array("id_categoria"=>$categoria["id"]),"producto_subcategoria");
                    
                    $data = array(
                        "grupos" => $grupos,
                        "grupo_seleccionado" => $grupo,
                        
                        "categorias" => $categorias,
                        "categoria_seleccionado" => $categoria,
                        
                        "subcategorias" => $subcategorias,
                        "subcategoria_seleccionado" => $subcategoria,
                        
                        "productos" => $productos
                    );
                    
                    $this->load->view("templates/header");
                    $this->load->view("producto",$data);
                    $this->load->view("templates/footer");
                }                        

            }else{
                echo "404";
            }
        } 
        else if($uri1 && $uri2){
            echo "2";
        }               
        else{
            echo "ERROR 404!<br/>";
        }
        

    }
    
    public function home(){
        $data_home = array(
            "seccion_home_header" => $this->load->view("home/seccion_home_header",null,true),
            "seccion_servicios" => $this->home_servicios(),
            "seccion_portafolio" => $this->home_portafolio(),
            "seccion_encuentranos" => $this->seccion_encuentranos(),
            "seccion_video" => $this->seccion_video(),
            "seccion_mapa" => $this->seccion_mapa(),
            "seccion_contacto" => $this->seccion_contacto(),
            
        );
        $this->load->view("templates/header");
        $this->load->view("home",$data_home);
        $this->load->view("templates/footer");
    }
    
    public function home_servicios(){
        //SERVICIOS
        $data['serv1'] = $this->generico_model->get(1,'home_contenido');
        $data['serv2'] = $this->generico_model->get(2,'home_contenido');
        $data['serv3'] = $this->generico_model->get(3,'home_contenido');
        //SERVICIOS MOVIL
        $data['serv_mov_1'] = $this->generico_model->get(4,'home_contenido');
        $data['serv_mov_2'] = $this->generico_model->get(5,'home_contenido');
        $data['serv_mov_3'] = $this->generico_model->get(6,'home_contenido');
        
        return $this->load->view("home/seccion_servicios",$data,true);
    }
    
     public function home_portafolio(){
        return $this->load->view("home/seccion_portafolio",null,true);
    }
    
    public function seccion_encuentranos(){ 
        return $this->load->view("home/seccion_encuentranos",null,true);
    }
    public function seccion_video(){ 
        return $this->load->view("home/seccion_video",null,true);
    }
    public function seccion_mapa(){ 
        return $this->load->view("home/seccion_mapa",null,true);
    }
    public function seccion_contacto(){ 
        return $this->load->view("home/seccion_contacto",null,true);
    }
    
    public function nosotros(){
        $this->load->view("templates/header");
        $this->load->view("nosotros",null);
        $this->load->view("templates/footer");
    }
    public function novedades(){
        $data = array( );
        $novedad_destacado = $this->generico_model->getCondicion(array("destacado" => 1,"publicar"=>1),"novedad"); 
        $data["novedad"] = $novedad_destacado;
        
        $data_carrusel['carrusel_items'] = $this->generico_model->listadoCondicion(array("id_novedad" => $novedad_destacado['id']),"novedad_carrusel"); 
        
        $data['carrusel'] = $this->load->view("novedades/carrusel",$data_carrusel,true);
                
        $data["novedades"] = $this->generico_model->listadoCondicion(array("publicar" => 1),"novedad"); 
        
        $this->load->view("templates/header");
        $this->load->view("novedades",$data);
        $this->load->view("templates/footer2");

    }    
    public function promociones(){
        $data = array( );
        
        $promocion_destacado = $this->generico_model->getCondicion(array("destacado" => 1,"publicar"=>1),"promocion"); 
        $data_detalle["promocion"] = $promocion_destacado;
        $data["detalle"] = $this->load->view("promociones/detalle",$data_detalle,true);
        
        $data["promociones"] = $this->generico_model->listadoCondicion(array("publicar" => 1),"promocion"); 
        
        $this->load->view("templates/header");
        $this->load->view("promociones",$data);
        $this->load->view("templates/footer");
    }
    
    public function contacto(){
        $this->load->view("templates/header");
        //$this->load->view("nosotros",null);
        $this->load->view("templates/footer2");
    }

}
