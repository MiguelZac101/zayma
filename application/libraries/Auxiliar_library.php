<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Auxiliar_library {

    protected $CI;
    
    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model("generico_model");
        
    }
    
    
    public function getArticulosConCategorias($articulos) {       
        foreach ($articulos as $key => $articulo) {
            $categoria = $this->CI->generico_model->get($articulo['id_categoria'],$articulo['nombre_tabla_categoria']);
//            echo $this->CI->db->last_query();
            $articulos[$key]['categoria'] = $categoria;
        }
        return $articulos;
    }   
    
    public function getArticulosConEditor($articulos) {       
        foreach ($articulos as $key => $articulo) {
            $editor = $this->CI->generico_model->get($articulo['id_editor'],'editor');
//            echo $this->CI->db->last_query();
            $articulos[$key]['editor'] = $editor;
        }
        return $articulos;
    } 
    
    //ARTICULOS X EDITOR , varias tablas
    public function getArticulosxEditorPrincipal(){
        
        $consulta = "
(SELECT * 
FROM noticia_articulo  as na
WHERE na.id_editor = 7 
)

UNION ALL
(
SELECT *
FROM logros_articulo as la
WHERE la.id_editor = 7
)
UNION ALL
(
SELECT *
FROM lideres_articulo as la
WHERE la.id_editor = 7
)
UNION ALL
(
SELECT *
FROM kausachun_articulo as ka
WHERE ka.id_editor = 7
)
    UNION ALL
(
SELECT *
FROM ideologia_articulo as ia
WHERE ia.id_editor = 7
)
UNION ALL
(
SELECT *
FROM documentos_articulo as da
WHERE da.id_editor = 7
    )
    ORDER BY fecha desc LIMIT 3;";
                     
        $query = $this->CI->db->query($consulta);                
        return $query->result_array();
    }
    
    public function getArticulosxColaborador(){
        $consulta = "(SELECT *
FROM noticia_articulo  as na
WHERE na.id_editor != 7 
)

UNION ALL
(
SELECT *
FROM logros_articulo as la
WHERE la.id_editor != 7
)
UNION ALL
(
SELECT *
FROM lideres_articulo as la
WHERE la.id_editor != 7
)
UNION ALL
(
SELECT *
FROM kausachun_articulo as ka
WHERE ka.id_editor != 7
)
    UNION ALL
(
SELECT *
FROM ideologia_articulo as ia
WHERE ia.id_editor != 7
)
UNION ALL
(
SELECT *
FROM documentos_articulo as da
WHERE da.id_editor != 7
    )
    ORDER BY fecha desc LIMIT 3;";
    
        $query = $this->CI->db->query($consulta);                
        return $query->result_array();
    }
    
    public function getArticulosxColaboradorxCategoria($tabla){
        $this->CI->db->where('publicar',1);
        $this->CI->db->limit(3);
        $this->CI->db->order_by('fecha', 'desc');        
        $query = $this->CI->db->get($tabla);        
        return $query->result_array();
    }

}
