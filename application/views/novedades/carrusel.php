<div id="novedades_carrusel" class="carousel slide carousel-fade" data-ride="carousel">

    <!-- Carousel items -->
    <div class="carousel-inner">
        <?php
        $bandera = 0;
        $class_item = "";
        foreach ($carrusel_items as $car) {                            
            $bandera++;
            if($bandera==1){
                $class_item = "active";                                
            }
        ?>
        <div class="item <?php if($bandera==1){ echo $class_item; } ?>">
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
        foreach ($carrusel_items as $car) {                            
            $bandera++;
            if($bandera==0){
                $class_item = "active";                                
            }
        ?>                        
        <li data-target="#novedades_carrusel" data-slide-to="<?php echo $bandera; ?>" class="<?php if($bandera==0){ echo $class_item; } ?>">
            <a href="" title="" >
                <img src="<?php echo $car['imagen_xs']; ?>" alt="" class="img-responsive"/>
                
                <div class="novedad_sombra">
                    <div class="bloque_lineas">                        
                        <div class="top"></div>
                        <div class="right"></div>
                        <div class="bottom"></div>
                        <div class="left"></div>
                    </div>
                </div>
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