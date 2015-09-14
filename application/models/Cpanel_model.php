<?php
Class Cpanel_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        
    }

    //acceso
    public function getAccess($data) {
        
        $this->db->where('usuario', $data['usuario']);
        $this->db->where('contrasena', $data['clave']);
        $this->db->limit(1);
        $query = $this->db->get('usuario');
        
        return $query->row_array();
        
    }

}
