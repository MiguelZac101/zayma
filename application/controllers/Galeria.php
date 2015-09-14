<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Galeria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("noticia_articulo_model");
        $this->load->model("generico_model");
        $this->load->library("pagination");
//        echo "contructor de galeria";

    }

    public function index() {        
        
        $header = array();
        $data = array();
        
        $this->load->view("templates/header",$header);
        $this->load->view("galeria",$data);
        $this->load->view("templates/footer");
        
    }
    
    public function fotos_paginacion() {
//        echo "paginacion";
        //pagination		
        $page_number = $this->uri->segment(3);		
        $page_url = $config['base_url'] = base_url().'galeria/fotos_paginacion';
        $config['uri_segment'] = 3;		

        $config['per_page'] = 3;
        $config['num_links'] = 3;
        if(empty($page_number)) $page_number = 1;
        $offset = ($page_number-1) * $config['per_page'];

        $config['use_page_numbers'] = TRUE;		
        $data["registros"] = $this->generico_model->paginacion($config['per_page'],$offset,false,'galeria_fotos');
        
        $config['total_rows'] = $this->generico_model->paginacion_numero_registros(false,'galeria_fotos');		

        $page_url = $page_url.'/'.$page_number;

        $config['full_tag_open'] = '<ul class="pagination" id="pagination_fotos">';
        $config['full_tag_close'] = '</ul>';
//        $config['prev_link'] = '&lt;';
        $config['prev_link'] = FALSE;
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
//        $config['next_link'] = '&gt;';
        $config['next_link'] = FALSE;
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="'.$page_url.'">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';		

        $this->pagination->initialize($config);
        $data['page_links'] = $this->pagination->create_links();  

//        return $data;	
        $this->load->view('galeria/fotos_paginacion',$data);
    }
    
     public function videos_paginacion() {
//        echo "paginacion";
        //pagination		
        $page_number = $this->uri->segment(3);		
        $page_url = $config['base_url'] = base_url().'galeria/videos_paginacion';
        $config['uri_segment'] = 3;		

        $config['per_page'] = 3;
        $config['num_links'] = 3;
        if(empty($page_number)) $page_number = 1;
        $offset = ($page_number-1) * $config['per_page'];

        $config['use_page_numbers'] = TRUE;		
        $data["registros"] = $this->generico_model->paginacion($config['per_page'],$offset,false,'galeria_videos');
        
        $config['total_rows'] = $this->generico_model->paginacion_numero_registros(false,'galeria_videos');		

        $page_url = $page_url.'/'.$page_number;

        $config['full_tag_open'] = '<ul class="pagination" id="pagination_videos">';
        $config['full_tag_close'] = '</ul>';
//        $config['prev_link'] = '&lt;';
        $config['prev_link'] = FALSE;
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
//        $config['next_link'] = '&gt;';
        $config['next_link'] = FALSE;
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="'.$page_url.'">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';		

        $this->pagination->initialize($config);
        $data['page_links'] = $this->pagination->create_links();  

//        return $data;	
        $this->load->view('galeria/videos_paginacion',$data);
    }


}
