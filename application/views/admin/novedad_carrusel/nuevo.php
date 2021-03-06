<div class="panel panel-default">
    <div class="panel-heading">CARRUSEL - Nuevo</div> 
    <div class="panel-body" >
        <!--<form name="form_nuevo" role="form" enctype="multipart/form-data">-->
        <form name="form_carrusel_nuevo" role="form">  
            <div class="form-group">
                <label>Imagen Grande</label>
                <input id="imagen_lg" type="file" name="imagen_lg" class="file" accept="image/*" data-show-upload="false" data-show-caption="false">
                <p class="text-info" style="font-size: 11px;">Dimensiones de imagen recomendado 1280x515px.</p>
                <script>
                    $('#imagen_lg').fileinput();
                </script>
            </div>
            
            <div class="form-group">
                <label>Imagen Pequeña</label>
                <input id="imagen_xs" type="file" name="imagen_xs" class="file" accept="image/*" data-show-upload="false" data-show-caption="false">
                <p class="text-info" style="font-size: 11px;">Dimensiones de imagen recomendado 428x358px.</p>
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

    $('form[name=form_carrusel_nuevo]').validate({   
        rules:{
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
            var url = "<?php echo base_url(); ?>admin/novedad_carrusel/registrar" ;
            var data = new FormData(form);
            data.append("id_novedad",$("#myModal").attr("data-id"));
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
                       //actualizar el LISTADO
                        $.post('<?php echo base_url(); ?>admin/novedad_carrusel/listado', {
                            
                        }, function (data) {                
                            $("#myModal #modal_listado").html(data);
                            
                            //actualizar nuevo
                            $.post('<?php echo base_url(); ?>admin/novedad_carrusel/nuevo', {

                            }, function (data) {                
                                $("#myModal #modal_proceso").html(data);
                                $("#preloader").hide();
                            });
                            
                        });
                        
                        
                        
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
