<div class="panel panel-default">
    <div class="panel-heading"><?php echo $titulo_modulo; ?> - Editar</div>                      

    <div class="panel-body" >
        <form name="form_editar" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>

            <div class="form-group">
                <label>Grupo</label>
                <select class="form-control" name="id_grupo" id="id_grupo">
                    <?php 
                    foreach ($grupos as $g){
                    ?>
                    <option value="<?php echo $g['id'];?>" <?php if($g['id']==$id_grupo){ echo "selected"; } ?> > <?php echo $g['nombre'];?></option>
                    <?php
                    }
                    ?>                  
                    
                </select>
            </div>
            
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="<?php echo $nombre; ?>">
                </div>          


                                           
            <fieldset>
                <hr>                
                <div class="form-group text-right">
                    
                    <button type="button" class="btn btn-default btn-sm" name="cancelar">CANCELAR</button>
                    <!--<input type="reset" value="CANCELAR" name="CANCELAR" class="btn btn-default btn-sm">-->
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
            nombre: {
                required: true,
                minlength: 5
            }

        },       
        submitHandler: function(form) {
            // some other code
            // maybe disabling submit button
            // then:
//            $(form).submit(); 
            var url = base_url + 'admin/<?php echo $control;?>/actualizar';
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
                    $("#preloader").hide();
                    //error de imagen
//                   if(data.upload_imagen!=''){
//                       alert(data.upload_imagen);
//                   }
                   //registro
                   if(data.actualizar==1){
                       alert("Registro Actualizado!.");
                       $(location).attr('href', base_url+"admin/<?php echo $control;?>/listado");
//                       redirect("admin/editor/listado");
                   }else{
                       alert("Sucedio un error no se pudo actualizar el registrar.");
                   }
                    
                }
            });
        }
    });
    
    //CANCELAR, CARGAR EL FORMULARIO DE "NUEVO"
    $('form[name=form_editar] button[name=cancelar]').on('click',function(e){
        e.preventDefault();
        $("#preloader").show();
        $.post('<?php echo base_url(); ?>admin/<?php echo $control;?>/nuevo/', {
            
        }, function (data) {
            $("#cargar_ajax").html(data);
            $("#preloader").hide();
        });
    });
        

});




</script>