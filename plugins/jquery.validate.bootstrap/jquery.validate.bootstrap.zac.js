(function($) {
  $.validator.setDefaults({
        errorClass: "text-danger",
        validClass: "success",
        errorElement: "p",
        wrapper: "",
        errorPlacement: function (error, element) {
            error.appendTo(element.parents(".form-group"));
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
            $(element).parents(".form-group").addClass("has-error");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
            $(element).parents(".form-group").removeClass("has-error");
        }

  });

  $.validator.messages = ({
    required: "Este campo no puede ir vacio",
    remote: 'needs to get fixed',
    email: 'El email que ingreso no es valido.',
    url: 'No es una URL valido',
    date: 'No es una fecha',
    dateISO: 'is not a valid date (ISO)',
    number: 'No es un numero valido.',
    digits: 'necesita ser digitos',
    creditcard: 'is not a valid credit card number',
    equalTo: 'is not the same value again',
    accept: 'is not a value with a valid extension',
    maxlength: jQuery.validator.format('Se permite maximo {0} caracteres'),
    minlength: jQuery.validator.format('Como minimo debe ingresar {0} caracteres'),
    rangelength: jQuery.validator.format('Se necesita que el valor se encuentre entre {0} y {1} numero de caracteres.'),
    range: jQuery.validator.format('Necesita ser un valor entre {0} y {1}'),
    max: jQuery.validator.format('Necesita ser un valor menor o igual a {0}'),
    min: jQuery.validator.format('Necesita ser un valor mayor o igual a {0}')
  });
  
    jQuery.validator.addMethod("url_youtube", function (value, element) {
        // allow any non-whitespace characters as the host part
        //return this.optional(element) || /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/.test(value);
        return this.optional(element) || /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/.test(value);
        //https://www.youtube.com/watch?v=OCNnljBcM6E
    }, 'Please enter a valid email address.');

  
})(jQuery);