<div class="panel panel-default">
    <div class="panel-heading"><?php echo $titulo_modulo; ?> - Nuevo</div>                      

    <div class="panel-body" >
        <form name="form_nuevo" role="form" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="" value="">
            </div>
            
            <div class="form-group">
                <label>URL</label>
                <input type="text" class="form-control" id="url" name="url" placeholder="" value="">
            </div> 

            <div class="form-group">
                <label>Imagen</label>
                <input id="imagen" type="file" name="imagen" accept="image/*" data-show-upload="false" data-show-caption="false">
               <p class="text-info" style="font-size: 11px;">Medidas de la imagen 1920 pixeles de ancho x 450pixeles de alto.</p>
                <script>
                    $('#imagen').fileinput();
                </script>
            </div>
            
            <hr>    
            
            <div class="form-group text-right">

                <!--<button type="button" class="btn btn-default btn-sm" name="cancelar">CANCELAR</button>-->
                <input type="reset" value="CANCELAR" name="CANCELAR" class="btn btn-default btn-sm">
                <!--<button type="button" class="btn btn-success btn-sm" name="guardar">GUARDAR</button>-->
                <input type="submit" value="GUARDAR" name="GUARDAR" class="btn btn-success btn-sm">

            </div>          
            
        </form>
    </div>
</div>

<script>
$(document).ready(function (){

    $('form[name=form_nuevo]').validate({   
        rules:{
            titulo: {
                required: true,
                maxlength: 100
            },
            url :{
                url: true,
                required: true,
                maxlength: 500
            }
            ,
            imagen: {
                required: true,
                accept: "image/*"
            }
        },
        messages:{
            imagen: {
                required: "Imagen requerido.",
                accept: "Solo se aceptan imagenes."
            }
        },
        submitHandler: function(form) {
            // some other code
            // maybe disabling submit button
            // then:
//            $(form).submit(); 
            var url = '<?php echo base_url();?>admin/<?php echo $funcion_nombre;?>/registrar';
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
                    if(data.registro==1){
                       alert("Se registro correctamente.");
                       $(location).attr('href', "<?php echo base_url();?>admin/<?php echo $funcion_nombre;?>/listado");
//                       redirect("admin/noticia_categoria/listado");
                    }else{
                       $("#preloader").hide();
                       //error de imagen
                        if(data.upload_imagen!=''){
                            alert(data.upload_imagen);
                        }else if(data.limite_registros!=''){
                            alert(data.limite_registros);
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