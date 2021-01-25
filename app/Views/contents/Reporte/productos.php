<div class="content p-4 d-flex justify-content-center align-items-center flex-column">
    <div class="card w-100 text-center" style="max-width: 60%;">
            <div class="card-header">
                <h2>Reporte de Productos</h2>
            </div>
            <div class="card-body">
                <form action="<?=ROOT;?>Reporte/reporteProducto" method="POST" enctype="multipart/form-data" id="formularioReporte" target="_blank">
                    <div class="row form-group">
                        <label for="categoria" class="col-form-label col-md-4 font-weight-bold">Categoria: </label>
                        <div class="col-md-8 d-flex align-items-center">
                            <select class="form-control js-example-basic-single" name="categoria" id="categoria" required>
                                <option value="0">TODOS</option>
                                
                                <?php foreach($categorias as $categoria):?>
                                    <option value="<?=$categoria->id?>"><?=$categoria->nombre?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        
                    </div>
                    <div class="row form-group">
                        <label for="producto" class="col-form-label col-md-4 font-weight-bold">Producto: </label>
                        <div class="col-md-8 d-flex align-items-center">
                            <select class="form-control js-example-basic-single" name="producto" id="producto" required>
                                <option value="0">TODOS</option>
                                <?php foreach($productos as $producto):?>
                                    <option value="<?=$producto->id?>"><?=$producto->nombre?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-md-center">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-fw fa-list-alt"></i> Generar Reporte</button>
                    </div>
                </form>
            </div>
    </div>
</div>
