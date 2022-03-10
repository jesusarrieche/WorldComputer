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
            url: "Usuario/listar"
        },
        columns: [
            { data: 'documento' },
            { data: "nombre" },
            { data: 'usuario' },
            { data: 'rol' },
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
    var seguridadImg = "", seguridadImgActu = "", seguridadPreguntaActu = "";
    var correoActu = "", rolUsuarioActu = "";
    /**
     * FUNCIONES
     */
    const mostrarUsuario = (href, formulario, modal) => {
        $.ajax({
            type: "POST",
            url: href,
            success: function (response) {
                let json = JSON.parse(response);
                if (modal == '#modalActualizarUsuario') {
                    let doc = json.data.documento.split('-');
                    let inicial = doc[0];
                    let documento = doc[1];
                    $(formulario).find('input#documento').val(documento);
                    $(formulario).find('select#inicial_documento').val(inicial);
                    $(formulario).find('input#contrasena').val("");
                    $(formulario).find('input#confirmarContrasena').val("");
                    correoActu = json.data.email;
                    rolUsuarioActu = json.data.rol_id;
                    $('.card-seguridad-img').removeClass('bg-primary');
                    seguridadImgActu = "";
                    seguridadPreguntaActu = json.data.seguridad_pregunta;
                } else {
                    $(formulario).find('input#documento').val(json.data.documento);
                }
                $(formulario).find('input#id').val(json.data.id);
                $(formulario).find('input#nombre').val(json.data.nombre);
                $(formulario).find('input#apellido').val(json.data.apellido);
                $(formulario).find('input#telefono').val(json.data.telefono);
                $(formulario).find('input#correo').val(json.data.email);
                $(formulario).find('input#direccion').val(json.data.direccion);
                $(formulario).find('input#usuario').val(json.data.usuario);
                $(formulario).find('select#rolUsuario').val(json.data.rol_id);

                $(modal).modal('show');
            },
            error: function (response) {
                console.log(response.getAllResponseHeaders())
            }
        });
    }

    const registrarUsuario = (datos) => {
        $.ajax({
            type: "POST",
            url: "Usuario/guardar",
            data: datos,
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
                    $('#modalRegistroUsuario').modal('hide');
                    $('#formularioRegistrarUsuario').trigger('reset');
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

    const actualizarUsuario = (datos) => {
        $.ajax({
            type: "POST",
            url: "Usuario/actualizar",
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
                    $('#modalActualizarUsuario').modal('hide');
                    $('#formularioActualizarUsuario').trigger('reset');
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

    const eliminarUsuario = (id) => {
        $.ajax({
            type: "POST",
            url: "Usuario/eliminar/" + id,
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
                else {
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
    const habilitar = (id) => {
        $.ajax({
            type: "POST",
            url: "usuario/habilitar/" + id,
            success: function (response) {
                const json = JSON.parse(response);
                if (json.tipo == 'success') {
                    Swal.fire(
                        'Activado!',
                        'El usuario ha sido habilitado!',
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
            url: "Usuario/consultarDocumento/" + documento,
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
    $('#formularioRegistrarUsuario').submit(async function (e) {
        e.preventDefault();
        let datos = new FormData(document.querySelector('#formularioRegistrarUsuario'));

        if (datos.get('contrasena') != datos.get('confirmarContrasena')) {
            Swal.fire(
                "Error",
                "Las Contraseñas no coinciden",
                "warning"
            );
            return 0;
        }
        if (seguridadImg == "") {
            Swal.fire(
                "Error",
                "Debe escoger una imagen de seguridad",
                "warning"
            );
            return 0;
        }
        if (datos.get('seguridad_pregunta') == "" || datos.get('seguridad_respuesta') == "" ||
            datos.get('seguridad_respuesta').length < 3 || datos.get('seguridad_respuesta').length > 20) {
            Swal.fire(
                "Error",
                `Escoja una pregunta de seguridad e indique la respuesta.\n
                    Debe contener entre 3 y 20 caracteres`,
                "warning"
            );
            return 0;
        }
        if (datos.get('rolUsuario') == '1') {
            let sesionAutenticada = await getSesionAutenticada();
            if (!sesionAutenticada) {
                iniciarAutenticacion();
                return 0;
            }
        }
        datos.append('seguridad_img', seguridadImg);
        console.log(datos.get('seguridad_img'))
        registrarUsuario(datos);
    });
    //Selección de imagen de seguridad
    $('.card-seguridad-img').on('click', function (e) {
        if ($(this).attr('data-action') == "registrar") {
            seguridadImg = $(this).attr('data-img');
        }
        else {
            seguridadImgActu = $(this).attr('data-img');
        }
        $('.card-seguridad-img').removeClass('bg-primary');
        $(this).addClass('bg-primary');
    })
    // Mostrar Usuario
    $('body').on('click', '.mostrar', function (e) {
        e.preventDefault();
        mostrarUsuario($(this).attr('href'), 'form#formularioMostrarUsuario', '#modalMostrarUsuario');
    });

    // Editar Usuario
    $('body').on('click', '.editar', function (e) {
        e.preventDefault();
        mostrarUsuario($(this).attr('href'), 'form#formularioActualizarUsuario', '#modalActualizarUsuario');
    });

    $('#formularioRegistrarUsuario').on('change', '#documento', function (e){
        consultarDocumento($('#formularioRegistrarUsuario'));
    });
    $('#formularioRegistrarUsuario').on('change', '#inicial_documento', function (e){
        consultarDocumento($('#formularioRegistrarUsuario'));
    });
    
    $('#formularioActualizarUsuario').submit(async function (e) {
        e.preventDefault();
        let requerirAutenticacion = false;
        let datos = new FormData(document.querySelector('#formularioActualizarUsuario'));
        if (datos.get('contrasena') != datos.get('confirmarContrasena')) {
            Swal.fire(
                "Error",
                "Las Contraseñas no coinciden",
                "warning"
            );
            return 0;
        }
        if (datos.get('seguridad_respuesta') != "" &&
            (datos.get('seguridad_respuesta').length < 3 || datos.get('seguridad_respuesta').length > 20)) {
            Swal.fire(
                "Error",
                `Escoja una pregunta de seguridad e indique la respuesta.\n
                    Debe contener entre 3 y 20 caracteres`,
                "warning"
            );
            return 0;
        }
        //Si se cambia algún dato sensible se exige autenticación de usuario
        if (datos.get('correo') != correoActu || datos.get('rolUsuario') != rolUsuarioActu || seguridadImgActu != "" ||
            datos.get('seguridad_pregunta') != seguridadPreguntaActu || datos.get('seguridad_respuesta') != "") {
            requerirAutenticacion = true;
        }
        if (requerirAutenticacion) {
            let sesionAutenticada = await getSesionAutenticada();
            if (!sesionAutenticada) {
                iniciarAutenticacion();
                return 0;
            }
        }
        datos.append('seguridad_img', seguridadImgActu);
        actualizarUsuario(datos);
    });
    // Eliminar Usuario
    $('body').on('click', '.eliminar', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Esta Seguro?',
            text: "El usuario sera eliminado del sistema!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.value) {

                eliminarUsuario($(this).attr('href'));

            }
        })
    });
    //Activar el registro
    $('body').on('click', '.estatusAnulado', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Esta Seguro?',
            text: "El usuario será habilitado en el sistema!",
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
