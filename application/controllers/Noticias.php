<?php

Class Noticias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("noticia_articulo_model");
        $this->load->model("noticia_categoria_model");
        
        $this->load->library('pagination');
//        $this->load->library("auth_library");
//        echo "constructor de noticias";
    }

    public function index() {
//        echo "noticias index";
//        $this->load->view("templates/header");
//        $this->load->view("home");
//        $this->load->view("templates/footer");
    }
    
    //mostrar pagina de los articulos de esta categoria
    public function categoria($url_categoria){
        
        $header['carrusel'] = getCarrusel("noticia_carrusel");
        $data['destacado'] = $this->noticia_articulo_model->destacado('noticia_articulo');        
        $categoria = $this->noticia_categoria_model->getCategoriaxURL($url_categoria,'noticia_categoria');
        $data['categoria'] = $categoria;
        /////////////////////////PAGINACION
        
        
        //pagination		
        $page_number = $this->uri->segment(3);		
        $page_url = $config['base_url'] = base_url().'noticias/'.$categoria['url'].'/';
        $config['uri_segment'] = 2;		

        $config['per_page'] = 2;
        $config['num_links'] = 3;
        if(empty($page_number)) $page_number = 1;
        $offset = ($page_number-1) * $config['per_page'];

        $config['use_page_numbers'] = TRUE;
        
        $data["articulos"] = $this->noticia_articulo_model->paginacion($config['per_page'],$offset,'noticia_categoria');    
        
        $config['total_rows'] = $this->noticia_articulo_model->paginacion_todos('noticia_categoria');		

        $page_url = $page_url.'/'.$page_number;

        $config['full_tag_open'] = '<ul class="pagination">';
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

//        $this->pagination->cur_page = $offset;

        $this->pagination->initialize($config);
        $data['page_links'] = $this->pagination->create_links();       


        /////////////////////////FIN PAGINACION
        
        $this->load->view("templates/header",$header);
        $this->load->view("noticia_categoria",$data);
        $this->load->view("templates/footer");
        
    }

}
