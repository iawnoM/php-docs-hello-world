<?php
    require_once 'autoloader.php';

    $bs = new BankingBusinessService();

    $checkBalance = $bs->getCheckingBalance();
    $savingBalance = $bs->getSavingBalance();

    echo "Current values:<br>";
    echo "Checking balance = " . $checkBalance . "<br>";
    echo "Saving balance = " . $savingBalance . "<br>";

    // echo "Take $100 from checking and put it into saving<br>";
    // $checking->updateBalance($checkBalance - 100);
    // $saving->updateBalance($savingBalance + 100);
    // $bs->transaction(100);

    // $checkBalance = $bs->getCheckingBalance();
    // $savingBalanc = $bs->getSavingBalance();

    // echo "Current values:<br>";
    // echo "Checking balance = " . $checkBalance . "<br>";
    // echo "Saving balance = " . $savingBalance . "<br>";