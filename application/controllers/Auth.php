<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("auth_library");
    }

    public function index() {
        $this->load->view('auth/login');        
    }
    
    //función para loguear a los usuarios
    public function login_user() {
        $email = $this->input->post("email");
        $password = md5($this->input->post("password"));
        
        $result = $this->auth_library->login_user($email,$password);
        $mensaje = "";
        
        if($result){
            $mensaje .= '<div class="alert alert-success" role="alert">';
            $mensaje .= '<button class="close" aria-label="Close" data-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>';
            $mensaje .= '<i class="fa fa-check-circle fa-fw"></i>';
            $mensaje .= 'Inicio de sesión correcto. Redireccionando...';
            $mensaje .= '</div>';
        }else{
            $mensaje .= '<div class="alert alert-danger" role="alert">';
            $mensaje .= '<button class="close" aria-label="Close" data-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>';
            $mensaje .= '<i class="fa fa-exclamation-circle fa-fw"></i>';
            $mensaje .= 'El inicio de sesión no es válido.';
            $mensaje .= '</div>';
        }        
   
        $data = array(
            "mensaje" => $mensaje,
            "result" => ($result)?1:0
        );
        
        echo json_encode($data) ;//1 o 0
        
    }
    
    public function logout(){
        $this->auth_library->logout();        
    }
}
