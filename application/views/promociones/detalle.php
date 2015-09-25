<div class="hidden-xs" id="promocion_detalle_contenedor">
    <div class="promocion_detalle">                
        <div class="promocion_detalle_descripcion">
            <div class="promocion_detalle_descripcion_lineas bloque_lineas">
                <h2>
                   <?php echo $promocion['titulo']; ?>
                </h2>
                <br/>
                <p class="detalle">
                    <?php echo $promocion['descripcion']; ?>
                </p>
                <br/>
                <p class="precio01">
                    De S/.<?php echo $promocion['precio_normal']; ?>
                </p>
                <p class="precio02">
                    A S/.<?php echo $promocion['precio_promocion']; ?>
                </p>

                <div class="top"></div>
                <div class="right"></div>
                <div class="bottom"></div>
                <div class="left"></div>
            </div>
        </div>
        <div class="promocion_detalle_imagen">
            <div class="promocion_detalle_imagen_fondo" style="background-image: url('<?php echo base_url().$promocion['imagen_lg']; ?>');"></div>
            <!--<img class="img-responsive" alt="" src="<?php echo base_url().$promocion['imagen_lg']; ?>">-->
        </div>                
    </div>
</div>
<div id="promocion_detalle_contenedor_movil" class="visible-xs">
    <div class="promocion_detalle">                
        <div class="promocion_detalle_descripcion">
            <div class="promocion_detalle_descripcion_lineas bloque_lineas">
                <h2>
                   <?php echo $promocion['titulo']; ?>
                </h2>
                <br/>
                <p class="detalle">
                    <?php echo $promocion['descripcion']; ?>
                </p>
                <br/>
                <p class="precio01">
                    De S/.<?php echo $promocion['precio_normal']; ?>
                </p>
                <p class="precio02">
                    A S/.<?php echo $promocion['precio_promocion']; ?>
                </p>                      
                <div class="top"></div>
                <div class="right"></div>
                <div class="bottom"></div>
                <div class="left"></div>
            </div>
        </div>
        <div class="promocion_detalle_imagen">
            <img src="<?php echo base_url().$promocion['imagen_xs']; ?>" alt="" class="img-responsive"/>
<!--            <a href="" title="" class="btn01">
                DESCUBRE MÁS
            </a>-->
        </div>                
    </div>
</div>