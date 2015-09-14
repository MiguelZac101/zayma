<div class="panel panel-default">
    <div class="panel-heading">Fotos - Editar</div>                      

    <div class="panel-body" >
        <form name="form_editar" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <fieldset>
<!--                <legend>Datos Principales</legend>-->

                <div class="form-group">
                    <label>Titulo</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="" value="<?php echo $titulo; ?>">
                </div>          

            </fieldset>
            <fieldset>
<!--                <legend>Multimedia</legend>-->
                <div class="form-group">
                    <label>Imagen</label>
                    <input id="imagen" type="file" name="imagen" class="file" accept="image/*" data-show-upload="false" data-show-caption="false">
                    <p class="text-info" style="font-size: 11px;">Dimensiones de imagen recomendado 870 pixeles x 600 pixeles.</p>
                    <script>
                        $('#imagen').fileinput({
                            initialPreview: [
                                '<img src="<?php echo base_url($imagen); ?>" class="file-preview-image" alt="<?php echo $titulo; ?>" title="<?php echo $titulo; ?>">'
                            ]
                        });
                    </script>
                </div>
            </fieldset>
                                           
            <fieldset>
                <hr>                
                <div class="form-group text-right">
                    
                    <!--<button type="button" class="btn btn-default btn-sm" name="cancelar">CANCELAR</button>-->
                    <input type="reset" value="CANCELAR" name="cancelar" class="btn btn-default btn-sm">
                    <!--<button type="button" class="btn btn-success btn-sm" name="guardar">GUARDAR</button>-->
                    <input type="submit" value="GUARDAR" name="GUARDAR" class="btn btn-success btn-sm">
                    
                </div>
            </fieldset>
            
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
            }
//            ,
//            imagen: {
//                required: true,
//                accept: "image/*"
//            }
        },
        submitHandler: function(form) {
            // some other code
            // maybe disabling submit button
            // then:
//            $(form).submit(); 
            var url = base_url + 'admin/galeria_fotos/actualizar';
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
                       $(location).attr('href', "<?php echo base_url();?>admin/galeria_fotos/listado");
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
    $('form[name=form_editar] input[name=cancelar]').on('click',function(e){
        e.preventDefault();
        $("#preloader").show();
        $.post('<?php echo base_url(); ?>admin/galeria_fotos/nuevo/', {            
        }, function (data) {
            $("#cargar_ajax").html(data);
            $("#preloader").hide();
        });
    });
    
});


  

</script>