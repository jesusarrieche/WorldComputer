<div class="content p-4 dataTables_wrapper">
    <h2 class="mb-4">Gestión de Producto</h2>

    <div class="card mb-4">
        <div class="card-header bg-white">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistroProducto"
          <?php $band = false;
                foreach ($_SESSION['permisos'] as $p):
                    if ($p->permiso == "Registrar Productos") {     
                        $band = true;
                }endforeach;     
                if (!$band) {
                    echo "disabled";
                }           
            ?>
          >
            <i class="fas fa-plus-square"></i> Agregar Producto
          </button>
        </div>
        <div class="card-body">
          <table class="table" id="datatable">
            <thead class="thead-dark">
              <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Precio $</th>
                <th>Precio BSS</th>
                <th>Stock</th>
                <th>Estatus</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
                
            </tbody>
          </table>
        </div>
    </div>
</div>

<!-- Modal Registro -->
<div class="modal fade" id="modalRegistroProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <div class="card">
        <div class="card-body">
            <h2 class="card-tittle text-center">Nuevo Producto</h2>
            <hr>
          
                <form action="#" method="POST" id="formularioRegistroProducto" enctype="multipart/form-data">
    

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <i class="fas fa-barcode"></i> <label for="codigo">Codigo Producto</label> 

                            <div class="row">
                                <div class="col-md-10">
                                    <input type="text" name="codigo" id="codigo" class=" form-control" placeholder="Codigo" required >
                                </div>
                                <div class="col-md-2 pl-0">
                                    <button class="btn btn-success" id="generarCodigo"> <i class="fas fa-reply"></i> </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <i class="fas fa-tag"></i> <label for="categoria">Categoria</label>
                            <select name="categoria" id="categoria" class="form-control" required>
                                <option value="" selected>-</option>
                            </select>
                        </div>

                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <i class="fas fa-box"></i> <label for="nombre">Nombre</label>
                            <input name="nombre" id="nombre" type="text" class=" form-control" maxlength="45" placeholder="Nombre" required >
                        </div>

                        <div class="form-group col-md-6">
                            <i class="fas fa-hockey-puck"></i> <label for="unidad">Unidad de Medida</label>
                            <select name="unidad" id="unidad" class="form-control" required>
                                <option value="" selected>-</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
<!-- 
                        <label> <i class="fas fa-tag"></i> Precio </label>
                        <input type="number" name="precio" id="precio" class="form-control" required > -->

                        <label> <i class="fas fa-tag"></i> <strong>Margen de Ganancia</strong> </label>
                        <input type="number" name="porcentaje" id="porcentaje" class="form-control" placeholder="Ej. 30%" max="100" required >
                        <small class=" form-text text-muted">Este porcentaje calculara la ganancia respecto al ultimo precio de compra del producto</small>
                        
                    </div>


                    <div class="form-group">
                        <i class="fas fa-clipboard"></i> <label for="descripcion">Descripcion</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Ej. Producto original..." ></textarea>
                    </div>

           
                    
                    <hr>

                    <h4 class="text-center">Datos de Inventario</h4>
                    
                    <hr class="bg-info">


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <i class="fas fa-angle-double-down"></i> <label for="stock_min">Stock Minimo</label>
                            <input class="form-control" type="number" name="stock_min" id="stock_min" placeholder="Ej. 5" required value="0">
                        </div>

                        <div class="form-group col-md-6">
                            <i class="fas fa-angle-double-up"></i> <label for="stock_max">Stock Maximo</label>
                            <input class="form-control" type="number" name="stock_max" id="stock_max" placeholder="E j. 10" required value="0">
                        </div>
                    </div>

                    <hr>

                    <div class="form-row justify-content-center">
                        <button class="btn btn-success" type="submit">Enviar</button>
                    </div>
                </form>   
        </div>


    </div>

        </div>
    </div>
</div>

<!-- Modal Mostrar -->
<div class="modal fade" id="modalMostrarProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <div class="card">
        <div class="card-body">
            <h2 class="card-tittle text-center">Producto</h2>
            <hr>
          
                <form action="#" method="POST" id="formularioMostrarProducto" enctype="multipart/form-data">
    
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <i class="fas fa-barcode"></i> <label for="codigo"><strong>Codigo Producto</strong></label>
                            <input type="text" name="codigo" id="codigo" class=" form-control-plaintext" disabled placeholder="Codigo" required disabled >
                        </div>

                        <div class="form-group col-md-6">
                            <i class="fas fa-tag"></i> <label for="categoria"><strong>Categoria</strong></label>
                            <input type="text" name="categoria" id="categoria" class=" form-control-plaintext" disabled placeholder="Codigo" required disabled >
                            
                        </div>

                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <i class="fas fa-box"></i> <label for="nombre"><strong>Nombre</strong></label>
                            <input name="nombre" id="nombre" type="text" class=" form-control-plaintext" disabled placeholder="Nombre" required >
                        </div>

                        <div class="form-group col-md-6">
                            <i class="fas fa-hockey-puck"></i> <label for="unidad"><strong>Unidad de Medida</strong></label>
                            <input type="text" name="unidad" id="unidad" class=" form-control-plaintext" disabled placeholder="Codigo" required disabled >
                            
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label> <i class="fas fa-money-bill-alt"></i> <strong>Precio de Costo</strong> </label>
                            <input type="number" name="precio_costo" id="precio_costo" class="form-control-plaintext" disabled required >
                          
                        </div>
                        <div class="form-group col-md-4">
                            <label> <i class="fas fa-tag"></i> <strong>Margen de Ganancia</strong> </label>
                            <input type="number" name="porcentaje" id="porcentaje" class="form-control-plaintext" placeholder="Ej. 30%" max="100" required disabled>
                            <small class=" form-text text-muted">Este porcentaje calculará la ganancia respecto al ultimo precio de compra del producto</small>
                          
                        </div>
                        <div class="form-group col-md-4">
                            <label> <i class="fas fa-money-check-alt"></i> <strong>Precio de Venta</strong> </label>
                            <input type="number" name="precio" id="precio" class="form-control-plaintext" disabled required >
                        </div>
                        <!-- <label> <i class="fas fa-tag"></i> <strong>Precio</strong> </label>
                        <input type="number" name="precio" id="precio" class="form-control-plaintext" disabled required > -->

                        
                    </div>


                    <div class="form-group">
                        <i class="fas fa-clipboard"></i> <label for="descripcion"><strong>Descripcion</strong></label>
                        <textarea name="descripcion" id="descripcion" class="form-control-plaintext" disabled placeholder="Ej. Producto original..." ></textarea>
                    </div>

           
                    
                    <hr>

                    <h4 class="text-center">Datos de Inventario</h4>
                    
                    <hr class="bg-info">


                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <i class="fas fa-angle-double-down"></i> <label for="stock_min"><strong>Stock Minimo</strong></label>
                            <input class="form-control-plaintext" disabled type="number" name="stock_min" id="stock_min" placeholder="Ej. 5" required >
                        </div>

                        <div class="form-group col-md-4">
                            <i class="fas fa-angle-double-up"></i> <label for="stock_max"><strong>Stock Maximo</strong></label>
                            <input class="form-control-plaintext" disabled type="number" name="stock_max" id="stock_max" placeholder="E j. 10" required >
                        </div>

                        <div class="form-group col-md-4">
                            <i class="fas fa-angle-double-up"></i> <label for="stock"><strong>Stock</strong></label>
                            <input class="form-control-plaintext" disabled type="number" name="stock" id="stock" placeholder="E j. 10" required >
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

<!-- Modal Actualizar -->
<div class="modal fade" id="modalActualizarProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <div class="card">
        <div class="card-body">
            <h2 class="card-tittle text-center">Actualizar Producto</h2>
            <hr>
          
                <form action="#" method="POST" id="formularioActualizarProducto" enctype="multipart/form-data">

                    <input name="id" id="id" hidden >
                    <!-- <input type="number" name="precio" id="precio" hidden> -->

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <i class="fas fa-barcode"></i> <label for="codigo">Codigo Producto</label>
                            <input type="text" name="codigo" id="codigo" class=" form-control" placeholder="Codigo" required >
                        </div>

                        <div class="form-group col-md-6">
                            <i class="fas fa-tag"></i> <label for="categoria">Categoria</label>
                            <select name="categoria" id="categoria" class="form-control" required>
                                <option value="" selected>-</option>
                            </select>
                        </div>

                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <i class="fas fa-box"></i> <label for="nombre">Nombre</label>
                            <input name="nombre" id="nombre" type="text" class=" form-control" placeholder="Nombre" maxlength="45" required >
                        </div>

                        <div class="form-group col-md-6">
                            <i class="fas fa-hockey-puck"></i> <label for="unidad">Unidad de Medida</label>
                            <select name="unidad" id="unidad" class="form-control" required>
                                <option value="" selected>-</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label> <i class="fas fa-money-bill-alt"></i> <strong>Precio de Costo</strong> </label>
                            <input type="number" name="precio_costo" id="precio_costo" class="form-control-plaintext" disabled required >
                          
                        </div>
                        <div class="form-group col-md-4">
                            <label> <i class="fas fa-tag"></i> <strong>Margen de Ganancia</strong> </label>
                            <input type="number" name="porcentaje" id="porcentaje" class="form-control" placeholder="Ej. 30%" min="0" max="100" required>
                            <small class=" form-text text-muted">Este porcentaje calculará la ganancia respecto al ultimo precio de compra del producto</small>
                          
                        </div>
                        <div class="form-group col-md-4">
                            <label> <i class="fas fa-money-check-alt"></i> <strong>Precio de Venta</strong> </label>
                            <input type="number" name="precio" id="precio" class="form-control-plaintext" disabled required >
                        </div>
                        <!-- <label> <i class="fas fa-tag"></i> <strong>Precio</strong> </label>
                        <input type="number" name="precio" id="precio" class="form-control-plaintext" disabled required > -->

                        
                    </div>


                    <div class="form-group">
                        <i class="fas fa-clipboard"></i> <label for="descripcion">Descripcion</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Ej. Producto original..." ></textarea>
                    </div>

           
                    
                    <hr>

                    <h4 class="text-center">Datos de Inventario</h4>
                    
                    <hr class="bg-info">


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <i class="fas fa-angle-double-down"></i> <label for="stock_min">Stock Minimo</label>
                            <input class="form-control" type="number" name="stock_min" id="stock_min" placeholder="Ej. 5" required >
                        </div>

                        <div class="form-group col-md-6">
                            <i class="fas fa-angle-double-up"></i> <label for="stock_max">Stock Maximo</label>
                            <input class="form-control" type="number" name="stock_max" id="stock_max" placeholder="E j. 10" required >
                        </div>
                    </div>

                    <hr>

                    <div class="form-row justify-content-center">
                        <button class="btn btn-success" type="submit">Enviar</button>
                    </div>
                </form>  
        </div>


    </div>

        </div>
    </div>
</div>
<?php require VIEWS . "modalAutenticarUsuario.php"; ?>
<script src="<?= ROOT; ?>public/assets/js/producto/index.js"></script>

