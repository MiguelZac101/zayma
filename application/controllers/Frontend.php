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
                case "galeria"  : $this->galeria(); break;
                default : echo "otro caso"; break;
            }
        }
        else if($uri1 && $uri2){
            echo "2";
        } 
        else if($uri1 && $uri2 && $uri3){
            echo "3";
        }        
        else{
            echo "ERROR 404!<br/>";
        }
        

    }
    
    public function home(){
        $data_home = array(
            "seccion_servicios" => $this->home_servicios()
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
    
    public function galeria(){
        echo "GALERIA";
    }

}
