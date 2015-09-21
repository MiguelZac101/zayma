<?php     echo $seccion_servicios;
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
                            <a href="" title="" class="btn02">
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
        <div id="seccion_contacto" class="hidden-xs">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="titulo02">
                            ¿TE PODEMOS AYUDAR?
                        </h2>
                        <h3 class="titulo03">
                            Es fácil, solo llena estos campos y nos comunicaremos contigo
                        </h3>
                        <br/><br/><br/>
                    </div>
                    <div class="col-xs-12">
                        <form class="form-horizontal" name="frm_contacto">
                            <div class="row">
                                <div class="col-sm-6 text-right">
                                    <div class="contenedor_input cuadradito_top_left">
                                        <input type="email" class="campo"  placeholder="¿Cual es tu nombre?">
                                    </div>                                    
                                    <br/><br/>
                                </div>
                                <div class="col-sm-6">
                                    <div class="contenedor_input cuadradito_top_right">                                        
                                        <input type="email" class="campo"  placeholder="¿A donde te podemos llamar?">
                                    </div>
                                    <br/><br/>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <input type="email" class="campo"  placeholder="Introduce tu E-mail" >
                                    <br/><br/>
                                </div>
                                <div class="col-sm-6">
                                    <!--
                                    <input type="email" class="campo"  placeholder="Escoje una tienda">
                                    -->
                                    <div class='selectBox select_contacto'>
                                        <span class='selected'></span>
                                        <span class='selectArrow'>
                                            <img src="images/select_flecha.png" alt="imagen select"/>
                                        </span>
                                        <div class="selectOptions" >
                                                <span class="selectOption" data-valor="1">Tienda 1</span>
                                                <span class="selectOption" data-valor="2">Tienda 2</span>
                                                <span class="selectOption" data-valor="3">Tienda 3</span>
                                        </div>
                                    </div>                                    
                                    <br/><br/>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <div class="contenedor_textarea cuadradito_bottom_left cuadradito_bottom_right">
                                        <textarea class="campo contenedor_textarea cuadradito_bottom_left " placeholder="Describenos tu consulta"></textarea>
                                    </div>
                                    <br/>
                                </div>
                                <div class="col-sm-12">                                    
                                    <a href="#" title="" class="btn01">
                                        Enviar
                                    </a>
                                </div>
                            </div>
                           
                                
                             
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div id="seccion_contacto" class="visible-xs">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="titulo02">
                            ¿TE PODEMOS AYUDAR?
                        </h2>
                        <h3 class="titulo03">
                            Es fácil, solo llena estos campos y nos comunicaremos contigo
                        </h3>
                        <br/><br/><br/>
                    </div>
                    <div class="col-xs-12">
                        <form class="form-horizontal" name="frm_contacto">
                            <div class="row">
                                <div class="col-xs-12">              
                                    <div class="contenedor_input_movil cuadradito_top_left cuadradito_top_right">                                
                                        <input type="email" class="campo inputclass"  placeholder="¿Cual es tu nombre?" >   
                                    </div>                               
                                    
                                    <br/><br/>
                                </div>
                                <div class="col-xs-12">
                                    <input type="email" class="campo"  placeholder="¿A donde te podemos llamar?">
                                    <br/><br/>
                                </div>
                                <div class="col-xs-12">
                                    <input type="email" class="campo"  placeholder="Introduce tu E-mail" >
                                    <br/><br/>
                                </div>
                                <div class="col-xs-12">
                                    <!--
                                    <input type="email" class="campo"  placeholder="Escoje una tienda">
                                    -->
                                    <div class='selectBox select_contacto'>
                                        <span class='selected'></span>
                                        <span class='selectArrow'>
                                            <img src="images/select_flecha.png" alt="imagen select"/>
                                        </span>
                                        <div class="selectOptions" >
                                            <span class="selectOption" data-valor="1">Tienda 1</span>
                                            <span class="selectOption" data-valor="2">Tienda 2</span>
                                            <span class="selectOption" data-valor="3">Tienda 3</span>
                                        </div>
                                    </div>
                                    
                                    <br/><br/>
                                </div>
                                <div class="col-xs-12">
                                    <div class="contenedor_input_movil cuadradito_bottom_left cuadradito_bottom_right">                                
                                        <textarea class="campo" placeholder="Describenos tu consulta"></textarea>
                                    </div> 
                                    
                                    <br/><br/>
                                </div>
                                <div class="col-xs-12">                                    
                                    <a href="#" title="" class="btn03">
                                        Enviar
                                    </a>
                                </div>
                            </div>
                           
                                
                             
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
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
        
        

