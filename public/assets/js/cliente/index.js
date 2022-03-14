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
            url: 'cliente/listar'
        },
        columns: [
            { data: 'documento' },
            { data: "nombre" },
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
    const mostrarCliente = (href, formulario, modal) => {

        $.ajax({
            type: "POST",
            url: href,
            success: function (response) {
                let json = JSON.parse(response);

                if (modal == '#modalActualizarCliente') {
                    let doc = json.data.documento.split('-');
                    inicialDocumentoActu = doc[0];
                    documentoActu = doc[1];
                    $(formulario).find('input#documento').val(documentoActu);
                    $(formulario).find('select#inicial_documento').val(inicialDocumentoActu);
                } else {
                    $(formulario).find('input#documento').val(json.data.documento);

                }
                $(formulario).find('input#id').val(json.data.id);
                $(formulario).find('input#nombre').val(json.data.nombre);
                $(formulario).find('input#apellido').val(json.data.apellido);
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

    const registrarCliente = (datos) => {

        $.ajax({
            type: "POST",
            url: "cliente/guardar",
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

                    $('#modalRegistroCliente').modal('hide');
                    $('#formularioRegistrarCliente').trigger('reset');
                } else {
                    json.mensaje = desglosarMensajeError(json.mensaje);
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
    }

    const actualizarCliente = (datos) => {
        $.ajax({
            type: "POST",
            url: "cliente/actualizar",
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

                    $('#modalActualizarCliente').modal('hide');
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

    const eliminarCliente = (id) => {
        $.ajax({
            type: "POST",
            url: "cliente/eliminar/" + id,
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
            url: GLOBAL.URL + "cliente/habilitar/" + id,
            success: function (response) {
                const json = JSON.parse(response);
                if (json.tipo == 'success') {
                    Swal.fire(
                        'Activado!',
                        'El cliente ha sido habilitado!',
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
    const consultarDocumento = (form) => {
        let inicial_documento = $(form).find('#inicial_documento').val()
        let documento = $(form).find('#documento').val()
        if(inicial_documento == ''){
            return 0;
        }
        if(documento.length < 7){
            return 0;
        }
        documento = inicial_documento + '-' + documento;
        $.ajax({
            type: "POST",
            url: "Cliente/consultarDocumento/" + documento,
            success: function (response) {
                const json = JSON.parse(response);
                if (json.tipo != 'success') {
                    Swal.fire(
                        json.titulo,
                        json.mensaje,
                        json.tipo
                    )
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

    $('#formularioRegistrarCliente').submit(function (e) {
        e.preventDefault();

        let datos = new FormData(document.querySelector('#formularioRegistrarCliente'));

        //  console.log(datos.get('documento'));

        registrarCliente(datos);
    });

    // Mostrar Cliente
    $('body').on('click', '.mostrar', function (e) {
        e.preventDefault();

        mostrarCliente($(this).attr('href'), 'form#formularioMostrarCliente', '#modalMostrarCliente');
    });

    // Editar Cliente

    $('body').on('click', '.editar', function (e) {
        e.preventDefault();
        console.log($(this).attr('href'));
        mostrarCliente($(this).attr('href'), 'form#formularioActualizarCliente', '#modalActualizarCliente');
    });
    $('#formularioRegistrarCliente').on('change', '#documento', function (e){
        consultarDocumento($('#formularioRegistrarCliente'));
    });
    $('#formularioRegistrarCliente').on('change', '#inicial_documento', function (e){
        consultarDocumento($('#formularioRegistrarCliente'));
    });

    $('#formularioActualizarCliente').submit(async function (e) {
        e.preventDefault();
        let requerirAutenticacion = true;
        // let datos = new FormData(document.querySelector('#formularioActualizarCliente'));
        // if (datos.get('inicial_documento') != inicialDocumentoActu || datos.get('documento') != documentoActu) {
        //     requerirAutenticacion = true;
        // }
        if (requerirAutenticacion) {
            let sesionAutenticada = await getSesionAutenticada();
            if (!sesionAutenticada) {
                iniciarAutenticacion();
                return 0;
            }
        }
        actualizarCliente(datos);
    });


    // Eliminar Cliente
    $('body').on('click', '.eliminar', async function (e) {
        e.preventDefault();
        let sesionAutenticada = await getSesionAutenticada();
        if (!sesionAutenticada) {
            iniciarAutenticacion();
            return 0;
        }
        Swal.fire({
            title: 'Esta Seguro?',
            text: "El cliente sera eliminado del sistema!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.value) {

                eliminarCliente($(this).attr('href'));

            }
        })
        console.log($(this).attr('href'));
    });
    //Activar el registro
    $('body').on('click', '.estatusAnulado', async function (e) {
        e.preventDefault();
        let sesionAutenticada = await getSesionAutenticada();
        if (!sesionAutenticada) {
            iniciarAutenticacion();
            return 0;
        }
        Swal.fire({
            title: 'Esta Seguro?',
            text: "El cliente será habilitado en el sistema!",
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
