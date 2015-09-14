<div id="wrapper">
    <section>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12">
                                SERVICIOS
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">                            
                            <div class="col-xs-4">     
                                <div class="panel panel-primary">                                    
                                    <div class="panel-body">
                                        <form name="form_serv_1" role="form" enctype="multipart/form-data"> 
                                            <input type="hidden" value="<?php echo $serv1['id'];?>" name="id">
                                            <input type="hidden" value="500" name="ancho">
                                            <input type="hidden" value="460" name="alto"> 
                                            
                                            <div class="form-group">
                                                <label>Imagen</label>
                                                <input id="imagen" type="file" name="imagen" accept="image/*" data-show-upload="false" data-show-caption="false">
                                               <p class="text-info" style="font-size: 11px;">Medidas de la imagen 500 pixeles de ancho x 460 pixeles de alto.</p>                                                
                                                <script>
                                                    $('#imagen').fileinput({
                                                        initialPreview: [
                                                            '<img src="<?php echo base_url($serv1['imagen']); ?>" class="file-preview-image" alt="imagen de servicio" >'
                                                        ]
                                                    });
                                                </script>
                                            </div>

                                            <hr>    

                                            <div class="form-group text-right">                                       
                                                <!--<input type="reset" value="CANCELAR" name="CANCELAR" class="btn btn-default btn-sm">-->                                  
                                                <input type="submit" value="GUARDAR" name="GUARDAR" class="btn btn-success btn-sm">
                                            </div>          

                                        </form>
                                        <script>
$(document).ready(function (){

    $('form[name=form_serv_1]').validate({   
        rules:{
            imagen: {
                required: true,
                accept: "image/*"
            }         
        },
        messages:{
           imagen: {
                required: "Imagen requerido",
                accept: "Solo se aceptan imagenes"
            }
        },
        submitHandler: function(form) {
            var url = '<?php echo base_url();?>admin/home/actualizar';
            var data = new FormData(form);
            $("#preloader").show();
            $.ajax({
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                dataType : 'json',
                success: function(data){       
                    
                    //registro
                    if(data.actualizar==1){
                       alert("Se registro correctamente.");
                       $(location).attr('href', base_url+"admin/home/listado");
//                       redirect("admin/noticia_categoria/listado");
                    }else{
                       $("#preloader").hide();
                       //error de imagen
                        if(data.upload_imagen!=''){
                            alert(data.upload_imagen);
                        }else{
                            alert("Sucedio un error no se pudo registrar.");
                        }     
                       
                   }
                    
                }
            });
        }
    });
    

        

});
</script>
                                    </div>
                               </div>                        
                                
                            </div>
                            
                            <div class="col-xs-4">
                                
                                
                                <div class="panel panel-primary">
                                    
                                    <div class="panel-body">
                                        <form name="form_serv_2" role="form" enctype="multipart/form-data"> 
                                            <input type="hidden" value="<?php echo $serv2['id'];?>" name="id">
                                            <input type="hidden" value="500" name="ancho">
                                            <input type="hidden" value="460" name="alto">
                                            
                                            <div class="form-group">
                                                <label>Imagen</label>
                                                <input id="imagen2" type="file" name="imagen" accept="image/*" data-show-upload="false" data-show-caption="false">
                                               <p class="text-info" style="font-size: 11px;">Medidas de la imagen 500 pixeles de ancho x 460 pixeles de alto.</p>                                                
                                                <script>
                                                    $('#imagen2').fileinput({
                                                        initialPreview: [
                                                            '<img src="<?php echo base_url($serv2['imagen']); ?>" class="file-preview-image" alt="imagen de servicio" >'
                                                        ]
                                                    });
                                                </script>
                                            </div>

                                            <hr>    

                                            <div class="form-group text-right">                                       
                                                <!--<input type="reset" value="CANCELAR" name="CANCELAR" class="btn btn-default btn-sm">-->                                  
                                                <input type="submit" value="GUARDAR" name="GUARDAR" class="btn btn-success btn-sm">
                                            </div>          

                                        </form>
                                        <script>
$(document).ready(function (){

    $('form[name=form_serv_2]').validate({   
        rules:{
            imagen: {
                required: true,
                accept: "image/*"
            }         
        },
        messages:{
           imagen: {
                required: "Imagen requerido",
                accept: "Solo se aceptan imagenes"
            }
        },
        submitHandler: function(form) {
            var url = '<?php echo base_url();?>admin/home/actualizar';
            var data = new FormData(form);
            $("#preloader").show();
            $.ajax({
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                dataType : 'json',
                success: function(data){       
                    
                    //registro
                    if(data.actualizar==1){
                       alert("Se registro correctamente.");
                       $(location).attr('href', base_url+"admin/home/listado");
//                       redirect("admin/noticia_categoria/listado");
                    }else{
                       $("#preloader").hide();
                       //error de imagen
                        if(data.upload_imagen!=''){
                            alert(data.upload_imagen);
                        }else{
                            alert("Sucedio un error no se pudo registrar.");
                        }     
                       
                   }
                    
                }
            });
        }
    });
    

        

});
</script>
                                    </div>
                               </div>                        
                                
                            </div>
                            
                            <div class="col-xs-4">
                                
                                
                                <div class="panel panel-primary">
                                    
                                    <div class="panel-body">
                                        <form name="form_serv_3" role="form" enctype="multipart/form-data"> 
                                            <input type="hidden" value="<?php echo $serv3['id'];?>" name="id">
                                            <input type="hidden" value="500" name="ancho">
                                            <input type="hidden" value="460" name="alto">                               
                                         
                                            <div class="form-group">
                                                <label>Imagen</label>
                                                <input id="imagen3" type="file" name="imagen" accept="image/*" data-show-upload="false" data-show-caption="false">
                                               <p class="text-info" style="font-size: 11px;">Medidas de la imagen 500 pixeles de ancho x 460 pixeles de alto.</p>                                                
                                                <script>
                                                    $('#imagen3').fileinput({
                                                        initialPreview: [
                                                            '<img src="<?php echo base_url($serv3['imagen']); ?>" class="file-preview-image" alt="imagen de servicio" >'
                                                        ]
                                                    });
                                                </script>
                                            </div>

                                            <hr>    

                                            <div class="form-group text-right">                                       
                                                <!--<input type="reset" value="CANCELAR" name="CANCELAR" class="btn btn-default btn-sm">-->                                  
                                                <input type="submit" value="GUARDAR" name="GUARDAR" class="btn btn-success btn-sm">
                                            </div>          

                                        </form>
                                        <script>
$(document).ready(function (){

    $('form[name=form_serv_3]').validate({   
        rules:{
            imagen: {
                required: true,
                accept: "image/*"
            }         
        },
        messages:{
           imagen: {
                required: "Imagen requerido",
                accept: "Solo se aceptan imagenes"
            }
        },
        submitHandler: function(form) {
            var url = '<?php echo base_url();?>admin/home/actualizar';
            var data = new FormData(form);
            $("#preloader").show();
            $.ajax({
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                dataType : 'json',
                success: function(data){       
                    
                    //registro
                    if(data.actualizar==1){
                       alert("Se registro correctamente.");
                       $(location).attr('href', base_url+"admin/home/listado");
//                       redirect("admin/noticia_categoria/listado");
                    }else{
                       $("#preloader").hide();
                       //error de imagen
                        if(data.upload_imagen!=''){
                            alert(data.upload_imagen);
                        }else{
                            alert("Sucedio un error no se pudo registrar.");
                        }     
                       
                   }
                    
                }
            });
        }
    });
    

        

});
</script>
                                    </div>
                               </div>                        
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
   
            
            
            <div class="col-xs-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">                      

                            <div class="col-xs-12">
                                PORTAFOLIO
                            </div>
                           
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">                            
                            <div class="col-xs-4">
                                
                                
                                <div class="panel panel-info">                                    
                                    <div class="panel-body">
                                        <form name="form_port_1" role="form" enctype="multipart/form-data"> 
                                            <input type="hidden" value="<?php echo$port1['id'];?>" name="id">
                                            <input type="hidden" value="360" name="ancho">
                                            <input type="hidden" value="250" name="alto">                                                                                  

                                            <div class="form-group">
                                                <label>Imagen</label>
                                                <input id="imagen_hu1" type="file" name="imagen" accept="image/*" data-show-upload="false" data-show-caption="false">
                                               <p class="text-info" style="font-size: 11px;">Medidas de la imagen 360 pixeles de ancho x 250 pixeles de alto.</p>                                                
                                                <script>
                                                    $('#imagen_hu1').fileinput({
                                                        initialPreview: [
                                                            '<img src="<?php echo base_url($port1['imagen']); ?>" class="file-preview-image" alt="imagen">'
                                                        ]
                                                    });
                                                </script>
                                            </div>

                                            <hr>    

                                            <div class="form-group text-right">                                       
                                                <!--<input type="reset" value="CANCELAR" name="CANCELAR" class="btn btn-default btn-sm">-->                                  
                                                <input type="submit" value="GUARDAR" name="GUARDAR" class="btn btn-success btn-sm">
                                            </div>          

                                        </form>
                                        <script>
$(document).ready(function (){

    $('form[name=form_port_1]').validate({   
        rules:{
            imagen: {
                required: true,
                accept: "image/*"
            }         
        },
        messages:{
           imagen: {
                required: "Imagen requerido",
                accept: "Solo se aceptan imagenes"
            }
        },
        submitHandler: function(form) {
            var url = '<?php echo base_url();?>admin/home/actualizar';
            var data = new FormData(form);
            $("#preloader").show();
            $.ajax({
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                dataType : 'json',
                success: function(data){       
                    
                    //registro
                    if(data.actualizar==1){
                       alert("Se registro correctamente.");
                       $(location).attr('href', base_url+"admin/home/listado");
//                       redirect("admin/noticia_categoria/listado");
                    }else{
                       $("#preloader").hide();
                       //error de imagen
                        if(data.upload_imagen!=''){
                            alert(data.upload_imagen);
                        }else{
                            alert("Sucedio un error no se pudo registrar.");
                        }     
                       
                   }
                    
                }
            });
        }
    });
    

        

});
</script>
                                    </div>
                               </div>                        
                                
                            </div>
                            
                            <div class="col-xs-4">
                                
                                
                                <div class="panel panel-info">
                                    
                                    <div class="panel-body">
                                        <form name="form_port_2" role="form" enctype="multipart/form-data"> 
                                            <input type="hidden" value="<?php echo $port2['id'];?>" name="id">
                                            <input type="hidden" value="360" name="ancho">
                                            <input type="hidden" value="250" name="alto">
                                            
                                            <div class="form-group">
                                                <label>Imagen</label>
                                                <input id="imagen_hu2" type="file" name="imagen" accept="image/*" data-show-upload="false" data-show-caption="false">
                                               <p class="text-info" style="font-size: 11px;">Medidas de la imagen 360 pixeles de ancho x 250 pixeles de alto.</p>                                                
                                                <script>
                                                    $('#imagen_hu2').fileinput({
                                                        initialPreview: [
                                                            '<img src="<?php echo base_url($port2['imagen']); ?>" class="file-preview-image" alt="imagen" >'
                                                        ]
                                                    });
                                                </script>
                                            </div>

                                            <hr>    

                                            <div class="form-group text-right">                                       
                                                <!--<input type="reset" value="CANCELAR" name="CANCELAR" class="btn btn-default btn-sm">-->                                  
                                                <input type="submit" value="GUARDAR" name="GUARDAR" class="btn btn-success btn-sm">
                                            </div>          

                                        </form>
                                        <script>
$(document).ready(function (){

    $('form[name=form_port_2]').validate({   
        rules:{
            imagen: {
                required: true,
                accept: "image/*"
            }         
        },
        messages:{
           imagen: {
                required: "Imagen requerido",
                accept: "Solo se aceptan imagenes"
            }
        },
        submitHandler: function(form) {
            var url = '<?php echo base_url();?>admin/home/actualizar';
            var data = new FormData(form);
            $("#preloader").show();
            $.ajax({
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                dataType : 'json',
                success: function(data){       
                    
                    //registro
                    if(data.actualizar==1){
                       alert("Se registro correctamente.");
                       $(location).attr('href', base_url+"admin/home/listado");
//                       redirect("admin/noticia_categoria/listado");
                    }else{
                       $("#preloader").hide();
                       //error de imagen
                        if(data.upload_imagen!=''){
                            alert(data.upload_imagen);
                        }else{
                            alert("Sucedio un error no se pudo registrar.");
                        }     
                       
                   }
                    
                }
            });
        }
    });
    

        

});
</script>
                                    </div>
                               </div>                        
                                
                            </div>
                            
                            <div class="col-xs-4">
                                
                                
                                <div class="panel panel-info">
                                    
                                    <div class="panel-body">
                                        <form name="form_port_3" role="form" enctype="multipart/form-data"> 
                                            <input type="hidden" value="<?php echo $port3['id'];?>" name="id">
                                            <input type="hidden" value="360" name="ancho">
                                            <input type="hidden" value="250" name="alto">
                                            
                                            <div class="form-group">
                                                <label>Imagen</label>
                                                <input id="imagen_hu3" type="file" name="imagen" accept="image/*" data-show-upload="false" data-show-caption="false">
                                               <p class="text-info" style="font-size: 11px;">Medidas de la imagen 360 pixeles de ancho x 250 pixeles de alto.</p>                                                
                                                <script>
                                                    $('#imagen_hu3').fileinput({
                                                        initialPreview: [
                                                            '<img src="<?php echo base_url($port3['imagen']); ?>" class="file-preview-image" alt="imagen" >'
                                                        ]
                                                    });
                                                </script>
                                            </div>

                                            <hr>    

                                            <div class="form-group text-right">                                       
                                                <!--<input type="reset" value="CANCELAR" name="CANCELAR" class="btn btn-default btn-sm">-->                                  
                                                <input type="submit" value="GUARDAR" name="GUARDAR" class="btn btn-success btn-sm">
                                            </div>          

                                        </form>
                                        <script>
$(document).ready(function (){

    $('form[name=form_port_3]').validate({   
       rules:{
            imagen: {
                required: true,
                accept: "image/*"
            }         
        },
        messages:{
           imagen: {
                required: "Imagen requerido",
                accept: "Solo se aceptan imagenes"
            }
        },
        submitHandler: function(form) {
            var url = '<?php echo base_url();?>admin/home/actualizar';
            var data = new FormData(form);
            $("#preloader").show();
            $.ajax({
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                dataType : 'json',
                success: function(data){       
                    
                    //registro
                    if(data.actualizar==1){
                       alert("Se registro correctamente.");
                       $(location).attr('href', base_url+"admin/home/listado");
//                       redirect("admin/noticia_categoria/listado");
                    }else{
                       $("#preloader").hide();
                       //error de imagen
                        if(data.upload_imagen!=''){
                            alert(data.upload_imagen);
                        }else{
                            alert("Sucedio un error no se pudo registrar.");
                        }     
                       
                   }
                    
                }
            });
        }
    });
    

        

});
</script>
                                    </div>
                               </div>                        
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
       
            
        </div>
    </section>
</div>







