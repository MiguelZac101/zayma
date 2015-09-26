$(document).ready(function(){
    //ANCHO DEL SCROLL
    $.scrollbarWidth=function(){var a,b,c;if(c===undefined){a=$('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo('body');b=a.children();c=b.innerWidth()-b.height(99).innerWidth();a.remove()}return c};
//    alert($.scrollbarWidth());
//    
    //COMBOS LISTA DE PRODUCTOS
    $("#producto_combo_1 .selectOptions .selectOption").click(function(){
        var dominio = base_url+$(this).data("url")+"/";
	window.location.href=dominio;
    });

    /* smooth scrolling sections */

    $('#navegacion a[href*=#]:not([href=#])').click(function () {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({scrollTop: target.offset().top}, 500);
                console.log(target.offset().top);
                return false;
            }
        }
    });
  
    //poner mas arriba el navegador si sobrepasa su posicion
    if($('#navegacion').length){
        var altura = $('#navegacion').offset().top;    
        $(window).on('scroll', function(){
            if ( $(window).scrollTop() > 65 ){
                $('#navegacion').addClass('navegacion_posicion_top');
                $('#navegacion').removeClass('navegacion_posicion_standar');
            } else {
                $('#navegacion').addClass('navegacion_posicion_standar');
                $('#navegacion').removeClass('navegacion_posicion_top');
            }
        });
    }
    
    
    //MENU

    var animRunning = false;
    var $header = $('#menu');
    $('html,body').scrollTop(0);
    $('> div', $header).width($(window).width()); 
        
    // Open Header
    $('.btn-menu').on('click', function(){
        if(!animRunning){
            animRunning = true;
            
            $header.css('display','block');
            setTimeout(function(){ $header.addClass('opened'); }, 100);
            setTimeout(function(){
                    $('.redes_sociales', $header).addClass('loaded');
                    setTimeout(function(){
                            $('.datos_contacto', $header).addClass('loaded');                            
                    }, 100);
            }, 950);
            setTimeout(function(){ animRunning = false; }, 750);
        }

        return false;
    });

    // Close Header
    $('a.btn-menu-cerrar').on('click', function(event){
        event.preventDefault();
       
//        if((event.target.tagName != 'A' && $(event.target).parents('a').length == 0) || (event.target.tagName == 'A' && $(event.target).hasClass('btn-menu'))){
            if(!animRunning){
                animRunning = true;
                 
                $header.addClass('leaving');
                setTimeout(function(){
                        $header.removeClass('leaving').removeClass('opened');
                        $('.redes_sociales', $header).removeClass('loaded');
                        $('.datos_contacto', $header).removeClass('loaded');
                        animRunning = false;	
                }, 1250);
            }

            return false;
//        }
    });
    
    $(window).resize(function(){       
        scrollContent();        
    }).scroll(function(){	
	scrollContent();
    });   
    
    function scrollContent(){
        $('> div', $header).width($(window).width()); 
    }
//VIDEO HOME
    $('a.bloque_video_youtube').on('click',function (e) {
        e.preventDefault();
        e.stopPropagation();
        //var src = 'http://www.youtube.com/v/FSi2fJALDyQ&amp;autoplay=1';
        var src = $(this).attr('data-video');
        
        $('#videoModal iframe').attr('src', src);
        $('#videoModal').modal('show');
        
    });

    $('#videoModal').on('hidden.bs.modal', function (e) {
        //$('#videoModal iframe').removeAttr('src');
        $('#videoModal iframe').attr('src', "");
    });

//PRODUCTOS COMBO
    $("#combo_producto_grupo a.combo_zayma_cabecera").menuzac({
        id_cuadromenu: '#combo_producto_grupo ul.combo_zayma_submenu',
        tiempo: 100
    });
    $("#combo_producto_categoria a.combo_zayma_cabecera").menuzac({
        id_cuadromenu: '#combo_producto_categoria ul.combo_zayma_submenu',
        tiempo: 100
    });
    $("#combo_producto_subcategoria a.combo_zayma_cabecera").menuzac({
        id_cuadromenu: '#combo_producto_subcategoria ul.combo_zayma_submenu',
        tiempo: 100
    }); 
    
    //ancho de google map
    var ancho_ventana = $(window).width();// - $.scrollbarWidth();
    $("#mapa_zayma").css("width",ancho_ventana);
    
//    var margen_lado = (1600 - ancho_ventana)/2;
//    $("#mapa_zayma").css("margin-left",- margen_lado);
////    $("#mapa_zayma").css("margin-right",margen_lado);
//    var  nuevo_ancho = 1600 - 2*margen_lado;
//    $("#mapa_zayma").css("width",nuevo_ancho);

    /*  MENU  */
    $("#menu .btn_menu").hover(function(){
        $(this).removeClass("btn_menu_borde"); 
    });
    $("#menu .btn_menu").mouseleave(function(){
        var puntero = $(this);
        setTimeout(
            function(){
                puntero.addClass("btn_menu_borde");
            }
            , 550);
        
    });
    
    //CAGAR CARRUSEL NOVEDADES
    $("a.novedad").click(function(e){
        e.preventDefault();
        var id_novedad = $(this).data("id"); 
        $("#novedades_carrusel_contenedor").css("opacity",.25);
        $("#novedades_descripcion").css("opacity",.25);
        $.post(base_url+"frontend_ajax/novedad_carrusel",{"id_novedad":id_novedad},function(data){            
            $("#novedades_carrusel_contenedor").html(data.carrusel);            
            $("#novedades_descripcion").html(data.descripcion);
            
            $("#novedades_carrusel_contenedor").css("opacity",1);
            $("#novedades_descripcion").css("opacity",1);
            
            var target = $("#seccion_novedades");            
            $('html,body').animate({
                scrollTop: target.offset().top - $("#menu_top").height()
            }, 1000);
            
        },"json");
    });
    
    //CARGAR DETALLE PROMOCION
    $("a.promocion").click(function(e){
        e.preventDefault();
        var id_promocion = $(this).data("id"); 
        $("#promocion_detalle_contenedor_ajax").css("opacity",.25);
        
        $.post(base_url+"frontend_ajax/promocion_detalle",{"id_promocion":id_promocion},function(data){            
            $("#promocion_detalle_contenedor_ajax").html(data); 
            $("#promocion_detalle_contenedor_ajax").css("opacity",1);
            
            var target = $("#promocion_detalle_contenedor_ajax");            
            $('html,body').animate({
                scrollTop: target.offset().top - $("#menu_top").height()
            }, 1000);
        });
    });
});

