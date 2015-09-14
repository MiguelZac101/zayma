<div class="panel panel-default">
    <div class="panel-heading">Videos - Editar</div>                      

    <div class="panel-body" >
        <form name="form_editar" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>

            <div class="form-group">
                <label>Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="" value="<?php echo $titulo; ?>">
            </div>          

            <div class="form-group">
                <label>URL del video</label>
                <input type="text" class="form-control" id="url" name="url" placeholder="" value="<?php echo $url; ?>">
                <p class="text-info" style="font-size: 11px;">El video debe ser de youtube y debe tener esta forma <br/>https://www.youtube.com/watch?v=phB9ICpxkcU</p>
            </div>

            <hr>                
            <div class="form-group text-right">

                <!--<button type="button" class="btn btn-default btn-sm" name="cancelar">CANCELAR</button>-->
                <input type="reset" value="CANCELAR" name="cancelar" class="btn btn-default btn-sm">
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
            }                     
            ,
            url: {
                required: true,
                url: true,
                maxlength: 500
            }
        },
        submitHandler: function(form) {
            // some other code
            // maybe disabling submit button
            // then:
//            $(form).submit(); 
            var url = base_url + 'admin/galeria_videos/actualizar';
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
                       $(location).attr('href', "<?php echo base_url();?>admin/galeria_videos/listado");
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
        

});


   //CANCELAR, CARGAR EL FORMULARIO DE "NUEVO"
    $('form[name=form_editar] input[name=cancelar]').on('click',function(e){
        e.preventDefault();
        $("#preloader").show();
        $.post('<?php echo base_url(); ?>admin/galeria_videos/nuevo/', {            
        }, function (data) {
            $("#cargar_ajax").html(data);
            $("#preloader").hide();
        });
    });

</script>