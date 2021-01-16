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
            { data: 'codigo' },
            { data: 'fecha' },
            { data: 'cliente' },
            { data: 'button' },
            { data: 'estado' }
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
                console.log(json);
                $('#servicio_codigo').val(json.servicio_prestado.codigo);
                $('#cliente').val(json.servicio_prestado.cliente);
                $('#cliente_documento').val(json.servicio_prestado.cliente_documento);
                $('#cliente_direccion').val(json.servicio_prestado.cliente_direccion);
                $('#empleado').val(json.servicio_prestado.empleado);
                $('#empleado_documento').val(json.servicio_prestado.empleado_documento);
                $('#empleado_direccion').val(json.servicio_prestado.empleado_direccion);
                
                $('#cuerpo').empty(); 
                $('#cuerpoServicios').empty(); 

                var totalServicios = 0;

                json.servicios.forEach( element => {
                    totalServicios += parseFloat(element.precio);

                    let row = `
                        <tr>
                            <td>${element.id}</td>
                            <td>${element.nombre}</td>
                            <td>${element.precio}</td>
                        </tr>
                    `;
                    $('#cuerpoServicios').append(row);
                    
                });
                // totalServicios = parseFloat(totalServicios).toFixed(2);
                $('#totalServicios').val(parseFloat(totalServicios).toFixed(2));
                console.log(json.venta);
                if (json.venta == null) {
                    $('.productos').hide();
                    $('#totalServicioPrestado').val(parseFloat(totalServicios).toFixed(2));
                }
                else{
                    $('.productos').show();    
                    $('#venta_codigo').val(json.venta.codigo);

                    let subtotal = 0;
                    var total = 0;

                    json.productos.forEach( element => {
                        total += element.cantidad*element.precio;
                        subtotal += element.cantidad*element.precio;

                        let row = `
                            <tr>
                                <td>${element.cantidad}</td>
                                <td>${element.codigo}</td>
                                <td>${element.nombre}</td>
                                <td>${element.precio}</td>
                                <td>${parseFloat(element.precio * element.cantidad).toFixed(2)}</td>
                            </tr>
                        `;

                        $('#subtotal').val(parseFloat(subtotal).toFixed(2));
                        $('#impuesto').val(parseFloat(subtotal * 0.16).toFixed(2))
                        $('#cuerpo').append(row);
                        
                    });

                    
                    total += total*0.16;
                    $('#total').val(parseFloat(total).toFixed(2));
                    totalServicioPrestado = totalServicios+total;
                    $('#totalServicioPrestado').val(parseFloat(totalServicioPrestado).toFixed(2));
                }
                $(modal).modal('show');
    
            },
            error: function(response) {
             console.log(response.getAllResponseHeaders())
         }
        });
    }
    const cambiarEstatus = (id) => {
        $.ajax({
            type: "POST",
            url: "/WorldComputer/Servicio/cambiarEstatus/" + id,
            success: function (response) {
                json = JSON.parse(response);

                Swal.fire(
                    json.titulo,
                    json.mensaje,
                    json.tipo
                );

                table.ajax.reload();
            },
            error: function (response) {
                console.log(JSON.parse(response));
            }
        });
    }
    // Mostrar Servicio
    $('body').on('click', '.mostrar', function (e) { 
        e.preventDefault();
    
        mostrarServicio($(this).attr('href'),'form#formularioMostrarServicio','#modalMostrarServicio','mostrar');
    });

    $('body').on('click', '.estatus', function (e) {
        e.preventDefault();

        $url = $(this).attr('href');

        Swal.fire({
            title: 'Esta Seguro?',
            text: "Cambiará el estatus del servicio prestado",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, Cambiar!'
            }).then((result) => {
                if (result.value) {
                    cambiarEstatus($url);                    
                }
            })

    });
})