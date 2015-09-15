(function( $ ) {    
    'use strict';
    // Funcion principal, cambia el color de fondo del elemento proporcionado al color indicado.
    // Por defecto se utilizara el color "red"
    $.fn.sliderZayma = function (options) {
    
        // Opciones por defecto si no se indican
        var defaults = {
            // Lista de opciones por defecto
            //color: 'red'
        };
        
        // Extiende las opciones
        var opts = $.fn.extend(defaults, options);
        
        // Define variables y constantes internas
        //var sizes = {7: {hoverCoef:5, width:600}, 3:{hoverCoef:2.5, width:851}, 2:{hoverCoef:1.8, width:1496}}
        var porcentaje_area = .5;//40% que porcentaje del area que se dispone debe tener cuando se agrandas
        var imagen_ancho = 500;
        
        var $contenedor = $(this);

        var margen = 30;//margenes centrales
        

        var liNum = 3,//son 3 pestañas
            liAncho,
            liHoverWidth,
            liRestWidth,
            liHeight = 460; //alto del bloque
        
            
        var resize = function(){
            //liNum = $contenedor.find('li').length;
            //margen = $contenedor.width()*.03;//margenes centrales

            liAncho = Math.ceil(($contenedor.width()-2*margen) / liNum); //ancho del bloque
            liHoverWidth = imagen_ancho;//Math.ceil(($contenedor.width()-1*margen) * porcentaje_area);//ancho cuando se agranda
            liRestWidth = Math.ceil(liAncho - ((liHoverWidth - liAncho) / (liNum - 1)));//ancho reducido
            //alert("ancho imagen :"+imagen_ancho+" liAncho : "+liAncho);

            //TweenMax.set( $contenedor.find('.servicio_bloque_separador') , { width: margen});

            $contenedor.find('li.servicio_bloque').each(function(index){
                var avanzar_x = index*liAncho+index*margen;
                
                TweenMax.set($(this), {width: imagen_ancho , x: avanzar_x, clip:'rect(0px,'+liAncho+'px,'+liHeight+'px,0px)'});
                //TweenMax.set($(this).find('a'), {x: (imagen_ancho-225)/2 });

                TweenMax.set( $(this).find('> div') , { x:-((imagen_ancho - liAncho) / 2 ), force3D:true});

                //TweenMax.set($(this).find("div"), {x: ((imagen_ancho-liAncho)/2)*-1});                
            });
        };
      
        var addListeners = function(){
            $contenedor.find('li.servicio_bloque').on('mouseenter', function(e){
               
                var Ease = Quad.easeOut;
                var time = .3;
                var Delay = 0.01;
                var $this = $(this);

                TweenMax.killTweensOf($(this));
                TweenMax.killTweensOf($(this).find('> div'));
                
                TweenMax.to($this, time, {clip:'rect(0px,'+liHoverWidth+'px,'+liHeight+'px,0px)', x: $this.data('index') * liRestWidth+ $this.data('index')*margen ,   ease: Ease});
                
                TweenMax.to($this.find('> div'), time, {x:-((imagen_ancho - liHoverWidth) / 2 ), ease: Ease, onComplete:poner_sombra, onCompleteParams:[$(this)]});
                TweenMax.to($(this).find(".servicio_bloque_hover"), time, {display:"block",  ease: Ease, delay:Delay, overwrite:'all'});
                TweenMax.to($(this).find(".btn_servicio"), time, {bottom: 198, ease: Ease});
                TweenMax.to($(this).find(".btn_servicio"), time, {css:{backgroundColor:"none",border:"1px solid #eae3d0"}});
                
                $contenedor.find('li.servicio_bloque').each(function(index, element){
                    
//                    alert(liRestWidth+" "+index+" "+margen+" "+liHoverWidth);
                    
                    if($(this).data('index') != $this.data('index')){
                        TweenMax.killTweensOf($(this));
                        TweenMax.killTweensOf($(this).find('> div'));

                        if($(this).data('index') < $this.data('index'))
                            TweenMax.to($(this), time, {clip:'rect(0px,'+liRestWidth+'px,'+liHeight+'px,0px)', x:liRestWidth*index + index*margen,  ease: Ease});
                        else
                            TweenMax.to($(this), time, {clip:'rect(0px,'+liRestWidth+'px,'+liHeight+'px,0px)', x:(liRestWidth*(index-1)) + liHoverWidth +index*margen,  ease: Ease});

                        TweenMax.to($(this).find('> div'), time, {x:-((imagen_ancho - liRestWidth) / 2 ), ease: Ease });
                        //TweenMax.to($(this).find('> .box-contact.right .close'), time, {x:((sizes[liNum].width*liCoef - liRestWidth) / 2 ), ease: Ease})
                    }
                });

                
            });


            $contenedor.find('li.servicio_bloque').on('mouseleave', function(e){
                var Ease = Quad.easeOut;
                var time = .3;
                var Delay = 0.00;
                var $this = $(this);

                TweenMax.killTweensOf($(this));
                TweenMax.killTweensOf($(this).find('> div'));
                TweenMax.to($(this), time, {clip:'rect(0px,'+liAncho+'px,'+liHeight+'px,0px)', x: $this.data('index') * liAncho + $this.data('index')*margen, ease: Ease, delay:Delay, overwrite:'all'});
                TweenMax.to($this.find('> div'), time, {x:-((imagen_ancho - liAncho) / 2 ), ease: Ease});
                
                TweenMax.to($(this).find(".servicio_bloque_hover"), 0 , {display:"none",  ease: Ease, delay:Delay, overwrite:'all'});
                TweenMax.to($(this).find(".btn_servicio"), time, {bottom: 30, ease: Ease});
                TweenMax.to($(this).find(".btn_servicio"), time, { css:{ backgroundColor:"rgba(0, 0, 0, 0.5)",border:"0px solid"}});
                
                //TweenMax.to($this.find('.overlay'), time, {backgroundColor:'rgba(0,0,0,.6)', ease: Linear.easeNone, delay:Delay, overwrite:'all', })
                $contenedor.find('li.servicio_bloque').each(function(index, element){
                    if($(this).data('index') != $this.data('index')){
                        TweenMax.killTweensOf($(this));
                        TweenMax.killTweensOf($(this).find('> div'));
                        TweenMax.to($(this), time, {clip:'rect(0px,'+liAncho+'px,'+liHeight+'px,0px)', x:liAncho*index + index*margen,  ease: Ease, delay:Delay, overwrite:'all'});
                        TweenMax.to($(this).find('> div'), time, {x:-((imagen_ancho - liAncho) / 2 ), ease: Ease})
                        
                        
                    }
                })
            });

/*
            $contenedor.find('li').on('mouseup', function(e){
                if($(this).closest('ul').find('.box-contact').length){ // pokud kontakty
                    $(this).trigger('mouseleave');
                }
            });
*/
        };

        var poner_sombra = function(element){
            //element.css({'transform': '', '-webkit-transform': ''})
            //resize();
            element.find('.servicio_bloque_hover').show();
        }
        
        var borrar_sombra = function(element){
            //element.css({'transform': '', '-webkit-transform': ''})
            //resize();
            element.find('.servicio_bloque_hover').hide();
        }

        $(window).on('resize', resize);
        resize();
        addListeners();
    }  

        
    $("#contenedor_servicio").sliderZayma();      

    
    
}( jQuery ));