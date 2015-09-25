<div class="panel panel-default">
    <div class="panel-heading">PRODUCTO - Editar</div>                      

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
                <input id="imagen" type="file" name="imagen" class="file" accept="image/*" data-show-upload="false" data-show-caption="false" >
                <p class="text-info" style="font-size: 11px;">Dimensiones de imagen 360x338px.</p>
                <script>
                    $('#imagen').fileinput({
                        initialPreview: [
                            '<img src="<?php echo base_url($producto['imagen']); ?>" class="file-preview-image" alt="imagen">'
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
           nombre : {
                required: true,
                minlength: 5
            },  
            id_grupo : {    
                required: true,
                min: 1
            },
            id_categoria : {    
                required: true,
                min: 1
            },
            id_subcategoria : {    
                required: true,
                min: 1
            },
            imagen : {
                accept: "image/*"
            }
        }, 
        messages:{
            imagen: {
                accept: "Solo se aceptan imagenes."
            },
            id_grupo:{
                min: "Debe seleccionar alguna opción"
            },
            id_categoria:{
                min: "Debe seleccionar alguna opción"
            },
            id_subcategoria:{
                min: "Debe seleccionar alguna opción"
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
                    if(data.actualizar==1){
                       alert("Registro Actualizado!.");
                       $(location).attr('href', base_url+"admin/producto/listado");
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
     
        $.post('<?php echo base_url(); ?>admin/producto/nuevo/', {
            
        }, function (data) {
            $("#cargar_ajax").html(data);
            $("#preloader").hide();
        });
    });
    
//ELIMINAR IMAGEN    
//    $(".btneliminar").on('click', function (e) {        
//        e.preventDefault();
//        
//        if (!confirm('¿Esta seguro de eliminar esta imagen?'))return;            
//        
//        var imagen = $(this);
//        /* Obtiene el objeto actual de la fila seleccionada */
//        var id_imagen = $(this).data('imagen');
//
//        $("#preloader").show();
//        /* Petición ajax al servidor */
//        $.post('<?php echo base_url(); ?>admin/producto_imagen/eliminar/', {
//            id: id_imagen
//        }, function (r) {            
//            $("#preloader").hide();
//            imagen.parents(".producto_imagen").remove();
//        }, 'json');
//
//        return false;
//    });
    
    //CARGAR AJAX LAS CATEGORIAS SEGUN EL GRUPO
    $("select[name=id_grupo]").on('change',function(){
        var id_grupo = $(this).val();        
        $.post( "<?php echo base_url(); ?>admin/combo/categorias_grupo", 
            { id_grupo: id_grupo },
            function(data){
                $("select[name=id_categoria]").html(data);
        });
        //borrar las opciones de las subcategorias
        $("select[name=id_subcategoria] option[value!=0]").remove();
       
    });
    
    //CARGAR AJAX LAS SUBCATEGORIAS SEGUN LA CATEGORIA
    $("select[name=id_categoria]").on('change',function(){
        var id_categoria = $(this).val();        
        $.post( "<?php echo base_url(); ?>admin/combo/subcategorias_categoria", 
            { id_categoria: id_categoria },
            function(data){
                $("select[name=id_subcategoria]").html(data);
        }); 
    });

});




</script>