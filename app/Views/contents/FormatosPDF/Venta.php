<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PDF</title>

    <style type="text/css">

        .container{
            padding: 0px 0px;
            color:lightslategrey;
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

    </style>
</head>
<body>
    <div class="container">

        <table style="width:725px">
            <tbody>
                <tr>
                    <td colspan="4" style="width:50%">
                        <img class="centrado" style="width:90%;" src="<?=URL;?>public/assets/img/logo.png" alt="">
                    </td>
                    <td colspan="4" style="width:50%">
                            <p class="text-right" style="display:block"><strong>FECHA:</strong> <span><i><?= $venta->fecha; ?></i></span></p>
                            <p class="text-right" style="display:block"><strong>CODIGO:</strong> <span><i><?= $venta->codigo; ?></i></span></p>
                    </td>
                </tr>

                <tr>
                    <td colspan="8">
                        <h1 class="text-center">DETALLE VENTA</h1>
                        <hr>
                    </td>
                </tr>

                <tr>
                    <td colspan="8">
                        <h3><u>CLIENTE</u></h3>
                    </td>
                </tr>

                <tr>
                    <td colspan="1">
                        <p><strong>NOMBRE:</strong></p>
                    </td>
                    <td colspan="3">
                        <p><?= $venta->cliente;?></p>
                    </td>
                    <td colspan="1">
                        <p><strong>CÉDULA/RIF:</strong></p>
                    </td>
                    <td colspan="3">
                        <p><?= $venta->rif_cliente;?></p>
                    </td>
                </tr>

                <tr>
                    <td colspan="1">
                        <p><strong>DIRECCION:</strong></p>
                    </td>
                    <td colspan="7">
                        <p><?= $venta->direccion;?></p>
                    </td>
                </tr>

                <tr>
                    <td colspan="8">
                        <h3 class="text-center"><u>PRODUCTOS</u></h3>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="centrado" style="width=100%;">
            <div style="width:19%; display:inline;" class="text-center">
                <strong>CANTIDAD</strong>
            </div>
            <div style="width:19%; display:inline;" class="text-center">
                <strong>CODIGO</strong>
            </div>
            <div style="width:19%; display:inline;" class="text-center">
                <strong>PRODUCTO</strong>
            </div>
            <div style="width:19%; display:inline;" class="text-center">
                <strong>PRECIO</strong>
            </div>
            <div style="width:19%; display:inline;" class="text-center">
                <strong>IMPORTE</strong>
            </div>
            <!-- <div style="width:15.5%; display:inline;" class="text-center">
                <strong>TOTAL BSS</strong>
            </div> -->
            <hr>
            <?php 

                    $total = 0;

                    foreach($productos AS $producto):

                        $total += ($producto->cantidad * $producto->precio);
                        // $totalBss = $total * $dolar;
                ?>

              
                <div style="width:19%; display:inline;" class="text-center" >
                    <?= $producto->cantidad; ?>
                </div>
                <div style="width:19%; display:inline;" class="text-center" >
                    <?= $producto->codigo; ?>
                </div>
                <div style="width:19%; display:inline;" class="text-center" >
                    <?= $producto->nombre; ?>
                </div>
                <div style="width:19%; display:inline;" class="text-center" >
                    <?= $producto->precio; ?>
                </div>
                <div style="width:19%; display:inline;" class="text-center" >
                    <?= $producto->precio * $producto->cantidad; ?>
                </div>
                <!-- <div style="width:15.5%; display:inline;" class="text-center" >
                    <?= $producto->precio * $producto->cantidad * $dolar; ?>
                </div> -->
                <br><br>

                <?php
                    endforeach;
                ?>
                <hr>
                <div>
                    
                  <strong>&nbsp;TOTAL:&nbsp; <?= $total; ?></strong>
                  <!-- <strong>&nbsp;TOTAL:&nbsp; <?= $total." $ - ".$totalBss." BSS"; ?></strong> -->
                </div>
        </div>
        
           
            
    </div>
</body>
</html>