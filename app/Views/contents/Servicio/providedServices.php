<div class="content p-4 dataTables_wrapper">
    <h2 class="mb-4">Gestion de Servicios Prestados</h2>

    <div class="card mb-4">
        <div class="card-header bg-white">
          <a class="btn btn-primary" href="<?= ROOT;?>Servicio/create">
            <i class="fas fa-plus-square"></i> Agregar Servicio Prestado
          </a>
        </div>
        <div class="card-body">
          <table class="table" id="datatable">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Codigo</th>
                <th scope="col">cantidad</th>
                <th scope="col">precio</th>
                <th scope="col">Cod. Empleado</th>
                <th scope="col">Cod. Venta</th>
                <th scope="col">Cod. Servicio</th>
                <th scope="col">Fecha</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
    </div>
</div>

<!-- Modal de mostrar -->
<div class="modal fade " id="modalMostrarServicio" tabindex="-1" role="dialog" aria-labelledby="mostrarServicioLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mostrarServicioLabel">mostrar Servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" enctype="multipart/form-data" id="formularioMostrarServicio">
            <div class="row form-group">
                <div class="col-md-6">
                    <input  name="id" id="id" hidden>
                    <label for="mostrarServicioNombre">Nombre:</label>
                    <input disabled type="text" name="mostrarServicioNombre" id="mostrarServicioNombre" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="30" required="required" class="form-control" placeholder="Nombre">
                </div>
                <div class="col-md-6">
                    <label for="mostrarServicioPrecio">Precio:</label>
                    <input disabled type="number" name="mostrarServicioPrecio" id="mostrarServicioPrecio" maxlength="30" required="required" class="form-control" placeholder="Precio">
                </div>
            </div>

            <div class="form-group">
                <label for="mostrarServicioDescripcion">Descripción</label>
                <textarea disabled class="form-control" id="mostrarServicioDescripcion" placeholder="Descripción del servicio" rows="3"></textarea>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <label for="mostrarVentaFecha">Codigo Venta:</label>
                    <input disabled type="text" name="mostrarVentaFecha" id="mostrarVentaFecha" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="30" required="required" class="form-control" placeholder="Nombre">
                </div>
                <div class="col-md-6">
                    <label for="mostrarServicioFecha">Fecha:</label>
                    <input disabled type="text" name="mostrarServicioFecha" id="mostrarServicioFecha" required="required" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <label for="mostrarEmpleadoNombre">Empleado:</label>
                    <input disabled type="text" name="mostrarEmpleadoNombre" id="mostrarEmpleadoNombre" required="required" class="form-control">
                </div>
            </div>

            
            <div class="modal-footer">
              <button type="submit"  class="btn btn-success m-2">Enviar</button>
              <button type="reset" class="btn btn-danger m-2">Limpiar</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<script>
    let empleados = <?= json_encode($empleados) ?>;
    let ventas = <?= json_encode($ventas) ?>;
    let servicios = <?= json_encode($servicios) ?>;
</script>
<script src="<?= ROOT; ?>public/assets/js/servicio/providedServices.js"></script>
