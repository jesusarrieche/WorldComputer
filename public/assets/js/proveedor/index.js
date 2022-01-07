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
            url: 'Proveedor/listar'
        },
        columns: [
            { data: 'documento' },
            { data: "razon_social" },
            { data: 'telefono' },
            { data: 'button' }
        ],

        language: {
            "decimal": "",
            "emptyTable": "No hay Registros Disponibles",
            "info": "Mostrando _START_ de _END_ para _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 de 0 para 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ Entradas en Total)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron coincidencias",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Atras"
            },
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }
    });
    /**
     * VARIABLES
     */
    var inicialDocumentoActu = "", documentoActu = "";
    /**
    * FUNCIONES
    */
    const mostrarProveedor = (href, formulario, modal) => {

        $.ajax({
            type: "POST",
            url: href,
            success: function (response) {
                let json = JSON.parse(response);
                if (modal == '#modalActualizarProveedor') {
                    let doc = json.data.documento.split('-');
                    inicialDocumentoActu = doc[0];
                    documentoActu = doc[1];
                    $(formulario).find('input#documento').val(documentoActu);
                    $(formulario).find('select#inicial_documento').val(inicialDocumentoActu);
                } else {
                    $(formulario).find('input#documento').val(json.data.documento);

                }
                $(formulario).find('input#id').val(json.data.id);
                $(formulario).find('input#nombre').val(json.data.razon_social);
                $(formulario).find('input#telefono').val(json.data.telefono);
                $(formulario).find('input#correo').val(json.data.email);
                $(formulario).find('input#direccion').val(json.data.direccion);

                $(modal).modal('show');
            },
            error: (response) => {
                console.log(response);
            }
        });
    }

    const registrarProveedor = (datos) => {
        $.ajax({
            type: "POST",
            url: "proveedor/guardar",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                let json = JSON.parse(response);

                if (json.tipo == 'success') {

                    Swal.fire(
                        json.titulo,
                        json.mensaje,
                        json.tipo
                    );

                    table.ajax.reload();

                    $('#agregarProveedor').modal('hide');
                    $('#formularioRegistrarProveedor').trigger('reset');
                } else {
                    json.mensaje = desglosarMensajeError(json.mensaje);
                    Swal.fire(
                        json.titulo,
                        json.mensaje,
                        json.tipo
                    );
                }
                console.log(response);
            },
            error: (response) => {
                console.log(response);

            }
        });
    }

    const actualizarProveedor = (datos) => {
        $.ajax({
            type: "POST",
            url: "proveedor/actualizar",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                let json = JSON.parse(response);

                if (json.tipo == 'success') {

                    Swal.fire(
                        json.titulo,
                        json.mensaje,
                        json.tipo
                    );

                    table.ajax.reload();

                    $('#modalActualizarProveedor').modal('hide');
                } else {
                    json.mensaje = desglosarMensajeError(json.mensaje);
                    Swal.fire(
                        json.titulo,
                        json.mensaje,
                        json.tipo
                    );
                }
            },
            error(response) {
                console.log(response);
            }
        });
    }

    const eliminarProveedor = (id) => {
        $.ajax({
            type: "POST",
            url: "proveedor/eliminar/" + id,
            success: function (response) {
                const json = JSON.parse(response);
                if (json.tipo == 'success') {
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
    const habilitar = (id) => {
        $.ajax({
            type: "POST",
            url: GLOBAL.URL + "proveedor/habilitar/" + id,
            success: function (response) {
                const json = JSON.parse(response);
                if (json.tipo == 'success') {
                    Swal.fire(
                        'Activado!',
                        'El proveedor ha sido habilitado!',
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

    /**
     * Eventos
     */

    // Registrar Proveedor
    $('#formularioRegistrarProveedor').submit(function (e) {
        e.preventDefault();

        let datos = new FormData(document.querySelector('#formularioRegistrarProveedor'));

        registrarProveedor(datos);
    });

    // Mostrar Proveedor
    $('body').on('click', '.mostrar', function (e) {
        e.preventDefault();

        mostrarProveedor($(this).attr('href'), 'form#formularioMostrarProveedor', '#modalMostrarProveedor');
    });

    // Editar Proveedor

    $('body').on('click', '.editar', function (e) {
        e.preventDefault();
        console.log($(this).attr('href'));

        mostrarProveedor($(this).attr('href'), 'form#formularioActualizarProveedor', '#modalActualizarProveedor');
    });

    $('#formularioActualizarProveedor').submit(async function (e) {
        e.preventDefault();
        let requerirAutenticacion = false;
        let datos = new FormData(document.querySelector('#formularioActualizarProveedor'));
        if (datos.get('inicial_documento') != inicialDocumentoActu || datos.get('documento') != documentoActu) {
            requerirAutenticacion = true;
        }
        if (requerirAutenticacion) {
            let sesionAutenticada = await getSesionAutenticada();
            if (!sesionAutenticada) {
                iniciarAutenticacion();
                return 0;
            }
        }
        actualizarProveedor(datos);
    });


    // Eliminar Proveedor
    $('body').on('click', '.eliminar', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Esta Seguro?',
            text: "El proveedor sera eliminado del sistema!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.value) {

                eliminarProveedor($(this).attr('href'));

            }
        })
        console.log($(this).attr('href'));
    });
    //Activar el registro
    $('body').on('click', '.estatusAnulado', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Esta Seguro?',
            text: "El proveedor será habilitado en el sistema!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.value) {

                habilitar($(this).attr('href'));

            }
        })
        console.log($(this).attr('href'));
    });
});
