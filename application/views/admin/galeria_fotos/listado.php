<div id="wrapper">
    <section>
        <div class="row">
            <div class="col-xs-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">                      

                            <div class="col-sm-6">
                                Fotos - Listado
                            </div>
                            <div class="col-sm-6 text-right">

                            </div>
                        </div>
                    </div>

                    <div class="panel-body">

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
                {leyenda: 'Titulo', style: '', class: '', columna: 'titulo'},
                {leyenda: 'Destacado', style: 'width:100px;', columna: 'destacado'},
//                {leyenda: 'Descripcion', style: '', columna: 'descripcion'},
                {style: 'width:48px;'},
                {style: 'width:48px;'},
                {style: 'width:48px;'}
            ],
            modelo: [
                {propiedad: 'titulo'},
//                {propiedad: 'descripcion'},
                {propiedad: 'destacado', formato: function (tr, obj, valor) {
                        return valor == 1 ? '<div class="text-success">Destacado</div>' : '<div class="text-danger">No Destacado</div>';
                    }},
                {formato: function (tr, obj, celda) {
                        return anexGrid_boton({
                            class: 'btn btn-danger btn-sm btn-eliminar',
                            contenido: '<i class="fa fa-trash-o fa-fw"></i>',
                            value: tr.data('fila'),
                            attr: [
                                'title="Eliminar"'
                            ]
                        });
                    }},
                {formato: function (tr, obj, celda) {
                        return anexGrid_boton({
                            class: 'btn btn-primary btn-sm btn-editar',
                            contenido: '<i class="fa fa-pencil-square-o fa-fw"></i>',
                            value: tr.data('fila'),
                            attr: [
                                'title="Editar"'
                            ]
                        });
                    }},
                    { formato: function(tr, obj, celda){
                        return anexGrid_boton({
                            class: 'btn btn-info btn-sm btn-destacado',
                            contenido: '<i class="fa fa-star fa-fw"></i>',
                            value: tr.data('fila'),
                            attr: [
                                'title="Destacado"'
                            ]
                        });    
                    }}
               
            ],
            url: '<?php echo base_url(); ?>admin/galeria_fotos/anexgrid',
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
            $.post('<?php echo base_url(); ?>admin/galeria_fotos/eliminar/', {
                id: fila.id
            }, function (r) {
                if (r) {
                    agrid.refrescar();                    
                }
                $("#preloader").hide();
            }, 'json')

            return false;
        });
        agrid.tabla().on('click', '.btn-editar', function (e) {
            e.preventDefault();
            //if(!confirm('¿Esta seguro de eliminar este registro?')) return;

            /* Obtiene el objeto actual de la fila seleccionada */
            var fila = agrid.obtener($(this).val());
            $("#preloader").show();
            /* Petición ajax al servidor */
            $.post('<?php echo base_url(); ?>admin/galeria_fotos/editar', {
                id: fila.id
            }, function (data) {                
                $("#cargar_ajax").html(data);
                $("#preloader").hide();
            })

            return false;
        });
        
        agrid.tabla().on('click', '.btn-destacado', function(e){
            e.preventDefault();
            //if(!confirm('¿Esta seguro de eliminar este registro?')) return;

            /* Obtiene el objeto actual de la fila seleccionada */
            var fila = agrid.obtener($(this).val());               
            $("#preloader").show();
            /* Petición ajax al servidor */
            $.post('<?php echo base_url(); ?>admin/galeria_fotos/destacado/', {
                id: fila.id
            }, function(r){
                if(r) agrid.refrescar();
                $("#preloader").hide();
            }, 'json');

            return false;
        });


    })
</script>       

<script src="<?php echo base_url(); ?>plugins/jquery_anexgrid/jquery.anexgrid.js"></script>