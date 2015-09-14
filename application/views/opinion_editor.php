<?php
if(count($articulos)>0){
?>

<h2>
    Opinion del editor
</h2>
<div class="row">
    <?php
    foreach ($articulos as $key => $articulo) {
    ?>
    
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-12">
        <div class="contenedor_opinion_editor">
            <div class="editor_datos" >                
                <img src="<?php echo base_url($editor['imagen']); ?>" alt="" class="img-responsive"/>

                <div class="comentarista">
                    <div class="nombre">
                        <?php echo $editor['nombre']; ?>
                    </div>
                    <div class="grado">                        
                        Lider comentarista
                    </div>
                </div>              
                
            </div>
            <div class="editor_comentario">
                <p class="comentario_dia" >
                    Comentario del dia
                </p>
                <p class="descripcion_breve">
                    <?php
                    echo $articulo['titulo'];
                    ?>
                </p>
                <p class="text-center">
                    <a href="<?php echo base_url($articulo['blog_url'].'/'.$articulo['categoria']['url'].'/'.$articulo['url']);  ?>" class="btn2" title="visitar '<?php echo $articulo['titulo'];?>'">Leer más</a>
                </p>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
<!--    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-12">
        <div class="contenedor_opinion_editor">
            <div class="editor_datos" >

                <img src="http://lorempixel.com/91/72/business/1" alt="" class="img-responsive"/>
                <div class="comentarista">
                    <div class="nombre">
                        Juan velasco Alvarado
                    </div>
                    <div class="grado">
                        Lider comentarista
                    </div>
                </div>
            </div>
            <div class="editor_comentario">
                <p class="comentario_dia" >
                    Comentario del dia
                </p>
                <p class="descripcion_breve">
                    Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.
                </p>
                <p class="text-center">
                    <a href="#" class="btn2">Leer más</a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-12">
         <div class="contenedor_opinion_editor">
            <div class="editor_datos" >

                <img src="http://lorempixel.com/91/72/business/1" alt="" class="img-responsive"/>
                <div class="comentarista">
                    <div class="nombre">
                        Juan velasco Alvarado
                    </div>
                    <div class="grado">
                        Lider comentarista
                    </div>
                </div>
            </div>
            <div class="editor_comentario">
                <p class="comentario_dia" >
                    Comentario del dia
                </p>
                <p class="descripcion_breve">
                    Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. 
                </p>
                <p class="text-center">
                    <a href="#" class="btn2">Leer más</a>
                </p>
            </div>
        </div>
    </div>-->
</div>

<?php    
}
?>