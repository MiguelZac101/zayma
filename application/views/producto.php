<div id="seccion_productos">
    <div class="container">
        <div class="seccion_producto_selectores row" >
            <div class="col-xs-12 text-center col-sm-12 col-md-4 col-lg-4">
                <div class='selectBox select_galeria' data-id="<?php echo $grupo_seleccionado['id']; ?>" id="producto_combo_1" >
                    <span class='selected'>
                        <?php echo $grupo_seleccionado['nombre']; ?>                        
                    </span>
                    <span class='selectArrow'>
                        <img src="<?php echo base_url();?>images/select_flecha_02.png" alt="imagen select"/>
                    </span>
                    <div class="selectOptions" >
                        <?php
                        foreach ($grupos as $gru) {
                        ?>
                        <span class="selectOption" data-id="<?php echo $gru['id']?>" data-url="<?php echo $gru['url']?>">
                            <?php echo $gru['nombre']?>
                        </span>
                        <?php
                        }
                        ?>
<!--                        <span class="selectOption" data-valor="1">Damas</span>
                        <span class="selectOption" data-valor="2">Caballeros</span>
                        <span class="selectOption" data-valor="3">Accesorios</span>-->
                    </div>
                </div>
            </div>
            <div class="col-xs-12 text-center col-sm-12 col-md-4 col-lg-4">
                <div class='selectBox select_galeria' data-id="<?php echo $categoria_seleccionado['id']; ?>" id="producto_combo_2" >
                    <span class='selected'>
                        <?php echo $categoria_seleccionado['nombre']; ?>  
                    </span>
                    <span class='selectArrow'>
                        <img src="<?php echo base_url();?>images/select_flecha_02.png" alt="imagen select"/>
                    </span>
                    <div class="selectOptions" >
                        <?php
                        foreach ($categorias as $gru) {
                        ?>
                        <span class="selectOption" data-id="<?php echo $gru['id']?>">
                            <?php echo $gru['nombre']?>
                        </span>
                        <?php
                        }
                        ?>
<!--                        <span class="selectOption" data-valor="1">Zapatos</span>
                        <span class="selectOption" data-valor="2">Categoria 2</span>
                        <span class="selectOption" data-valor="3">Categoria 3</span>-->
                    </div>
                </div>
            </div>
            <div class="col-xs-12 text-center col-sm-12 col-md-4 col-lg-4">
                <div class='selectBox select_galeria' data-id="<?php echo $subcategoria_seleccionado['id']; ?>" id="producto_combo_3" >
                    <span class='selected'>
                        <?php echo $subcategoria_seleccionado['nombre']; ?> 
                    </span>
                    <span class='selectArrow'>
                        <img src="<?php echo base_url();?>images/select_flecha_02.png" alt="imagen select"/>
                    </span>
                    <div class="selectOptions" >
                        <?php
                        foreach ($subcategorias as $gru) {
                        ?>
                        <span class="selectOption" data-id="<?php echo $gru['id']?>">
                            <?php echo $gru['nombre']?>
                        </span>
                        <?php
                        }
                        ?>
<!--                        <span class="selectOption" data-valor="1">Subcategoria 1</span>
                        <span class="selectOption" data-valor="2">Subcategoria 2</span>
                        <span class="selectOption" data-valor="3">Subcategoria 3</span>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <a class="producto">
                    <div class="producto_imagen">
                        <img src="<?php echo base_url();?>images/producto.jpg" alt="imagen de producto" class="img-responsive"/>
                        <div class="producto_imagen_sombra">
                            <div class="producto_imagen_sombra_lineas bloque_lineas">
                                <div class="producto_imagen_sombra_lineas_cruz">

                                </div>
                                <div class="top"></div>
                                <div class="right"></div>
                                <div class="bottom"></div>
                                <div class="left"></div>
                            </div>
                        </div>
                    </div>                            
                    <div class="producto_contenedor_titulo">
                        <div class="producto_titulo">
                            CARTERA<BR/>
                            TIPO 01
                        </div>
                    </div>
                </a>                      
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <a class="producto">
                    <div class="producto_imagen">
                        <img src="<?php echo base_url();?>images/producto.jpg" alt="imagen de producto" class="img-responsive"/>
                        <div class="producto_imagen_sombra">
                            <div class="producto_imagen_sombra_lineas bloque_lineas">
                                <div class="producto_imagen_sombra_lineas_cruz">

                                </div>
                                <div class="top"></div>
                                <div class="right"></div>
                                <div class="bottom"></div>
                                <div class="left"></div>
                            </div>
                        </div>
                    </div>                            
                    <div class="producto_contenedor_titulo">
                        <div class="producto_titulo">
                            CARTERA<BR/>
                            TIPO 01
                        </div>
                    </div>
                </a>                      
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <a class="producto">
                    <div class="producto_imagen">
                        <img src="<?php echo base_url();?>images/producto.jpg" alt="imagen de producto" class="img-responsive"/>
                        <div class="producto_imagen_sombra">
                            <div class="producto_imagen_sombra_lineas bloque_lineas">
                                <div class="producto_imagen_sombra_lineas_cruz">

                                </div>
                                <div class="top"></div>
                                <div class="right"></div>
                                <div class="bottom"></div>
                                <div class="left"></div>
                            </div>
                        </div>
                    </div>                            
                    <div class="producto_contenedor_titulo">
                        <div class="producto_titulo">
                            CARTERA<BR/>
                            TIPO 01
                        </div>
                    </div>
                </a>                      
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <a class="producto">
                    <div class="producto_imagen">
                        <img src="<?php echo base_url();?>images/producto.jpg" alt="imagen de producto" class="img-responsive"/>
                        <div class="producto_imagen_sombra">
                            <div class="producto_imagen_sombra_lineas bloque_lineas">
                                <div class="producto_imagen_sombra_lineas_cruz">

                                </div>
                                <div class="top"></div>
                                <div class="right"></div>
                                <div class="bottom"></div>
                                <div class="left"></div>
                            </div>
                        </div>
                    </div>                            
                    <div class="producto_contenedor_titulo">
                        <div class="producto_titulo">
                            CARTERA<BR/>
                            TIPO 01
                        </div>
                    </div>
                </a>                      
            </div>

        </div>
    </div>


</div>