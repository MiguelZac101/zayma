<div class="panel panel-default">
    <div class="panel-heading">Fotos - Nuevo</div>                      

    <div class="panel-body" >
        <form name="form_nuevo" role="form" enctype="multipart/form-data">
            <fieldset>
<!--                <legend>Datos Principales</legend>-->

                <div class="form-group">
                    <label>Titulo</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="" value="">
                </div>          

            </fieldset>
            <fieldset>
<!--                <legend>Multimedia</legend>-->
                <div class="form-group">
                    <label>Imagen</label>
                    <input id="imagen" type="file" name="imagen" class="file" accept="image/*" data-show-upload="false" data-show-caption="false">
                    <p class="text-info" style="font-size: 11px;">Dimensiones de imagen recomendado 870 pixeles x 600 pixeles.</p>
                    <script>
                        $('#imagen').fileinput();
                    </script>
                </div>
            </fieldset>
                                           
            <fieldset>
                <hr>                
                <div class="form-group text-right">
                    
                    <!--<button type="button" class="btn btn-default btn-sm" name="cancelar">CANCELAR</button>-->
                    <input type="reset" value="CANCELAR" name="CANCELAR" class="btn btn-default btn-sm">
                    <!--<button type="button" class="btn btn-success btn-sm" name="guardar">GUARDAR</button>-->
                    <input type="submit" value="GUARDAR" name="GUARDAR" class="btn btn-success btn-sm">
                    
                </div>
            </fieldset>
            
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
            }                     
            ,
            imagen: {
                required: true,
                accept: "image/*"
//                ,
//                validarImagenAnchoAlto  : true
            }
        },
        messages:{
            imagen: {
                required: "Imagen requerido.",
                accept: "Solo se aceptan imagenes."
            }
        },
        submitHandler: function(form) {
            var url = '<?php echo base_url(); ?>admin/galeria_fotos/registrar';
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
//                    $("#preloader").hide();
                    //error de imagen
                   
                   //registro
                   if(data.registro==1){
                       alert("Se registro correctamente.");
                       $(location).attr('href', base_url+"admin/galeria_fotos/listado");
//                       redirect("admin/noticia_articulo/listado");
                   }else{
                       $("#preloader").hide();
                       if(data.upload_imagen!=''){
                            alert(data.upload_imagen);
                            return;
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