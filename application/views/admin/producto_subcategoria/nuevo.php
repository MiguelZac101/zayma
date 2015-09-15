<div class="panel panel-default">
    <div class="panel-heading"><?php echo $titulo_modulo; ?> - Nuevo</div>                      

    <div class="panel-body" >
        <!--<form name="form_nuevo" role="form" enctype="multipart/form-data">-->
        <form name="form_nuevo" role="form">        
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
                <label>Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="">
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
            var url = "<?php echo base_url(); ?>admin/<?php echo $control;?>/registrar" ;
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
                   if(data.registro==1){
                       alert("Se registro correctamente.");
                       $(location).attr('href', "<?php echo base_url(); ?>admin/<?php echo $control;?>/listado");
//                       redirect("admin/noticia_categoria/listado");
                   }else{
                       alert("Sucedio un error no se pudo registrar.");
                   }
                    
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

        

});
</script>