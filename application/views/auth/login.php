<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login CPanel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- fonts -->
        <link href="http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic" rel="stylesheet" type="text/css">
        <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('plugins/font-awesome-4.4.0/css/font-awesome.css'); ?>" rel="stylesheet" type="text/css">       
        <!-- css -->
        <link href="<?php echo base_url('plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
        
        <link href="<?php echo base_url('css/admin.css'); ?>" rel="stylesheet" type="text/css">
    </head>
    <body>
        <!-- Login [Start] -->
        <div style="display: table; width: 100%; height: 100%;">
            <div style="display: table-cell; vertical-align: middle;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <div id="message"></div>
                            <form name="form_login" role="form" class="panel panel-default">
                                <fieldset class="panel-body">
                                    <legend>CPanel - <?php echo $this->config->item('empresa_nombre');?></legend>
                                    <div class="form-group has-feedback">
                                        <label for="email">Correo</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Correo" value=""> 
                                        <span class="ion-person form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="password">Contraseña</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" value="">                                        
                                        <span class="ion-unlocked form-control-feedback"></span>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary btn-block" >Iniciar Sesión</button>
                                        <!--<input type="submit" name="btn_login" value="Iniciar Sesión" class="btn btn-primary btn-block">-->
                                    </div>
                                </fieldset>
                            </form>
                            <div class="text-center">
                                <p><?php echo $this->config->item('web_copyright');?></p>
                                <p><?php echo $this->config->item('web_powered');?></p>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
        <!-- Login [End] -->
        
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('plugins/bootstrap/js/bootstrap.js'); ?>"></script>
        <script src="<?php echo base_url('js/base_url.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('js/default.js'); ?>" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url('js/auth.js'); ?>"></script>     
    </body>
</html>

