<div id="wrapper">
    <section>
        <div class="row">
            <div class="col-xs-6">

<div class="panel panel-default">
    <div class="panel-heading">PRODUCTO - NUEVO</div>                      

    <div class="panel-body" >
        <form name="form_nuevo" role="form" enctype="multipart/form-data">            
            <div class="form-group">
                <label>Grupo</label>
                <select class="form-control" name="id_grupo" id="id_grupo">
                    <option value="0">Seleccione Grupo</option>
                    <?php 
                    foreach ($grupos as $g){
                    ?>
                    <option value="<?php echo $g['id'];?>"><?php echo $g['nombre'];?></option>
                    <?php
                    }
                    ?>                  
                    
                </select>
            </div>
            
            <div class="form-group">
                <label>Categoria</label>
                <select class="form-control" name="id_categoria" id="id_categoria">
                    <option value="0">Seleccione Categoria</option>                                    
                    
                </select>
            </div>
            
            <div class="form-group">
                <label>Subcategoria</label>
                <select class="form-control" name="id_subcategoria" id="id_subcategoria">
                    <option value="0">Seleccione Subcategoria</option>                                    
                    
                </select>
            </div>

            <div class="form-group">
               
                <label>Nombre</label>
               
                
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="">
            </div>

            <div class="form-group">
                <label>Imagenes</label>
                <input id="imagen" type="file" name="imagen[]" class="file" accept="image/*" data-show-upload="false" data-show-caption="false" multiple>
                <p class="text-info" style="font-size: 11px;">Dimensiones de imagen 850 pixeles de ancho y 500 pixeles de alto.</p>
                <script>
                    $('#imagen').fileinput();
                </script>

            </div>


                                         
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

                </div>
            <div class="col-xs-6">

<div class="panel panel-default">
    <div class="panel-heading">PRODUCTO - IMAGENES</div>                      

    <div class="panel-body" >
    
    </div>
</div>
                
                
            </div>
        </div>
    </section>
</div>
<script>
$(document).ready(function (){

    $('form[name=form_nuevo]').validate({   
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
                required: "Imagen requerido.",
                accept: "Solo se aceptan imagenes."
            }
        },
        submitHandler: function(form) {
            var url = "<?php echo base_url(); ?>admin/producto/registrar" ;
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
//                   if(data.registro==1){
//                       alert("Se registro correctamente.");
//                       $(location).attr('href', base_url+"admin/producto/listado");
//                   }else{
//                        $("#preloader").hide();
                        if(data.upload_imagen!=''){
                            alert(data.upload_imagen);
                            return;
                        }else{
                            //REDIRECCIONAR AL LISTADO
                           $(location).attr('href', base_url+"admin/producto/listado");
                        }                           
                       
//                   }
                    
                }
            });
        }
    });
    
    //CARGAR AJAX LAS CATEGORIAS SEGUN EL GRUPO
    $("select[name=id_grupo]").on('change',function(){
        var id_grupo = $(this).val();        
        $.post( "<?php echo base_url(); ?>admin/combo/categorias_grupo", 
            { id_grupo: id_grupo },
            function(data){
                $("select[name=id_categoria]").html(data);
        }); 
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