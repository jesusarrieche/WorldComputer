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



        let cliente = buscarCliente($('#listadoClientes').val());

        $('#cliente').val(cliente.id);
        $('#nombreCliente').val(cliente.nombre);
        $('#documentoCliente').val(cliente.documento);

        
    });

    //Agregar Empleado
    $('#agregarEmpleado').click(function (e) { 
        e.preventDefault();


        let empleado = buscarEmpleado($('#listadoEmpleados').val());

        $('#empleado').val(empleado.id);
        $('#nombreEmpleado').val(empleado.nombre);
        $('#cedulaEmpleado').val(empleado.documento);

        
    });

    $('#listadoServicios').change(function (e) { 
        e.preventDefault();
        
        let servicio = buscarServicio($(this).val());
        

        $('#servicio').val(servicio.id);
        $('#descripcionServicio').val(servicio.descripcion);
        $('#precioServicio').val(servicio.precio);
    });

    //Agregar servicio a tabla
    $('#formularioServicio').on('submit',function (e) { 
        e.preventDefault();

        
        let servicio = buscarServicio($('#listadoServicios').val());
        let empleado = buscarEmpleado($('#listadoEmpleados').val());
        let cliente = buscarCliente($('#listadoClientes').val());
        
       

    });

    // Eliminar Articulo de la Lista
    $('tbody').on('click', '.eliminar',function (e) { 
        e.preventDefault();
        
        $(this).parents('tr').remove();

    });


    $('#formularioServicio').submit(function (e){
        e.preventDefault();

        let form = $(this)

        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            success: function (response) {
                console.log(response);
               json = JSON.parse(response);
                console.log(json);

                
                Swal.fire(
                    json.titulo,
                    json.mensaje,
                    json.tipo
                );

                setTimeout(function(){
                    location.reload();
                },2000);
            },
            error: function (response) {
                console.log(response);
            }
        });
    })

})