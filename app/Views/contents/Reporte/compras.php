<div class="content p-4 d-flex justify-content-center align-items-center flex-column">
    
    <div class="card w-100 text-center mb-4" style="max-width: 60%;">
            <div class="card-header">
                <h2>Reporte de Compras</h2>
            </div>
            <div class="card-body">
                <form action="<?=ROOT;?>Reporte/estadisticasCompras" method="POST" enctype="multipart/form-data" id="formularioReporte" target="_blank">
                    <div class="row form-group">
                        <label for="proveedor" class="col-form-label col-md-4 font-weight-bold">Proveedor: </label>
                        <div class="col-md-8 d-flex align-items-center p-0">
                            <select class="form-control js-example-basic-single" name="proveedor" id="proveedor" required>
                                <option value="0">TODOS</option>
                                <?php foreach($proveedores as $proveedor):?>
                                    <option value="<?=$proveedor->id?>"><?=$proveedor->razon_social?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="producto" class="col-form-label col-md-4 font-weight-bold">Producto: </label>
                        <div class="col-md-8 d-flex align-items-center p-0">
                            <select class="form-control js-example-basic-single" name="producto" id="producto" required>
                                <option value="0">TODOS</option>
                                <?php foreach($productos as $producto):?>
                                    <option value="<?=$producto->id?>"><?=$producto->nombre?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="desde" class="col-form-label col-md-4 font-weight-bold">Desde: </label>
                        <input type="date" class="form-control col-md-6" name="desde" id="desde" required>
                        
                    </div>
                    <div class="row form-group">
                        <label for="hasta" class="col-form-label col-md-4 font-weight-bold">Hasta: </label>
                        <input type="date" class="form-control col-md-6" name="hasta" id="hasta" required>
                    </div>
                    <hr>
                    <div class="row justify-content-md-center">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-fw fa-list-alt"></i> Generar Reporte</button>
                    </div>
                </form>
            </div>
    </div>
</div>
