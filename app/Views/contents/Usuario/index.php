<div class="content p-4 dataTables_wrapper">
    <h2 class="mb-4">Gestión de Usuario</h2>

    <div class="card mb-4">
        <div class="card-header bg-white">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistroUsuario" <?php $band = false;?>>
                <i class="fas fa-plus-square"></i> Agregar Usuarios
            </button>
        </div>
        <div class="card-body">
            <table class="table" id="datatable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Cédula/RIF</th>
                        <th scope="col">Nombre y Apellido</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

</div>
</div>



<!-- Modal Registro -->
<div class="modal fade" id="modalRegistroUsuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Nuevo Usuario</h2>
                </div>
                <div class="card-body">
                    <form action="#" method="POST" enctype="multipart/form-data" id="formularioRegistrarUsuario">

                        <div class="form-row justify-content-center">
                            <h4 class="text-center">Datos Personales</h4>
                        </div>

                        <hr>

                        <div class="row form-group">
                            <input name="id" id="id" hidden>
                            <label for="nombre" class="col-form-label col-md-2">Nombre:</label>
                            <div class="col-md-4 ">
                                <input type="text" name="nombre" id="nombre" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="30" required="required" class="form-control" placeholder="Nombre">
                            </div>

                            <label for="apellido" class="col-form-label col-md-2">Apellido:</label>
                            <div class="col-md-4 ">
                                <input type="text" name="apellido" id="apellido" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="30" required="required" class="form-control" placeholder="Apellido">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label for="cedula_cliente" class="col-form-label col-md-2">Cedula/RIF:</label>
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
                                <input type="tel" name="telefono" id="telefono" title="Debe Contener minimo 11 Caracteres numericos" minlength="10" maxlength="12" pattern="[0-9-]+" required class="form-control" placeholder="Telefono">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="correo" class="col-form-label col-md-2">Correo:</label>
                            <div class="col-md-4 ">
                                <input type="email" name="correo" id="correo" required class="form-control" placeholder="Correo Electronico">
                            </div>

                            <label for="direccion" class="col-form-label col-md-2">Direccion:</label>
                            <div class="col-md-4">
                                <input type="text" name="direccion" id="direccion" pattern="[A-Za-z0-9/ ]+" required maxlength="150" class="form-control" placeholder="Direccion">
                            </div>
                        </div>

                        <hr class="bg-secondary">

                        <div class="form-row justify-content-center">
                            <h4 class="text-center">Usuario</h4>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="user">Nombre de Usuario</label>
                            <input id="usuario" name="usuario" type="text" class="form-control" required minlength="8" maxlength="20">
                        </div>
                        <div class="form-row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="pass">Password</label>
                                    <input type="password" class="form-control" name="contrasena" id="contrasena" required minlength="8" maxlength="20">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="pass">Confirmar Password</label>
                                    <input type="password" class="form-control" name="confirmarContrasena" id="confirmarContrasena" required minlength="8" maxlength="20">
                                </div>
                            </div>
                        </div>
                        <hr class="bg-secondary">

                        <div class="form-row justify-content-center">
                            <h4 class="text-center">Rol de Usuario</h4>
                        </div>


                        <div class="form-row">
                            <small class=" form-text">**Por favor seleccione un rol de usuario</small>
                        </div>
                        <hr>

                        <div class="form-row" id="listadoRoles">
                            <select class="form-control w-50" name="rolUsuario" id="rolUsuario">
                                <?php foreach ($roles as $rol) : ?>
                                    <option value="<?= $rol->id ?>"><?= $rol->nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <hr class="bg-secondary">
                        <div class="form-row justify-content-center">
                            <h4 class="text-center">Imagen de Seguridad</h4>
                        </div>
                        <hr>
                        <div class="form-row">
                            <?php foreach ($seguridad_imgs as $img) : ?>
                                <div class="col-6 col-md-3 p-1">
                                    <div class="card p-2 card-seguridad-img" data-action="registrar" data-img="<?= $img ?>">
                                        <img src="<?= ROOT; ?>public/assets/img/seguridad/<?= $img ?>" />
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <hr class="bg-secondary">
                        <div class="form-row justify-content-center">
                            <h4 class="text-center">Pregunta de Seguridad</h4>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="seguridad_pregunta">Pregunta</label>
                                    <select class="form-control w-100" name="seguridad_pregunta" id="seguridad_pregunta">
                                        <option value="Ciudad Favorita">¿Cuál es mi ciudad favorita?</option>
                                        <option value="Nombre primer hijo">¿Cuál es el nombre de mi primer hijo?</option>
                                        <option value="Libro favorito">¿Cuál es mi libro favorito?</option>
                                        <option value="Primer carro">¿Cuál fue mi primer vehículo?</option>
                                        <option value="Apodo">¿Cuál es mi apodo?</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="seguridad_respuesta">Respuesta</label>
                                    <input type="text" class="form-control" name="seguridad_respuesta" id="seguridad_respuesta" pattern="[A-Za-z0-9/. ]+" required minlength="3" maxlength="20">
                                </div>
                            </div>
                        </div>
                        <hr class="bg-secondary">
                        <div class="row form-group mt-1 justify-content-center">
                            <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
                            <button type="submit" class="btn btn-success m-2">Enviar</button>
                            <button type="reset" class="btn btn-danger m-2">Limpiar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal mostrar -->
<div class="modal fade" id="modalMostrarUsuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Usuario</h2>
                </div>
                <div class="card-body">
                    <form id="formularioMostrarUsuario">
                        <div class="row form-group">
                            <input name="id" id="id" value="" hidden>
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
                            <label for="cedula_cliente" class="col-form-label col-md-2"><strong>Cedula|RIF:</strong></label>

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
                            <input type="text" id="direccion" class="form-control-plaintext" disabled placeholder="Direccion">
                        </div>
                        <div class="form-group">
                            <label for="usuario"><strong>Usuario:</strong></label>
                            <input type="text" id="usuario" class="form-control-plaintext" disabled placeholder="Usuario">
                        </div>

                        <hr class="bg-secondary">

                        <div class="row form-group justify-content-center">
                            <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal actualizar -->
<div class="modal fade" id="modalActualizarUsuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Actualizar Usuario</h2>
                </div>
                <div class="card-body">
                    <form action="#" method="POST" enctype="multipart/form-data" id="formularioActualizarUsuario">
                        <div class="form-row justify-content-center">
                            <h4 class="text-center">Datos Personales</h4>
                        </div>
                        <hr>

                        <div class="row form-group">
                            <input name="id" id="id" hidden>
                            <label for="nombre" class="col-form-label col-md-2">Nombre:</label>
                            <div class="col-md-4 ">
                                <input type="text" name="nombre" id="nombre" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="30" required="required" class="form-control" placeholder="Nombre">
                            </div>
                            <label for="apellido" class="col-form-label col-md-2">Apellido:</label>
                            <div class="col-md-4 ">
                                <input type="text" name="apellido" id="apellido" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="30" required="required" class="form-control" placeholder="Apellido">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label for="cedula_cliente" class="col-form-label col-md-2">Cedula/RIF:</label>
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
                                <input type="tel" name="telefono" id="telefono" title="Debe Contener minimo 11 Caracteres numericos" minlength="10" maxlength="12" pattern="[0-9-]+" required class="form-control" placeholder="Telefono">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="correo" class="col-form-label col-md-2">Correo:</label>
                            <div class="col-md-4 ">
                                <input type="email" name="correo" id="correo" required class="form-control" placeholder="Correo Electronico">
                            </div>

                            <label for="direccion" class="col-form-label col-md-2">Direccion:</label>
                            <div class="col-md-4">
                                <input type="text" name="direccion" id="direccion" pattern="[A-Za-z0-9/ ]+" required maxlength="150" class="form-control" placeholder="Direccion">
                            </div>
                        </div>

                        <hr class="bg-secondary">

                        <div class="form-row justify-content-center">
                            <h4 class="text-center">Usuario</h4>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="user">Nombre de Usuario</label>
                            <input id="usuario" name="usuario" type="text" class="form-control" required minlength="8" maxlength="20">
                        </div>
                        <hr class="bg-secondary">
                        <div class="form-row justify-content-center">
                            <h4 class="text-center">Rol de Usuario</h4>
                        </div>
                        <div class="form-row">
                            <small class=" form-text">**Por favor seleccione un rol de usuario</small>
                        </div>
                        <hr>
                        <div class="form-row" id="listadoRoles">
                            <select class="form-control w-50" name="rolUsuario" id="rolUsuario">
                                <?php foreach ($roles as $rol) : ?>
                                    <option value="<?= $rol->id ?>"><?= $rol->nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <hr>
                        <div class="form-row mb-1">
                            <small class=" form-text">**No es obligatorio modificar los siguientes campos</small>
                        </div>
                        <div class="form-row">
                            <div class="accordion w-100" id="accordion">
                                <!-- Cantraseña -->
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button type="button" class="btn btn-block" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                <h4 class="text-center">Contraseña</h4>
                                            </button>
                                        </h5>
                                    </div>
                                    <div class="collapse " id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <label for="contrasena">Password</label>
                                                        <input type="password" class="form-control" name="contrasena" id="contrasena" minlength="8" maxlength="20">
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <label for="confirmarContrasena">Confirmar Password</label>
                                                        <input type="password" class="form-control" name="confirmarContrasena" id="confirmarContrasena" minlength="8" maxlength="20">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Imagen de Seguridad -->
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button type="button" class="btn btn-block" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <h4 class="text-center">Imagen de Seguridad</h4>
                                            </button>
                                        </h5>
                                    </div>
                                    <div class="collapse " id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-row">
                                                <?php foreach ($seguridad_imgs as $img) : ?>
                                                    <div class="col-6 col-md-3 p-1">
                                                        <div class="card p-2 card-seguridad-img" data-action="actualizar" data-img="<?= $img ?>">
                                                            <img src="<?= ROOT; ?>public/assets/img/seguridad/<?= $img ?>" />
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Pregunta de Seguridad -->
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <button type="button" class="btn btn-block" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                <h4 class="text-center">Pregunta de Seguridad</h4>
                                            </button>
                                        </h5>
                                    </div>
                                    <div class="collapse " id="collapseThree" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <label for="seguridad_pregunta">Pregunta</label>
                                                        <select class="form-control w-100" name="seguridad_pregunta" id="seguridad_pregunta">
                                                            <option value="Ciudad Favorita">¿Cuál es mi ciudad favorita?</option>
                                                            <option value="Nombre primer hijo">¿Cuál es el nombre de mi primer hijo?</option>
                                                            <option value="Libro favorito">¿Cuál es mi libro favorito?</option>
                                                            <option value="Primer carro">¿Cuál fue mi primer vehículo?</option>
                                                            <option value="Apodo">¿Cuál es mi apodo?</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <label for="seguridad_respuesta">Respuesta</label>
                                                        <input type="text" class="form-control" name="seguridad_respuesta" id="seguridad_respuesta" pattern="[A-Za-z0-9/. ]+" minlength="3" maxlength="20">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="bg-secondary">
                        <div class="row form-group justify-content-center">
                            <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
                            <button type="submit" class="btn btn-success m-2">Enviar</button>
                            <button type="reset" class="btn btn-danger m-2">Limpiar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require VIEWS . "modalAutenticarUsuario.php"; ?>

<script src="<?= ROOT; ?>public/assets/js/usuario/index.js"></script>