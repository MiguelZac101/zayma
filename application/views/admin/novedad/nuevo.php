<div class="panel panel-default">
    <div class="panel-heading">NOVEDADES - Nuevo</div>                      

    <div class="panel-body" >
        <!--<form name="form_nuevo" role="form" enctype="multipart/form-data">-->
        <form name="form_nuevo" role="form">            

            <div class="form-group">
                <label>Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="" value="">
            </div>  
            <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control" rows="3" maxlength="200" id="descripcion" name="descripcion" placeholder="Descripción"></textarea>
                <p class="text-info" style="font-size: 11px;">Máximo de caracteres 200.</p>
            </div>
            
            <div class="form-group">
                <label>Imagen</label>
                <input id="imagen" type="file" name="imagen" class="file" accept="image/*" data-show-upload="false" data-show-caption="false">
                <p class="text-info" style="font-size: 11px;">Dimensiones de imagen recomendado 600x270px.</p>
                <script>
                    $('#imagen').fileinput();
                </script>
            </div>
            <hr>                                
            <fieldset>
                               
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
                minlength: 5
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
            var url = "<?php echo base_url(); ?>admin/novedad/registrar" ;
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
                       $(location).attr('href', base_url+"admin/novedad/listado");
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