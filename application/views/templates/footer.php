        <!--FOOTER--> 
        <footer>
            <div id="footer_menu_movil" class="container visible-xs">
                <div class="row">
                    <div class="col-xs-12">
                        <a href="#" title="" class="btn_footer">
                            NOSOTROS
                        </a>
                        <a href="#" title="" class="btn_footer">
                            GALERIA
                        </a>
                        <a href="#" title="" class="btn_footer">
                            PROMOCIONES
                        </a>
                        <a href="#" title="" class="btn_footer">
                            NOVEDADES
                        </a>
                        <a href="#" title="" class="btn_footer">
                            CONTACTO
                        </a>
                    </div>
                </div>
            </div>
            <div id="footer_menu" class="container hidden-xs text-center">
                <div class="row">
                    <div class="col-xs-12">
                        <a href="#" title="" class="">
                            NOSOTROS
                        </a>
                        -
                        <a href="galeria.html" title="" class="animsition-link">
                            GALERIA
                        </a>
                        -
                        <a href="#" title="" class="">
                            PROMOCIONES
                        </a>
                        -
                        <a href="#" title="" class="">
                            NOVEDADES
                        </a>
                        -
                        <a href="#" title="" class="">
                            CONTACTO
                        </a>
                    </div>
                </div>
            </div>
            <div id="footer_logo" class="text-center">
                <a href="http://lifedigital.pe" title="Visitar LifeDigital">
                    <img src="<?php echo base_url();?>images/logo_life.png" alt="imagen de lifedigital" class="img-responsive"/><br/>
                </a> 
                
                <p>
                    Diseño de paginas web
                </p>
            </div>
            <div id="footer_derechos">
                Todos los derechos reservados de Zayma 2015
            </div>
        </footer>
        <!--FIN FOOTER--> 
        
        <!--MENU-->
        <div  id="menu" class="">
            <div>

                <!-- Background -->
                <div class="bg"></div>         
                <div id="menu_contenido">
                    <div class="container" >
                        <div class="row">                        
                            <div class="col-xs-12" id="contenedor_salir">
                                <a class="btn-menu-cerrar">
                                    SALIR
                                </a>                    
                            </div>
                        </div>
                    </div>
                </div>
                

               
            </div>
        </div>
        <!--FIN MENU-->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js" charset="utf-8"></script>
        

        
        <script src="<?php echo base_url();?>plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
     
        <script src="<?php echo base_url();?>plugins/animsition-master/dist/js/jquery.animsition.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>js/animsition.config.js" type="text/javascript"></script>
    
   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script> 
        <script src="<?php echo base_url();?>js/base_url.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>js/frontend.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>js/sliderZayma.js" type="text/javascript"></script> 
        <script src="<?php echo base_url();?>js/jquery.menuzac.js" type="text/javascript"></script> 
        <script type="text/javascript">
        $(document).ready(function(){ 
            $("#combo_producto_grupo a.combo_zayma_cabecera").menuzac({
                id_cuadromenu:'#combo_producto_grupo ul.combo_zayma_submenu',
                tiempo:100
            });  
            $("#combo_producto_categoria a.combo_zayma_cabecera").menuzac({
                id_cuadromenu:'#combo_producto_categoria ul.combo_zayma_submenu',
                tiempo:100
            }); 
            $("#combo_producto_subcategoria a.combo_zayma_cabecera").menuzac({
                id_cuadromenu:'#combo_producto_subcategoria ul.combo_zayma_submenu',
                tiempo:100
            }); 
        });
        </script>
    </body>
</html>