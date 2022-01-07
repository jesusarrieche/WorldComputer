<div class="content p-42">

    
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
                    <input  name="perfil" id="perfil" value="1" hidden>
                    <input  name="id" id="id" value="<?=$usuario->id?>" hidden>
                    <label for="nombre" class="col-form-label col-md-2">Nombre:</label>
                    <div class="col-md-4 ">
                        <input type="text" value="<?=$usuario->nombre?>" name="nombre" id="nombre" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="30" required="required" class="form-control" placeholder="Nombre">
                    </div> 

                    <label for="apellido" class="col-form-label col-md-2">Apellido:</label>
                    <div class="col-md-4 ">
                        <input type="text" value="<?=$usuario->apellido?>" name="apellido" id="apellido" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="30" required="required"  class="form-control" placeholder="Apellido">
                    </div>
                </div>

                <div class="row form-group">
                    <label for="cedula_cliente" class="col-form-label col-md-2">Cedula/RIF:</label>
                    <div class="col-md-1 ">
                        <input type="hidden" id="inicial_documentoH" value="<?=$inicial_documento?>">
                        <select class="form-control pl-0 pr-0"  name="inicial_documento" id="inicial_documento" required="">
                            <option value="" selected="">-</option>
                            <option value="V">V</option>
                            <option value="E">E</option>
                            <option value="J">J</option>
                            <option value="G">G</option>
                        </select>
                    </div>
                    <script>
                        $(document).ready(function(){
                            $("#inicial_documento").val($("#inicial_documentoH").val());
                            $("#rolUsuario").val($("#rolH").val());
                        });
                            
                    </script>
                    <div class="col-md-3">
                        <input type="text" value="<?=$documento?>" pattern="[0-9]{6,8}" name="documento" id="documento" minlength="6" maxlength="8" title="Ingrese entre 6 y 8 digitos" class="form-control" placeholder="Identificaion" required="">
                    </div>
                    <label for="telefono" class="col-form-label col-md-2" >Telefono:</label>
                    <div class="col-md-4 ">
                        <input type="tel" value="<?=$usuario->telefono?>" name="telefono" id="telefono" title="Debe Contener minimo 11 Caracteres numericos" minlength="10"  maxlength="12" pattern="[0-9-]+" required class="form-control" placeholder="Telefono">
                    </div>
                </div>
                <div class="row form-group">
                    <label for="correo" class="col-form-label col-md-2">Correo:</label>
                    <div class="col-md-4 ">
                        <input type="email" value="<?=$usuario->email?>" name="correo" id="correo" required class="form-control" placeholder="Correo Electronico">
                    </div>

                    <label for="direccion" class="col-form-label col-md-2">Direccion:</label>
                    <div class="col-md-4">
                        <input type="text" value="<?=$usuario->direccion?>" name="direccion" id="direccion" pattern="[A-Za-z0-9/ ]+" required maxlength="150" class="form-control" placeholder="Direccion" >
                    </div>
                </div>

                <hr class="bg-secondary">

                <div class="form-row justify-content-center">
                    <h4 class="text-center">Usuario</h4>
                </div>

                <hr>

                <div class="form-group">
                    <label for="user">Nombre de Usuario</label>
                    <input  value="<?=$usuario->usuario?>" id="usuario" name="usuario" type="text" class="form-control" required minlength="8" maxlength="20">
                </div>

                <div class="form-row">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input type="password" class="form-control" name="contrasena" id="contrasena" minlength="8" maxlength="20">
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="pass">Confirmar Password</label>
                            <input type="password" class="form-control" name="confirmarContrasena" id="confirmarContrasena" minlength="8" maxlength="20">
                        </div>
                    </div>
                </div>

                <hr class="bg-secondary">
                <?php if($_SESSION['rol']==1 && $_SESSION['id'] != 1){?>

                <div class="form-row justify-content-center">
                    <h4 class="text-center">Rol de Usuario</h4>
                </div>
                <hr>

                <div class="form-row" id="listadoRoles">

                    <input type="hidden" value="<?=$usuario->rol_id?>" id="rolH">
                    <select class="form-control w-50" name="rolUsuario" id="rolUsuario">
                    <?php foreach($roles AS $rol): ?>
                        <option value="<?=$rol->id?>"><?=$rol->nombre?></option>
                        
                    <?php endforeach; ?>
                    </select>
                </div>
                <?php }else{?>
                    <input id="rolUsuarioN" name="rolUsuarioN" value="<?=$usuario->rol_id?>" hidden>
                <?php }?>
                <hr>
                <!-- <div class="form-row mb-1">
                    <small class=" form-text">**No es obligatorio modificar los siguientes campos</small>
                </div> -->
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
                <div class="row form-group justify-content-md-center">
                    <!-- <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a> -->
                    <button type="submit"  class="btn btn-success m-2">Enviar</button>
                    <!-- <button type="reset" class="btn btn-danger m-2">Limpiar</button> -->
                </div>
            </form>
        </div>
    </div>
   
</div>
<?php require VIEWS . "modalAutenticarUsuario.php"; ?>
<script>
    let seguridadPregunta = <?= json_encode($usuario->seguridad_pregunta) ?>;    
    let correo = <?= json_encode($usuario->email) ?>;    
    let rolUsuario = <?= json_encode($usuario->rol_id) ?>;    
</script>
<script src="<?= ROOT; ?>public/assets/js/usuario/perfil.js"></script>