<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Compras</title>

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
            <h1 class="text-center margin">REPORTE DE COMPRAS</h1>
            <hr>
            <div>
            
                <p>
                <?php if(!$proveedores){?>
                    <strong>Proveedor: </strong> <?=$proveedor?><br>
                <?php }?>
                 <strong>Desde: </strong> <?=$desde?><br>
                 <strong>Hasta: </strong> <?=$hasta?>
                </p>
                
            </div>
            <!-- Compras -->
            <?php if(isset($compras) && count($compras)>0){?>
            <div clas="separadorDos"></div>
            <h3 class="text-center margin"><u>COMPRAS</u></h3><br>
        
        
        <?php if($proveedores){?>
            <div>
                <div style="width:15%; display:inline;" class="text-center">
                    <strong>CÓDIGO</strong>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center">
                    <strong>FECHA</strong>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center">
                    <strong>PROVEEDOR</strong>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center">
                    <strong>IMPUESTO</strong>
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
                foreach($compras AS $compra):
                    $cantidad++;
                    $total += $compra->total;
            ?>

            <div>
                <div style="width:15%; display:inline;" class="text-center" >
                    <span><?= $compra->codigo; ?></span>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <span><?= $compra->fecha; ?></span>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <span><?= $compra->proveedor; ?></span>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <span><?= $compra->impuesto; ?></span>
                </div>
                <div style="width:18%; display:inline;" class="text-center" >
                    <span><?= $compra->total ?></span>
                </div>
                <div style="width:18%; display:inline;" class="text-center" >
                    <span><?= $compra->total * $dolar; ?></span>
                </div>
            </div>
                
            <br>
            <div class="separador"></div>
                <?php
                    endforeach;
                ?>
            <div>
                <div style="width:22.5%; display:inline;" class="text-center" >
                    <b>Cantidad de Compras</b>
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
                    <div style="width:20%; display:inline;" class="text-center">
                        <strong>CÓDIGO</strong>
                    </div>
                    <div style="width:20.5%; display:inline;" class="text-center">
                        <strong>FECHA</strong>
                    </div>
                    <div style="width:20.5%; display:inline;" class="text-center">
                        <strong>IMPUESTO</strong>
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
                    foreach($compras AS $compra):
                        $cantidad++;
                        $total += $compra->total;
                ?>

                <div>
                    <div style="width:20%; display:inline;" class="text-center" >
                        <span><?= $compra->codigo; ?></span>
                    </div>
                    <div style="width:20.5%; display:inline;" class="text-center" >
                        <span><?= $compra->fecha; ?></span>
                    </div>
                    <div style="width:20.5%; display:inline;" class="text-center" >
                        <span><?= $compra->impuesto; ?></span>
                    </div>
                    <div style="width:18%; display:inline;" class="text-center" >
                        <span><?= $compra->total ?></span>
                    </div>
                    <div style="width:18%; display:inline;" class="text-center" >
                        <span><?= $compra->total * $dolar; ?></span>
                    </div>
                </div>
                
                <br>
                <div class="separador"></div>
                <?php
                    endforeach;
                ?>
                <div>
                    <div style="width:26.5%; display:inline;" class="text-center" >
                        <b>Cantidad de Compras</b>
                    </div>
                    <div style="width:15%; display:inline;" class="text-center" >
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
        <!-- Fin de Compras -->
       
        <br>
        <div class="separadorDos"></div>
        <div class="separadorDos"></div>
        <!-- Métodos de Pago -->
        <?php if(isset($pagos) AND count($pagos)>0){?>
        <div class="centrado" style="width: 95%;">
                <h3 class="text-center margin"><u>MÉTODOS DE PAGO</u></h3><br>
                <div>
                    <!-- <p> <b>Total de Compras: </b> <?=$cantidad;?></p> -->
                   
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