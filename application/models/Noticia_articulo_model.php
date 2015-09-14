<?php

Class Noticia_articulo_model extends CI_Model {

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
    
    //ACTUALIZAR TODOS
    public function editar_todos($data,$tabla) {               
        return $this->db->update($tabla,$data);
    } 
    
    //LISTADO
    public function categoria_listado($tabla) {            
        $this->db->where('publicar',1);
        $this->db->order_by('orden', 'asc');        
        $query = $this->db->get($tabla);                
        return $query->result_array();
    }
    
    //GET DESTACADO  
    public function destacado($tabla) {
        $this->db->where('destacado', 1);
        $query = $this->db->get($tabla);
        return $query->row_array();
    }
    
    //GET ARTICULO X URL   
    public function getArticuloxURL($url_articulo,$tabla) {
        $this->db->where('url', $url_articulo);
        $query = $this->db->get($tabla);
        return $query->row_array();
    }
    
    //PAGINACION
    public function paginacion($per_page, $offset,$tabla,$id_categoria) {
        $sdata = array();

        $this->db->select('*');
        $this->db->from($tabla);
        $this->db->where('id_categoria', $id_categoria); 
        $this->db->where('publicar', 1);    
        $this->db->order_by('fecha','DESC'); 
        $this->db->limit($per_page, $offset);
        $query_result = $this->db->get();       

        if ($query_result->num_rows() > 0) {
            $sdata = $query_result->result_array();
        }
        return $sdata;
    }

    public function paginacion_todos($tabla,$id_categoria) {

        $this->db->select('*');
        $this->db->from($tabla);
        $this->db->where('id_categoria', $id_categoria); 
        $this->db->where('publicar', 1);
  
        $query_result = $this->db->get();
        return $query_result->num_rows();
    }
    

    

    

    
}
