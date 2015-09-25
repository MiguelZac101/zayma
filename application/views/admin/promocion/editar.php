<div class="panel panel-default">
    <div class="panel-heading">PROMOCIONES - Editar</div>                      

    <div class="panel-body" >
        <form name="form_promocion_editar" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>

            <div class="form-group">
                <label>Titulo</label>
                <input type="text" class="form-control" id="nombre" name="titulo" placeholder="" value="<?php echo $titulo; ?>">
            </div>          
            <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control" rows="3" maxlength="100" id="descripcion" name="descripcion" placeholder="Descripción"><?php echo $descripcion; ?></textarea>
                <p class="text-info" style="font-size: 11px;">Máximo de caracteres 100.</p>
            </div>
            <div class="form-group">
                <label>Precio Normal</label>
                <input type="text" class="form-control" id="precio_anterior" name="precio_normal" placeholder="" value="<?php echo $precio_normal; ?>">
            </div>
            <div class="form-group">
                <label>Precio promocion</label>
                <input type="text" class="form-control" id="precio_promocion" name="precio_promocion" placeholder="" value="<?php echo $precio_promocion; ?>">
            </div>
            
            <div class="form-group">
                <label>Imagen Grande</label>
                <input id="imagen_lg" type="file" name="imagen_lg" class="file" accept="image/*" data-show-upload="false" data-show-caption="false">
                <p class="text-info" style="font-size: 11px;">Dimensiones de imagen recomendado 1075x515px.</p>
                <script>
                    $('#imagen_lg').fileinput({
                        initialPreview: [
                            '<img src="<?php echo base_url($imagen_lg); ?>" class="file-preview-image" alt="imagen lg">'
                        ]
                    });
                </script>
            </div>
            
            <div class="form-group">
                <label>Imagen Pequeña</label>
                <input id="imagen_xs" type="file" name="imagen_xs" class="file" accept="image/*" data-show-upload="false" data-show-caption="false">
                <p class="text-info" style="font-size: 11px;">Dimensiones de imagen recomendado 556x270px.</p>
                <script>
                    $('#imagen_xs').fileinput({
                        initialPreview: [
                            '<img src="<?php echo base_url($imagen_xs); ?>" class="file-preview-image" alt="imagen xs">'
                        ]
                    });
                </script>
            </div>
            
            <hr>                
            <div class="form-group text-right">

                <button type="button" class="btn btn-default btn-sm" name="cancelar">CANCELAR</button>
                <!--<input type="reset" value="CANCELAR" name="CANCELAR" class="btn btn-default btn-sm">-->
                <!--<button type="button" class="btn btn-success btn-sm" name="guardar">GUARDAR</button>-->
                <input type="submit" value="GUARDAR" name="GUARDAR" class="btn btn-success btn-sm">

            </div>

            
        </form>
    </div>
</div>

<script>
    $(document).ready(function (){

    
    $('form[name=form_promocion_editar]').validate({        
        rules:{
            titulo: {
                required: true,
                minlength: 5,
                maxlength: 50
            },
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
            },
            imagen_lg: {               
                accept: "image/*"
            },
            imagen_xs: {                
                accept: "image/*"
            }
        },
        messages:{
            imagen_lg: {           
                accept: "Solo se aceptan imagenes."
            },
            imagen_xs: {                
                accept: "Solo se aceptan imagenes."
            }
        }
        ,       
        submitHandler: function(form) {
            // some other code
            // maybe disabling submit button
            // then:
//            $(form).submit(); 
            var url = base_url + 'admin/promocion/actualizar';
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
                   if(data.actualizar==1){
                       alert("Registro Actualizado!.");
                       $(location).attr('href', base_url+"admin/promocion/listado");

                   }else{
                       $("#preloader").hide();
                       
                        if(data.upload_imagen!=''){
                            alert(data.upload_imagen);
                        }else{
                            alert("Sucedio un error no se pudo actualizar el registro.");
                        } 
                   }
                    
                }
            });
        }
    });
    
    //CANCELAR, CARGAR EL FORMULARIO DE "NUEVO"
    $('form[name=form_promocion_editar] button[name=cancelar]').on('click',function(e){
        e.preventDefault();
        $("#preloader").show();
        $.post('<?php echo base_url(); ?>admin/promocion/nuevo/', {
            
        }, function (data) {
            $("#cargar_ajax").html(data);
            $("#preloader").hide();
        });
    });
        

});




</script>