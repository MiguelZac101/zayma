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
            <div class="col-xs-12">
                <div id="novedades_carrusel" class="carousel slide carousel-fade" data-ride="carousel">

                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <?php
                        $bandera = 0;
                        $class_item = "";
                        foreach ($carrusel as $car) {                            
                            $bandera++;
                            if($bandera==1){
                                $class_item = "item";                                
                            }
                        ?>
                        <div class="<?php if($bandera==1){ echo $class_item; } ?>">
                            <img src="<?php echo $car['imagen_lg']; ?>" alt="" class="img-responsive"/>
                        </div>
                        <?php                            
                        }
                        ?>
<!--                        <div class="active item">
                            <img src="images/novedades1.jpg" alt="" class="img-responsive"/>
                        </div>
                        <div class="item">
                            <img src="images/novedades2.jpg" alt="" class="img-responsive"/>
                        </div>
                        <div class="item">
                            <img src="images/moda_grande.jpg" alt="" class="img-responsive"/>
                        </div>-->
                    </div>

                    <ol class="carousel-indicators">
                        <?php
                        $bandera = -1;
                        $class_item = "";
                        foreach ($carrusel as $car) {                            
                            $bandera++;
                            if($bandera==0){
                                $class_item = "active";                                
                            }
                        ?>                        
                        <li data-target="#novedades_carrusel" data-slide-to="<?php echo $bandera; ?>" class="<?php if($bandera==0){ echo $class_item; } ?>">
                            <a href="" title="" >
                                <img src="<?php echo $car['imagen_xs']; ?>" alt="" class="img-responsive"/>
                            </a>
                        </li>
                        <?php                            
                        }
                        ?>
<!--                        <li data-target="#novedades_carrusel" data-slide-to="0" class="active">
                            <a href="" title="" >
                                <img src="images/moda_peque.jpg" alt="" class="img-responsive"/>
                            </a>
                        </li>
                        <li data-target="#novedades_carrusel" data-slide-to="1" class="">
                            <a href="" title="">
                                <img src="images/moda_peque.jpg" alt="" class="img-responsive"/>
                            </a>
                        </li>
                        <li data-target="#novedades_carrusel" data-slide-to="2" class="">
                            <a href="" title="">
                                <img src="images/moda_peque.jpg" alt="" class="img-responsive"/>
                            </a>
                        </li>-->
                    </ol>
                    <!-- Carousel nav -->
                    <a class="carousel-control left" href="#novedades_carrusel" data-slide="prev">
                                              
                    </a>
                    <a class="carousel-control right" href="#novedades_carrusel" data-slide="next">
                                              
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <br/>
                <p class="novedades_descripcion">
                    Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.
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
                    <a class="novedad">
                        <img src="<?php echo $nov['imagen']; ?>"/>
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



