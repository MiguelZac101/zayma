<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Orden_library {

    protected $CI;

    public function __construct(){
        $this->CI =& get_instance();
    }
    
    //obtener el ultimo orden
    public function getOrdenxTabla($nombre_tabla) {      
                
        $query = $this->CI->db->get($nombre_tabla);
        if($query->num_rows()==0){//si no hay ningun registro el orden es 1
            return 1;
        }else{
            //orden asc, primer + 1
            $this->CI->db->select("orden");
            $this->CI->db->order_by('orden','desc');
            $this->CI->db->limit(1);
            $query = $this->CI->db->get($nombre_tabla);
            $ultima_fila =  $query->row_array();
            return $ultima_fila['orden']+1;
        }        
         
    }   
     
//subir un nivel el objeto
   public function orden_arriba_tabla($id,$tabla){
       $obj1 = $this->getxTabla($id,$tabla);
       
        if($obj1['orden']==1){
            //llego al principio
            return false;
//            echo "llego al principio";
        }else{
            //obtener el anterior
            $obj2 = $this->getAnteriorInmediato($obj1['orden'],$tabla);
            if($obj2){
                //significa que hay un anterior
                //averiguar si la diferencia de orden es 1
                if($obj1['orden']-1==$obj2['orden']){
                    //intercambiar orden                    
                    $this->intercambiar_orden($obj1,$obj2,$tabla);
                    return true;
//                    echo "intercambiar orden";
                }else{
                    //significa que hay un espacio entre ellos
                    //solo cambiar el orden a obj1
                    $this->cambiar_orden($obj1,$tabla,$obj1['orden']-1);
                    return true;
//                    echo "cambio de orden en 1";
                }
            }else{
                //significa que no hay ningun anterior
                //entonces solo reducirle el orden en 1
                $this->cambiar_orden($obj1,$tabla,$obj1['orden']-1);
                return true;
//                echo "cambio de orden en 1 xxxx";
            }
        }
        
       
   }
   
   //get objeto por id
   public function getxTabla($id,$nombre_tabla){
        $this->CI->db->where("id",$id);        
        $query = $this->CI->db->get($nombre_tabla);
        return $query->row_array();        
   }
   
   //objeto anterior inmediato
   public function getAnteriorInmediato($orden,$nombre_tabla){
        $this->CI->db->where("orden <",$orden);        
        $this->CI->db->order_by("orden",'desc');        
        $this->CI->db->limit(1);        
        $query = $this->CI->db->get($nombre_tabla);
        return $query->row_array();        
   }
   //intercambiar orden
   public function intercambiar_orden($obj1,$obj2,$nombre_tabla){
        $orden_a = $obj1['orden'];
        $orden_b = $obj2['orden'];
        //orden a        
        $this->cambiar_orden($obj1,$nombre_tabla,$orden_b);
        //orden b        
        $this->cambiar_orden($obj2,$nombre_tabla,$orden_a);
    }
    //cambiar orden , cantuidad es lo que se agrega
    public function cambiar_orden($obj1,$nombre_tabla,$nuevo_orden){                
        $this->CI->db->where('id', $obj1['id']);
        $this->CI->db->update($nombre_tabla, array('orden' => $nuevo_orden));        
    }

    //bajar un nivel el objeto
    public function orden_abajo_tabla($id,$tabla){
       $obj1 = $this->getxTabla($id,$tabla);
       
        if($this->esElMayorOrden($obj1,$tabla)){//verificar si tiene el mayor orden, ya no se puede ir mas abajo
            //llego al principio
            return false;
//            echo "llego al final".$this->CI->db->last_query();
        }else{
            //obtener el anterior
            $obj2 = $this->getSiguienteInmediato($obj1['orden'],$tabla);
            if($obj2){
                //significa que hay un anterior
                //averiguar si la diferencia de orden es 1
                if($obj1['orden']+1==$obj2['orden']){
                    //intercambiar orden                    
                    $this->intercambiar_orden($obj1,$obj2,$tabla);
                    return true;
//                    echo "intercambiar orden";
                }else{
                    //significa que hay un espacio entre ellos
                    //solo cambiar el orden a obj1
                    $this->cambiar_orden($obj1,$tabla,$obj1['orden']+1);
                    return true;
//                    echo "cambio de orden en 1";
                }
            }else{
                //significa que no hay ningun anterior
                //entonces solo reducirle el orden en 1
                $this->cambiar_orden($obj1,$tabla,$obj1['orden']+1);
                return true;
//                echo "cambio de orden en 1 xxxx";
            }
        }      
    }
    
    public function esElMayorOrden($obj1,$nombre_tabla){
        $this->CI->db->select("*");
        $this->CI->db->where("orden >",$obj1['orden']);    
        $this->CI->db->where("id !=",$obj1['id']); 
        
        $query = $this->CI->db->get($nombre_tabla);
        if($query->num_rows()==0){
            return true;
        }else{
            return false;
        }        
    }
    
    //objeto anterior inmediato
    public function getSiguienteInmediato($orden,$nombre_tabla){
        $this->CI->db->where("orden >",$orden);        
        $this->CI->db->order_by("orden",'asc');        
        $this->CI->db->limit(1);        
        $query = $this->CI->db->get($nombre_tabla);
        return $query->row_array();        
    }
    

}
