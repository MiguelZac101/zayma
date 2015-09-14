<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
            <h1>
                <?php
                echo $categoria['nombre'];
                ?>
            </h1>
            <?php
            if(!empty($destacado)){
            ?>
            <div class="contenedor_articulo_destacado">
                <a class="articulo_destacado" href="<?php echo base_url($blog_url.'/'.$categoria_url.'/'.$destacado['url']); ?>" title="<?php echo $destacado['titulo']; ?>">
                    <img src="<?php echo base_url($destacado['imagen']); ?>" alt="" class="img-responsive"/>
                    
                    <div class="titulo">
                        <?php echo $destacado['titulo']; ?>
                    </div>
                </a>
                <div class="descripcion">
                    <?php echo $destacado['descripcion']; ?>
                </div>
            </div>
            <?php
            }
            ?>
            
            <div class="contenedor_articulos">
                <?php	  
    if(count($articulos) > 0) {							
        foreach($articulos as $articulo) { 
    ?>	
                <article>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <img src="<?php echo base_url($articulo['imagen']); ?>" alt="" class="img-responsive"/>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            <div class="fecha">                              
                                <?php echo fechaMysqlABlog($articulo['fecha']); ?>                    
                            </div>
                            <a href="<?php echo base_url($blog_url.'/'.$categoria_url.'/'.$articulo['url']);?>" class="titulo" title="<?php echo $articulo['titulo']; ?>">
                                <?php echo $articulo['titulo']; ?> 
                            </a>
                            <div class="contenido">
                                <?php echo $articulo['descripcion']; ?>
                            </div>
                        </div>
                    </div>
                </article>
                <?php 
    
        } 
    }
    else {
    ?>
        <div class="text-center">
            Ningun resgistro encontrado
        </div> 
        <?php
    }
    ?>

            </div>
            <div class="text-center">
                <?php echo $page_links; ?>
            </div>
            
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
            <?php
//                $this->load->view("opinion_editor");
            echo $opinion_editor; 
            echo $opinion_colaborador;  
//                $this->load->view("opinion_colaboradores");
            ?>
        </div>
    </div>
</div>
    