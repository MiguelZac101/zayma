<!--SECCION PROMOCIONES-->
<div id="seccion_promociones">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="titulo01">LO ÚLTIMO DE LA MODA</h2>            
                <h3 class="titulo01">Con un toque de estilo</h3>
                <br/>
                <br/>
            </div>
        </div>
    </div>  
    <div id="promocion_detalle_contenedor_ajax">
    <?php echo $detalle; ?>
    </div>    
    <div id="promocion_contenedor" >
        <div class="container">
            <div class="row">
                <?php
                if(count($promociones)>0){
                    foreach ($promociones as $nov) {
                ?>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <a class="promocion" data-id="<?php echo $nov['id']; ?>">
                                    <div class="promocion_imagen_contenedor">
                                        <div class="promocion_imagen" style="background-image:url('<?php echo base_url().$nov['imagen_xs']; ?>');">
                                        </div>
                                    </div>
                                    <!--<img src="<?php echo $nov['imagen']; ?>"/>-->
                                    <div class="promocion_nombre">
                                        <?php echo $nov['titulo']; ?>
                                    </div>
                                </a>
                            </div>
                <?php
                    }
                }
                ?>
<!--                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <a class="promocion">
                        <img src="images/producto_promocion.jpg"/>
                        <div class="promocion_nombre">
                            CARTERA DE CUERO MARRON
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <a class="promocion">
                        <img src="images/promocion02.jpg"/>
                        <div class="promocion_nombre">
                            BILLETERA DE CUERO NEGRO
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <a class="promocion">
                        <img src="images/promocion03.jpg"/>
                        <div class="promocion_nombre">
                            CARTERA DE CUERO MARRON
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <a class="promocion">
                        <img src="images/promocion04.jpg"/>
                        <div class="promocion_nombre">
                            BILLETERA DE CUERO NEGRO
                        </div>
                    </a>
                </div>-->
            </div>
        </div>
    </div>
</div>
<!--FIN SECCION PROMOCIONES-->
