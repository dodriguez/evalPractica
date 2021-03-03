<?php

class DB{

    private $host     = 'localhost'; //host remote.
    private $db       = 'ds'; //data base.
    private $user     = 'php'; //create user in mysql.
    private $password = "p@*tutu"; //pass of the user.

    public function connect(){
            
        $con = mysqli_connect($this->host, $this->user, $this->password, $this->db);

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $con;
    }

    public function conn(){

        $server = new mysqli($this->host,$this->user,$this->password);

        return $server;

    }
}


?>