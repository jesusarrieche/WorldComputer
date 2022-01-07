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
            url: 'producto/listar'
        },
        columns: [
            { data: 'codigo' },
            { data: "nombre" },
            { data: 'categoria' },
            { data: 'precio_venta' },
            { data: 'precio_bss' },
            { data: 'stock' },
            { data: 'estatus' },
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
    var codigoActu = "";
    /**
     * FUNCIONES
     */
    const listarUnidades = (idFormulario) => {

        $.ajax({
            type: "POST",
            url: "unidad/listar",
            success: function (response) {
                json = JSON.parse(response);


                let select = document.querySelector(idFormulario + ' #unidad');
                let unidades = json.data;

                unidades.forEach((element) => {

                    let option = document.createElement('option');
                    option.value = element.id;
                    option.innerHTML = element.abreviatura + ' - ' + element.nombre;

                    select.append(option);
                });

            },
            error: function (response) {
                console.log(response);
            }
        });
    }

    const listarCategorias = (idFormulario) => {

        $.ajax({
            type: "POST",
            url: "categoria/listar",
            success: function (response) {
                let json = JSON.parse(response);


                let select = document.querySelector(idFormulario + ' #categoria');
                let categorias = json.data;

                categorias.forEach((element) => {

                    let option = document.createElement('option');
                    option.value = element.id;
                    option.innerHTML = element.nombre;

                    select.append(option);
                });


            },
            error: function (response) {
                console.log(response);
            }
        });

    }

    const mostrarProducto = (href, formulario, modal) => {

        $.ajax({
            type: "POST",
            url: href,
            success: function (response) {
                let json = JSON.parse(response);

                if (modal == '#modalActualizarProducto') {

                    $(formulario).find('input#id').val(json.data.id);
                    $(formulario).find('input#codigo').val(json.data.codigo);
                    $(formulario).find('input#nombre').val(json.data.nombre);
                    $(formulario).find('input#precio').val(json.data.precio);
                    $(formulario).find('input#precio_costo').val(json.data.precio_costo);
                    $(formulario).find('select#categoria').val(json.data.categoria_id);
                    $(formulario).find('select#unidad').val(json.data.unidad_id);
                    $(formulario).find('input#porcentaje').val(json.data.porcentaje);
                    $(formulario).find('textarea#descripcion').val(json.data.descripcion);
                    $(formulario).find('input#stock_min').val(json.data.stock_min);
                    $(formulario).find('input#stock_max').val(json.data.stock_max);
                    $(formulario).find('input#stock').val(json.data.stock);
                    $(formulario).on('keyup', '#porcentaje', function (e) {
                        let precio_costo = parseFloat($(formulario).find('input#precio_costo').val());
                        if (precio_costo != null) {
                            let porcentaje = parseFloat($(this).val());
                            let precio = (precio_costo * (porcentaje / 100)) + precio_costo;
                            $(formulario).find('input#precio').val(precio);
                        }
                    });
                    codigoActu = json.data.codigo;
                } else {

                    $(formulario).find('input#id').val(json.data.id);
                    $(formulario).find('input#codigo').val(json.data.codigo);
                    $(formulario).find('input#nombre').val(json.data.nombre);
                    $(formulario).find('input#categoria').val(json.data.categoria);
                    $(formulario).find('input#unidad').val(json.data.unidad);
                    $(formulario).find('input#precio').val(json.data.precio);
                    $(formulario).find('input#porcentaje').val(json.data.porcentaje);
                    $(formulario).find('input#precio_costo').val(json.data.precio_costo);
                    $(formulario).find('textarea#descripcion').val(json.data.descripcion);
                    $(formulario).find('input#stock_min').val(json.data.stock_min);
                    $(formulario).find('input#stock_max').val(json.data.stock_max);
                    $(formulario).find('input#stock').val(json.data.stock);
                }

                $(modal).modal('show');


            },
            error: (response) => {
                console.log(response);
            }
        });
    }

    const registrarProducto = (datos) => {

        $.ajax({
            type: "POST",
            url: "producto/guardar",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                let json = JSON.parse(response);

                if (json.tipo == 'success') {

                    Swal.fire(
                        json.titulo,
                        json.mensaje,
                        json.tipo
                    );

                    table.ajax.reload();

                    $('#modalRegistroProducto').modal('hide');
                    $('#formularioRegistroProducto').trigger('reset');
                } else {
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

    const actualizarProducto = (datos) => {
        $.ajax({
            type: "POST",
            url: "producto/actualizar",
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

                    $('#modalActualizarProducto').modal('hide');
                } else {
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

    const eliminarProducto = (id) => {
        $.ajax({
            type: "POST",
            url: "producto/eliminar/" + id,
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

    const habilitarProducto = (id) => {
        $.ajax({
            type: "POST",
            url: "producto/habilitar/" + id,
            success: function (response) {
                const json = JSON.parse(response);
                if (json.tipo == 'success') {
                    Swal.fire(
                        'Activado!',
                        'El producto ha sido habilitado!',
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


    const generarCodigo = (letra, longitud, numeroFinal, elemento) => {
        $.ajax({
            type: "POST",
            url: "Producto/generarCodigo",
            data: { letra: letra, longitud: longitud, numero: numeroFinal },
            success: function (response) {
                let json = JSON.parse(response);

                document.querySelector(elemento).value = json.data;
            },
            error: function (response) {
                console.log(response);
            }
        });
    }

    /**
     * Eventos
     */

    listarUnidades('#formularioRegistroProducto');
    listarCategorias('#formularioRegistroProducto');

    listarUnidades('#formularioActualizarProducto');
    listarCategorias('#formularioActualizarProducto');


    // Registrar Producto
    document.querySelector('#formularioRegistroProducto').addEventListener('submit', (e) => {
        e.preventDefault();

        let datos = new FormData(document.querySelector('#formularioRegistroProducto'));

        registrarProducto(datos);

    });

    document.querySelector('#formularioRegistroProducto #generarCodigo').addEventListener('click', (e) => {
        e.preventDefault();

        generarCodigo('P', 6, Math.floor(Math.random() * 10), '#formularioRegistroProducto #codigo');
    });

    // $('#formularioRegistroProducto').submit(function (e) { 
    //     e.preventDefault();

    //     let datos = new FormData(document.getElementById('formularioRegistrarProducto'));

    //     registrarProducto(datos);   
    // });

    // Mostrar Producto
    $('body').on('click', '.mostrar', function (e) {
        e.preventDefault();
        console.log($(this).attr('href'));
        mostrarProducto($(this).attr('href'), 'form#formularioMostrarProducto', '#modalMostrarProducto');
    });




    // Editar Producto

    $('body').on('click', '.editar', function (e) {
        e.preventDefault();
        console.log($(this).attr('href'));

        mostrarProducto($(this).attr('href'), 'form#formularioActualizarProducto', '#modalActualizarProducto');
    });

    $('#formularioActualizarProducto').submit(async function (e) {
        e.preventDefault();
        let requerirAutenticacion = false;
        let datos = new FormData(document.querySelector('#formularioActualizarProducto'));
        if (datos.get('codigo') != codigoActu) {
            requerirAutenticacion = true;
        }
        if (requerirAutenticacion) {
            let sesionAutenticada = await getSesionAutenticada();
            if (!sesionAutenticada) {
                iniciarAutenticacion();
                return 0;
            }
        }
        actualizarProducto(datos);
    });

    // Eliminar Producto
    $('body').on('click', '.eliminar', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Esta Seguro?',
            text: "El producto sera eliminado del sistema!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, estoy seguro!'
        }).then((result) => {
            if (result.value) {

                eliminarProducto($(this).attr('href'));

            }
        })
        console.log($(this).attr('href'));
    });

    $('body').on('click', '.estatusAnulado', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Esta Seguro?',
            text: "El producto será habilitado en el sistema!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, estoy seguro!'
        }).then((result) => {
            if (result.value) {

                habilitarProducto($(this).attr('href'));

            }
        })
        console.log($(this).attr('href'));
    });

});