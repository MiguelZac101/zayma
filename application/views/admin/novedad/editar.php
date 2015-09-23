<div class="panel panel-default">
    <div class="panel-heading">NOVEDADES - Editar</div>                      

    <div class="panel-body" >
        <form name="form_editar" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>

            <div class="form-group">
                <label>Titulo</label>
                <input type="text" class="form-control" id="nombre" name="titulo" placeholder="" value="<?php echo $titulo; ?>">
            </div>          
            <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control" rows="3" maxlength="200" id="descripcion" name="descripcion" placeholder="Descripción"><?php echo $descripcion; ?></textarea>
                <p class="text-info" style="font-size: 11px;">Máximo de caracteres 200.</p>
            </div>

            <div class="form-group">
                <label>Imagen</label>
                <input id="imagen" type="file" name="imagen" class="file" accept="image/*" data-show-upload="false" data-show-caption="false">
                <p class="text-info" style="font-size: 11px;">Dimensiones de imagen recomendado 600x270 pixeles.</p>
                <script>
                    $('#imagen').fileinput({
                        initialPreview: [
                            '<img src="<?php echo base_url($imagen); ?>" class="file-preview-image" alt="<?php echo $titulo; ?>">'
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

    
    $('form[name=form_editar]').validate({        
        rules:{
            titulo: {
                required: true,
                minlength: 5
            }

        },       
        submitHandler: function(form) {
            // some other code
            // maybe disabling submit button
            // then:
//            $(form).submit(); 
            var url = base_url + 'admin/novedad/actualizar';
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
                       $(location).attr('href', base_url+"admin/novedad/listado");

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
    $('form[name=form_editar] button[name=cancelar]').on('click',function(e){
        e.preventDefault();
        $("#preloader").show();
        $.post('<?php echo base_url(); ?>admin/novedad/nuevo/', {
            
        }, function (data) {
            $("#cargar_ajax").html(data);
            $("#preloader").hide();
        });
    });
        

});




</script>