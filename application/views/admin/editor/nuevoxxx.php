<div id="wrapper">
    <section>
        <div class="row">
           
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Editor Nuevo</div>
                <div class="panel-body">
                    <form name="form_editor_nuevo" role="form" enctype="multipart/form-data">
                        <fieldset class="col-md-4">
                            <legend>Datos Principales</legend>
                                                             
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" id="titulo" name="nombre" placeholder="Nombre del editor." value="MIGUEL ZAC">
                            </div>
<!--                            <div class="form-group">
                                <label>URL del articulo</label>
                                <input type="text" class="form-control" id="url" name="url" placeholder="URL del articulo.">
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea class="form-control" rows="5" maxlength="500" id="blog" name="blog" placeholder="Blog"></textarea>
                                <textarea class="form-control" rows="6"  maxlength="200" id="descripcion" name="descripcion" placeholder="Descripción"></textarea>
                                <p class="text-info" style="font-size: 11px;">Máximo de caracteres permitidos 200.</p>
                            </div>                              -->
                           
                        </fieldset>
                        <fieldset class="col-md-4">
                            <legend>Multimedia</legend>
                            <div class="form-group">
                                <label>Imagen</label>
                                <input id="imagen" type="file" name="imagen" class="file" accept="image/*" data-show-upload="false" data-show-caption="true">
                                <p class="text-info" style="font-size: 11px;">Dimensiones de imagen recomendado 265x200px.</p>
                                <script type="text/javascript" >
//                                    $(document).ready(function (){
//                                        $("#imagen").fileinput({
//                                            'showUpload':false, 
//                                            'showRemove':false,
//                                            'previewFileType':'any',
//                                            'allowedFileExtensions': {'jpg', 'gif', 'png'},                                            
//                                            'allowedFileTypes ': {'image'}
//                                        });
//                                    }
                                </script>
                                
                                
                            </div>
                        </fieldset>
                        <div class="row">                                    
                            <fieldset class="col-md-8">
                                <hr>
                                <div id="message"></div>
                                <div class="form-group">
                                    <div class="form-inline text-right">
                                        <button type="button" class="btn btn-default btn-sm" onclick="redirect('admin/editor/listado')">CANCELAR</button>
                                        <!--<button type="button" class="btn btn-default btn-sm" onclick="clearForm('Zm9ybS10ZXN0aW1vbmlv')">LIMPIAR</button>-->
                                        <!--<button type="button" class="btn btn-primary btn-sm" >GUARDAR</button>-->
                                        <input type="submit" value="GUARDAR" name="GUARDAR" class="btn btn-primary btn-sm">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </form>
                </div>
            </div>
        </div>
              
        </div>
    </section>
</div>

<script type="text/javascript" src="<?php echo base_url('js/admin/editor.js'); ?>"></script>


