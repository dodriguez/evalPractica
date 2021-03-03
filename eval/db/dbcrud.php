<?php

    include_once 'db.php';

class dbCreate extends DB{
      
    public function createDb(){

        $sql = 'DROP DATABASE IF EXISTS ds';
        $con = $this->conn();
        $con->query($sql);


        $sql = 'CREATE DATABASE ds';
        if ($con->query($sql) === TRUE) {
            echo "se creo database";
            $this->createTablesData();
        }
    }

    public function createTablesData(){

        $con = $this->connect();
        $sqlClients = 'CREATE TABLE `clientes`(
            `id_cliente` int(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `identificacion` varchar(255) NOT NULL,
            `nombre` varchar(255) not null,
            `telefono` varchar(10) not null
        )';
        $sqlCompra = 'CREATE TABLE `compras`(
            `id_compra` int(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `id_cliente` int(4) NOT NULL,
            `articulo` varchar(255),
            `cantidad` varchar(255),
            `total` varchar(255)
        )';
        $sqlRelations = 'ALTER TABLE clientes ADD FOREIGN KEY (id_cliente) REFERENCES compras(id_cliente)';
        // $sqlRelations = 'ALTER TABLE compras ADD FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)';
        $sqlInserCliente = 'INSERT INTO `clientes`(
            `identificacion`,
            `nombre`,
            `telefono`
            ) VALUES 
            ("1122334455","Jose Perez","318000023"),
            ("5522884455","Rosa Arias","315000031"),
            ("7726634005","Rafael Cardenas","319001155"),
            ("7726634005","Rodrigo Arenas","320044012"),
            ("1892365451","Manuel Rincon","320044023")';
        $sqlCompras = 'INSERT INTO `compras`(
            `id_cliente`,
            `articulo`,
            `cantidad`,
            `total`
            ) VALUES 
            ("1","Taladro","1","120000"),
            ("1","Pulidora","1","350000"),
            ("2","Llantas","3","280000"),
            ("2","Pulidora","2","700000"),
            ("3","Secadora","2","450000"),
            ("4","Baterias","5","780000")';
        
        $arr = array(
            $sqlClients,
            $sqlCompra,
            $sqlRelations,
            $sqlInserCliente,
            $sqlCompras
        );

        foreach ($arr as $indice => $valor) {
            mysqli_query($con,$valor);
            
            
        }

        return ; 
        
    }
}
?>