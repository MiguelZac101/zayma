<div id="seccion_productos">
    <div class="container">
        <div class="seccion_producto_selectores row" >
            <div class="col-xs-12 text-center col-sm-12 col-md-4 col-lg-4">
                
                <div class="combo_zayma combo_producto" id="combo_producto_grupo" data-id="<?php echo $grupo_seleccionado['id']; ?>">                
                    <a class="combo_zayma_cabecera">
                        <div class="combo_zayma_cabecera_nombre">
                            <?php echo $grupo_seleccionado['nombre']; ?>                     
                        </div>                        
                    </a>
                    <ul class="combo_zayma_submenu">                        
                        <?php
                        foreach ($grupos as $gru) {
                        ?>
                        <li>
                            <a href="" data-id="<?php echo $gru['id']?>" data-url="<?php echo $gru['url']?>">                                
                                <?php echo $gru['nombre']?>
                            </a>
                        </li>                        
                        <?php
                        }
                        ?>                                                 
                    </ul>
                </div>
                
            </div>
            <div class="col-xs-12 text-center col-sm-12 col-md-4 col-lg-4">
                <div class="combo_zayma combo_producto" id="combo_producto_categoria" data-id="<?php echo $categoria_seleccionado['id']; ?>">                
                    <a class="combo_zayma_cabecera">
                        <div class="combo_zayma_cabecera_nombre">
                            <?php echo $categoria_seleccionado['nombre']; ?>                       
                        </div>                                         
                    </a>
                    <ul class="combo_zayma_submenu">                        
                        <?php
                        foreach ($categorias as $gru) {
                        ?>
                        <li>
                            <a href="" data-id="<?php echo $gru['id']?>" data-url="<?php echo $gru['url']?>">
                                <?php echo $gru['nombre']?>
                            </a>
                        </li>                        
                        <?php
                        }
                        ?>                                                 
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 text-center col-sm-12 col-md-4 col-lg-4">
                
                <div class="combo_zayma combo_producto" id="combo_producto_subcategoria" data-id="<?php echo $subcategoria_seleccionado['id']; ?>">                
                    <a class="combo_zayma_cabecera">
                        <div class="combo_zayma_cabecera_nombre">
                            <?php echo $subcategoria_seleccionado['nombre']; ?>                       
                        </div>                                            
                    </a>
                    <ul class="combo_zayma_submenu">                        
                        <?php
                        foreach ($subcategorias as $gru) {
                        ?>
                        <li>
                            <a href="" data-id="<?php echo $gru['id']?>" data-url="<?php echo $gru['url']?>">
                                <?php echo $gru['nombre']?>
                            </a>
                        </li>                        
                        <?php
                        }
                        ?>                                                 
                    </ul>
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