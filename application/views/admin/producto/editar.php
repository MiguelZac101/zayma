<div class="panel panel-default">
    <div class="panel-heading"><?php echo $titulo_modulo; ?> - Editar</div>                      

    <div class="panel-body" >
        <form name="form_editar" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>  

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
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="" value="<?php echo $titulo; ?>">
            </div>
            
            <div class="form-group">
                <label>Editor</label>
                <select class="form-control" name="id_editor" id="id_editor">
                    <?php 
                    foreach ($editores as $editor){
                    ?>
                    <option value="<?php echo $editor['id'];?>" <?php if($editor['id']==$id_editor){ echo "selected"; } ?> > <?php echo $editor['nombre'];?></option>
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
                    <option value="<?php echo $categoria['id'];?>" <?php if($categoria['id']==$id_categoria){ echo "selected"; } ?> ><?php echo $categoria['nombre'];?></option>
                    <?php
                    }
                    ?>                  
                    
                </select>
            </div>
 
<?php 
if($control=="lideres_articulo"){
?>
    <input type='hidden' name='fecha' value="<?php echo fechaMysqlANatural($fecha);?>"/>        
<?php
}else{
?> 
            <div class="form-group">
                <label>Fecha</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" name='fecha' value="<?php echo fechaMysqlANatural($fecha);?>"/>
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
            <div class="form-group">
                <label>Imagen</label>
                <input id="imagen" type="file" name="imagen" class="file" accept="image/*" data-show-upload="false" data-show-caption="false">
                <p class="text-info" style="font-size: 11px;">Dimensiones de imagen 850 pixeles de ancho y 500 pixeles de alto.</p>
                <script>
                    $('#imagen').fileinput({
                        initialPreview: [
                            '<img src="<?php echo base_url($imagen); ?>" class="file-preview-image" alt="<?php echo $titulo; ?>" title="<?php echo $titulo; ?>">'
                        ]
                    });
                </script>
            </div>
            
            <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control" rows="3" maxlength="200" id="descripcion" name="descripcion" placeholder="Descripción"><?php echo $descripcion; ?></textarea>
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
                <textarea id="contenido" rows="25" class="textarea form-control" name="contenido" placeholder="contenido"><?php echo $contenido; ?></textarea>                                    
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
//                    $("#preloader").hide();
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
        $.post('<?php echo base_url(); ?>admin/<?php echo $control;?>/nuevo/', {
            
        }, function (data) {
            $("#cargar_ajax").html(data);
            $("#preloader").hide();
        });
    });
        

});




</script>