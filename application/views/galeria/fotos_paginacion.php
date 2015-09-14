<div id="galeria_fotos_result">
    <div class="galeria_fotos_contenedor">
        <div class="row">
            <?php
            foreach ($registros as $value) {
            ?>
            <div class="col-xs-12 col-sm-6 col-sm-6 col-lg-4">
                <!--<img src="<?php echo base_url($value['imagen']); ?>" alt="<?php echo $value['titulo']; ?>" class="img-responsive">--> 
                
                 <a title="<?php echo $value['titulo']; ?>" class="bloque_opinion" href="" data-toggle="modal" data-target="#fotoModal<?php echo $value['id']; ?>">
                    <img class="img-responsive" alt="" src="<?php echo base_url($value['imagen']); ?>">
                    <div class="info">                                        
                        <?php echo $value['titulo']; ?>                                                                 
                    </div>
                </a>

                <div class="modal fade" id="fotoModal<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="videoModal<?php echo $value['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                                <div>
                                    <img class="img-responsive" alt="" src="<?php echo base_url($value['imagen']); ?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <?php
            }
            ?>
    <!--        <div class="col-xs-4">
                <img src="http://lorempixel.com/360/250" alt="xxx" class="img-responsive"> 
            </div>
            <div class="col-xs-4">
                <img src="http://lorempixel.com/360/250" alt="xxx" class="img-responsive"> 
            </div>-->
        </div>
    </div>
    <div class="galeria_fotos_contenedor_paginacion text-right">
        <?php echo $page_links; ?>
    </div>
</div>
