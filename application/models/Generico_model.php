<?php

Class Generico_Model extends CI_Model {

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
    //GET x condicion
    public function getCondicion($condicion,$tabla) {        
        
        if(is_array($condicion) && count($condicion)>0){
            foreach ($condicion as $key => $value) {
                $this->db->where($key, $value);
            }
            $query = $this->db->get($tabla);
            return $query->row_array();
        }else{
            return false;
        } 
        
        
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
    public function listado($tabla) {            
        $query = $this->db->get($tabla);
        //orders
        $this->db->order_by('id', 'asc');        
        return $query->result_array();
    }  
    //LISTADO CONDICIONAL
    public function listadoCondicion($condicion,$tabla) {            
        foreach ($condicion as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get($tabla);
        //orders
        $this->db->order_by('id', 'asc');        
        return $query->result_array();
    }  

    
    //PAGINACION GENERICA
    public function paginacion($per_page, $offset, $condicion, $tabla) {
        $data = array();

        $this->db->select('*');
        $this->db->from($tabla);       
        
        if(is_array($condicion) && count($condicion)>0){
            foreach ($condicion as $key => $value) {
                $this->db->where($key, $value);
            }
        }        
        
        $this->db->limit($per_page, $offset);
        $query_result = $this->db->get();
        //echo $this->db->last_query(); // shows last executed query

        if ($query_result->num_rows() > 0) {
            $data = $query_result->result_array();
        }
        return $data;
    }
    
    //NUMERO DE ITEMS TOTALES
    public function paginacion_numero_registros($condicion , $tabla) {

        $this->db->select('*');
        $this->db->from($tabla);       
        
        if(is_array($condicion) && count($condicion)>0){
            foreach ($condicion as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        
        $query_result = $this->db->get();
        return $query_result->num_rows();
    }
    

    
}