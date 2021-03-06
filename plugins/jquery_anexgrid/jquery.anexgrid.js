/*
    jQuery AnexGRID 1.0.0
    
    Plugin desarrollado en jQuery y en español que permite paginar, ordenar y/o filtrar registros para los proyectos que usen Bootstrap 3.
    
    Desarrollador: Eduardo Rodríguez
    Website: http://anexsoft.com
*/

$.fn.anexGrid = function (config) {
    /* Lenguaje */
    var lang = {
        error_cargando: 'Ocurrio un error al cargar la data.',
        filtro_limpiar: 'Retirar filtro',
        paginas: 'páginas',
        pagina: 'página',
        primera_pagina: 'Primera página',
        ultima_página: 'Página final',
        anterior_pagina: 'Página anterior',
        siguiente_pagina: 'Página siguiente',
        registro_encontrados: 'Se han encontrado {t} {r}',
        registros: 'registros',
        registro: 'registro',
        registros_mostrando: 'Por página:',
        encontrados: 'encontrados',
        no_encontrados: 'Sin registros que mostrar',
        cargando: '.. cargando ..',
    }

    /* Variables de apoyo */
    var id = 'anexgrid-' + this.attr('id').replace('#', '');
    
    var clase = {
        /* Clases de grilla */
        columnas: id + '-columnas',
        filas: id + '-filas',
        filtro: id + '-filtro',
        
        /* Clase filtro */
        filtro_control_container: id + '-filtro-control-container',
        filtro_control: id + '-filtro-control',
        filtro_limpiar: id + '-filtro-limpiar',

        /* Clases paginador */
        paginador: id + '-paginador',
        paginador_pagina_actual: id + '-paginador-pagina-actual',
        paginador_paginas_por_pagina: id + '-paginador-por-pagina',
        paginador_paginas: id + '-paginador-paginas',
        paginador_registros_encontrados: id + '-paginador-registros-encontrados',
        
        paginador_siguiente: id + '-paginador-siguiente',
        paginador_final: id + '-paginador-final',
        paginador_anterior: id + '-paginador-anterior',
        paginador_primero: id + '-paginador-primero',

        /* Clase ordenamiento */
        columna_ordenar: id + '-columna-ordenar',

        /* Otras clases */
        fila: id + '-fila-'        
    };

    /* Grilla */
    var anexGrid = {
        /* Atributos de tabla */
        class: reemplazaUndefinedPor(config.class, ''),
        style: reemplazaUndefinedPor(config.style, ''),

        /* Columnas especificadas */
        columnas: config.columnas,

        /* Modelo de la información a mostrar */
        modelo: config.modelo,

        /* La información de donde queremos consumir la data */
        url: config.url,
        type: reemplazaUndefinedPor(config.type, 'POST'),
        dataType: reemplazaUndefinedPor(config.dataType, 'JSON'),
        data: [],
        parametros: reemplazaUndefinedPor(config.parametros, {}),

        /* Ordenamiento */
        columna:               config.columna,
        columna_orden:         config.columna_orden,
        columna_defecto:       config.columna,
        columna_defecto_orden: config.columna_orden,

        /* Paginación */
        pagina:    1,
        paginas:   1,
        total:     0,
        limite:    reemplazaUndefinedPor(config.limite, 20),
        porPagina: 0,
        paginable: reemplazaUndefinedPor(config.paginable, false),

        /* Filtrable */
        filtrable: reemplazaUndefinedPor(config.filtrable, false),
        filtros: [],

        /* Tabla */
        tabla: null,

        /* Eventos para configurar la grilla */
        creaGrilla: function()
        {
            /* Creamos la grilla */
            anexGrid.tabla = $('<table id="' + id + '" style="' + anexGrid.style + '" class="table ' + anexGrid.class + '"><thead class="' + clase.columnas + '"><tr></tr></thead><tbody class="' + clase.filas + '"></tbody><tfoot class="' + clase.paginador + '"></tfoot></table>');

            /* Registros por página */
            anexGrid.porPagina = typeof anexGrid.limite == 'number' ? anexGrid.limite : anexGrid.limite[0];
        },
        cargarColumnas: function()
        {
            cargarColumnas();                        
        },
        cargarData: function()
        {
            /* Bloqueamos los controles de la grilla */
            paginadorBloqueaControles(true);
            filtroBloqueaControles(true);
            ordenarBloqueaControles(true);

            var tbody = anexGrid.tabla.find('.' + clase.filas);
            tbody.css('opacity', 0.4);
            
            /* Parametros a enviar */
            var parametros = {
                limite: anexGrid.porPagina,
                pagina: anexGrid.pagina,
                columna: anexGrid.columna,
                columna_orden: anexGrid.columna_orden,
                filtros: anexGrid.filtros
            };

            for (key in anexGrid.parametros) {
                parametros[key] = anexGrid.parametros[key];
            }
            
            /* Peticion AJAX al servidor */
            $.ajax({
                dataType: anexGrid.dataType,
                type: anexGrid.type,
                url: anexGrid.url,
                data: parametros,
                success: function (r) {
                    tbody.html('')
                         .css('opacity', 1);

                    anexGrid.data = r.data;
                    anexGrid.total = r.total;

                    cargarData();
                },
                error: function(jqXHR, textStatus, errorThrown){
                    paginadorBloqueaControles(false);
                    filtroBloqueaControles(false);
                    ordenarBloqueaControles(false);
                    
                    tbody.html('<tr class="danger"><td colspan="' + anexGrid.columnas.length + '" class="danger text-center">' + lang.error_cargando + '</td></tr>');
                    console.log(errorThrown + ' | ' + textStatus);
                }   
            })
        },
        obtener: function(n)
        {
            return anexGrid.data[n];
        },
        cargarPaginacion: function()
        {
            cargarPaginacion();
        }
    };

    /* Creamos la tabla y sus columnas */
    anexGrid.creaGrilla();
    anexGrid.cargarColumnas();

    /* Cargamos las filas */
    anexGrid.cargarData();

    this.html(anexGrid.tabla);

    /* Evento para ordenar */
    anexGrid.tabla.on('click', '.' + clase.columna_ordenar, function()
    {
        var a = $(this);        
        if(a.attr('disabled')) return false;
        
        $('.glyphicon', a.closest('tr')).remove();

        /* Regresamos a la pagina 1 */
        anexGrid.pagina = 1;

        var icono = $('<i style="margin-left:4px;font-size:0.8em;" class=""></i>');

        /* En caso que la columna clikeada no sea la actual */
        if( anexGrid.columna != a.data('columna') )
        {
            anexGrid.columna = a.data('columna');
            anexGrid.columna_orden = '';
        }

        /* Cuando el ordenamiento no ha sido definido */
        if( anexGrid.columna_orden == '' )
        {
            anexGrid.columna_orden = 'ASC';
            icono.attr('class', 'glyphicon glyphicon-chevron-up');
            a.append(icono);
        }

        /* Cuando es ascendente */
        else if( anexGrid.columna_orden == 'ASC' )
        {
            anexGrid.columna_orden = 'DESC';
            icono.attr('class', 'glyphicon glyphicon-chevron-down');
            a.append(icono);
        }

        /* Cuando es descedente, regresamos al ordenamiento por defecto */
        else if( anexGrid.columna_orden == 'DESC' )
        {
            anexGrid.columna_orden = '';
            anexGrid.columna = anexGrid.columna_defecto;
            anexGrid.columna_orden = anexGrid.columna_orden;
        }

        anexGrid.cargarData();  
        
        return false;
    })
    
    /* Eventos de filtro */
    anexGrid.tabla.on('keyup', '.' + clase.filtro_control, function(e)
    {
        var control = $(this);
        
        if(e.keyCode == 13)
        {
            agregaFiltro({
                columna: control.data('columna'),
                valor:control.val()
            });
            
            anexGrid.pagina = 1;
            anexGrid.cargarData();
        }
    })
    
    /* Filtro > Select */
    anexGrid.tabla.on('change', '.' + clase.filtro_control, function(e)
    {
        var control = $(this);
        
        if(control.is('select'))
        {
            if(control.find('option:selected').index() > 0)
            {
                agregaFiltro({
                    columna: control.data('columna'),
                    valor:  control.val()
                });                
            }
            else
            {
                retiraFiltro(control.data('columna'));
            }
            
            anexGrid.pagina = 1;
            anexGrid.cargarData()   
        }
    })
    
    anexGrid.tabla.on('click', '.' + clase.filtro_limpiar, function(e)
    {
        var control = $(this).closest('.input-group')
                             .find('.' + clase.filtro_control);
        
        control.val('');
        
        retiraFiltro(control.data('columna'));
        
        anexGrid.pagina = 1;
        anexGrid.cargarData();
    })

    /* Eventos de paginador */
    anexGrid.tabla.on('keyup', '.' + clase.paginador_pagina_actual, function(e)
    {
        if(e.keyCode == 13)
        {
            if(!esNumerico($(this).val()))
            {
                $(this).val(anexGrid.pagina);
                return;
            }

            if($(this).val() == anexGrid.pagina) return;
            else if($(this).val() > anexGrid.paginas) return;
            else if ($(this).val() == 0) return;
                
            anexGrid.pagina = $(this).val();
            anexGrid.cargarData();
        }
    })

    anexGrid.tabla.on('focus', '.' + clase.paginador_pagina_actual, function(e)
    {
        $(this).val('');
    })
    
    /* Registros por pagina */
    anexGrid.tabla.on('change', '.' + clase.paginador_paginas_por_pagina, function()
    {
        anexGrid.pagina = 1;
        anexGrid.porPagina = $(this).val();
        anexGrid.cargarData();
    })
    
    /* Paginador > Primera página */
    anexGrid.tabla.on('click', '.' + clase.paginador_primero, function()
    {
        if($(this).attr('disabled')) return;
        
        if(!esNumerico(anexGrid.pagina)) return;        
        if($("." + clase.paginador_pagina_actual).val() == 1) return;
        
        anexGrid.pagina = 1;
        anexGrid.cargarData();
    })
    
    /* Paginador > Página Anterior */
    anexGrid.tabla.on('click', '.' + clase.paginador_anterior, function()
    {
        if($(this).attr('disabled')) return;
        
        if(!esNumerico(anexGrid.pagina)) return;        
        if($("." + clase.paginador_pagina_actual).val() == 1) return;
        
        anexGrid.pagina -= 1;
        anexGrid.cargarData();
    })
    
    /* Paginador > Página Final */
    anexGrid.tabla.on('click', '.' + clase.paginador_final, function()
    {
        if($(this).attr('disabled')) return;
        
        if(!esNumerico(anexGrid.pagina)) return;        
        if($("." + clase.paginador_pagina_actual).val() == anexGrid.paginas) return;
        
        anexGrid.pagina = anexGrid.paginas;
        anexGrid.cargarData();
    })
    
    /* Paginador > Página Siguiente */
    anexGrid.tabla.on('click', '.' + clase.paginador_siguiente, function()
    {
        if($(this).attr('disabled')) return;
        
        if(!esNumerico(anexGrid.pagina)) return;        
        if($("." + clase.paginador_pagina_actual).val() == anexGrid.paginas) return;
        
        anexGrid.pagina += 1;
        anexGrid.cargarData();
    })

    /* Funciones de Grilla */
    function cargarColumnas()
    {
        var columnas = anexGrid.tabla.find('.' + clase.columnas);
        columnas.html('<tr></tr>');
        
        /* Si es filtrable, agregamos una fila más a la cabecera */
        if(anexGrid.filtrable) columnas.append('<tr class="' + clase.filtro + '"></tr>');
            
        $(anexGrid.columnas).each(function(i, col)
        {
            /* Agregamos las columnas */
            var th = $('<th class="' + reemplazaUndefinedPor(col.class, '') + '" style="' + reemplazaUndefinedPor(col.style, '') + '"></th>');

            /* ¿Es ordenable? */
            if(col.ordenable)
            {
                var a = $('<a href="#" class="' + clase.columna_ordenar + '" data-columna="' + reemplazaUndefinedPor(col.columna, '') + '"></a>');
                a.html(col.leyenda)

                th.html(a);
            }
            else th.text(col.leyenda);

            anexGrid.tabla.find('thead tr:first').append(th);
            
            /* Agregamos los filtros */
            if(anexGrid.filtrable)
            {
                th = $('<th></th>');
                
                if(col.filtro != undefined)
                {
                    if(typeof col.filtro == 'function')
                    {
                        /* Control */
                        var control = $(col.filtro());
                        control.attr('data-columna', col.columna)
                               .removeClass('input-sm input-lg')
                               .addClass('input-sm')
                               .addClass(clase.filtro_control);

                        if($(control).is('input'))
                        {
                            /* Agregamos el control al grupo */
                            var inputGroup = $('<div class="input-group"><div class="' + clase.filtro_control_container + '"></div><span class="input-group-btn"><button class="btn btn-default btn-sm ' + clase.filtro_limpiar + '" type="button">Go!</button></span>');

                            var icono = '<i class="glyphicon glyphicon-remove"></i>';

                            inputGroup.find('.' + clase.filtro_control_container).html(control);
                            inputGroup.find('.' + clase.filtro_limpiar).html(icono);

                            /* Insertamos el grupo */
                            th.html(inputGroup);
                        }

                        if($(control).is('select'))
                        {
                            th.html(control);
                        }                        
                    }
                    else if(col.filtro)
                    {
                        /* Control */
                        var control = $(anexGrid_input({}));
                        control.attr('data-columna', col.columna)
                               .removeClass('input-sm input-lg')
                               .addClass('input-sm')
                               .addClass(clase.filtro_control);

                        /* Agregamos el control al grupo */
                        var inputGroup = $('<div class="input-group"><div class="' + clase.filtro_control_container + '"></div><span class="input-group-btn"><button title="' + lang.filtro_limpiar + '" class="btn btn-default btn-sm ' + clase.filtro_limpiar + '" type="button">Go!</button></span>');

                        var icono = '<i class="glyphicon glyphicon-remove"></i>';

                        inputGroup.find('.' + clase.filtro_control_container).html(control);
                        inputGroup.find('.' + clase.filtro_limpiar).html(icono);

                        /* Insertamos el grupo */
                        th.html(inputGroup);
                    }
                }                
                
                anexGrid.tabla.find('thead tr.' + clase.filtro).append(th);
            }
        })
    }

    function cargarData()
    {
        if(anexGrid.data.length == 0)
        {
            anexGrid.tabla.find('.' + clase.filas).html('<tr><td colspan="' + anexGrid.columnas.length + '" class="text-center">' + lang.no_encontrados + '</td></tr>');
        }
        
        $(anexGrid.data).each(function(i, f)
        {
            /* Creamos la fila */
            var tr = $('<tr data-fila="' + i + '" class="' + clase.fila + i + '"></tr>');

            /* Agregamos las celdas*/
            $(anexGrid.modelo).each(function(x, m)
            {
                var td = $('<td class="' + reemplazaUndefinedPor(m.class, '') + '" style="' + reemplazaUndefinedPor(m.style, '') + '"></td>');
                
                /* Obtenemos el valor de la propiedad actual*/
                var propiedad = '';
                
                /* Si el valor está dentro de un objeto */
                if(m.propiedad != undefined)
                {
                    if(m.propiedad.indexOf('.') > -1) propiedad = buscarIndiceEnArray(f, m.propiedad);
                    else propiedad = f[m.propiedad];                    
                }

                /* Si el formato ha sido definido */
                if(m.formato != undefined) td.html(m.formato(tr, f, propiedad));
                /* Del caso contrario mostramos el valor de la propiedad en la celda */
                else td.text(propiedad);
                
                tr.append(td);
            })

            anexGrid.tabla.find('.' + clase.filas).append(tr);
        });
        
        ordenarBloqueaControles(false);
        filtroBloqueaControles(false);
    
        anexGrid.cargarPaginacion();
    }

    function cargarPaginacion()
    {
        if(!anexGrid.paginable) return;
        
        var paginador = anexGrid.tabla.find('.' + clase.paginador);
        
        /* Cuando el paginador no existe */
        if(!paginador.data('cargado'))
        {
            /* Calcular total de páginas */
            paginadorCalcularPaginas();

            /* Limpiamos el paginador */
            paginador.html('');

            /* Fila del paginador */
            var tr = $('<tr class="active"></tr>');
            tr.html('<td colspan="' + anexGrid.columnas.length + '" style="height:40px;line-height:30px;"></td>');

            /* Registros por página */
            var registrosPorPagina = '';

            if(typeof anexGrid.limite != 'number')
            {
                registrosPorPagina = '<div class="col-xs-3">' + lang.registros_mostrando + ' <select style="width:80px;display:inline-block;" class="form-control input-sm ' + clase.paginador_paginas_por_pagina + '">' + paginadorPaginasAMostrar() + '</select></div>';
            }
            else
            {
                registrosPorPagina = '<div class="col-xs-3">' + lang.registros_mostrando + ' ' + anexGrid.porPagina + ' ' + lang.registros + '</div>';
            }

            /* Control de paginador */
            var controlPaginacion = '<div class="col-xs-6 text-center"><i title="' + lang.primera_pagina + '" style="font-size:0.8em;cursor:pointer;" class="glyphicon glyphicon-step-backward ' + clase.paginador_primero + '"></i><i title="' + lang.anterior_pagina + '" style="font-size:0.8em;margin-right:4px;cursor:pointer;" class="glyphicon glyphicon-backward ' + clase.paginador_anterior + '"></i> ' + primeraLetraAMayuscula(lang.pagina) + ' <input class="text-center form-control input-sm ' + clase.paginador_pagina_actual + '" type="text" value="' + anexGrid.pagina + '" style="width:50px;display:inline-block;" /> / <b class="' + clase.paginador_paginas + '">' + anexGrid.paginas + '</b> <i title="' + lang.siguiente_pagina + '" style="font-size:0.8em;margin-left:4px;cursor:pointer;" class="glyphicon glyphicon-forward ' + clase.paginador_siguiente + '"></i><i title="' + lang.ultima_página + '" style="font-size:0.8em;cursor:pointer;" class="glyphicon glyphicon-step-forward ' + clase.paginador_final + '"></i></div>';

            /* Registros encontrados */
            var registrosEncontrados = '<div class="col-xs-3 text-right ' + clase.paginador_registros_encontrados + '">' + paginadorRegistrosPorPagina() + '</div>';

            /* Agregamos el HTML de todo el paginador */
            tr.find('td').html('<div style="margin:0;" class="row">' + registrosPorPagina + controlPaginacion + registrosEncontrados + '</div>');

            paginador.html(tr)
                     .attr('data-cargado', true);
        }
        /* Cuando ya ha sido cargado, solo debemos calcular los valores */
        else
        {
            /* Recalcula las páginas */
            paginadorCalcularPaginas();
            
            /* Cantidad de páginas */
            paginador.find('.' + clase.paginador_paginas)
                     .text(anexGrid.paginas);
            
            /* Registros a mostrar */
            paginador.find('.' + clase.paginador_registros_encontrados)
                     .html(paginadorRegistrosPorPagina());
            
            /* Pagina actual */
            paginador.find('.' + clase.paginador_pagina_actual)
                     .val(anexGrid.pagina);
            
            /* Desbloqueamos los controles */
            paginadorBloqueaControles(false);
        }
    }

    /* Funciones de Apoyo */
    function buscarIndiceEnArray(obj, indice)
    {
        var indices = indice.split('.');
        
        if(indices.length > 1)
        {
            var nuevo_indice = '';
            
            $.each(indices, function(i, v){
                if(i > 0) 
                {
                    nuevo_indice += v + (indices.length - 2 == i ? '.' : '');                    
                }
            })
            
            return buscarIndiceEnArray(obj[indices[0]], nuevo_indice);
        }
        else
        {
            return obj[indices[0]];
        }
    }
    
    function reemplazaUndefinedPor(obj, v)
    {
        return (obj === undefined) ? v : obj;
    }

    function primeraLetraAMayuscula(string)
    {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function esNumerico(x)
    {
        return !parseInt(x) ? false : true;
    }    
    
    function agregaFiltro(filtro)
    {
        if(anexGrid.filtros.length > 0)
        {
            $.each(anexGrid.filtros, function(i, f){
                if(f.columna == filtro.columna)
                {
                    anexGrid.filtros[i].columna = filtro.columna;
                    anexGrid.filtros[i].valor = filtro.valor;
                }
                else if(i == anexGrid.filtros.length - 1)
                {
                    anexGrid.filtros.push(filtro);
                }
            })            
        }
        else
        {
            anexGrid.filtros.push(filtro);
        }
    }
    
    function retiraFiltro(columna)
    {
        var filtros = [];
        
        $.each(anexGrid.filtros, function(i, f){
            if(f.columna != columna)
            {
                filtros.push(f);
            }
        })
        
        anexGrid.filtros = filtros;
    }
    
    function paginadorCalcularPaginas()
    {
        anexGrid.paginas =  Math.ceil(anexGrid.total / anexGrid.porPagina);
    }
    
    function paginadorRegistrosPorPagina()
    {
        return lang.registro_encontrados.replace('{t}', anexGrid.total).replace('{r}', anexGrid.total == 0 || anexGrid.total > 1 ? lang.registros : lang.registro);
    }
    
    function paginadorPaginasAMostrar()
    {
        var opciones = '';
        
        $.each(anexGrid.limite, function(i, v){
            opciones += '<option value="' + v + '">' + v + '</option>';
        })
        
        return opciones;
    }
    
    function paginadorBloqueaControles(r)
    {
        anexGrid.tabla.find('.' + clase.paginador_pagina_actual)
                      .attr('disabled', r);

        anexGrid.tabla.find('.' + clase.paginador_paginas_por_pagina)
                      .attr('disabled', r);
    
        anexGrid.tabla.find('.' + clase.paginador_primero)
                      .attr('disabled', r);
        
        anexGrid.tabla.find('.' + clase.paginador_anterior)
                      .attr('disabled', r);
        
        anexGrid.tabla.find('.' + clase.paginador_siguiente)
                      .attr('disabled', r);
        
        anexGrid.tabla.find('.' + clase.paginador_final)
                      .attr('disabled', r);
    }
    
    function filtroBloqueaControles(r)
    {
        anexGrid.tabla.find('.' + clase.filtro_control)
                      .attr('disabled', r);
    }

    function ordenarBloqueaControles(r)
    {
        anexGrid.tabla.find('.' + clase.columnas + ' a')
                      .attr('disabled', r);
    }

    return {
        total: function(){
            return anexGrid.total;
        },
        tabla: function(){
            return anexGrid.tabla;
        },
        refrescar: function()
        {
            anexGrid.pagina = 1;
            return anexGrid.cargarData();
        },
        parametros: function(param)
        {
            anexGrid.parametros = param;
        },
        obtener: function(i)
        {
            return anexGrid.obtener(i);
        }
    };
};

/* Controles */
function anexGrid_boton(config)
{
    config = {
        contenido: config.contenido != undefined ? config.contenido : '',
        class: config.class != undefined ? config.class : '',
        style: config.style != undefined ? config.style : '',
        attr: config.attr != undefined ? config.attr : [],
        
        type: config.type != undefined ? config.type : 'button',
        value: config.value != undefined ? config.value : '',
    };
    
    var atributos = '';
    $.each(config.attr, function(i, v){
        atributos += v;
    })
    
    config.attr = atributos;
    
    return '<button type="' + config.type + '" style="' + config.style + '" class="btn ' + config.class + '" value="' + config.value + '" ' + config.attr + '>' + config.contenido + '</button>';
}

function anexGrid_link(config)
{
    config = {
        contenido: config.contenido != undefined ? config.contenido : '',
        class: config.class != undefined ? config.class : '',
        style: config.style != undefined ? config.style : '',
        attr: config.attr != undefined ? config.attr : [],
        
        href: config.href != undefined ? config.href : '_self',
        target: config.target != undefined ? config.target : '',
    };
    
    var atributos = '';
    $.each(config.attr, function(i, v){
        atributos += v;
    })
    
    config.attr = atributos;
    
    return '<a href="' + config.href + '" target="' + config.target + '" class="' + config.class + '" ' + config.attr + '>' + config.contenido + '</a>';
}

function anexGrid_dropdown(config)
{
    config = {
        contenido: config.contenido != undefined ? config.contenido : '',
        class: config.class != undefined ? config.class : '',
        style: config.style != undefined ? config.style : '',
        attr: config.attr != undefined ? config.attr : [],
        
        id: config.id != undefined ? config.id : '',
        data: config.data != undefined ? config.data : [],
    };

    var atributos = '';
    $.each(config.attr, function(i, v){
        atributos += v;
    })
    
    config.attr = atributos;
    
    var boton = '<button id="' + config.id + '" style="' + config.style + '" class="btn ' + config.class + '" type="button" ' + config.attr + ' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' + config.contenido + ' <span class="caret"></span></button>';
    
    var list = '<ul class="dropdown-menu" aria-labelledby="' + config.id + '">';
    
    $.each(config.data, function(i, v){
        list += '<li><a href="' + v.href + '">' + v.contenido + '</a></li>';
    })
    
    list += '</ul>';
    
    return '<div class="dropdown">' + boton + list + '</div>';
}

function anexGrid_input(config)
{
    config = {
        class: config.class != undefined ? config.class : '',
        style: config.style != undefined ? config.style : '',
        attr: config.attr != undefined ? config.attr : [],
        
        type: config.type != undefined ? config.type : 'text',
        value: config.value != undefined ? config.value : '',
    };
    
    var atributos = '';
    $.each(config.attr, function(i, v){
        atributos += v;
    })
    
    config.attr = atributos;
    
    return '<input type="' + config.type + '" style="' + config.style + '" class="form-control input-sm ' + config.class + '" value="' + config.value + '" ' + config.attr + ' />';
}

function anexGrid_imagen(config)
{
    config = {
        class: config.class != undefined ? config.class : '',
        style: config.style != undefined ? config.style : '',
        attr: config.attr != undefined ? config.attr : [],
        
        src: config.src != undefined ? config.src : '',
    };
    
    var atributos = '';
    $.each(config.attr, function(i, v){
        atributos += v;
    })
    
    config.attr = atributos;
    
    return '<img src="' + config.src + '" class="' + config.class + '" style="' + config.style + '" ' + config.attr + '/>';
}

function anexGrid_select(config)
{
    config = {
        class: config.class != undefined ? config.class : '',
        style: config.style != undefined ? config.style : '',
        attr: config.attr != undefined ? config.attr : [],
        
        selected: config.selected != undefined ? config.selected : '',
        data: config.data != undefined ? config.data : [],
    };
    
    var atributos = '';
    $.each(config.attr, function(i, v){
        atributos += v;
    })
    
    config.attr = atributos;
    
    var control = $('<select style="' + config.style + '" class="form-control input-sm ' + config.class + '" ' + config.attr + '></select>');
    
    $.each(config.data, function(i, d){
        control.append('<option ' + (d.valor == config.selected ? 'selected' : '') + ' value="' + d.valor + '">' + d.contenido + '</option>');
    })
    
    return control;
}