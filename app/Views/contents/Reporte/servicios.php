<div class="content p-4 d-flex justify-content-center align-items-center flex-column">
    <div class="card w-100 text-center mb-4" style="max-width: 60%;">
            <div class="card-header">
                <h2>Reporte de Servicios</h2>
            </div>
            <div class="card-body">
                <form action="<?=ROOT;?>Reporte/reporteServicio" method="POST" enctype="multipart/form-data" id="formularioReporte" target="_blank">
                    <div class="row form-group">
                        <label for="tecnico" class="col-form-label col-md-4 font-weight-bold">Técnico: </label>
                        <div class="col-md-8 d-flex align-items-center">
                            <select class="form-control js-example-basic-single" name="tecnico" id="tecnico" required>
                                <option value="0">TODOS</option>
                                
                                <?php foreach($tecnicos as $tecnico):?>
                                    <option value="<?=$tecnico->id?>"><?=$tecnico->nombre?></option>
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
