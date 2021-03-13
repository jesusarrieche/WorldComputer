<div class="content p-4">
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
            <h2 class="text-center">Reporte Estadístico de Compras</h2>
        </div>
        <div class="card">
            <div class="card-body">
                <h3>Productos más comprados</h3>
                <div class="m-auto"><canvas id="chartProductos" width="400" height="300"></canvas></div>
                
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3>Proveedore más recurridos</h3>
                <div class="m-auto"><canvas id="chartProveedores" width="400" height="300"></canvas></div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="<?=ROOT;?>Reporte/reporteCompra" method="POST" enctype="multipart/form-data" id="formularioReporte" target="_blank">
                    <!-- <input type="hidden" name="vendedor" value="<?=$_POST['vendedor']?>"> -->
                    <input type="hidden" name="proveedor" value="<?=$_POST['proveedor']?>">
                    <input type="hidden" name="producto" value="<?=$_POST['producto']?>">
                    <input type="hidden" name="desde" value="<?=$_POST['desde']?>">
                    <input type="hidden" name="hasta" value="<?=$_POST['hasta']?>">
                    <div class="row text-center justify-content-center">
                        <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-list-alt"></i>Reporte de Detalles de Compras</button>
                    </div>
                    <div class="row text-center justify-content-center">
                        <span class="w-75">Extraiga un documento PDF con los detalles de las compras realizadas con los parámetros escogidos</span>
                    </div>                  
                    
                </form>
            </div>
        </div>
        
        
        
    </div>
    <script src="<?= ROOT; ?>node_modules/chart.js/dist/Chart.min.js"></script>
    <script>
        $(document).ready(function () {  
            var cp = document.getElementById('chartProductos');
            var chartProductos = new Chart(cp, {
                type: 'bar',
                data: {
                    labels: [
                        '<?=$productosN[0]?>', '<?=$productosN[1]?>', '<?=$productosN[2]?>', '<?=$productosN[3]?>', '<?=$productosN[4]?>', '<?=$productosN[5]?>', '<?=$productosN[6]?>',<?=$productosN[7]?>
                    ],
                    datasets: [{
                        label: 'Cantidad de Compras en las que se demandó el producto',
                        data: [
                            '<?=$productosC[0]?>', '<?=$productosC[1]?>', '<?=$productosC[2]?>', '<?=$productosC[3]?>', '<?=$productosC[4]?>', '<?=$productosC[5]?>', '<?=$productosC[6]?>',<?=$productosC[7]?>
                        ],
                        backgroundColor: [                            
                            'rgba(54, 162, 235, 0.9)',
                            'rgba(255, 206, 86, 0.9)',
                            'rgba(24, 255, 255, 0.9)',
                            'rgba(200, 99, 132, 0.9)',
                            'rgba(153, 102, 255, 0.9)',
                            'rgba(255, 159, 64, 0.9)',
                            'rgba(238, 255, 65, 0.9)',
                            'rgba(67, 160, 71, 0.9)'
                        
                        ],
                        borderColor: [                            
                            'rgba(54, 182, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(24, 255, 255, 1)',
                            'rgba(200, 99, 132, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(238, 255, 65, 1)',
                            'rgba(67, 160, 71, 1)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                fontColor: "black",
                                fontSize: 12,
                                // stepSize: 1,
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                fontColor: "black",
                                fontSize: 12,
                                stepSize: 1,
                                beginAtZero: true
                            }
                        }]
                    },
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            fontColor: 'black',
                            fontFamily: 'Arial',
                            fontSize: 12
                        }
                    },
                    
                }
            });

            var cc = document.getElementById('chartProveedores');
            var chartProveedores = new Chart(cc, {
                type: 'line',
                data: {
                    labels: [
                        '<?=$proveedoresN[0]?>', '<?=$proveedoresN[1]?>', '<?=$proveedoresN[2]?>', '<?=$proveedoresN[3]?>', '<?=$proveedoresN[4]?>', '<?=$proveedoresN[5]?>', '<?=$proveedoresN[6]?>',<?=$proveedoresN[7]?>
                    ],
                    datasets: [{
                        label: 'Cantidad de Compras al proveedor',
                        data: [
                            '<?=$proveedoresC[0]?>', '<?=$proveedoresC[1]?>', '<?=$proveedoresC[2]?>', '<?=$proveedoresC[3]?>', '<?=$proveedoresC[4]?>', '<?=$proveedoresC[5]?>', '<?=$proveedoresC[6]?>',<?=$proveedoresC[7]?>
                        ],
                        backgroundColor: [                            
                            'rgba(54, 162, 235, 0.45)',
                            'rgba(255, 206, 86, 0.45)',
                            'rgba(24, 255, 255, 0.45)',
                            'rgba(200, 99, 132, 0.45)',
                            'rgba(153, 102, 255, 0.45)',
                            'rgba(255, 159, 64, 0.45)',
                            'rgba(238, 255, 65, 0.45)',
                            'rgba(67, 160, 71, 0.45)'
                        
                        ],
                        borderColor: [                            
                            'rgba(54, 182, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(24, 255, 255, 1)',
                            'rgba(200, 99, 132, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(238, 255, 65, 1)',
                            'rgba(67, 160, 71, 1)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                fontColor: "black",
                                fontSize: 12,
                                // stepSize: 1,
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                fontColor: "black",
                                fontSize: 12,
                                stepSize: 1,
                                beginAtZero: true
                            }
                        }]
                    },
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            fontColor: 'black',
                            fontFamily: 'Arial',
                            fontSize: 12
                        }
                    },
                    
                }
            });
        });
        
    </script>