<?php

    require ('vendor/autoload.php');

    include "dbConnect.php";
    
    $newUsername = addslashes($_GET['username']);
    $password = addslashes($_GET['password']);
    $passConfirm = addslashes($_GET['password2']);

    use PragmaRX\Google2FA\Google2FA;
    
    $google2fa = new Google2FA();
    $secret = $google2fa->generateSecretKey();

    $hashedPW = password_hash($passConfirm, PASSWORD_DEFAULT);

    echo "<h2> Adding new user: " . $newUsername . " | Pw: " . $password ."</h2>";

    // check to see if user is already in database
    
    if ($passConfirm != $password) {
        echo "Passwords are not equal!<br>";
        exit;
    }

    // check for numbers in password
    preg_match('/[0-9]+/', $passConfirm, $matches);
    if (sizeof($matches) == 0) {
        echo "Password must have at least 1 number<br>";
        exit;
    }
    
    // TODO uncomment this after testing
    // preg_match('/[!@#$%^&*()]+/', $passConfirm, $matches);
    // if (sizeof($matches) == 0) {
    //     echo "Password must have at least 1 special character<br>";
    //     exit;
    // }

    // if (strlen($passConfirm) < 8) {
    //     echo "Password must have at least 8 characters<br>";
    //     exit;
    // }
    

    $sql = "SELECT * FROM loginData WHERE username = '$newUsername'";

    $stmt = $conn->prepare("SELECT * FROM loginData WHERE username = ?");
    $stmt->bind_param("s", $newUsername);

    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Error: username is already taken<br>";
        exit;
    }

    // If passwrods are equal, add to the database
    $stmt = $conn->prepare("INSERT INTO loginData (id, username, password) VALUES (NULL, ?, ?)");
    $stmt->bind_param("ss", $newUsername, $hashedPW);

    $result = $stmt->execute();

    $stmt = $conn->prepare("UPDATE loginData SET secretKey = '$secret' WHERE username = '$newUsername'");
    $stmt->execute();

    echo "Scan code with Authenticator app!";

    $text = $google2fa->getQRCodeUrl(
        'localhost',
        $username,
        $secret
       );
           
    $image_url = 'https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl='.$text;
    echo '<img src="'.$image_url.'" />';
    
    if ($result) {
        echo "Registration Success!";
    } else {
        echo "Erorr occurrued, registration unsuccessful";
    }

    $stmt->close();
?>

<a href="index.php"> Return to Main Page</a>
