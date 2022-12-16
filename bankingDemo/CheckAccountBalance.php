<?php

    require_once 'autoloader.php';

    class CheckAccountBalance {

        private $conn;

        function __construct($conn)
        {
            $this->$conn;
        }

        function getBalance() {

            // $db = new Database;
            // $conn = $db->getConnection();

            // run query to get balance
            $sql = "SELECT BALANCE FROM CHECKING";
            $result = $this->conn->query($sql);

            if ($result->num_rows == 0) {
                
                // $this->conn->close();
                return 1;
            } else {
                $row = $result->fetch_assoc();
                $balance = $row['BALANCE'];
                // $this->conn->close();
                return $balance;
            }
        }

        function updateBalance($balance) {

            // $db = new Database;
            // $conn = $db->getConnection();

            // run query to get balance
            $sql = "UPDATE CHECKING SET BALANCE=$balance";
            $result = $this->conn->query($sql);

            if ($result) {
                // $this->conn->close();
                return 1;
            } else {
                // $this->conn->close();
                return 0;
            }
        }

    }