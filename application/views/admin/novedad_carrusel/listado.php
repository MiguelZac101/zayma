         
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">                      

            <div class="col-sm-6">
                CARRUSEL - Listado
            </div>
            <div class="col-sm-6 text-right">

            </div>
        </div>
    </div>

    <div class="panel-body">
<!--                       <div class="panel panel-default">
                <div class="panel-body text-right">
                    <a class="btn btn-default" href="<?php echo base_url(); ?>noticia_categoria/nuevo/" role="button" title="Testimonio Nuevo">Nuevo</a>
                </div>
            </div>-->
        <div id="list_carrusel"></div>                           


    </div>
</div>

<script>
    $(document).ready(function () {
        var agrid = $("#list_carrusel").anexGrid({
            class: 'table-striped table-bordered table-condensed',
            columnas: [
                {leyenda: '#', style: 'width:30px;text-align:center;', class: '', columna: 'id'}, 
                {leyenda: 'Titulo', style: '', class: ''},
                {style: 'width:48px;'},
                {style: 'width:48px;'}
            ],
            modelo: [
                {propiedad: 'id', style:'text-align:center;'},
                { formato: function(tr, obj, valor){
                    return "carrusel-"+obj.id;
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
                    }}
                    ,
                {formato: function (tr, obj, celda) {
                        return anexGrid_boton({
                            class: 'btn btn-default btn-sm btn-ver',
                            contenido: '<i class="fa fa-eye fa-fw"></i>',
                            value: tr.data('fila'),
                            attr: [
                                'title="Ver Detalles"'
                            ]
                        });
                    }}
            ],
            url: '<?php echo base_url(); ?>admin/novedad_carrusel/anexgrid',
            paginable: true,
//                    filtrable: true,
            limite: [10, 20, 50],
            columna: 'id',
            columna_orden: 'ASC'
        });

        agrid.tabla().on('click', '.btn-eliminar', function (e) {
            e.preventDefault();
            if (!confirm('¿Esta seguro de eliminar este registro?'))
                return;

            /* Obtiene el objeto actual de la fila seleccionada */
            var fila = agrid.obtener($(this).val());

            $("#preloader").show();
            /* Petición ajax al servidor */
            $.post('<?php echo base_url(); ?>admin/novedad_carrusel/eliminar/', {
                id: fila.id
            }, function (r) {
                if (r.error==0) {
                    agrid.refrescar();                    
                }else{
                    alert("No se pudo eliminar.");
                }    
                
                $("#preloader").hide();
            }, 'json');

            return false;
        });
        
        agrid.tabla().on('click', '.btn-ver', function (e) {
            e.preventDefault();
            //if(!confirm('¿Esta seguro de eliminar este registro?')) return;

            /* Obtiene el objeto actual de la fila seleccionada */
            var fila = agrid.obtener($(this).val());
            $("#preloader").show();
            /* Petición ajax al servidor */
            $.post('<?php echo base_url(); ?>admin/novedad_carrusel/ver', {
                id: fila.id
            }, function (data) {                
                $("#cargar_ajax").html(data);
                $("#preloader").hide();
            });

            return false;
        });

    })
</script>       

<!--<script src="<?php echo base_url(); ?>plugins/jquery_anexgrid/jquery.anexgrid.js"></script>-->