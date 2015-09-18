/*
autor : miguel angel quispe zacarias
ejemplo de uso

$('#support-link').menuzac({id_cuadromenu:'#support-menu'});

*/
!function(n){n.fn.menuzac=function(o){defaults={tiempo:800,id_cuadromenu:""};var o=n.extend({},defaults,o);this.each(function(){var i,e=n(this),t=n(o.id_cuadromenu),u=o.tiempo,c=function(o){o.stopPropagation(),e.addClass("activo"),t.show(),e.unbind("click"),e.bind("click",a),e.bind("mouseleave",s),n("body").bind("click",a)},a=function(o){try{o.stopPropagation()}catch(u){}e.removeClass("activo"),t.hide(),e.unbind("click"),e.bind("click",c),e.unbind("mouseleave",s),e.unbind("mouseenter",d),n("body").unbind("click"),clearTimeout(i)},s=function(n){try{n.stopPropagation()}catch(o){}e.bind("mouseenter",d),i=setTimeout(function(){a()},u)},d=function(n){n.stopPropagation(),e.unbind("mouseenter",d),clearTimeout(i)},r=function(n){n.stopPropagation(),t.unbind("mouseleave",r),i=setTimeout(function(){a()},u)},m=function(n){n.stopPropagation(),clearTimeout(i),t.bind("mouseleave",r)};e.mouseenter(c),t.bind("mouseenter",m),t.click(function(n){n.stopPropagation()})})}}(jQuery);
