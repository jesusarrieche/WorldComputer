<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>

    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
        .container{
            padding: 0px 0px;
            /* color:lightslategrey; */
            color:black;
        }
        .padding{
            padding: 2px;
        }
        .margin{
            margin: 2px 0px;
        }
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
        .centrado{
            margin: auto;
        }
        .clear{
            clear: both;
        }
        .separador{
            display:block; 
            width:100%; 
            height:1px; 
            margin: 1px 0px;
            background: gray; 
        }
        .separadorDos{
            display:block; 
            width:100%; 
            height:1px; 
            margin: 2px 0px;
        }

    </style>
</head>
<body>
    <div class="container centrado" style="width: 98%;">

        <div class="centrado" style="width=98%;">
            <h1 class="text-center margin">REPORTE DE VENTAS</h1>
            <hr>
            <div>
            
                <p>
                <?php if(!$vendedores){?>
                    <strong>Vendedor: </strong> <?=$vendedor?><br>
                <?php }?>
                 <strong>Desde: </strong> <?=$desde?><br>
                 <strong>Hasta: </strong> <?=$hasta?>
                </p>
                
            </div>
            <!-- Ventas -->
            <?php if(isset($ventas) && count($ventas)>0){?>
            <div clas="separadorDos"></div>
            <h3 class="text-center margin"><u>VENTAS</u></h3><br>
        
        
        <?php if($vendedores){?>
            <div>
                <div style="width:15%; display:inline;" class="text-center">
                    <strong>CÓDIGO</strong>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center">
                    <strong>FECHA</strong>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center">
                    <strong>CLIENTE</strong>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center">
                    <strong>VENDEDOR</strong>
                </div>
                <div style="width:18%; display:inline;" class="text-center">
                    <strong>TOTAL $</strong>
                </div>
                <div style="width:18%; display:inline;" class="text-center">
                    <strong>TOTAL BSS</strong>
                </div>
            </div>
            
            <hr><br>
            <?php                    
                $total = 0;
                foreach($ventas AS $venta):
                    $cantidad++;
                    $total += $venta->total;
            ?>

            <div>
                <div style="width:15%; display:inline;" class="text-center" >
                    <span><?= $venta->codigo; ?></span>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <span><?= $venta->fecha; ?></span>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <span><?= $venta->cliente; ?></span>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <span><?= $venta->vendedor; ?></span>
                </div>
                <div style="width:18%; display:inline;" class="text-center" >
                    <span><?= $venta->total ?></span>
                </div>
                <div style="width:18%; display:inline;" class="text-center" >
                    <span><?= $venta->total * $dolar; ?></span>
                </div>
            </div>
                
            <br>
            <div class="separador"></div>
                <?php
                    endforeach;
                ?>
            <div>
                <div style="width:22.5%; display:inline;" class="text-center" >
                    <b>Cantidad de Ventas</b>
                </div>
                <div style="width:23.5%; display:inline;" class="text-center" >
                    <span><?= $cantidad; ?></span>
                </div>
                <!-- <div style="width:15.5%; display:inline;" class="text-center" >
                    <span></span>
                </div> -->
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <b>Total</b>
                </div>
                <div style="width:18%; display:inline;" class="text-center" >
                    <span><?= $total ?></span>
                </div>
                <div style="width:18%; display:inline;" class="text-center" >
                    <span><?= $total * $dolar; ?></span>
                </div>
            </div>
                
            <br>
            <div class="separador"></div>
            <?php }else{?>
                <div>
                    <div style="width:18.5%; display:inline;" class="text-center">
                        <strong>CÓDIGO</strong>
                    </div>
                    <div style="width:15.5%; display:inline;" class="text-center">
                        <strong>FECHA</strong>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center">
                        <strong>CLIENTE</strong>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center">
                        <strong>TOTAL $</strong>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center">
                        <strong>TOTAL BSS</strong>
                    </div>
                </div>

                <hr><br>
                <?php                    
                    $total = 0;
                    foreach($ventas AS $venta):
                        $cantidad++;
                        $total += $venta->total;
                ?>

                <div>
                    <div style="width:18.5%; display:inline;" class="text-center" >
                        <span><?= $venta->codigo; ?></span>
                    </div>
                    <div style="width:15.5%; display:inline;" class="text-center" >
                        <span><?= $venta->fecha; ?></span>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center" >
                        <span><?= $venta->cliente; ?></span>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center" >
                        <span><?= $venta->total ?></span>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center" >
                        <span><?= $venta->total * $dolar; ?></span>
                    </div>
                </div>
                
                <br>
                <div class="separador"></div>
                <?php
                    endforeach;
                ?>
                <div>
                    <div style="width:18.5%; display:inline;" class="text-center" >
                        <b>Cantidad de Ventas</b>
                    </div>
                    <div style="width:15.5%; display:inline;" class="text-center" >
                        <span><?= $cantidad ?></span>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center" >
                        <b>Total</b>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center" >
                        <span><?= $total ?></span>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center" >
                        <span><?= $total * $dolar; ?></span>
                    </div>
                </div>
                
                <br>
                <div class="separador"></div>
            <?php }?>
            <?php } ?>
            <br> 
                
        </div>  
        <!-- Fin de Ventas -->
       
        <br>
        <div class="separadorDos"></div>
        <div class="separadorDos"></div>
        <!-- Métodos de Pago -->
        <?php if(isset($pagos) AND count($pagos)>0){?>
        <div class="centrado" style="width: 95%;">
                <h3 class="text-center margin"><u>MÉTODOS DE PAGO</u></h3><br>
                <div>
                    <!-- <p> <b>Total de Ventas: </b> <?=$cantidad;?></p> -->
                   
                    <div style="width:24%; display:inline;" class="text-center">
                        <strong>MÉTODO</strong>
                    </div>
                    <div style="width:24%; display:inline;" class="text-center">
                        <strong>CANTIDAD</strong>
                    </div>
                    <div style="width:24%; display:inline;" class="text-center">
                        <strong>TOTAL $</strong>
                    </div>
                    <div style="width:24%; display:inline;" class="text-center">
                        <strong>TOTAL BSS</strong>
                    </div>
                    
                </div>

                <hr><br>
                <?php
                    $cantidadPagos = 0;
                    $totalPagos = 0;
                    foreach ($pagos as $pago): 
                        if(isset($pago->metodo)){
                            $cantidadPagos += $pago->cantidad;
                            $totalPagos += $pago->total;
                ?>
                <div>
                    <div style="width:24%; display:inline;" class="text-center" >
                        <span><?= $pago->metodo; ?></span>
                    </div>
                    <div style="width:24%; display:inline;" class="text-center" >
                        <span><?= $pago->cantidad; ?></span>
                    </div>
                    <div style="width:24%; display:inline;" class="text-center" >
                        <span><?= $pago->total; ?></span>
                    </div>
                    <div style="width:24%; display:inline;" class="text-center" >
                        <span><?= $pago->total*$dolar ?></span>
                    </div>
                </div>
                
                <br>
                <div class="separador"></div>
                <?php }endforeach;?>
                <div>
                    <div style="width:24%; display:inline;" class="text-center" >
                        <b>TOTAL</b>
                    </div>
                    <div style="width:24%; display:inline;" class="text-center" >
                        <span><?= $cantidadPagos ?></span>
                    </div>
                    <div style="width:24%; display:inline;" class="text-center" >
                        <span><?= $totalPagos ?></span>
                    </div>
                    <div style="width:24%; display:inline;" class="text-center" >
                        <span><?= $totalPagos*$dolar ?></span>
                    </div>
                </div>
                <br>
                <div class="separador"></div>
        </div>
        <?php }?>
        <!--Fin Métodos de Pago  -->
           
            
    </div>
</body>
</html>