<div class="content p-4 dataTables_wrapper">
    <h2 class="mb-4">Gestión de Empleado</h2>

    <div class="card mb-4">
        <div class="card-header bg-white">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistroEmpleado"
          <?php $band = false;
                foreach ($_SESSION['permisos'] as $p):
                    if ($p->permiso == "Registrar Empleados") {     
                        $band = true;
                }endforeach;     
                if (!$band) {
                    echo "disabled";
                }           
            ?>
          >
            <i class="fas fa-plus-square"></i> Agregar Empleado
          </button>
        </div>
        <div class="card-body">
          <table class="table" id="datatable">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Cédula/RIF</th>
                <th scope="col">Nombre y Apellido</th>
                <th scope="col">Cargo</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Acción</th>
              </tr>
            </thead>
            <tbody>
                
            </tbody>
          </table>
        </div>
    </div>
</div>

    <!-- Modal Registro -->
    <div class="modal fade" id="modalRegistroEmpleado" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="card">
                    <div class="card-header">
                            <h2 class="text-center">Registrar Empleado</h2>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data" id="formularioRegistrarEmpleado">
                            <div class="row form-group">
                                <input  name="id" id="id" hidden>
                                <label for="nombre" class="col-form-label col-md-2">Nombre:</label>
                                <div class="col-md-4 ">
                                    <input type="text" name="nombre" id="nombre" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="30" required="required" class="form-control" placeholder="Nombre">
                                </div> 

                                <label for="apellido" class="col-form-label col-md-2">Apellido:</label>
                                <div class="col-md-4 ">
                                    <input type="text" name="apellido" id="apellido" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="30" required="required"  class="form-control" placeholder="Apellido">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="cedula_empleado" class="col-form-label col-md-2">Cedula/RIF:</label>
                                <div class="col-md-1 ">
                                    <select class="form-control pl-0 pr-0" name="inicial_documento" id="inicial_documento" required="">
                                        <option value="" selected="">-</option>
                                        <option value="V">V</option>
                                        <option value="E">E</option>
                                        <option value="J">J</option>
                                        <option value="G">G</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" pattern="[0-9]{6,8}" name="documento" id="documento" minlength="6" maxlength="8" title="Ingrese entre 6 y 8 digitos" class="form-control" placeholder="Identificaion" required="">
                                </div>
                                <label for="telefono" class="col-form-label col-md-2">Telefono:</label>
                                <div class="col-md-4 ">
                                    <input type="tel" name="telefono" id="telefono" title="Debe Contener minimo 11 Caracteres numericos" minlength="10"  maxlength="12" pattern="[0-9-]+" required class="form-control" placeholder="Telefono">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="correo" class="col-form-label col-md-2">Correo:</label>
                                <div class="col-md-4 ">
                                    <input type="email" name="correo" id="correo" required class="form-control" placeholder="Correo Electronico">
                                </div>

                                <label for="direccion" class="col-form-label col-md-2">Direccion:</label>
                                <div class="col-md-4">
                                    <input type="text" name="direccion" id="direccion" pattern="[A-Za-z0-9/ ]+" required maxlength="150" class="form-control" placeholder="Direccion" >
                                </div>
                                
                            </div>
                            <div class="row form-group">
                                <label for="cargo" class="col-form-label col-md-2">Cargo:</label>
                                <div class="col-md-5">
                                    <input type="text" name="cargo" id="cargo" pattern="[A-Za-z0-9/ ]+" required maxlength="150" class="form-control" placeholder="Cargo" >
                                </div>
                            </div>

                            <hr class="bg-secondary">

                            <div class="row form-group justify-content-md-center">
                                <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
                                <button type="submit"  class="btn btn-success m-2">Enviar</button>
                                <button type="reset" class="btn btn-danger m-2">Limpiar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal mostrar -->
    <div class="modal fade" id="modalMostrarEmpleado" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="card">
                    <div class="card-header">
                            <h2 class="text-center">Empleado</h2>
                    </div>
                    <div class="card-body">
                        <form id="formularioMostrarEmpleado">
                            <div class="row form-group">
                                <input  name="id" id="id" value="" hidden>
                                <label for="nombre" class="col-form-label col-md-2"><strong>Nombre:</strong></label>
                                <div class="col-md-4 ">
                                    <input type="text" name="nombre" id="nombre" value="" class="form-control-plaintext" disabled placeholder="Nombre">
                                </div> 

                                <label for="apellido" class="col-form-label col-md-2"><strong>Apellido:</strong></label>
                                <div class="col-md-4 ">
                                    <input type="text" name="apellido" id="apellido" class="form-control-plaintext" disabled placeholder="Apellido">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="cedula_empleado" class="col-form-label col-md-2"><strong>Cedula|RIF:</strong></label>
                              
                                <div class="col-md-4">
                                    <input type="text" id="documento" class="form-control-plaintext" placeholder="Identificaion" disabled>
                                </div>
                                <label for="telefono" class="col-form-label col-md-2"><strong>Telefono:</strong></label>
                                <div class="col-md-4 ">
                                    <input type="tel" id="telefono" class="form-control-plaintext" disabled placeholder="Telefono">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="correo"><strong>Correo:</strong></label>
                                <input type="email" id="correo" class="form-control-plaintext" disabled placeholder="Correo Electronico">
                            </div>

                            <div class="form-group">
                                <label for="direccion"><strong>Direccion:</strong></label> 
                                <input type="text" id="direccion" class="form-control-plaintext" disabled placeholder="Direccion" > 
                            </div>
                            <div class="form-group">
                                <label for="cargo"><strong>Cargo:</strong></label> 
                                <input type="text" id="cargo" class="form-control-plaintext" disabled placeholder="Cargo" > 
                            </div>

                            <hr class="bg-secondary">

                            <div class="row form-group justify-content-md-center">
                                <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal actualizar -->
    <div class="modal fade" id="modalActualizarEmpleado" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="card">
                    <div class="card-header">
                            <h2 class="text-center">Actualizar Empleado</h2>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data" id="formularioActualizarEmpleado">
                            <div class="row form-group">
                                <input  name="id" id="id" hidden>
                                <label for="nombre" class="col-form-label col-md-2">Nombre:</label>
                                <div class="col-md-4 ">
                                    <input type="text" name="nombre" id="nombre" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="30" required="required" class="form-control" placeholder="Nombre">
                                </div> 

                                <label for="apellido" class="col-form-label col-md-2">Apellido:</label>
                                <div class="col-md-4 ">
                                    <input type="text" name="apellido" id="apellido" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="30" required="required"  class="form-control" placeholder="Apellido">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="cedula_empleado" class="col-form-label col-md-2">Cedula/RIF:</label>
                                <div class="col-md-1 ">
                                    <select class="form-control pl-0 pr-0" name="inicial_documento" id="inicial_documento" required="">
                                        <option value="" selected="">-</option>
                                        <option value="V">V</option>
                                        <option value="E">E</option>
                                        <option value="J">J</option>
                                        <option value="G">G</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" pattern="[0-9]{6,8}" name="documento" id="documento" minlength="6" maxlength="8" title="Ingrese entre 6 y 8 digitos" class="form-control" placeholder="Identificaion" required="">
                                </div>
                                <label for="telefono" class="col-form-label col-md-2">Telefono:</label>
                                <div class="col-md-4 ">
                                    <input type="tel" name="telefono" id="telefono" title="Debe Contener minimo 11 Caracteres numericos" minlength="10"  maxlength="12" pattern="[0-9-]+" required class="form-control" placeholder="Telefono">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="correo" class="col-form-label col-md-2">Correo:</label>
                                <div class="col-md-4 ">
                                    <input type="email" name="correo" id="correo" required class="form-control" placeholder="Correo Electronico">
                                </div>

                                <label for="direccion" class="col-form-label col-md-2">Direccion:</label>
                                <div class="col-md-4">
                                    <input type="text" name="direccion" id="direccion" pattern="[A-Za-z0-9/ ]+" required maxlength="150" class="form-control" placeholder="Direccion" >
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="cargo" class="col-form-label col-md-2">Cargo:</label>
                                <div class="col-md-5">
                                    <input type="text" name="cargo" id="cargo" pattern="[A-Za-z0-9/ ]+" required maxlength="150" class="form-control" placeholder="Cargo" >
                                </div>
                            </div>
                            <hr class="bg-secondary">

                            <div class="row form-group justify-content-md-center">
                                <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
                                <button type="submit"  class="btn btn-success m-2">Enviar</button>
                                <button type="reset" class="btn btn-danger m-2">Limpiar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php require VIEWS . "modalAutenticarUsuario.php"; ?>
    <script src="<?= ROOT; ?>public/assets/js/empleado/index.js"></script>


