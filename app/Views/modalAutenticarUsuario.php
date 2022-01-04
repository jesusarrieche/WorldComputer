<div class="modal fade modal-autenticar-usuario" id="modalAutenticarUsuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Autenticación de Usuario</h2>
                </div>
                <div class="card-body">
                    <form id="formularioAutenticarUsuario">
                        <div class="form-row justify-content-center">
                            <h4 class="text-center">Imagen de Seguridad</h4>
                        </div>
                        <hr>
                        <div class="form-row">
                            <?php
                            $seguridad_imgs_desordenadas = $seguridad_imgs;
                            shuffle($seguridad_imgs_desordenadas);
                            foreach ($seguridad_imgs_desordenadas as $img) : ?>
                                <div class="col-6 col-md-3 p-1">
                                    <div class="card p-2 card-seguridad-img-autenticar" data-action="autenticar" data-img="<?= $img ?>">
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
                                    <select class="form-control-plaintext w-100" name="seguridad_pregunta" id="seguridad_pregunta" disabled>
                                        <option value=""></option>
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
                        <hr class="bg-secondary">
                        <div class="row form-group justify-content-center">
                            <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
                            <button type="submit" class="btn btn-success m-2">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= ROOT; ?>public/assets/js/main/autenticar.js"></script>