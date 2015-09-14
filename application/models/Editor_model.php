<?php

Class Editor_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        //
    }

    //NUEVO
    public function nuevo($data) {
        return $this->db->insert('editor', $data);
    }    
    //GET
    public function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('editor');
        return $query->row_array();
    }    
    //ELIMINAR
    public function eliminar($id) {
        $this->db->where('id', $id);
        return $this->db->delete('editor');
    }
    //ACTUALIZAR
    public function editar($id,$data) {
        $this->db->where('id', $id);        
        return $this->db->update('editor',$data);
    }
    //LISTADO
    public function listado() {            
        $query = $this->db->get("editor");
        //orders
        $this->db->order_by('id', 'asc');        
        return $query->result_array();
    }

//////////////////////////////////////////////////////////////////////////////////////////    

    
    public function get_blog_list_limit($limit) {            
        
//        $this->db->where('estado', '1');
        $this->db->order_by('id_blog', 'desc');
        $this->db->limit($limit);        
        
        $query = $this->db->get("blog");
        return $query->result_array();
    }
    


    

    

    
}