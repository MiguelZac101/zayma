<div id="wrapper">
    <section>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">                      

                            <div class="col-xs-12">
                                <?php echo $titulo_modulo; ?> - Listado
                            </div>
                           
                        </div>
                    </div>

                    <div class="panel-body">
<!--                       <div class="panel panel-default">
                                <div class="panel-body text-right">
                                    <a class="btn btn-default" href="<?php echo base_url(); ?>noticia_categoria/nuevo/" role="button" title="Testimonio Nuevo">Nuevo</a>
                                </div>
                            </div>-->
                        <div id="list"></div>                           


                    </div>
                </div>
            </div>
            <div class="col-xs-12" id="cargar_ajax">
                <?php echo $pagina;?>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function () {
        var agrid = $("#list").anexGrid({
            class: 'table-striped table-bordered table-condensed',
            columnas: [            
                {leyenda: 'Titulo', style: '', class: '', columna: 'titulo'},
                {leyenda: 'URL', style: '', columna: 'url'},               
                {style: 'width:48px;'}
            ],
            modelo: [              
                {propiedad: 'titulo'},    
                {propiedad: 'url'},                
                {formato: function (tr, obj, celda) {
                        return anexGrid_boton({
                            class: 'btn btn-primary btn-sm btn-editar',
                            contenido: '<i class="fa fa-pencil-square-o fa-fw"></i>',
                            value: tr.data('fila'),
                            attr: [
                                'title="Editar"'
                            ]
                        });
                    }}
               
            ],
            url: '<?php echo base_url(); ?>admin/<?php echo $funcion_nombre; ?>/anexgrid',
            paginable: false,
//                    filtrable: true,
            limite: [10, 20, 50],
            columna: 'id',
            columna_orden: 'ASC'
        });

        agrid.tabla().on('click', '.btn-editar', function (e) {
            e.preventDefault();
            //if(!confirm('¿Esta seguro de eliminar este registro?')) return;

            /* Obtiene el objeto actual de la fila seleccionada */
            var fila = agrid.obtener($(this).val());
            $("#preloader").show();
            /* Petición ajax al servidor */
            $.post('<?php echo base_url(); ?>admin/<?php echo $funcion_nombre; ?>/editar', {
                id: fila.id
            }, function (data) {                
                $("#cargar_ajax").html(data);
                $("#preloader").hide();
            });

            return false;
        });

    })
</script>       

<script src="<?php echo base_url(); ?>plugins/jquery_anexgrid/jquery.anexgrid.js"></script>
