<div class="content p-4 dataTables_wrapper">
    

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-center">
            <h2 class="mb-4">Bítacora</h2>
        </div>
        <div class="card-body">
          <table class="table table-dark table-striped table-bordered" id="datatable">
            <thead class="text-center">
              <tr>
                <th>Módulo</th>
                <th>Actividad</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Consultar</th>
                <!-- <th>Detalles</th>  -->
              </tr>
            </thead>
            <tbody class="text-center">
              
            </tbody>
          </table>
        </div>
    </div>
</div>

<!-- Modal Mostrar -->
<div class="modal fade" id="modalMostrarBitacora" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

         <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <h2 class="card-tittle text-center">Detalles de la Actividad</h2>
                </div>
            </div>
            <div class="card-body">
            
                    <form action="#" method="POST" id="formularioMostrarBitacora" enctype="multipart/form-data">
        
                        <div class="row justify-content-center">
                            <h3>Usuario</h3>
                        </div>
                        <hr class="bg-secondary">
                        <div class="row">
                            <label for="" class="col-form-label col-lg-2"><strong>Nombre:</strong></label>
                            <div class="col-lg-4">
                                <input type="text" id="usuario_nombre" class="form-control-plaintext" value="" disabled>
                            </div>

                            <label for="" class="col-form-label col-lg-2"><strong>Cedula|RIF::</strong></label>
                            <div class="col-lg-4">
                                <input type="text" id="usuario_documento" class="form-control-plaintext" value="" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-form-label col-lg-2"><strong>Nombre de Usuario:</strong></label>
                            <div class="col-lg-4">
                                <input type="text" id="usuario_username" class="form-control-plaintext" value="J-26540950" disabled>
                            </div>
                            <label for="" class="col-form-label col-lg-2"><strong>Rol:</strong></label>
                            <div class="col-lg-4">
                                <input type="text" id="usuario_rol" class="form-control-plaintext" value="" disabled>
                            </div>                            
                        </div>
                        <hr>
                        <div class="row justify-content-center">
                            <h3>Actividad</h3>
                        </div>
                        <hr class="bg-info">
                        
                        <div class="form-row">
                                <label class="col-form-label col-lg-2" for="fecha"><strong>Fecha:</strong></label>
                                <div class="col-lg-4">
                                    <input type="text" id="fecha" class="form-control-plaintext" value="" disabled>
                                </div>
                                <label class="col-form-label col-lg-2" for="hora"><strong>Hora:</strong></label>
                                <div class="col-lg-4">
                                    <input type="text" id="hora" class="form-control-plaintext" value="" disabled>
                                </div>
                                

                        </div>
                        <div class="form-row">
                                <label class="col-form-label col-lg-2" for="modulo"><strong>Módulo:</strong></label>
                                <div class="col-lg-10">
                                    <input type="text" id="modulo" class="form-control-plaintext" value="" disabled>
                                </div>                              
                        </div>
                        <div class="form-row">
                                <label class="col-form-label col-lg-2" for="accion"><strong>Acción:</strong></label>
                                                              
                        </div>
                        <div class="form-row pl-2" id="accion">
                                   
                        </div>
                        <div class="" id="descripcionDiv">
                            <div class="row">
                                <label class="col-form-label col-lg-2" for="descripcion"><strong>Descripcion:</strong></label>
                            </div>                                
                            <div class="p-2" id="descripcion">
                                
                            </div>                      
                        </div>
                         
                        <hr>

                        <div class="form-row justify-content-center">
                            <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
                            
                        </div>
                    </form>      
            </div>


         </div>

        </div>
    </div>
</div>


<script src="<?= ROOT; ?>public/assets/js/bitacora/index.js"></script>

