<?php   

echo $seccion_home_header;

echo $seccion_servicios;
?>
        
        <!--FRASE-->
        <div id="seccion_frase" class="hidden-xs">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <img src="images/icono_frase.png">
                        <p>
                            Para ser <b><i>irreemplazable,</i></b> uno debe buscar<br/>
                            siempre ser <b><i>diferente.</i></b>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div id="seccion_frase" class="visible-xs">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <img src="images/icono_frase.png">
                        <p style="line-height: 20px;">
                            Para ser <b><i>irreemplazable,</i></b> <br/>
                            uno debe buscar<br/>
                            siempre ser <b><i>diferente.</i></b>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--FIN FRASE-->
        
        <!--PORTAFOLIO-->
<?php
    echo $seccion_portafolio;
?>       
        <!--FIN PORTAFOLIO-->  
        
        <!--CONOCENOS-->
        <div id="seccion_conocenos">
            <div class="container"> 
                <div class="row">
                    <div class="col-xs-12 col-sm-6 text-center">
                        <h2 class="titulo01">
                            CRECEMOS CON EL MISMO OBJETIVO
                        </h2>
                        <h3 class="titulo01">
                            Brindarte la mejor calidad
                        </h3>
                        <br/><br/><br/>
                        <div class="hidden-xs">
                            <p class="container_p_pc">
                                Lorem Ipsum es simplemente el texto de relleno de las imprentas y 
                                archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar 
                                de las industrias desde el año 1500, cuando un impresor (N. del T. persona 
                                que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de 
                                tal manera que logró hacer un libro de textos especimen.                             
                            </p>
                            <br/><br/>
                            <a href="<?php echo base_url();?>conocenos" title="" class="btn02">
                                DESCUBRE MÁS
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 text-center contenedor_billetera">
                        <img src="images/billetera.png" class="img-responsive">                             
                    </div>
                    <div class="col-xs-12 visible-xs">
                        <br/>
                        <p>
                            Lorem Ipsum es simplemente el texto de relleno de las imprentas y 
                            archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar 
                            de las industrias desde el año 1500, cuando un impresor (N. del T. persona 
                            que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de 
                            tal manera que logró hacer un libro de textos especimen.                             
                        </p>
                        <br/>                        
                        <a href="" title="" class="btn02">
                            DESCUBRE MÁS
                        </a>
                    </div>
                </div>                            
            </div>
        </div>
        <!--FIN CONOCENOS-->  
        
        <!--VIDEOS-->  
<?php
    echo $seccion_video;
?>         
        <!--FIN VIDEOS-->  
        
        <!--CONTACTO-->  
<?php
    echo $seccion_contacto;
?>        
        <!--FIN CONTACTO--> 
        <!--MAPA--> 
<?php
    echo $seccion_mapa;
?> 
        <!--FIN MAPA--> 
        <!--ENCUENTRANOS--> 
        <!--PORTAFOLIO-->
<?php
    echo $seccion_encuentranos;
?>          
        <!--FIN ENCUENTRANOS--> 
        
        
        <!--nevegacion>-->
      
        <div id="navegacion" class="hidden-xs hidden-sm navegacion_posicion_standar">
            <ul class="list-unstyled nav nav-navigation">
                <li class="active"><a href="#menu_top"><span class="expand">Inicio</span></a></li>
                <li><a href="#seccion_servicios"><span class="expand">Servicios</span></a></li>
                <li><a href="#seccion_portafolio"><span class="expand">Portafolio</span></a></li>
                <li><a href="#seccion_conocenos"><span class="expand">Conocenos</span></a></li>
                <li><a href="#seccion_videos"><span class="expand">Video</span></a></li>
                <li><a href="#seccion_contacto"><span class="expand">Contacto</span></a></li>                
                <li><a href="#seccion_mapa"><span class="expand">Ubicanos</span></a></li>                
                <li><a href="#seccion_encuentranos"><span class="expand">Encuentranos</span></a></li>
                
                
            </ul>
        </div>
   
        <!--fin navegacion-->
        
        

