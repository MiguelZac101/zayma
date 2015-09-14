<?php

Class Articulos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("noticia_articulo_model");
        $this->load->model("noticia_categoria_model");
        
        $this->load->model("generico_model");
        
        $this->load->library('pagination');
        $this->load->library("auxiliar_library");
//        echo "constructor de noticias";
    }

    public function index() {
//        echo "noticias index";
//        $this->load->view("templates/header");
//        $this->load->view("home");
//        $this->load->view("templates/footer");
    }
    
    //mostrar pagina de los articulos de esta categoria
    public function paginado($blog_url,$categoria_url){
        
        switch($blog_url){
            case "ideologia":
                $config = array(
                    "tabla_carrusel" => "ideologia_carrusel",
                    "tabla_articulo" => "ideologia_articulo",
                    "tabla_categoria" => "ideologia_categoria",
                    "blog_url" => $blog_url,
                    "categoria_url" => $categoria_url

                );
            break;
            case "logros":
                $config = array(
                    "tabla_carrusel" => "logros_carrusel",
                    "tabla_articulo" => "logros_articulo",
                    "tabla_categoria" => "logros_categoria",
                    "blog_url" => $blog_url,
                    "categoria_url" => $categoria_url

                );
            break;
            case "documentos":
                $config = array(
                    "tabla_carrusel" => "documentos_carrusel",
                    "tabla_articulo" => "documentos_articulo",
                    "tabla_categoria" => "documentos_categoria",
                    "blog_url" => $blog_url,
                    "categoria_url" => $categoria_url

                );
            break;
            case "kausachun-peru":
                $config = array(
                    "tabla_carrusel" => "kausachun_carrusel",
                    "tabla_articulo" => "kausachun_articulo",
                    "tabla_categoria" => "kausachun_categoria",
                    "blog_url" => $blog_url,
                    "categoria_url" => $categoria_url

                );
            break;
            case "noticias":
                $config = array(
                    "tabla_carrusel" => "noticia_carrusel",
                    "tabla_articulo" => "noticia_articulo",
                    "tabla_categoria" => "noticia_categoria",
                    "blog_url" => $blog_url,
                    "categoria_url" => $categoria_url

                );
            break;
            case "grandes-lideres":
                $config = array(
                    "tabla_carrusel" => "lideres_carrusel",
                    "tabla_articulo" => "lideres_articulo",
                    "tabla_categoria" => "lideres_categoria",
                    "blog_url" => $blog_url,
                    "categoria_url" => $categoria_url

                );
            break;
            default :
            break;
        }
        
        
        $this->paginacion_master($config);
        
        
    }
    
    public function paginacion_master($config){
        
        $header['carrusel'] = getCarrusel($config['tabla_carrusel']);
        $data['destacado'] = $this->noticia_articulo_model->destacado($config['tabla_articulo']);        
        $categoria = $this->noticia_categoria_model->getCategoriaxURL($config['categoria_url'],$config['tabla_categoria']);
        $data['categoria'] = $categoria;
        
        $data["blog_url"] = $config['blog_url'];
        $data["categoria_url"] = $config['categoria_url'];
        /////////////////////////PAGINACION 
        
        //pagination
        $page_number =  $this->uri->segment(4);
//        $page_number = $indice_pagina;
        		
        $page_url = $config['base_url'] = base_url().$config['blog_url'].'/'.$categoria['url'];
        $config['uri_segment'] = 4;		

        $config['per_page'] = 10;
        $config['num_links'] = 3;
        if(empty($page_number)) $page_number = 1;
        $offset = ($page_number-1) * $config['per_page'];

        $config['use_page_numbers'] = TRUE;
        
        $data["articulos"] = $this->noticia_articulo_model->paginacion($config['per_page'],$offset,$config['tabla_articulo'],$categoria['id']);        
        $config['total_rows'] = $this->noticia_articulo_model->paginacion_todos($config['tabla_articulo'],$categoria['id']);		

        
        
        $config['first_url'] = $page_url.'/pagina/1';
        $config['prefix'] = '/pagina/';
        $config['use_page_numbers'] = TRUE;
        $page_url = $page_url.'/pagina/'.$page_number;
        
        
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '&lt;';
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
//
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';		


        $this->pagination->initialize($config);
        $data['page_links'] = $this->pagination->create_links();       


        /////////////////////////FIN PAGINACION
        
        //opinion del editor
        $editor = $this->generico_model->get(7,'editor');
        ///opinoon del editor
        $articulos = $this->auxiliar_library->getArticulosxEditorPrincipal();
        $articulos = $this->auxiliar_library->getArticulosConCategorias($articulos);
                
        $data_oe = array(
            "articulos" => $articulos,
            "editor" => $editor
        );
        
        //opinion del editor
        $data['opinion_editor'] = $this->load->view("opinion_editor",$data_oe,true);
        
        //OPINION COLABORADOR
        //opinion x blog
        $articulos_colaborador = $this->auxiliar_library->getArticulosxColaboradorxCategoria($config['tabla_articulo']);
//        echo "<pre>";
//        print_r($articulos_colaborador);
//        echo "</pre>";
//        echo "opinion colaborador : ".$this->db->last_query();
        
        $articulos_colaborador = $this->auxiliar_library->getArticulosConCategorias($articulos_colaborador);
        $articulos_colaborador = $this->auxiliar_library->getArticulosConEditor($articulos_colaborador);
        $data['opinion_colaborador'] = $this->load->view('opinion_colaboradores',array('articulos'=>$articulos_colaborador),true); 
        
        $this->load->view("templates/header",$header);
        $this->load->view("noticia_categoria",$data);
        $this->load->view("templates/footer");
    }
    
    //noticias / noticias / nadine
    public function detalle($blog_url,$categoria_url,$articulo_url){
        
        switch($blog_url){
            case "ideologia":
                $config = array(                
                    "tabla_articulo" => "ideologia_articulo",
                    "tabla_categoria" => "ideologia_categoria",
                    "blog_url" => $blog_url,
                    "categoria_url" => $categoria_url,
                    "articulo_url" => $articulo_url
                );
            break;
            case "logros":
                $config = array(                  
                    "tabla_articulo" => "logros_articulo",
                    "tabla_categoria" => "logros_categoria",
                    "blog_url" => $blog_url,
                    "categoria_url" => $categoria_url,
                    "articulo_url" => $articulo_url
                );
            break;
            case "documentos":
                $config = array(                    
                    "tabla_articulo" => "documentos_articulo",
                    "tabla_categoria" => "documentos_categoria",
                    "blog_url" => $blog_url,
                    "categoria_url" => $categoria_url,
                    "articulo_url" => $articulo_url
                );
            break;
            case "kausachun-peru":
                $config = array(                   
                    "tabla_articulo" => "kausachun_articulo",
                    "tabla_categoria" => "kausachun_categoria",
                    "blog_url" => $blog_url,
                    "categoria_url" => $categoria_url,
                    "articulo_url" => $articulo_url
                );
            break;
            case "noticias":
                $config = array(                    
                    "tabla_articulo" => "noticia_articulo",
                    "tabla_categoria" => "noticia_categoria",
                    "blog_url" => $blog_url,
                    "categoria_url" => $categoria_url,
                    "articulo_url" => $articulo_url
                );
            break;
            case "grandes-lideres":
                $config = array(                  
                    "tabla_articulo" => "lideres_articulo",
                    "tabla_categoria" => "lideres_categoria",
                    "blog_url" => $blog_url,
                    "categoria_url" => $categoria_url,
                    "articulo_url" => $articulo_url
                );
            break;
            default :
            break;
        }
        
        $this->detalle_master($config);
        
    }
    
    public function detalle_master($config){
        $header = array();
        $data = array();
        
        $articulo = $data['articulo'] = $this->noticia_articulo_model->getArticuloxURL($config['articulo_url'],$config['tabla_articulo']);
        
        if(!$articulo){
            show_404();
        }
        
        $data['url_articulo'] = $url_articulo =  $config['blog_url']."/".$config['categoria_url']."/".$articulo['url'];
        $data_meta = array(
            "titulo" => $articulo['titulo'],
            "descripcion" => $articulo['descripcion'],
            "url" => $url_articulo,
            "imagen" => $articulo['imagen_thumbnail']
        );
        
        $header['meta'] = $this->load->view("templates/meta",$data_meta,true);
        $header['titulo_pagina'] = $articulo['titulo'];
        
        //opinion del editor
        $editor = $this->generico_model->get(7,'editor');
        ///opinoon del editor
        $articulos = $this->auxiliar_library->getArticulosxEditorPrincipal();
        $articulos = $this->auxiliar_library->getArticulosConCategorias($articulos);
                
        $data_oe = array(
            "articulos" => $articulos,
            "editor" => $editor
        );
        
        //opinion del editor
        $data['opinion_editor'] = $this->load->view("opinion_editor",$data_oe,true);
        
        //OPINION COLABORADOR
//        $articulos_colaborador = $this->auxiliar_library->getArticulosxColaborador();
//        $articulos_colaborador = $this->auxiliar_library->getArticulosConCategorias($articulos);
//        $articulos_colaborador = $this->auxiliar_library->getArticulosConEditor($articulos);
//        $data['opinion_colaborador'] = $this->load->view('opinion_colaboradores',array('articulos'=>$articulos_colaborador),true);
        //OPINION COLABORADOR
        //opinion x blog
        $articulos_colaborador = $this->auxiliar_library->getArticulosxColaboradorxCategoria($config['tabla_articulo']);        
        $articulos_colaborador = $this->auxiliar_library->getArticulosConCategorias($articulos_colaborador);
        $articulos_colaborador = $this->auxiliar_library->getArticulosConEditor($articulos_colaborador);
        $data['opinion_colaborador'] = $this->load->view('opinion_colaboradores',array('articulos'=>$articulos_colaborador),true); 
        
        $this->load->view("templates/header",$header);
        $this->load->view("articulo",$data);
        $this->load->view("templates/footer");
    }
}
