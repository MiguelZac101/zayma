$(function ()
{
    //inputs
    $('#email').focus(function () { $('.ion-person').css('color', '#66afe9');});
    $('#email').focusout(function () { $('.ion-person').css('color', '#ccc'); });
    $('#password').focus(function () { $('.ion-unlocked').css('color', '#66afe9'); });
    $('#password').focusout(function () { $('.ion-unlocked').css('color', '#ccc'); });
    //buttons
    $('form[name=form_login] button').click(function(e){
        var form = $("form[name=form_login]");
        var btn = $(this);
        
        var texto_inicial = btn.html(); 
        var loading = '<div class="preload"><i class="fa fa-spinner fa-pulse fa-fw"></i></div>';
        btn.html(loading);
                
        $.post( base_url + 'auth/login_user', form.serialize(),function (data) {
            btn.html(texto_inicial);
            $('#message').html(data.mensaje);
            $('#message').fadeIn(500);            
            
            if (data.result == 1){         
                //redireccionar
                setTimeout("redirect('admin/')", 2000);
                
            }else if(data.result == 0){
                             
            }           
        },"json");
    });    

    
    $('#password,#email').keyup(function(event) {
        if (event.which === 13) {
            $('form[name=form_login] button').trigger("click");
        }
    });
});


//function logOut()
//{
//    var url = baseURL + 'cpanel/ajaxLogOut';
//    jqueryAjax(url, 'POST', '', 'text', false, '');
//    href('admin');
//}
