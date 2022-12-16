<?php

class Database {

    private $servername = "localhost";
    private $username = "root";
    private $password = "usbw";
    private $dbInUse = "bankingdemo";

    // Create connection
    function getConnection() {

        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbInUse);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

}
    
?>