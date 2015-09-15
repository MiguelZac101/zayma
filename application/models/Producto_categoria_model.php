<?php

Class Producto_categoria_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        //
    }

    //NUEVO
    public function nuevo($data,$tabla) {
        return $this->db->insert($tabla, $data);
    }    
    //GET
    public function get($id,$tabla) {
        $this->db->where('id', $id);
        $query = $this->db->get($tabla);
        return $query->row_array();
    }    
    //ELIMINAR
    public function eliminar($id,$tabla) {
        $this->db->where('id', $id);
        return $this->db->delete($tabla);
    }
    //ACTUALIZAR
    public function editar($id,$data,$tabla) {
        $this->db->where('id', $id);        
        return $this->db->update($tabla,$data);
    }
    
    //NUMERO DE REGISTROS
    public function numero_registros($tabla) {                    
        $query = $this->db->get($tabla);                
        return $query->num_rows();
    }
    
    //GET CATEGORIA X URL   
    public function getCategoriaxURL($url_categoria,$tabla) {
        $this->db->where('url', $url_categoria);
        $query = $this->db->get($tabla);
        return $query->row_array();
    } 

    

    
}