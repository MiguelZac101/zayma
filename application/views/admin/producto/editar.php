<div id="wrapper">
    <section>
        <div class="row">
            <div class="col-xs-6">

<div class="panel panel-default">
    <div class="panel-heading">PRODUCTO - EDITAR</div>                      

    <div class="panel-body" >
        <form name="form_editar" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>"/>  

            <div class="form-group">
                <label>Grupo</label>
                <select class="form-control" name="id_grupo" id="id_grupo">
                    <option value="0">Seleccione Grupo</option>
                    <?php 
                    foreach ($grupos as $g){
                    ?>
                    <option value="<?php echo $g['id'];?>" <?php if($g['id']==$producto['id_grupo']){ ?> selected=" " <?php } ?> >
                        <?php echo $g['nombre'];?>
                    </option>
                    <?php
                    }
                    ?>                  
                    
                </select>
            </div>
            
            <div class="form-group">
                <label>Categoria</label>
                <select class="form-control" name="id_categoria" id="id_categoria">
                    <option value="0">Seleccione Categoria</option>                                    
                    <?php 
                    foreach ($categorias as $g){
                    ?>
                    <option value="<?php echo $g['id'];?>" <?php if($g['id']==$producto['id_categoria']){?> selected=" "<?php } ?>>
                        <?php echo $g['nombre'];?>
                    </option>
                    <?php
                    }
                    ?> 
                </select>
            </div>
            
            <div class="form-group">
                <label>Subcategoria</label>
                <select class="form-control" name="id_subcategoria" id="id_subcategoria">
                    <option value="0">Seleccione Subcategoria</option>                                    
                    <?php 
                    foreach ($subcategorias as $g){
                    ?>
                    <option value="<?php echo $g['id'];?>" <?php if($g['id']==$producto['id_subcategoria']){?> selected=" "<?php } ?>>
                        <?php echo $g['nombre'];?>
                    </option>
                    <?php
                    }
                    ?> 
                </select>
            </div>
            
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="<?php echo $producto['nombre']; ?>">
            </div>

            <div class="form-group">
                <label>Imagen</label>
                <input id="imagen" type="file" name="imagen[]" class="file" accept="image/*" data-show-upload="false" data-show-caption="false" multiple>
                <p class="text-info" style="font-size: 11px;">Dimensiones de imagen 850 pixeles de ancho y 500 pixeles de alto.</p>
                <script>
                    $('#imagen').fileinput();
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

                </div>
            <div class="col-xs-6">

<div class="panel panel-default">
    <div class="panel-heading">PRODUCTO - IMAGENES</div>                      

    <div class="panel-body" >
        <div class="row">
            <?php
            foreach ($producto_imagen as $key => $imagen) {                
            ?>
            <div class="col-xs-4 producto_imagen">

                <div class="thumbnail">
                    <img src="<?php echo base_url().$imagen['imagen'];?>" alt="imagen de producto" class="img-responsive">
                    <div class="caption">                        
                        
                        <a href="#" class="btn btn-danger btn-block btn-eliminar" role="button" data-imagen="<?php echo $imagen['id'];?>">
                            Eliminar
                        </a> 
                        <a href="#" class="btn btn-default btn-block btn-destacado" role="button" data-imagen="<?php echo $imagen['id'];?>">
                            Destacado
                        </a>
                        
                    </div>
                </div>
    
                
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
                
                
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function (){

    
    $('form[name=form_editar]').validate({        
        rules:{
            nombre: {
                required: true,
                minlength: 5
            },
            imagen: {
                required: true,
                accept: "image/*"
            }

        }, 
        messages:{
            imagen: {                
                accept: "Solo se aceptan imagenes."
            }
        },
        submitHandler: function(form) {
            // some other code
            // maybe disabling submit button
            // then:
//            $(form).submit(); 
            var url = "<?php echo base_url();?>admin/producto/actualizar" ;
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
                   if(data.actualizar==1){
                       alert(data.mensaje);
                       $(location).attr('href', "<?php echo base_url();?>admin/producto/editar/<?php echo $producto['id'];?>");
//                       redirect("admin/editor/listado");
                   }else{
                        $("#preloader").hide();
                        alert(data.mensaje);                              
                   }
                    
                }
            });
        }
    });
    
    //CANCELAR, CARGAR EL FORMULARIO DE "NUEVO"
    $('form[name=form_editar] button[name=cancelar]').on('click',function(e){
        e.preventDefault();
        $("#preloader").show();
        $.post('<?php echo base_url(); ?>admin/producto/nuevo/', {
            
        }, function (data) {
            $("#cargar_ajax").html(data);
            $("#preloader").hide();
        });
    });
    
    $(".btn_eliminar").on('click', function (e) {
        e.preventDefault();
        if (!confirm('¿Esta seguro de eliminar esta imagen?'))return;            
        
        var imagen = $(this);
        /* Obtiene el objeto actual de la fila seleccionada */
        var id_imagen = $(this).data('imagen');

        $("#preloader").show();
        /* Petición ajax al servidor */
        $.post('<?php echo base_url(); ?>admin/producto_imagen/eliminar/', {
            id: id_imagen
        }, function (r) {            
            $("#preloader").hide();
            imagen.parents(".producto_imagen").remove();
        }, 'json');

        return false;
    });

});




</script>