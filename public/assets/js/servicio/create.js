$(document).ready(function () {


    const buscarCliente = (id) => {

        let cliente = clientes.find( element => element.id === id);

        return cliente;
    }
    const buscarEmpleado = (id) => {

        let empleado = empleados.find( element => element.id === id);

        return empleado;
    }

    const buscarServicio = (id) => {

        let servicio = servicios.find( element => element.id === id);

        return servicio;
    }

    /**EVENTOS */

    //Agregar Cliente
    $('#agregarCliente').click(function (e) { 
        e.preventDefault();

        Swal.fire(
            'Cliente agregado!',
            'Se ha seleccionado un cliente correctamente',
            'success'
        )

        let cliente = buscarCliente($('#listadoClientes').val());

        $('#cliente').val(cliente.nombre);
        $('#nombreCliente').val(cliente.nombre);
        $('#documentoCliente').val(cliente.documento);

        
    });

    //Agregar Empleado
    $('#agregarEmpleado').click(function (e) { 
        e.preventDefault();

        Swal.fire(
            'Empleado agregado!',
            'Se ha seleccionado un empleado correctamente',
            'success'
        )

        let empleado = buscarEmpleado($('#listadoEmpleados').val());

        $('#empleado').val(empleado.nombre);
        $('#nombreEmpleado').val(empleado.nombre);
        $('#cedulaEmpleado').val(empleado.documento);

        
    });

    $('#listadoServicios').change(function (e) { 
        e.preventDefault();
        
        let servicio = buscarServicio($(this).val());
        

        $('#descripcionServicio').val(servicio.descripcion);
        $('#precioServicio').val(servicio.precio);
    });

    //Agregar servicio a tabla
    $('#agregarServicio').click(function (e) { 
        e.preventDefault();

        
        let servicio = buscarServicio($('#listadoServicios').val());
        let empleado = buscarEmpleado($('#listadoEmpleados').val());
        let cliente = buscarCliente($('#listadoClientes').val());
        
        Swal.fire(
            servicio.nombre + ' Agregado',
            'Servicio Agregado correctamente',
            'success'   
        )

        let fila = `
            <tr>
                <td>
                    <input type="text" name="servicios[]" class="form-control-plaintext" value="${servicio.id}" hidden>
                    <input type="text" name="" class="form-control-plaintext" value="${cliente.nombre}" disabled>
                </td>
                <td>
                    <input type="text" class="form-control-plaintext" value="${empleado.nombre}" disabled>
                </td>
                <td>
                    <input type="text" class="form-control-plaintext" value="${servicio.nombre}" disabled>
                </td>
                <td>
                    <input type="number" name="precios[]" class="form-control precio" value="${servicio.precio}" min="0" required>
                </td>
                <td>
                    <button class="btn btn-danger eliminar"><i class="fas fa-trash-alt text-white"></i></button>
                </td>
            </tr>`;

        $('#cuerpo').append(fila);
        $('#listadoServicios').val('');

    });

    // Eliminar Articulo de la Lista
    $('tbody').on('click', '.eliminar',function (e) { 
        e.preventDefault();
        
        $(this).parents('tr').remove();

    });


    $('#formularioServicio').submit(function (e){
        e.preventDefault();
    
        Swal.fire(
            'Servicios Agregados',
            'Servicios Agregados correctamente',
            'success'   
        ).then((result) => {

            window.location.replace(backUrl);
        })
    })

})