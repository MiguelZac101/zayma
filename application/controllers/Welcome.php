<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function upload_multiple_files()
    {
        $this->load->helper('form');
        $data['title'] = 'Multiple file upload';

        if ($this->input->post()) {
            $config = array(
                'file_name' => "prueba",
                'upload_path' => './temp/',
                'allowed_types' => 'gif|jpg|png',
//                'max_size' => '2048',
                'max_width' => 100,
                'max_height' => 100,
                'min_width' => 100,
                'min_height' => 100,
                'multi' => 'all'//sube los correctos
            );

            // load Upload library
            $this->load->library('upload', $config);

            $this->upload->do_upload('uploadedimages');

            echo '<pre>';
            $uploaded = $this->upload->data();
            print_r($uploaded);
            echo '</pre>';
            foreach ($uploaded as $key => $value) {
                echo $value['file_name'];
            }
            
            echo '<hr />';
            $errors = $this->upload->display_errors();
            echo '<pre>';
            print_r($errors);
            echo '</pre>';
            
            if($errors == ""){
                echo "es vacio";
            }else{
                echo "no es vacio";
            }
            exit();
        }
        $this->load->view('upload_form', $data);
    }
}