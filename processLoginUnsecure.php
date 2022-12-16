<?php
    
    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require ('vendor/autoload.php');
    include "dbConnect.php";
    use PragmaRX\Google2FA\Google2FA;

    $google2fa = new Google2FA();

    $username = addslashes($_POST['username']);
    $password = addslashes($_POST['password']);
    $userProvidedCode = $_POST["code"];

    echo "You've attempted to login with username:" . $username . " and password: " . $password . "<br>";

    $stmt = $conn->prepare("SELECT id, username, password, secretKey FROM loginData WHERE username = ?");
    $stmt->bind_param("s", $username);

    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($id, $uname, $pword, $secretKey);

    if ($stmt->num_rows == 1) {
        echo "Found 1 person with username!<br>";
        // output data of each row
        // $row = $result->fetch_assoc();
        $stmt->fetch();
        if (password_verify($password, $pword)) {
            echo "Passwords match<br>";
            if ($google2fa->verifyKey($secretKey, $userProvidedCode)) {
                echo "Login successful!<br>";
                $_SESSION['username'] = $uname;
                $_SESSION['userid'] = $id;

                echo "<br><a href = 'index.php'>return to main page</a>";
                exit;
            } else {
                echo "Invalid code, please try again";
                $_SESSION = [];
                session_destroy();
                echo "<br><a href='loginPage.php'> Return to Login Page <br>";
            }
    
        } else {
            $_SESSION = [];
            session_destroy();
        }

        echo "</div>";

    } else {
        echo "<br>0 results. Nobody found with given username and password<br>";
        $_SESSION = [];
        session_destroy();
    }
    echo "Login Failed<br>";
    
    echo "<hr>SESSION = <br>";
    
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
    
    echo "<br><a href = 'index.php'>return to main page</a>";

?>