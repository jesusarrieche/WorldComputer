$(document).ready(function () {

    let table = $('#datatable').DataTable({
        serverSide: false,
        ordering: false,
        searching: true,
        ajax: {
            method: 'POST',
            url: '/WorldComputer/Servicio/listarPrestados'
        },
        columns: [
            { data: 'id' },
            { data: "cantidad" },
            { data: 'precio' },
            { data: 'empleado_id' },
            { data: 'venta_id' },
            { data: 'servicio_id' },
            { data: 'created_at' },
            { data: 'button' }
        ],

        language: { 
                    "decimal":        "",
                    "emptyTable":     "No hay Registros Disponibles",
                    "info":           "Mostrando _START_ de _END_ para _TOTAL_ Entradas",
                    "infoEmpty":      "Mostrando 0 de 0 para 0 Entradas",
                    "infoFiltered":   "(Filtrado de _MAX_ Entradas en Total)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing":     "Procesando...",
                    "search":         "Buscar:",
                    "zeroRecords":    "No se encontraron coincidencias",
                    "paginate": {
                        "first":      "Primero",
                        "last":       "Ultimo",
                        "next":       "Siguiente",
                        "previous":   "Atras"
                    },
                    "aria": {
                        "sortAscending":  ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
        }
    });
    //script mostrar servicio
    const mostrarServicio = (href, formulario, modal, action) => {
        $.ajax({
            type: "POST",
            url: href,
            success: function (response) {
                let json = JSON.parse(response);
            
    
                $(formulario).find('input#id').val(json.data.id);
                $(formulario).find('input#'+action+'Nombre').val(json.data.nombre);
                $(formulario).find('input#'+action+'Precio').val(json.data.precio);
                $(formulario).find('#'+action+'Descripcion').val(json.data.descripcion);
    
                $(modal).modal('show');
    
            },
            error: function(response) {
             console.log(response.getAllResponseHeaders())
         }
        });
    }

    // Mostrar Servicio
    $('body').on('click', '.mostrar', function (e) { 
        e.preventDefault();
    
        mostrarServicio($(this).attr('href'),'form#formularioMostrarServicio','#modalMostrarServicio','mostrar');
    });


})