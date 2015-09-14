<div class="panel panel-default">
    <div class="panel-heading"><?php echo $titulo_modulo; ?> - Editar</div>                      

    <div class="panel-body" >
        <form name="form_editar" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <div class="form-group">
                <label>Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="" value="<?php echo $titulo; ?>">
            </div>   
            <div class="form-group">
                <label>URL</label>
                <input type="text" class="form-control" id="url" name="url" placeholder="" value="<?php echo $url; ?>">
            </div> 

            <div class="form-group">
                <label>Imagen</label>
                <input id="imagen" type="file" name="imagen" class="file" accept="image/*" data-show-upload="false" data-show-caption="false">
                <p class="text-info" style="font-size: 11px;">Medidas de la imagen 1920 pixeles de ancho x 450pixeles de alto.</p>
                <script>
                    $('#imagen').fileinput({
                        initialPreview: [
                            '<img src="<?php echo base_url($imagen); ?>" class="file-preview-image" alt="<?php echo $titulo; ?>" title="<?php echo $titulo; ?>">'
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
                maxlength: 100                               
            },
            url :{
                url: true,
                required: true,
                maxlength: 500
            }

        },       
        submitHandler: function(form) {
            // some other code
            // maybe disabling submit button
            // then:
//            $(form).submit(); 
            var url = '<?php echo base_url();?>admin/<?php echo $funcion_nombre;?>/actualizar';
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
                    //error de imagen
//                   if(data.upload_imagen!=''){
//                       alert(data.upload_imagen);
//                   }
                   //registro
                   if(data.actualizar==1){
                       alert("Registro Actualizado!.");
                       $(location).attr('href', "<?php echo base_url();?>admin/<?php echo $funcion_nombre;?>/listado");
//                       redirect("admin/editor/listado");
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
        $.post('<?php echo base_url(); ?>admin/<?php echo $funcion_nombre;?>/nuevo/', {
            
        }, function (data) {
            $("#cargar_ajax").html(data);
            $("#preloader").hide();
        });
    });
        

});




</script>