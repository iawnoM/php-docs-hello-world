<?php

    require_once "autoloader.php";

    class BankingBusinessService {

        function getCheckingBalance() {
    
            $db = new Database();
            $conn = $db->getConnection();
    
            $checkingservice = new CheckAccountBalance($conn);
            $balance = $checkingservice->getBalance();
    
            $conn->close();
            return $balance;
        }
    
        function getSavingBalance() {
    
            $db = new Database();
            $conn = $db->getConnection();
    
            $savingservice = new SavingAccountBalance($conn);
            $balance = $savingservice->getBalance();
    
            $conn->close();
            return $balance;
        }

        function transaction($transfer) {

            $db = new Database();
            $conn = $db->getConnection();

            $conn->autocommit(false);
            $conn->begin_transaction();

            $checkingbalance = $this->getCheckingBalance();
            $checking = new CheckAccountBalance($conn);
            $okchecking = $checking->updateBalance($checkingbalance - $transfer);
            
            $savingbalance = $this->getSavingBalance();
            $saving = new SavingAccountBalance($conn);
            $oksaving = $saving->updateBalance($savingbalance + $transfer);

            if ($okchecking && $oksaving) {
                $conn->commit();
            } else {
                $conn->rollback();
            }
            
            $conn->close();
        }
    }
    
