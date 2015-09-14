<div id="wrapper">
    <section>
        <div class="row">
            <div class="col-xs-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">                      

                            <div class="col-sm-6">
                                Editor Listado
                            </div>
                            <div class="col-sm-6 text-right">
<!--                                    <a title="Nuevo" role="button" href="<?php echo base_url('admin/editor/nuevo') ?>" class="btn btn-default btn-xs btn-success">
                                    Nuevo
                                </a>-->
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
<!--                       <div class="panel panel-default">
                                <div class="panel-body text-right">
                                    <a class="btn btn-default" href="<?php echo base_url(); ?>editor/nuevo/" role="button" title="Testimonio Nuevo">Nuevo</a>
                                </div>
                            </div>-->
                        <div id="list"></div>                           


                    </div>
                </div>
            </div>
            <div class="col-md-4" id="cargar_ajax">
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
                {leyenda: 'Nombre', style: '', class: '', columna: 'nombre'},
//                {leyenda: 'Descripcion', style: '', columna: 'descripcion'},
//                {style: 'width:48px;'},        
                {style: 'width:48px;'}
            ],
            modelo: [
                {propiedad: 'nombre'},

//                {formato: function (tr, obj, celda) {
//                        return anexGrid_boton({
//                            class: 'btn btn-danger btn-sm btn-eliminar',
//                            contenido: '<i class="fa fa-trash-o fa-fw"></i>',
//                            value: tr.data('fila'),
//                            attr: [
//                                'title="Eliminar"'
//                            ]
//                        });
//                    }},
                {formato: function (tr, obj, celda) {
//                        return anexGrid_link({
//                            class: 'btn btn-primary btn-sm btn-editar',
//                            contenido: '<i class="fa fa-pencil-square-o fa-fw"></i>',
//                            href: '<?php echo base_url(); ?>admin/editor/editar' ,
//                            attr: [
//                                'title="Editar"'
//                            ]
////                               
//                        });
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
            url: '<?php echo base_url(); ?>admin/editor/anexgrid',
            paginable: true,
//                    filtrable: true,
            limite: [10, 20, 50],
            columna: 'id',
            columna_orden: 'DESC'
        });

        agrid.tabla().on('click', '.btn-eliminar', function (e) {
            e.preventDefault();
            if (!confirm('¿Esta seguro de eliminar este registro?'))
                return;

            /* Obtiene el objeto actual de la fila seleccionada */
            var fila = agrid.obtener($(this).val());

            $("#preloader").show();
            /* Petición ajax al servidor */
            $.post('<?php echo base_url(); ?>admin/editor/eliminar/', {
                id: fila.id
            }, function (r) {
                if (r) {
                    agrid.refrescar();                    
                }
                $("#preloader").hide();
            }, 'json')

            return false;
        });

//                agrid.tabla().on('click', '.btn-publicar', function(e){
//                    e.preventDefault();
//                    //if(!confirm('¿Esta seguro de eliminar este registro?')) return;
//                    
//                    /* Obtiene el objeto actual de la fila seleccionada */
//                    var fila = agrid.obtener($(this).val());               
//
//                    /* Petición ajax al servidor */
//                    $.post('<?php echo base_url(); ?>editor/publicar/', {
//                        id_editor: fila.id_editor,
//                        estado:fila.estado
//                    }, function(r){
//                        if(r) agrid.refrescar();
//                    }, 'json')
//
//                    return false;
//                });

        agrid.tabla().on('click', '.btn-editar', function (e) {
            e.preventDefault();
            //if(!confirm('¿Esta seguro de eliminar este registro?')) return;

            /* Obtiene el objeto actual de la fila seleccionada */
            var fila = agrid.obtener($(this).val());
            $("#preloader").show();
            /* Petición ajax al servidor */
            $.post('<?php echo base_url(); ?>admin/editor/editar', {
                id: fila.id
            }, function (data) {                
                $("#cargar_ajax").html(data);
                $("#preloader").hide();
            })

            return false;
        });



    })
</script>       


