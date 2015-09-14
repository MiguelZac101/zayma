<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Testimonio extends CI_Controller {

    public function __construct() {
        parent::__construct();       
        $this->load->model("generico_model");
        $this->load->model("noticia_articulo_model");
        $this->load->library("auxiliar_library");
    }

    public function index() {        
        
//        echo "index testimonio";
        
        $header = array();
        $data = array();

        $data['testimonio'] = $this->generico_model->get(1,'testimonio');
        
//        echo $this->db->last_query();
        //$header['titulo_pagina'] = "Testimonio";
        
        //opinion del editor
        $editor = $this->generico_model->get(7,'editor');   
        $articulos = $this->auxiliar_library->getArticulosxEditorPrincipal();
        $articulos = $this->auxiliar_library->getArticulosConCategorias($articulos);
                
        $data_oe = array(
            "articulos" => $articulos,
            "editor" => $editor
        );
        
        //opinion del editor
        $data['opinion_editor'] = $this->load->view("opinion_editor",$data_oe,true);
        
        //OPINION COLABORADORES
        //opinion del editor        
        $articulos_colaborador = $this->auxiliar_library->getArticulosxColaborador();
        $articulos_colaborador = $this->auxiliar_library->getArticulosConCategorias($articulos_colaborador);       
        $articulos_colaborador = $this->auxiliar_library->getArticulosConEditor($articulos_colaborador);
        
        $data['opinion_colaborador'] = $this->load->view("opinion_colaboradores",array("articulos"=>$articulos_colaborador),true);
        
        $this->load->view("templates/header",$header);
        $this->load->view("testimonio",$data);
        $this->load->view("templates/footer");
        
    }   


}
