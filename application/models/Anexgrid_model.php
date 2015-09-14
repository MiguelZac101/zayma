<?php

Class Anexgrid_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        //
    }
    
    //anexgrid
    //array asociativo
    public  function query_registros($consulta){        
        $query = $this->db->query($consulta);        
        return $query->result_array();
    }
    //objeto
    public  function query_total($consulta){
        $query = $this->db->query($consulta);
        $data = $query->row_array(); 
        return $data['Total'];
    }  

    
}