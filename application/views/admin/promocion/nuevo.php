<div class="panel panel-default">
    <div class="panel-heading">PROMOCIONES - Nuevo</div>                      

    <div class="panel-body" >
        <!--<form name="form_promocion_nuevo" role="form" enctype="multipart/form-data">-->
        <form name="form_promocion_nuevo" role="form">            

            <div class="form-group">
                <label>Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="" value="">
            </div>  
            <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control" rows="3" maxlength="100" id="descripcion" name="descripcion" placeholder="Descripción"></textarea>
                <p class="text-info" style="font-size: 11px;">Máximo de caracteres 100.</p>
            </div>
            <div class="form-group">
                <label>Precio Normal</label>
                <input type="text" class="form-control" id="precio_anterior" name="precio_normal" placeholder="" value="">
            </div>
            <div class="form-group">
                <label>Precio promocion</label>
                <input type="text" class="form-control" id="precio_promocion" name="precio_promocion" placeholder="" value="">
            </div>
            
            <div class="form-group">
                <label>Imagen Grande</label>
                <input id="imagen_lg" type="file" name="imagen_lg" class="file" accept="image/*" data-show-upload="false" data-show-caption="false">
                <p class="text-info" style="font-size: 11px;">Dimensiones de imagen recomendado 1075x515px.</p>
                <script>
                    $('#imagen_lg').fileinput();
                </script>
            </div>
            
            <div class="form-group">
                <label>Imagen Pequeña</label>
                <input id="imagen_xs" type="file" name="imagen_xs" class="file" accept="image/*" data-show-upload="false" data-show-caption="false">
                <p class="text-info" style="font-size: 11px;">Dimensiones de imagen recomendado 556x270px.</p>
                <script>
                    $('#imagen_xs').fileinput();
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

    $('form[name=form_promocion_nuevo]').validate({   
        rules:{
            titulo: {
                required: true,
                minlength: 5,
                maxlength: 50
            }
            ,
            descripcion: {
                required: true,
                minlength: 5,
                maxlength: 100
            },
            precio_normal: {
                required: true               
            },
            precio_promocion: {
                required: true
            }
            ,
            imagen_lg: {
                required: true,
                accept: "image/*"
            }
            ,
            imagen_xs: {
                required: true,
                accept: "image/*"
            }
        },
        messages:{
            imagen_lg: {
                required: "Imagen requerido.",
                accept: "Solo se aceptan imagenes."
            },
            imagen_xs: {
                required: "Imagen requerido.",
                accept: "Solo se aceptan imagenes."
            }
        },
        submitHandler: function(form) {
            var url = "<?php echo base_url(); ?>admin/promocion/registrar" ;
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
                       $(location).attr('href', base_url+"admin/promocion/listado");
//                       redirect("admin/noticia_articulo/listado");
                   }else{
                        $("#preloader").hide();
                        if(data.upload_imagen!=""){
                            alert(data.upload_imagen);
                            return;
                        }else if(data.db_error!=""){
                            alert(data.db_error);
                            return;
                        }
                        else{
                            alert("Sucedio un error no se pudo registrar.");
                        } 
                   }
                }
            });
        }
    });
    

        

});
</script>