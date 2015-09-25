<div id="wrapper">
    <section>
        <div class="row">
            <div class="col-xs-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">                      

                            <div class="col-sm-6">
                                <?php echo $titulo_modulo; ?> - Listado
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
                {leyenda: '#', style: 'width:30px;text-align:center;', class: '', columna: 'orden'},
                {leyenda: 'Nombre', style: '', class: '', columna: 'nombre'},
                {leyenda: 'Publicar', style: 'width:100px;', columna: 'publicar'},
                {style: 'width:48px;'},
                {style: 'width:48px;'},
                {style: 'width:48px;'},
                {style: 'width:48px;'},
                {style: 'width:48px;'}
            ],
            modelo: [
                {propiedad: 'orden', style:'text-align:center;'},
                {propiedad: 'nombre'},              
                {propiedad: 'publicar', formato: function (tr, obj, valor) {
                        return valor == 1 ? '<div class="text-success">Publicado</div>' : '<div class="text-danger">No Publicado</div>';
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
                            class: 'btn btn-success btn-sm btn-publicar',
                            contenido: '<i class="fa fa-refresh fa-fw"></i>',
                            value: tr.data('fila'),
                            attr: [
                                'title="Publicar/Despublicar"'
                            ]
                        });    
                    }},
                    { formato: function(tr, obj, celda){
                        return anexGrid_boton({
                            class: 'btn btn-info btn-sm btn-arriba',
                            contenido: '<i class="fa fa-arrow-up fa-fw"></i>',
                            value: tr.data('fila'),
                            attr: [
                                'title="Arriba"'
                            ]
                        });    
                    }},
                    { formato: function(tr, obj, celda){
                        return anexGrid_boton({
                            class: 'btn btn-info btn-sm btn-abajo',
                            contenido: '<i class="fa fa-arrow-down fa-fw"></i>',
                            value: tr.data('fila'),
                            attr: [
                                'title="Abajo"'
                            ]
                        });    
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
               
            ],
            url: '<?php echo base_url(); ?>admin/<?php echo $control; ?>/anexgrid',
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
            $.post('<?php echo base_url(); ?>admin/<?php echo $control; ?>/eliminar/', {
                id: fila.id
            }, function (r) {
                if (r.error==0) {
                    agrid.refrescar();                    
                }else{
                    alert("Al parecer esta Categoria tiene Subcategorias registradas, primero debe eliminar todas las subcategorias dependientes.")
                }    
                
                $("#preloader").hide();
            }, 'json');

            return false;
        });

        agrid.tabla().on('click', '.btn-publicar', function(e){
            e.preventDefault();
            //if(!confirm('¿Esta seguro de eliminar este registro?')) return;

            /* Obtiene el objeto actual de la fila seleccionada */
            var fila = agrid.obtener($(this).val());               
            $("#preloader").show();
            /* Petición ajax al servidor */
            $.post('<?php echo base_url(); ?>admin/<?php echo $control; ?>/publicar/', {
                id: fila.id,
                publicar:fila.publicar
            }, function(r){
                if(r) agrid.refrescar();
                $("#preloader").hide();
            }, 'json');

            return false;
        });

        agrid.tabla().on('click', '.btn-editar', function (e) {
            e.preventDefault();
            //if(!confirm('¿Esta seguro de eliminar este registro?')) return;

            /* Obtiene el objeto actual de la fila seleccionada */
            var fila = agrid.obtener($(this).val());
            $("#preloader").show();
            /* Petición ajax al servidor */
            $.post('<?php echo base_url(); ?>admin/<?php echo $control; ?>/editar', {
                id: fila.id
            }, function (data) {                
                $("#cargar_ajax").html(data);
                $("#preloader").hide();
            });

            return false;
        });
        
        agrid.tabla().on('click', '.btn-arriba', function (e) {
            e.preventDefault();
            //if(!confirm('¿Esta seguro de eliminar este registro?')) return;

            /* Obtiene el objeto actual de la fila seleccionada */
            var fila = agrid.obtener($(this).val());
            $("#preloader").show();
            /* Petición ajax al servidor */
            $.post('<?php echo base_url(); ?>admin/<?php echo $control; ?>/orden_arriba', {
                id: fila.id
            }, function (data) {
                if(data.arriba==1){
                    agrid.refrescar();
                }else{
                    alert("Llego al primer lugar, no se puede poner mas arriba.")
                }    
                
                $("#preloader").hide();
            },'json');

            return false;
        });
        
        agrid.tabla().on('click', '.btn-abajo', function (e) {
            e.preventDefault();
            //if(!confirm('¿Esta seguro de eliminar este registro?')) return;

            /* Obtiene el objeto actual de la fila seleccionada */
            var fila = agrid.obtener($(this).val());
            $("#preloader").show();
            /* Petición ajax al servidor */
            $.post('<?php echo base_url(); ?>admin/<?php echo $control; ?>/orden_abajo', {
                id: fila.id
            }, function (data) {  
//                alert(data);
                if(data.abajo==1){
//                    alert("cambio de lugar, correcto.");
                    agrid.refrescar();
                }else{
                    alert("Llego al final, no se puede poner mas abajo.")
                } 
                $("#preloader").hide();
            },'json');

            return false;
        });



    })
</script>       

<script src="<?php echo base_url(); ?>plugins/jquery_anexgrid/jquery.anexgrid.js"></script>
