$(document).ready(function(){
    
//    SELECT DE CONTACTO
//    function enableSelectBoxes() {
//        $('div.selectBox').each(function () {
//            //$(this).children('span.selected').html($(this).children('div.selectOptions').children('span.selectOption:first').html());
////            $(this).attr('value', $(this).children('div.selectOptions').children('span.selectOption:first').attr('value'));
//
//            $(this).children('span.selected,span.selectArrow').click(function () {
//                if ($(this).parent().children('div.selectOptions').css('display') == 'none') {
//                    $(this).parent().children('div.selectOptions').css('display', 'block');
//                }
//                else
//                {
//                    $(this).parent().children('div.selectOptions').css('display', 'none');
//                }
//            });     
//
//            
//            $(this).parent().children('div.selectOptions').mouseout(function () {
//                alert("salio del cuadro");
//            });
//
//            $(this).find('span.selectOption').click(function () {
//                $(this).parent().css('display', 'none');
//                $(this).closest('div.selectBox').attr('data-id', $(this).data('id'));
////                alert($(this).data('id'));
//                $(this).parent().siblings('span.selected').html($(this).html());
//            });
//        });
//    }
//    
//    enableSelectBoxes();
    
    
    
    //COMBOS LISTA DE PRODUCTOS
    $("#producto_combo_1 .selectOptions .selectOption").click(function(){
        var dominio = base_url+$(this).data("url")+"/";
	window.location.href=dominio;
    });

    /* smooth scrolling sections */
    $('a[href*=#]:not([href=#])').click(function () {
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
            if ( $(window).scrollTop() > altura ){
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
                    $('.secondary-links', $header).addClass('loaded');
                    setTimeout(function(){
                            $('.secondary-links .btn-shop', $header).addClass('loaded');
                            setTimeout(function(){
                                    $('.secondary-links .btn-follow', $header).addClass('loaded');
                            }, 250);
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
                        $('.secondary-links', $header).removeClass('loaded');
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

});

