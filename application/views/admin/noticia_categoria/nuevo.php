<div class="panel panel-default">
    <div class="panel-heading"><?php echo $titulo_modulo; ?> - Nuevo</div>                      

    <div class="panel-body" >
        <form name="form_nuevo" role="form" enctype="multipart/form-data">
            <fieldset>
<!--                <legend>Datos Principales</legend>-->

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="">
                </div>          

            </fieldset>
<!--            <fieldset>
                <legend>Multimedia</legend>
                <div class="form-group">
                    <label>Imagen</label>
                    <input id="imagen" type="file" name="imagen" class="file" accept="image/*" data-show-upload="false" data-show-caption="false">
                    <p class="text-info" style="font-size: 11px;">Dimensiones de imagen recomendado 265x200px.</p>
                    <script>
                        $('#imagen').fileinput();
                    </script>

                </div>
            </fieldset>-->
                                           
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
            nombre: {
                required: true,
                minlength: 5
            }
//            ,
//            imagen: {
//                required: true,
//                accept: "image/*"
//            }
        },
        messages:{
//            imagen: {
//                required: "Imagen requerido.",
//                accept: "Solo se aceptan imagenes."
//            }
        },
        submitHandler: function(form) {
            // some other code
            // maybe disabling submit button
            // then:
//            $(form).submit(); 
            var url = base_url + 'admin/<?php echo $control;?>/registrar';
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
//                   if(data.upload_imagen!=''){
//                       alert(data.upload_imagen);
//                   }
                   //registro
                   if(data.registro==1){
                       alert("Se registro correctamente.");
                       $(location).attr('href', base_url+"admin/<?php echo $control;?>/listado");
//                       redirect("admin/noticia_categoria/listado");
                   }else{
                       alert("Sucedio un error no se pudo registrar.");
                   }
                    
                }
            });
        }
    });
    

        

});
</script>