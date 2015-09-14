<?php
//echo "testimonio view";
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
            
            <h1>Testimonio</h1>  
            <img src="<?php echo base_url($testimonio['imagen']); ?>" alt="<?php echo $testimonio['autor']; ?>" class="img-responsive">
            <br/>
                      
            <div>
                <?php echo $testimonio['contenido']; ?>
            </div>
            <br/>
            
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
            <?php
//                $this->load->view("opinion_editor");
//                
//                $this->load->view("opinion_colaboradores");
            echo $opinion_editor;
            echo $opinion_colaborador;
            ?>
        </div>
    </div>
</div>          
            
            
