<div class="container-fluid hidden-xs">
    <div class="row">
        <div id="slider">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false" style="text-align: center">

                <ol class="carousel-indicators">
                    <?php
                    $activo = true;
                    $clase_activo = "";
                    $indice = -1;
                    
                    foreach($registros as $row){
                        $indice++;
                        $clase_activo = "";
                        if($activo){
                            $activo = false;
                            $clase_activo = "active";
                        }
                    ?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $indice; ?>" class="<?php echo $clase_activo; ?>"></li>                    
                    <?php
                    }
                    ?>
<!--                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>-->
<!--                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>-->
                </ol>


                <div class="carousel-inner" role="listbox">
                    <?php
                    $activo = true;
                    $clase_activo = "";
                    
                    foreach($registros as $row){
                        $clase_activo = "";
                        if($activo){
                            $activo = false;
                            $clase_activo = "active";
                        }
                    ?>
                    <a class="item <?php echo $clase_activo; ?>" href="<?php echo $row['url']; ?>" title="<?php echo $row['titulo'];?>" target="_blank">
                        <img src="<?php echo base_url($row['imagen']);?>" alt="" height="" class=""/>                      
                        <div class="carousel-caption">
                            <?php echo $row['titulo'];?>
                        </div>
                    </a>
                    <?php
                    }
                    ?>
                    
<!--                    <div class="item active">
                        <img src="http://lorempixel.com/1920/450/business/1" alt="" height="" class=""/>                      
                        <div class="carousel-caption">
                            carousel-caption
                        </div>
                    </div>
                    <div class="item">
                        <img src="http://lorempixel.com/1920/450/business/2" alt="" height="" class=""/> 
                        <div class="carousel-caption">
                            carousel-caption
                        </div>
                    </div>
                    <div class="item">
                        <img src="http://lorempixel.com/1920/450/business/3" alt="" height="" class=""/> 
                        <div class="carousel-caption">
                            carousel-caption
                        </div>
                    </div>-->

                </div>

                <!--              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                              </a>
                              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                              </a>-->
            </div>
        </div>
    </div>
</div>