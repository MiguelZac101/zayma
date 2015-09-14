

<div class="panel panel-default">
    <div class="panel-heading"><?php echo $titulo_modulo; ?> - Nuevo</div>                      

    <div class="panel-body" >
        <form name="form_nuevo" role="form" enctype="multipart/form-data">            
<!--                <legend>Datos Principales</legend>-->

            <div class="form-group">
                <?php 
                if($control=="lideres_articulo"){
                ?>
                <label>Nombre</label>
                <?php
                }else{
                ?>
                <label>Titulo</label>
                <?php
                }
                ?>
                
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="" value="">
            </div>

<!--            <div class="form-group">
                <label>Fecha</label>
                <input type="text" class="form-control" id="fecha" name="fecha" placeholder="" value="">
            </div> -->
            
            <div class="form-group">
                <label>Editor</label>
                <select class="form-control" name="id_editor" id="id_editor">
                    <?php 
                    foreach ($editores as $editor){
                    ?>
                    <option value="<?php echo $editor['id'];?>"><?php echo $editor['nombre'];?></option>
                    <?php
                    }
                    ?>                  
                    
                </select>
            </div>

            <div class="form-group">
                <label>Categoria</label>
                <select class="form-control" name="id_categoria" id="id_categoria">
                    <?php 
                    foreach ($categorias as $categoria){
                    ?>
                    <option value="<?php echo $categoria['id'];?>"><?php echo $categoria['nombre'];?></option>
                    <?php
                    }
                    ?>                  
                    
                </select>
            </div>
<?php 
if($control=="lideres_articulo"){
?>
<input type='hidden' name='fecha' value="<?php echo Date("d/m/Y"); ?>"/>        
<?php
}else{
?>     
                
    <div class="form-group">
        <label>Fecha</label>
        <div class='input-group date' id='datetimepicker1'>
            <input type='text' class="form-control" name='fecha'/>
<!--                    <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>-->
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('input[name=fecha]').datepicker({
                format: 'dd/mm/yyyy',
                language:'es',
                todayHighlight:true
            });
        });
    </script>
<?php
}
?>
<!--                <legend>Multimedia</legend>-->
            <div class="form-group">
                <label>Imagen</label>
                <input id="imagen" type="file" name="imagen" class="file" accept="image/*" data-show-upload="false" data-show-caption="false">
                <p class="text-info" style="font-size: 11px;">Dimensiones de imagen 850 pixeles de ancho y 500 pixeles de alto.</p>
                <script>
                    $('#imagen').fileinput();
                </script>

            </div>
           
            
            <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control" rows="3" maxlength="200" id="descripcion" name="descripcion" placeholder="Descripción"></textarea>
                <p class="text-info" style="font-size: 11px;">Máximo de caracteres 200.</p>
            </div>

            <div class="form-group">
<?php 
if($control=="lideres_articulo"){
?>
    <label>Biografía</label>      
<?php
}else{
?> 
    <label>Contenido</label>  
<?php
}
?> 
                <textarea id="contenido" rows="25" class="textarea form-control" name="contenido" placeholder="contenido"></textarea>                                    
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('.textarea').wysihtml5();
                    });
                    
                </script>
                <div id="has-message"></div>
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
            titulo: {
                required: true,
                maxlength: 100
            },
            fecha: {
                required: true,
                date: true
            },
            descripcion : {
                required:true,
                maxlength : 200
            }             
            ,
            imagen: {
                required: true,
                accept: "image/*"
//                ,
//                validarImagenAnchoAlto  : true
            }
        },
        messages:{
            imagen: {
                required: "Imagen requerido.",
                accept: "Solo se aceptan imagenes."
            }
        },
        submitHandler: function(form) {
            var url = base_url + 'admin/<?php echo $control;?>/registrar';
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
                       $(location).attr('href', base_url+"admin/<?php echo $control;?>/listado");
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
    
    //AA alto ancho
//    $.validator.addMethod("validarImagenAnchoAlto", function(value, element){
//        var response='';
//        var data_validar = new formData();
//        data_validar.append("imagen",$(element));
//        data_validar.append("alto",100);
//        data_validar.append("ancho",100);
//        
//        $.ajax({
//            type: "POST",
//            url: "<?php echo base_url();?>admin/validar_imagen/ancho_alto" ,
//            data: data_validar,
//            async:false,
//            success:function(data){
//                response = data;
//            }
//        });
//        
//        if(response == 1){
//            return true;
//        } else  {
//            return false;
//        }
//
//    }, "La imagen debe tener las dimensiones 100px x 100px");
    

        

});
</script>