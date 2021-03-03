<?php
    require_once 'db/db.php';
    
    class getAll extends DB {
        
        function getClient(){
            $sql = "SELECT * FROM clientes";
            $conn = $this->connect();
    
            $cliente = mysqli_query($conn,$sql);
        
            return $cliente;
        }
    
        function getCompra(){
            $sql = "SELECT * FROM compras";
            $conn = $this->connect();

            $compra = mysqli_query($conn,$sql);

            return $compra;
        }

        function getClienteCompra($id){
            $sql = "SELECT COUNT(*) AS con, c.id_cliente, c.identificacion, c.nombre, 
                    c.telefono FROM clientes c INNER JOIN compras cp ON 
                    c.id_cliente = cp.id_cliente WHERE cp.id_cliente = $id";
            $conn = $this->connect();
            $clienteCompra = mysqli_fetch_object(mysqli_query($conn,$sql));
            $clienteCompra = [
                "con" => $clienteCompra->con,
                "id_cliente" => $clienteCompra->id_cliente,
                "identificacion" => $clienteCompra->identificacion,
                "nombre" => $clienteCompra->nombre,
                "telefono" => $clienteCompra->telefono
            ];
            
            return $clienteCompra;
        }

        function getTotalCompras(){
            $sql = "SELECT c.id_cliente, c.nombre, SUM(IFNULL(cp.cantidad,0)) AS cantidad,
                    IFNULL(SUM(total),0) AS total FROM clientes c LEFT JOIN compras cp ON 
                    (cp.id_cliente = c.id_cliente) GROUP BY c.id_cliente";
            $conn = $this->connect();
            $totalCompras = mysqli_fetch_all(mysqli_query($conn,$sql));
        
            return $totalCompras;
        }


        function articuloMasVendido(){
            $sql = "SELECT cp.articulo, cp.cantidad FROM compras cp 
                    WHERE cp.cantidad = (SELECT MAX(cp.cantidad) FROM compras cp);";
            $conn = $this->connect();
            $articulo = mysqli_fetch_object(mysqli_query($conn,$sql));
            $articulo = [
                "articulo" => $articulo->articulo,
                "cantidad" => $articulo->cantidad
            ];

            return $articulo;
        }


    }

?>