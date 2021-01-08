<div class=" container-fluid p-2">
    <form action="<?= ROOT;?>Servicio/agregarPrestado" method="post" id="formularioServicio">
        <div class="card">
            <div class=" card-header bg-gray">
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <h3 class="text-center">Nuevo Servicio</h3>
                    </div>
                    <div class="col">
                        
                    </div>
                </div>
            </div>

            <div class="card-body">
                
                <!--
                <div class="form-row justify-content-end">
                    <label for="" class="col-form-label col-md-2"><strong>Fecha:</strong></label>
                    <div class="col-md-2">
                        <input type="text" class="form-control-plaintext" disabled>
                    </div>
                </div>
                -->

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h4>Cliente</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label for="cliente" class=" col-form-label col-md-2">
                                        <i class="fas fa-user-alt"></i>
                                        <span> <strong>Cliente</strong></span>
                                    </label>
    
                                    <div class="col-md-6 form-group">
                                        <select name="cliente" id="listadoClientes" class="form-control select2">
                                            <option value="">-</option>
                                            
                                            <?php 
                                            
                                                foreach($clientes as $cliente): 
                                            ?>

                                                <option value="<?= $cliente->id; ?>"><?= $cliente->documento . " - " .$cliente->nombre; ?></option>

                                            <?php 
                                                endforeach; 
                                                
                                            ?>
                                            
                                        </select>
                                    </div>
            
                
                                    <div class="col-md-4 form-group">
                                        <button type="button" class="btn btn-block btn-success" id="agregarCliente" ><i class="fas fa-plus-circle"></i></button>
                                    </div>
                                </div>

                                
                                <div class="row form-row">
                                            
                                    <input type="text" name="cliente" id="cliente" hidden>

                                    <label for="cedula" class="col-form-label col-lg-2"><strong>Cedula | Rif</strong> </label>
                                    <div class="col-lg-10 form-group">
                                        <input type="text" class="form-control-plaintext" id="documentoCliente" disabled >    
                                    </div>
                                </div>
                                <div class="row form-row">
                                    <label for="Nombre" class="col-form-label col-lg-2"><strong>Nombre:</strong> </label>
                                    <div class="col-lg-10 form-group">
                                        <input type="text" class="form-control-plaintext" name="nombre" id="nombreCliente" disabled >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="bg-secondary">

                <hr class="bg-secondary">

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h4>Empleado</h4>
                            </div>
                            <div class="card-body">
                                <div class="row form-row">
                                    <label for="Nombre" class="col-form-label col-lg-2"><strong>Empleado</strong> </label>
                                    <div class="col-lg-8 form-group">
                                
                                        <select id="listadoEmpleados" class="form-control select2">
                                            <option value="">-</option>

                                            <?php 
                                            #===== update to services table ====#
                                            
                                                foreach($empleados as $empleado): 
                                            ?>

                                                <option value="<?= $empleado->id; ?>"><?= $empleado->nombre; ?></option>

                                            <?php 
                                                endforeach; 
                                            ?>

                                        </select>
                                    </div>
    
                                    <div class="col-lg-2">
                                        <button class="btn btn-info" id="agregarEmpleado">
                                            <i class="fas fa-wrench"></i> Agregar Empleado
                                        </button>
                                    </div>
                                </div>
    
                                <div class="row form-row">
                                    <input type="text" name="empleado" id="empleado" hidden>
                                    <label for="Direccion" class="col-form-label col-lg-2"><strong>Nombre:</strong> </label>
                                    <div class="col-lg-7 form-group">
                                        <input type="text" class="form-control-plaintext" id="nombreEmpleado" disabled value="N/A">
                                    </div>
    
                                </div>
                                
                                <div class="row form-row">
                                    
                                    <label for="Direccion" class="col-form-label col-lg-1"><strong>cedula:</strong> </label>
                                    <div class="col-lg-2 form-group">
                                        <input type="text" class="form-control-plaintext" id="cedulaEmpleado" disabled value="N/A">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h4>Servicio</h4>
                            </div>
                            <div class="card-body">
                                <div class="row form-row">
                                    <label for="Nombre" class="col-form-label col-lg-2"><strong>Servicio</strong> </label>
                                    <div class="col-lg-8 form-group">
                                
                                        <select id="listadoServicios" class="form-control select2">
                                            <option value="">-</option>

                                            <?php 
                                            #===== update to services table ====#
                                            
                                                foreach($servicios as $servicio): 
                                            ?>

                                                <option value="<?= $servicio->id; ?>"><?= $servicio->nombre; ?></option>

                                            <?php 
                                                endforeach; 
                                            ?>

                                        </select>
                                    </div>
    
                                    <div class="col-lg-2">
                                        <button class="btn btn-info" id="agregarServicio">
                                            <i class="fas fa-handshake"></i> Agregar Servicio
                                        </button>
                                    </div>
                                </div>
    
                                <div class="row form-row">
                                    <input type="text" name="servicio" id="servicio" hidden>
                                    <label for="Direccion" class="col-form-label col-lg-2"><strong>Descripcion:</strong> </label>
                                    <div class="col-lg-7 form-group">
                                        <input type="text" class="form-control-plaintext" id="descripcionServicio" disabled value="N/A">
                                    </div>
    
                                </div>
                                
                                <div class="row form-row">
                                    
                                    <label for="Direccion" class="col-form-label col-lg-1"><strong>Precio:</strong> </label>
                                    <div class="col-lg-2 form-group">
                                        <input type="text" class="form-control-plaintext" id="precioServicio" name="precioServicio" value="N/A">
                                    </div>
                                </div>
                                <!--
                                <div class="form-row">
                
                                    <label for="documento" class=" col-form-label col-md-2">
                                        <i class="fas fa-clock"></i>
                                        <strong>Horas de trabajo:</strong></label>
                                    <div class="col-md-2">
                                        <input type="number" name="horasServicio" class="form-control" placeholder="Horas de trabajo">
                                    </div>
                                
                                </div>
                                -->
                            </div>
                        </div>
                    </div>
                </div>
              

                
              
                

                <hr class="bg-secondary">

                

                <div class="row justify-content-center">
                    <div class="col"></div>
                    <div class="col">
                        <button type="submit" class="btn btn-block btn-success"><i class=" fas fa-save"></i> Registrar servicio</button>
                    </div>
                    <div class="col"></div>
                </div>

            </div>
        </div>
    </form>
</div>

<script>
    let clientes = <?= json_encode($clientes) ?>;
    let servicios = <?= json_encode($servicios) ?>;    
    let empleados = <?= json_encode($empleados) ?>;    
    let backUrl = <?= ROOT ?> + 'Servicio/ProvidedServices';
    console.log(backUrl);
</script>

<script src="<?= ROOT; ?>public/assets/js/servicio/create.js"></script>
