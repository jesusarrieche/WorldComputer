<?php

namespace App\Controllers;

use App\Models\Compra;
use App\Models\Venta;
use App\Traits\Utility;
use PDO;
use System\Core\Controller;
use System\Core\View;

class ReporteController extends Controller {

    private $compra;
    private $venta;
	
	use Utility;

	public function __construct(){
        $this->compra = new Compra;
        $this->venta = new Venta;
    }
    
    public function index(){
        return View::getView('Reporte.index');
    }

    public function compras($producto){

        $query = $this->compra->query("SELECT c.codigo , Date_format(c.fecha,'%d/%m/%Y') AS fecha, p.razon_social FROM
            compras c
                JOIN
            proveedores p
                ON c.proveedor_id = p.id
            WHERE c.estatus = 'ACTIVO'");

        $compras = $query->fetchAll(PDO::FETCH_OBJ);

        return View::getView('Reporte.compras', ['compras' => $compras]);
    }

    public function totalTransacciones(){

        $query = $this->compra->query("SELECT c.codigo, c.fecha, c.impuesto, SUM(dc.costo * dc.cantidad) AS monto FROM
            compras c
                LEFT JOIN
            detalle_compra dc
                ON dc.compra_id = c.id
                WHERE c.estatus = 'ACTIVO'
                GROUP BY c.codigo, c.fecha, c.impuesto");

        $respQuery = $query->fetchAll(PDO::FETCH_OBJ);

        $egresos = 0;

        foreach( $respQuery AS $compra ) {
            $egresos += $compra->monto;
        }

        $query2 = $this->compra->query("SELECT COUNT(c.id) AS compras FROM
            compras c
            WHERE c.estatus = 'ACTIVO'");

        $compras = $query2->fetch(PDO::FETCH_COLUMN);

        $query3 = $this->venta->query("SELECT v.codigo, v.fecha, v.impuesto, IFNULL(SUM(dv.precio * dv.cantidad), 0) AS monto FROM
            ventas v
                LEFT JOIN
            detalle_venta dv
                ON dv.venta_id = v.id
                WHERE v.estatus = 'ACTIVO'
                GROUP BY v.codigo, v.fecha, v.impuesto");

        $respQuery3 = $query3->fetchAll(PDO::FETCH_OBJ);

        $ingresos = 0;

        foreach($respQuery3 AS $venta) {
            $ingresos += $venta->monto;
        }

        $query4 = $this->venta->query("SELECT COUNT(v.id) AS ventas FROM
            ventas v
            WHERE v.estatus = 'ACTIVO'");

        $ventas = $query4->fetch(PDO::FETCH_COLUMN);



        return View::getView('Reporte.totalTransacciones', [
            'compras' => $compras,
            'egresos' => $egresos,
            'ventas' => $ventas,
            'ingresos' => $ingresos
            ]);
    }

}