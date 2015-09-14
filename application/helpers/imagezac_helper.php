<?php
if ( ! function_exists('imagen_crear_miniatura'))
{    
    function imagen_crear_miniatura($image_original_path, $image_thumbnail_path, $width, $height){
        $CI =& get_instance();
        // LOAD LIBRARY
        $CI->load->library('image_lib');

        // CONFIGURE IMAGE LIBRARY
        $config['image_library']    = 'gd2';
        $config['source_image']     = $image_original_path;
        $config['new_image']        = $image_thumbnail_path;
        $config['maintain_ratio']   = TRUE;
        $config['height']           = $height;
        $config['width']            = $width;
        $CI->image_lib->initialize($config);
        $CI->image_lib->resize();
        $CI->image_lib->clear();
    }
}

 
