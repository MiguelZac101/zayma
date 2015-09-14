<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Formdata extends CI_Controller {
    
    public function index(){
        $this->load->view("formdata/formulario");
    }
    
    function cargar_archivo() {  
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_error_delimiters('', '');
        
        $this->form_validation->set_rules('titulo', 'TITULO', 'required|min_length[5]|max_length[10]|trim');
        $this->form_validation->set_message('required', 'El campo no puede ir vacío!');
        $this->form_validation->set_message('min_length', 'El campo %s debe tener al menos 5 carácteres');
        $this->form_validation->set_message('max_length', 'El campo %s no puede tener más de 10  carácteres');
        
        $this->form_validation->set_rules('descripcion', 'DESCRIPCION', 'required|min_length[5]|max_length[10]|trim');
        
                 
        if ($this->form_validation->run() == FALSE) 
        {
            //SI NO PASA LA VALIDACION
            $errors = array(
                'titulo' =>  form_error('titulo'),
                'descripcion' => form_error('descripcion')
            );

            echo json_encode($errors);
            exit();
           
        }
        else
        {
            //cojer los datos y procesarlos
                    //IMAGEN 01
            $config['upload_path'] = "uploads/";
            $config['file_name'] = "imagen01";
            $config['allowed_types'] = "*";  
//            $config['max_size'] = '100';
//            $config['max_width'] = '1024';
//            $config['max_height'] = '768';
    
            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload("imagen01")) {
                //*** ocurrio un error
//                $data['uploadError'] = $this->upload->display_errors();          
                
                $errors = array(
                    'imagen01' =>  $this->upload->display_errors('','')
                );
                echo json_encode($errors);
                exit();                
             
            
            }else{
//                $data['uploadSuccess'] = $this->upload->data();
    //            echo "la imagen01 se subio.";
            }
            
            //IMAGEN 02
            $config['upload_path'] = "uploads/";
            $config['file_name'] = "XXXX";
            $config['allowed_types'] = "*"; 
            
            if (!$this->upload->do_upload("imagen02")) {
                //*** ocurrio un error
                $errors = array(
                    'imagen02' =>  $this->upload->display_errors('','')
                );
                //echo json_encode($errors);   
                exit();
            }else{
//                $data['uploadSuccess'] = $this->upload->data();
    //            echo "la imagen02 se subio.";
            }

        }        
        


    }
    
    public function imprimir($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";       
        
    }
}