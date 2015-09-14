<section id="galeria">     
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>
                    Fotos
                </h1>

                <div id="galeria_fotos">
<!--cargado con js-->
                </div>
                <br/>

            </div>
            
            <div class="col-xs-12">
                <h1>
                    Videos
                </h1>

                <div id="galeria_videos">
                    <!--cargado con js-->
                </div>            
            

        </div>

    </div>
</section>

<!-- <a href="#" class="btn btn-default" data-toggle="modal" data-target="#videoModal" data-theVideo="http://www.youtube.com/embed/loFtozxZG0s" >VIDEO</a>
 
 <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div>
          <iframe width="100%" height="350" src="http://www.youtube.com/embed/loFtozxZG0s"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>-->

<script>
//    $(document).ready(function(){
//        $('.view-first').bind('touchstart touchend', function(e){    
//            $(this).trigger('hover');
//            
//        });
//    });
    //MIGUEL ZAC
//27/07/15
//COLECCION - PAGINADO

 //paginacion fotos   
    function bindClicks() {
        $("ul#pagination_fotos li a").click(paginationClick);		
    }

    function paginationClick(e) { 
        e.preventDefault();
        var href = $(this).attr('href');
        pagination(href);
    }
    
    function pagination(href){
        $("#galeria_fotos_result").css("opacity","0.4");
//        var data_presupuesto = $("form[name=form_presupuesto]").serialize();
        //NECESITO SABER QUE COLECCION ES????        
        $.ajax({
            type: "POST",
            url: href,			
            data: {},
            success: function(response)
            {				
//              alert("pagination : "+response);
                $("#galeria_fotos_result").css("opacity","1");
                $("#galeria_fotos").html(response);
                bindClicks();
            }
        });

        return false;
    }

    bindClicks();
    pagination("<?php echo base_url(); ?>galeria/fotos_paginacion/1");
    
    
 //paginacion videos  
    function bindClicks2() {
        $("ul#pagination_videos li a").click(paginationClick2);		
    }

    function paginationClick2(e) { 
        e.preventDefault();
        var href = $(this).attr('href');
        pagination2(href);
    }
    
    function pagination2(href){
        $("#galeria_videos_result").css("opacity","0.4");
//        var data_presupuesto = $("form[name=form_presupuesto]").serialize();
        //NECESITO SABER QUE COLECCION ES????        
        $.ajax({
            type: "POST",
            url: href,			
            data: {},
            success: function(response)
            {				
//                alert("pagination : "+response);
                $("#galeria_videos_result").css("opacity","1");
                $("#galeria_videos").html(response);
                bindClicks2();
            }
        });

        return false;
    }

    bindClicks2();
    pagination2("<?php echo base_url(); ?>galeria/videos_paginacion/1");
    
    
</script>