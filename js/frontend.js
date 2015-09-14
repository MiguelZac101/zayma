$(document).ready(function(){
    
//    SELECT DE CONTACTO
    function enableSelectBoxes() {
        $('div.selectBox').each(function () {
            $(this).children('span.selected').html($(this).children('div.selectOptions').children('span.selectOption:first').html());
            $(this).attr('value', $(this).children('div.selectOptions').children('span.selectOption:first').attr('value'));

            $(this).children('span.selected,span.selectArrow').click(function () {
                if ($(this).parent().children('div.selectOptions').css('display') == 'none') {
                    $(this).parent().children('div.selectOptions').css('display', 'block');
                }
                else
                {
                    $(this).parent().children('div.selectOptions').css('display', 'none');
                }
            });

            $(this).find('span.selectOption').click(function () {
                $(this).parent().css('display', 'none');
                $(this).closest('div.selectBox').attr('value', $(this).attr('value'));
                $(this).parent().siblings('span.selected').html($(this).html());
            });
        });
    }
    
    enableSelectBoxes();
    

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
    
});

