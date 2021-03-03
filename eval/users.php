<?php

    include_once 'consult.php';

class data extends getAll{
    
    function cliente(){
        $list = $this->getClient();

        $arrCliente = [];
        while ($row = mysqli_fetch_object($list)){
            array_push($arrCliente,[
                "id" => $row->id_cliente,
                "identificacion" => $row->identificacion,
                "nombre" => $row->nombre,
                "telefono" => $row->telefono
            ]);
        };
        
        return $arrCliente;
    }

    function compras(){
        $clien = $this->cliente();
        
        foreach ($clien as $indice => $valor) {
            $cont = $this->getClienteCompra($valor['id']);
            if ($cont['con'] == 0) {
                echo "<br></br>";
                echo "<h3>Clientes sin Compras 03:</h3>";
                echo "<h5> Consulta 03: ".$cont['nombre']." Identificado con el numero: ".$cont['identificacion']." con el telefono: ".$cont['telefono']." Tiene ".$cont['con']." compras registradas"."</h5>";
                echo "<h3>Consultas agrupadas por cliente 04:</h3>";
            }
        }
 
        return;
    }

    function totalCompra(){
        $total = $this->getTotalCompras();
        
        foreach ($total as $indice => $valor){
            $totalAll = [
                "id_cliente" => $valor[0],
                "nombre" => $valor[1],
                "cantidad" => $valor[2],
                "total" => $valor[3]
            ];
            echo "<h5>".$totalAll['nombre'] ." Cantidad de articulos comprados: ".$totalAll["cantidad"]." Total compra: ".$totalAll["total"]."</h5>";
        }

        return;
    }

    function articulo(){
        $articulo = $this->articuloMasVendido();
        
        echo "<h3>Articulo mas vendido 05:</h3>";
        echo "<h5>Articulo con mayor ventas: ".$articulo["articulo"]." cantidad: ".$articulo["cantidad"]."</h5>";

        return;
    }

}

$data = new data();
$data->cliente();
$data->compras();
$data->totalCompra();
$data->articulo();

?>