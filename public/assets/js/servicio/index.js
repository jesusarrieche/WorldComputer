$(document).ready(function () {

    let table = $('#datatable').DataTable({
        serverSide: false,
        ordering: false,
        searching: true,
        ajax: {
            method: 'POST',
            url: '/WorldComputer/Servicio/listar'
        },
        columns: [
            { data: 'id' },
            { data: "nombre" },
            { data: 'descripcion' },
            { data: 'precio' },
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

    const eliminarServicio = (id) => {
        $.ajax({
            type: "DELETE",
            url: "/WorldComputer/Servicio/eliminar/" + id,
            success: function (response) {
                const json = JSON.parse(response);
                if(json.tipo == 'success'){
                    Swal.fire(
                        'Eliminado!',
                        'El registro ha sido eliminado!',
                        'success'
                      )
    
                    table.ajax.reload();
                }
            },
            error: function (response) {
                console.log(response);
            }
        });
    }
    

    // Mostrar Servicio
    $('body').on('click', '.mostrar', function (e) { 
        e.preventDefault();
    
        mostrarServicio($(this).attr('href'),'form#formularioMostrarServicio','#modalMostrarServicio','mostrar');
    });

    // Actualizar Servicio
    $('body').on('click', '.editar', function (e) { 
        e.preventDefault();
    
        mostrarServicio($(this).attr('href'),'form#formularioActualizarServicio','#modalActualizarServicio','actualizar');
    });

    // Eliminar Servicio
    $('body').on('click', '.eliminar', function (e) {
        e.preventDefault();
    
        Swal.fire({
            title: 'Esta Seguro?',
            text: "El servicio sera eliminado del sistema!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
            if (result.value) {
    
                eliminarServicio($(this).attr('href'));
              
            }
          })
    });
})