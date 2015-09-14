<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Auth_library {

    protected $CI;

    //creamos una instancia del super objeto de codeigniter
    //en el constructor para poder tenerlo disponible las veces
    //que necesitemos sin repetir la misma línea
    public function __construct(){
        $this->CI =& get_instance();
    }
    
    //función para loguear a los usuarios
    public function login_user($email, $password) {
        $this->CI->db->where('email', $email);
        $query = $this->CI->db->get('usuario');

        //si el nombre de usuario coincide y sólo existe uno procedemos
        if ($query->num_rows() == 1) {         
            $this->CI->db->where(array('email' => $email, 'password' => $password));
            $this->CI->db->limit(1);            
            $query = $this->CI->db->get("usuario");
            
            if ($query->num_rows() == 0) {
                return FALSE;
            } else {                
                //usuario logeado   
                $usuario = $query->row_array();
                $this->CI->session->set_userdata("login",TRUE);
                $this->CI->session->set_userdata("admin_nombre",$usuario['nombre']);
                return TRUE;   
            }            
        }else{
            return FALSE;
        }
    }
    
    //función para comprobar si el usuario está logueado
    public function is_logged(){
        return $this->CI->session->userdata('login');
    }
    
    //función para cerrar sesión
    public function logout(){
        $this->CI->session->unset_userdata('login');  
        
        $this->CI->session->sess_destroy();
        redirect('auth/');
    }

}
