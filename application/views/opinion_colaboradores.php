<?php
if(count($articulos)>0){
?>

<h2>
    Opinion de Colaboradores
</h2>
<div class="row">
    <?php
    foreach ($articulos as $key => $articulo) {
    ?>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-12">        
        <a class="opinion_colaborador" href="<?php echo base_url($articulo['blog_url'].'/'.$articulo['categoria']['url'].'/'.$articulo['url']);  ?>" title="<?php echo $articulo['titulo']; ?>">                
            <img src="<?php echo base_url($articulo['editor']['imagen']); ?>" alt="<?php echo $articulo['editor']['nombre']; ?>" class="img-responsive"/>

            <p class="descripcion">
               <?php
                    echo $articulo['titulo'];
                    ?>
            </p>

        </a>       
       
    </div>
    <?php
    }
    ?>
    
    
<!--    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-12">        
        <a class="opinion_colaborador" href="#" title="xxx">                
            <img src="http://lorempixel.com/91/72/business/1" alt="" class="img-responsive"/>

            <p class="descripcion">
                Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.
            </p>

        </a>       
       
    </div>
    
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-12">        
        <a class="opinion_colaborador" href="#" title="xxx">                
            <img src="http://lorempixel.com/91/72/business/1" alt="" class="img-responsive"/>

            <p class="descripcion">
                Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.
            </p>

        </a>       
       
    </div>-->
    
</div>

<?php
}
?>