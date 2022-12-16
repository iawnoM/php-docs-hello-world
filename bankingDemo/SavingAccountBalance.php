<?php

    require_once 'autoloader.php';

    class SavingAccountBalance {

        private $conn;

        function __construct($conn)
        {
            $this->$conn;
        }

        function getBalance() {

            // $db = new Database;
            // $conn = $db->getConnection();

            // run query to get balance
            $sql = "SELECT BALANCE FROM SAVINGS";
            $result = $this->conn->query($sql);

            if ($result->num_rows == 0) {
                
                // $conn->close();
                return 1;
            } else {
                $row = $result->fetch_assoc();
                $balance = $row['BALANCE'];
                // $conn->close();
                return $balance;
            }
        }

        function updateBalance($balance) {
            
            // $balance -= 100;
            // $db = new Database;
            // $conn = $db->getConnection();

            // run query to get balance
            $sql = "UPDATE SAVINGSX SET BALANCE=$balance";
            $result = $this->conn->query($sql);

            if ($result) {
                // $conn->close();
                return 1;
            } else {
                // $conn->close();
                return 0;
            }
        }

    }