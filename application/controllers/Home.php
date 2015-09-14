<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("noticia_articulo_model");
        $this->load->model("generico_model");
        
        $this->load->library("auxiliar_library");
//        echo "constructor de home";
    }

    public function index() {        
        $header['carrusel'] = getCarrusel("home_carrusel");        
        //hechos historicos
        $hh1 = $this->noticia_articulo_model->get(1,'home_contenido');
        $hh2 = $this->noticia_articulo_model->get(2,'home_contenido');
        $hh3 = $this->noticia_articulo_model->get(3,'home_contenido');
        
        $hechos = array($hh1,$hh2,$hh3);
                
        //referencias biograficas
        $rb1 = $this->noticia_articulo_model->get(4,'home_contenido');
        $rb2 = $this->noticia_articulo_model->get(5,'home_contenido');        
        $referencias = array($rb1,$rb2);
        
        //huellas de la historia        
        $hu1 = $this->noticia_articulo_model->get(6,'home_contenido');
        $hu2 = $this->noticia_articulo_model->get(7,'home_contenido');
        $hu3 = $this->noticia_articulo_model->get(8,'home_contenido');
        $huellas = array($hu1,$hu2,$hu3);
        
        //testimonios
        $testimonio = $this->generico_model->get(1,'testimonio');
        
        //opinion del editor
        $editor = $this->generico_model->get(7,'editor');
//                                                    
        $articulos = $this->auxiliar_library->getArticulosxEditorPrincipal();
//        echo $this->db->last_query();
//        echo "<pre>";
//        print_r($articulos);
//        echo "</pre>";
        
        $articulos = $this->auxiliar_library->getArticulosConCategorias($articulos);
                
        $data_oe = array(
            "articulos" => $articulos,
            "editor" => $editor
        );
        
        //opinion del editor
        $opinion_editor = $this->load->view("opinion_editor",$data_oe,true);
        
        //OPINION COLABORADORES
        //opinion del editor        
        $articulos_colaborador = $this->auxiliar_library->getArticulosxColaborador();

//        echo $this->db->last_query();
        $articulos_colaborador = $this->auxiliar_library->getArticulosConCategorias($articulos_colaborador);
//        echo $this->db->last_query();
        
        $articulos_colaborador = $this->auxiliar_library->getArticulosConEditor($articulos_colaborador);
                
//        $data_oc = array(
//            "articulos" => $articulos
//        );
        
        //opinion del editor
//        $opinion_colaborador = $this->load->view("opinion_colaborador",$data_oc,true);
        
        //datos de HISTORIA Y REALIDAD
        //video destacado
        $video_destacado = $this->generico_model->getCondicion(array("destacado" => 1),'galeria_videos');
        //imagen destacado
        $foto_destacado = $this->generico_model->getCondicion(array("destacado" => 1),'galeria_fotos');
        //testimonio
        $data = array(
            "hechos" => $hechos,
            "referencias" => $referencias,
            "huellas" => $huellas,
            "foto_destacado" => $foto_destacado,
            "video_destacado" => $video_destacado,
            "testimonio" => $testimonio,
            "opinion_editor" => $opinion_editor,
            "opinion_colaborador" => $articulos_colaborador
        );
        

        
        $this->load->view("templates/header",$header);
        $this->load->view("home",$data);
        $this->load->view("templates/footer");
    }
    


}
