<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CPanel - <?php echo $this->config->item('empresa_nombre')?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- fonts -->
        <link href="http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic" rel="stylesheet" type="text/css">
        <!--<link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">-->
        <link href="<?php echo base_url('plugins/font-awesome-4.4.0/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">       
        
        <!-- css -->
        <link href="<?php echo base_url('plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
                
        <link href="<?php echo base_url('plugins/bootstrap-fileinput-master/css/fileinput.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('css/admin.css'); ?>" rel="stylesheet" type="text/css">
        
        <link rel="stylesheet" href="http://css-spinners.com/css/spinners.css" type="text/css">
        
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url('plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
        
        <script type="text/javascript" src="<?php echo base_url('plugins/bootstrap-fileinput-master/js/fileinput.min.js'); ?>"></script>
               
        
        <script src="<?php echo base_url('plugins/jquery-validation-1.14.0/dist/jquery.validate.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('plugins/jquery-validation-1.14.0/dist/additional-methods.min.js'); ?>" type="text/javascript" ></script> 
        
        <script src="<?php echo base_url('plugins/jquery.validate.bootstrap/jquery.validate.bootstrap.zac.js'); ?>" type="text/javascript"></script>
        
        
        <!--wysihtml5-->
<!--        <script type="text/javascript" src="<?php echo base_url('plugins/wysiwyg/wysihtml5-0.3.0.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('plugins/wysiwyg/bootstrap-wysihtml5.js'); ?>"></script>
         <link href="<?php echo base_url('plugins/wysiwyg/bootstrap-wysihtml5.css'); ?>" rel="stylesheet" type="text/css">-->
         
        <!--bootstrap datepicker-->
<!--        <script type="text/javascript" src="<?php echo base_url('plugins/bootstrap-datepicker/bootstrap-datepicker.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('plugins/bootstrap-datepicker/language/bootstrap-datepicker.es.js'); ?>"></script>     
        
        <link href="<?php echo base_url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css'); ?>" rel="stylesheet" type="text/css">-->
        
        <script src="<?php echo base_url(); ?>plugins/jquery_anexgrid/jquery.anexgrid.js"></script>
        
        
        <script type="text/javascript" src="<?php echo base_url('js/base_url.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/admin.js'); ?>"></script>
   
    </head>
    <body>
        <div id="preloader" >

            <div class="throbber-loader">
                Loading…
            </div>
        </div>
        <header>
            <nav class="navbar navbar-inverse navbar-fixed-top container-fluid" style="background-color: #353f47;">
                <div class="nav-row">
                    <div class="navbar-header">
                        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="<?php echo base_url('admin/home/listado'); ?>" class="navbar-brand">
                            <img src="<?php echo base_url(); ?>images/logo.jpg" alt=""/>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a tabindex="0" data-toggle="dropdown">
                                    Home <i class="fa fa-angle-down fa-fw"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
<!--                                    <li>
                                        <a href="<?php echo base_url('admin/noticia_categoria/listado'); ?>" tabindex="0">
                                            <i class="fa fa-book fa-fw"></i> 
                                            Categorias
                                        </a>
                                    </li>
-->                                    <li>
                                        <a href="<?php echo base_url('admin/home/listado'); ?>" tabindex="0">
                                            <i class="fa fa-file-text-o"></i> 
                                            Contenido
                                        </a>
                                    </li>
<!--                                    <li class="divider"></li>-->
<!--                                    <li>
                                        <a href="<?php echo base_url('admin/home_carrusel/listado'); ?>" tabindex="0">
                                            <i class="fa fa-image fa-fw"></i> 
                                            Carrusel
                                        </a>
                                    </li>-->
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a tabindex="0" data-toggle="dropdown">
                                    Productos <i class="fa fa-angle-down fa-fw"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="<?php echo base_url('admin/producto_categoria/listado'); ?>" tabindex="0">
                                            <i class="fa fa-book fa-fw"></i> 
                                            Categorias
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('admin/producto_subcategoria/listado'); ?>" tabindex="0">
                                            <i class="fa fa-file-text-o"></i> 
                                            Subcategorias
                                        </a>
                                    </li>                                  
                                    <li>
                                        <a href="<?php echo base_url('admin/producto/listado'); ?>" tabindex="0">
                                            <i class="fa fa-image fa-fw"></i> 
                                            Productos
                                        </a>
                                    </li>
                                </ul>
                            </li>  
                            <li class="dropdown">
                                <a tabindex="0" data-toggle="dropdown">
                                    Novedades <i class="fa fa-angle-down fa-fw"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="<?php echo base_url('admin/novedad/listado'); ?>" tabindex="0">
                                            <i class="fa fa-book fa-fw"></i> 
                                            Listado
                                        </a>
                                    </li>                                   
                                </ul>
                            </li>  
                            <li class="dropdown">
                                <a tabindex="0" data-toggle="dropdown">
                                    Promociones <i class="fa fa-angle-down fa-fw"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="<?php echo base_url('admin/promocion/listado'); ?>" tabindex="0">
                                            <i class="fa fa-book fa-fw"></i> 
                                            Listado
                                        </a>
                                    </li>                                   
                                </ul>
                            </li>
                           
                            <li class="dropdown">
                                <a tabindex="0" data-toggle="dropdown">
                                    <i class="fa fa-user" style="margin-right: 10px;"></i>

                                    <!--<i class="ion-person fa-fw" style="margin-right: 10px;"></i>--> 
                                    <?php echo $this->session->userdata("admin_nombre"); ?>
                                    <i class="fa fa-angle-down fa-fw"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="<?php echo base_url()."auth/logout";?>" tabindex="0"><i class="fa fa-power-off fa-fw"></i> Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </nav>
        </header>
