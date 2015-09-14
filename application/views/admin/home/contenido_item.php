<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="row">                     

            <div class="col-xs-12">
                <?php echo $titulo; ?>
            </div>

        </div>
    </div>
    <div class="panel-body">
        <form name="form_<?php echo $contenido['id']; ?>" role="form" enctype="multipart/form-data"> 
            <input type="hidden" value="<?php echo $contenido['id']; ?>" name="id">
            <input type="hidden" value="490" name="ancho">
            <input type="hidden" value="650" name="alto">

            <div class="form-group">
                <label>Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="" value="<?php echo $contenido['titulo']; ?>">
            </div>
            <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control" rows="3" maxlength="200" id="descripcion" name="descripcion" placeholder="Descripción"><?php echo $contenido['descripcion']; ?></textarea>
                <p class="text-info" style="font-size: 11px;">Máximo de caracteres 200.</p>
            </div>
            <div class="form-group">
                <label>URL</label>
                <input type="text" class="form-control" id="url" name="url" placeholder="" value="<?php echo $contenido['url']; ?>">
            </div> 

            <div class="form-group">
                <label>Imagen</label>
                <input id="imagen_<?php echo $contenido['id']; ?>" type="file" name="imagen" accept="image/*" data-show-upload="false" data-show-caption="false">
                <p class="text-info" style="font-size: 11px;">Medidas de la imagen 490 pixeles de ancho x 650 pixeles de alto.</p>                                                
                <script>
                    $('#imagen_<?php echo $contenido['id']; ?>').fileinput({
                        initialPreview: [
                            '<img src="<?php echo base_url($contenido['imagen']); ?>" class="file-preview-image" alt="<?php echo $contenido['titulo']; ?>" title="<?php echo $contenido['titulo']; ?>">'
                        ]
                    });
                </script>
            </div>

            <hr>    

            <div class="form-group text-right">                                       
                <!--<input type="reset" value="CANCELAR" name="CANCELAR" class="btn btn-default btn-sm">-->                                  
                <input type="submit" value="GUARDAR" name="GUARDAR" class="btn btn-success btn-sm">
            </div>          

        </form>
        <script>
            $(document).ready(function () {

                $('form[name=form_<?php echo $contenido['id']; ?>]').validate({
                    rules: {
                        titulo: {
                            required: true,
                            maxlength: 100
                        },
                        url: {
                            url: true,
                            required: true,
                            maxlength: 500
                        }
                    },
                    messages: {
                    },
                    submitHandler: function (form) {
                        var url = '<?php echo base_url(); ?>admin/home/actualizar';
                        var data = new FormData(form);
                        $("#preloader").show();
                        $.ajax({
                            url: url,
                            data: data,
                            cache: false,
                            contentType: false,
                            processData: false,
                            type: 'POST',
                            dataType: 'json',
                            success: function (data) {

                                //registro
                                if (data.actualizar == 1) {
                                    alert("Se registro correctamente.");
                                    $(location).attr('href', <?php echo base_url(); ?> + "admin/home/listado");
//                       redirect("admin/noticia_categoria/listado");
                                } else {
                                    $("#preloader").hide();
                                    //error de imagen
                                    if (data.upload_imagen != '') {
                                        alert(data.upload_imagen);
                                    } else {
                                        alert("Sucedio un error no se pudo registrar.");
                                    }

                                }

                            }
                        });
                    }
                });




            });
        </script>
    </div>
</div>  