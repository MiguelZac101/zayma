<div id="wrapper">
    <section>
        <div class="row">
            <div class="col-xs-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">                      

                            <div class="col-sm-6" style="padding-top: 8px;">
                                PRODUCTO - Listado
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
            <div class="col-xs-4" id="cargar_ajax">
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
                //{leyenda: 'Subcategoria', style: '', columna: 'id_subcategoria'},
                {leyenda: 'Publicar', style: 'width:100px;', columna: 'publicar'},
//                {leyenda: 'Destacado', style: 'width:100px;', columna: 'destacado'},
                {style: 'width:48px;'},
                {style: 'width:48px;'},
                {style: 'width:48px;'},            
                {style: 'width:48px;'}
            ],
            modelo: [                
                {propiedad: 'nombre'},             
                {propiedad: 'publicar', formato: function (tr, obj, valor) {
                    return valor == 1 ? '<div class="text-success">Publicado</div>' : '<div class="text-danger">No Publicado</div>';
                }},
//                {propiedad: 'destacado', formato: function (tr, obj, valor) {
//                        return valor == 1 ? '<div class="text-success">Destacado</div>' : '<div class="text-danger">No Destacado</div>';
//                    }},
              
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
                    {formato: function (tr, obj, celda) {
                        return anexGrid_boton({
                            class: 'btn btn-warning btn-sm btn-carrusel',
                            contenido: '<i class="fa fa-picture-o fa-fw"></i>',
                            value: tr.data('fila'),
                            attr: [
                                'title="Imagenes Carrusel"'
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
//                    ,
//                    { formato: function(tr, obj, celda){
//                        return anexGrid_boton({
//                            class: 'btn btn-info btn-sm btn-destacado',
//                            contenido: '<i class="fa fa-star fa-fw"></i>',
//                            value: tr.data('fila'),
//                            attr: [
//                                'title="Destacado"'
//                            ]
//                        });    
//                    }}
               
            ],
            url: '<?php echo base_url(); ?>admin/producto/anexgrid',
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
            $.post('<?php echo base_url(); ?>admin/producto/eliminar/', {
                id: fila.id
            }, function (r) {
                if (r) {
                    agrid.refrescar();                    
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
            $.post('<?php echo base_url(); ?>admin/producto/publicar/', {
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
            $.post('<?php echo base_url(); ?>admin/producto/editar', {
                id: fila.id
            }, function (data) {                
                $("#cargar_ajax").html(data);
                $("#preloader").hide();
            });
            return false;
        });
        
        agrid.tabla().on('click', '.btn-carrusel', function(e){
            e.preventDefault();
            var fila = agrid.obtener($(this).val()); 
            var id_producto = fila.id;
            
            $('#myModal').attr("data-id",id_producto);
            
            $.post('<?php echo base_url(); ?>admin/producto_carrusel/vista_modal', {
                id: fila.id                
            }, function(r){      
                $('#myModal #modal_listado').html(r.listado);
                $('#myModal #modal_proceso').html(r.nuevo); 
            }, 'json');
            
            //cargar datos al modal
            $('#myModal').modal('show');            

            return false;
        });

    })
</script>       
