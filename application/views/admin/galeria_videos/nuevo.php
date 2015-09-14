<div class="panel panel-default">
    <div class="panel-heading">Videos - Nuevo</div>                      

    <div class="panel-body" >
        <form name="form_nuevo" role="form" enctype="multipart/form-data">


                <div class="form-group">
                    <label>Titulo</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="" value="">
                </div>          
                
            <div class="form-group">
                    <label>URL del video</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="" value="">
                    <p class="text-info" style="font-size: 11px;">El video debe ser de youtube y debe tener esta forma <br/>https://www.youtube.com/watch?v=phB9ICpxkcU</p>
                    
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
<script>
$(document).ready(function (){

    $('form[name=form_nuevo]').validate({   
        rules:{
            titulo : {
                required: true,
                maxlength: 100
            }                     
            ,
            url : {
                required: true,
                url: true,
                maxlength: 500,
                url_youtube:true
            }
        },
        messages:{
            url : {
                url_youtube : "Solo se permiten videos de youtube."
            }
        }, 
        
        submitHandler: function(form) {
            var url = '<?php echo base_url(); ?>admin/galeria_videos/registrar';
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
                   
                   //registro
                   if(data.registro==1){
                       alert("Se registro correctamente.");
                       $(location).attr('href', base_url+"admin/galeria_videos/listado");
//                       redirect("admin/noticia_articulo/listado");
                   }else{
                       $("#preloader").hide();
                       if(data.upload_imagen!=''){
                            alert(data.upload_imagen);
                            return;
                        }else{
                            alert("Sucedio un error no se pudo registrar.");
                        }                           
                       
                   }
                    
                }
            });
        }
    });
    
    
        

});
</script>