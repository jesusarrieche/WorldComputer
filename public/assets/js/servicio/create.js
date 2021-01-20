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
    const buscarProducto = (codigo) => {

        let producto = productos.find( element => element.codigo === codigo);

        return producto;
    }

    /**EVENTOS */

    //Agregar Cliente
    $('#agregarCliente').click(function (e) { 
        e.preventDefault();
        Toast.fire(
            'Cliente agregado!',
            'Se ha seleccionado un cliente correctamente',
            'success'
        )
        let cliente = buscarCliente($('#listadoClientes').val());

        $('#cliente').val(cliente.id);
        $('#nombreCliente').val(cliente.nombre);
        $('#documentoCliente').val(cliente.documento);

        
    });

    //Agregar Empleado
    $('#agregarEmpleado').click(function (e) { 
        e.preventDefault();
        Toast.fire(
            'Empleado agregado!',
            'Se ha seleccionado un empleado correctamente',
            'success'
        )
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
    $('#listadoProductos').change(function (e) { 
        e.preventDefault();
        
        let producto = buscarProducto($(this).val());

        $('#nombreProducto').val(producto.nombre);
        $('#stockProducto').val(producto.stock);
    });

    //Agregar servicio a tabla
    $('#agregarServicio').click(function (e) { 
        e.preventDefault();

        
        let servicio = buscarServicio($('#listadoServicios').val());
        
        Toast.fire(
            servicio.nombre + ' Agregado',
            'Servicio Agregado correctamente',
            'success'   
        )

        let fila = `
            <tr>
                <td>
                    <input type="text" name="servicios[]" class="form-control-plaintext" value="${servicio.id}" >
                </td>
                <td>
                    <input type="text" class="form-control-plaintext" value="${servicio.nombre}" disabled>
                </td>
                <td>
                    <input type="text" name="servicios_precio[]" class="form-control-plaintext precio_servicio" value="${servicio.precio}">
                </td>
                
                <td>
                    <button class="btn btn-danger eliminar"><i class="fas fa-trash-alt text-white"></i></button>
                </td>
            </tr>`;

        $('#cuerpoServicios').append(fila);
        $('#listadoServicios').val('');
        actualizarTotal();

    });
    
    $('#agregarProducto').click(function (e) { 
        e.preventDefault();

        
        let producto = buscarProducto($('#listadoProductos').val());
        
        Toast.fire(
            producto.nombre + ' Agregado',
            'Producto Agregado correctamente',
            'success'   
        )

        let fila = `
            <tr>
                <td>
                    <input type="text" name="productos[]" class="form-control-plaintext" value="${producto.id}" hidden>
                    <input type="text" name="" class="form-control-plaintext" value="${producto.codigo}" disabled>
                </td>
                <td>
                    <input type="text" class="form-control-plaintext" value="${producto.nombre}" disabled>
                </td>
                <td>
                    <input type="number" name="cantidades[]" class="form-control cantidad" value="0" min="1" max="${producto.stock}" required>
                </td>
                <td>
                    <input type="text" class="form-control-plaintext" value="${producto.stock}" disabled>
                </td>
                <td>
                    <input type="number" class="form-control-plaintext" value="${producto.precio_venta}" disabled>
                    <input type="number" name="precios[]" class="form-control precio" value="${producto.precio_venta}" hidden required>

                </td>
                <td>
                    <input type="number" class="form-control-plaintext total" value="0" disabled>
                </td>
                <td>
                    <button class="btn btn-danger eliminar"><i class="fas fa-trash-alt text-white"></i></button>
                </td>
            </tr>`;

        $('#cuerpo').append(fila);
        $('#listadoProductos').val('');

    });


    // Cambio en input de labla de productos
    $('#tproductos').on('change', 'input', function(e){
        e.preventDefault();
        // alert('funciona');

        let row = $(this).closest('tr');
        let total = row.find('.cantidad').val() * row.find('.precio').val();

        row.find('.total').val(total.toFixed(2));

        actualizarTotal();
    
    });

    // Eliminar Articulo de la Lista
    $('tbody').on('click', '.eliminar',function (e) { 
        e.preventDefault();
        
        $(this).parents('tr').remove();
        actualizarTotal();

    });
    function actualizarTotal() {
        var totalServicios, totalProductos;
        //total servicios
        let elementos = document.querySelectorAll('.precio_servicio');
        totalServicios = 0;

        elementos.forEach(element => {
            totalServicios = parseFloat(totalServicios) + parseFloat(element.value);
        });
        $('#totalServicios').val((totalServicios).toFixed(2)); 

        //total productos
        let elementosP = document.querySelectorAll('.total');
        totalProductos = 0;
        elementosP.forEach(element => {
            totalProductos = parseFloat(totalProductos) + parseFloat(element.value);
        });      
        let impuestos = totalProductos * (iva/100);
        $('#impuesto').val(impuestos.toFixed(2));
        $('#subtotal').val(totalProductos.toFixed(2));
        totalProductos = totalProductos + impuestos;
        $('#totalVenta').val((totalProductos).toFixed(2));
        //total
        $('#totalServicioPrestado').val((totalServicios+totalProductos).toFixed(2));
    }

    $('#formularioServicio').submit(function (e){
        e.preventDefault();
        let empleado = buscarEmpleado($('#listadoEmpleados').val());
        let cliente = buscarCliente($('#listadoClientes').val());
        
        if($('#cliente').val() == '' || $('#cliente').val() == null){
            Swal.fire(
                'Seleccione un Cliente',
                'Debe incluir un cliente',
                'warning'
            )           
            return false;
        }
        if($('#empleado').val() == '' || $('#empleado').val() == null){
            Swal.fire(
                'Seleccione un Empleado',
                'Debe incluir un empleado',
                'warning'
            )    
            return false;
        }
        let form = $(this);
        let cantidadServicios = 0;
        let totalfilas = document.querySelectorAll('.precio_servicio');
        
        totalfilas.forEach(element => {
                cantidadServicios++;
        });  
        if(cantidadServicios == 0){
            Swal.fire(
                'Servicio Vacío',
                'Debe seleccionar al menos un servicio',
                'warning'
            )
    
            return false;
        }  

        actualizarTotal();
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
                if (json.tipo=="success") {
                    setTimeout(function(){
                        location="./ProvidedServices";
                    },700);
                }
                
            },
            error: function (response) {
                console.log(response);
            }
        });
    });
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-start',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
});