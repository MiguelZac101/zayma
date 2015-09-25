<div id="seccion_novedades">
     <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="titulo01">LO ÚLTIMO DE LA MODA</h2>            
                <h3 class="titulo01">Con un toque de estilo</h3>
                <br/>
                <br/>
                <br/>              
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-xs-12" id="novedades_carrusel_contenedor">
                <?php
                echo $carrusel;
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <br/>
                <p id="novedades_descripcion">
                    <?php
                    echo $novedad["descripcion"];
                    ?>
                </p>
                <br/>
            </div>
        </div>
    </div>

    
    <div id="novedades_contenedor" >
        <div class="container">
            <div class="row">  
    <?php
    if(count($novedades)>0){
        foreach ($novedades as $nov) {
    ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <a class="novedad" data-id="<?php echo $nov['id']; ?>">
                        <div class="novedad_imagen_contenedor">
                            <div class="novedad_imagen" style="background-image:url('<?php echo base_url().$nov['imagen']; ?>');">
                            </div>
                        </div>
                        
                        <!--<img src="<?php echo $nov['imagen']; ?>"/>-->
                        <div class="novedad_nombre">
                            <?php echo $nov['titulo']; ?>
                        </div>
                    </a>
                </div>
    <?php
        }
    }
    ?>
                
                            
            </div>
        </div>
    </div>    
</div>



