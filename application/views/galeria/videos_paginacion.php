<div id="galeria_videos_result">
    <div class="galeria_videos_contenedor">
        <div class="row">
            <?php
            foreach ($registros as $value) {
            ?>
            <div class="col-xs-12 col-sm-6 col-sm-6 col-lg-4"> 
                <a href="#" class="bloque_video_youtube" data-toggle="modal" data-target="#videoModal<?php echo $value['id']; ?>" data-theVideo="http://www.youtube.com/embed/<?php echo $value['codigo_youtube']; ?>?html5=1" >
                    <img src="http://i.ytimg.com/vi/<?php echo $value['codigo_youtube']; ?>/hqdefault.jpg" alt="<?php echo $value['titulo']; ?>" class="img-responsive">
                    <i class="fa fa-youtube-play"></i>
                    <p>
                        <?php echo $value['titulo']; ?>
                    </p>
                </a>

                
            </div>
            <?php
            }
            ?>  
        </div>
    </div>
    <div class="galeria_videos_contenedor_paginacion text-right">
        <?php echo $page_links; ?>
    </div>
</div>

<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <div>
                    <!--<iframe width="100%" height="350" src="http://www.youtube.com/embed/<?php echo $value['codigo_youtube']; ?>"></iframe>-->

                    <div class="embed-responsive embed-responsive-4by3">
                        <!--<iframe class="embed-responsive-item" src="http://www.youtube.com/embed/<?php echo $value['codigo_youtube']; ?>?html5=1"></iframe>-->
                        <iframe class="embed-responsive-item" src=""></iframe>
                        
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('a.bloque_video_youtube').on('click',function (e) {
            e.preventDefault();
            //var src = 'http://www.youtube.com/v/FSi2fJALDyQ&amp;autoplay=1';
            var src = $(this).attr('data-theVideo');

            $('#videoModal').modal('show');
            $('#videoModal iframe').attr('src', src);
        });

    //    $('#videoModal button').click(function () {
    //        $('#videoModal iframe').removeAttr('src');
    //    });

        $('#videoModal').on('hidden.bs.modal', function (e) {
            $('#videoModal iframe').removeAttr('src');
        });
    });

</script>