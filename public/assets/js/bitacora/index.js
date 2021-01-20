$(document).ready(function () {

/**
 * DataTable
 */

let table = $('#datatable').DataTable({
    serverSide: false,
    ordering: false,
    searching: true,
    ajax: {
        method: 'POST',
        url: 'Categoria/listar'
    },
    columns: [
        { data: 'nombre' },
        { data: "descripcion" },
        { data: 'estatus' },
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



/**
 * FUNCIONES
 */

const mostrarCategoria = (href, formulario, modal) => {

    $.ajax({
        type: "POST",
        url: href,
        success: function (response) {
            let json = JSON.parse(response);

            console.log(json);

            $(formulario).find('input#id').val(json.data.id);
            $(formulario).find('input#nombre').val(json.data.nombre);
            $(formulario).find('textarea#descripcion').val(json.data.descripcion);

 

            $(modal).modal('show');
            

        },
        error: (response) => {
            console.log(response);
        }
    });
}

const registrarCategoria = (datos) => {

    $.ajax({
        type: "POST",
        url: "Categoria/guardar",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            let json = JSON.parse(response);
            
            if( json.tipo == 'success'){

                Swal.fire(
                    json.titulo,
                    json.mensaje,
                    json.tipo
                );
    
                table.ajax.reload();
    
                $('#modalRegistroCategoria').modal('hide');
                $('#formularioRegistrarCategoria').trigger('reset');
            }else{
                Swal.fire(
                    json.titulo,
                    json.mensaje,
                    json.tipo
                );
            }

        },
        error: (response) => {
            console.log(response);
            
        }
    });



    // fetch('categoria/guardar', { method: 'POST', body: datos })
    // .then((response) => {
    //     console.log(response);
    //     return response.json();
    // })
    // .then((json) => {
    //     Swal.fire(
    //         json.titulo,
    //         json.mensaje,
    //         json.tipo
    //     )

    //     table.ajax.reload();
    //     
    // })
    // .catch( (response) => {
    //     console.log(response);
    // });
}


/**
 * Eventos
 */



// Mostrar Categoria
$('body').on('click', '.mostrar', function (e) { 
    e.preventDefault();

    mostrarCategoria($(this).attr('href'),'form#formularioMostrarCategoria','#modalMostrarCategoria');
});



$('[name="datatable_length"]').val(5);
$('[name="datatable_length"]').change();
});
