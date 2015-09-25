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
        $carrusel = $this->load->view("novedades/carrusel",$data_carrusel,true);
        
        $novedad = $this->generico_model->get($id_novedad,"novedad");
        $descripcion = $novedad['descripcion'];
        
        $data = array("carrusel"=>$carrusel,"descripcion"=>$descripcion);
        echo json_encode($data);
    }
    
    public function promocion_detalle(){
        $id_promocion = $this->input->post("id_promocion");        
        
        $data_detalle['promocion'] = $this->generico_model->getCondicion(array("id" => $id_promocion),"promocion");        
        $data = $this->load->view("promociones/detalle",$data_detalle,true);
        
        echo $data;
    }
}