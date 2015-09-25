<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Frontend_ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();   
        
        $this->load->model("generico_model");
    }
    
    public function novedad_carrusel(){
        $id_novedad = $this->input->post("id_novedad");        
        $data_carrusel['carrusel_items'] = $this->generico_model->listadoCondicion(array("id_novedad" => $id_novedad),"novedad_carrusel");        
        echo $this->load->view("novedades/carrusel",$data_carrusel,true);
    }
}