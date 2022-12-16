<?php

    session_start();

    if (!$_SESSION['username']) {
        echo "Only logged in users can add a joke. Click <a href = 'loginPage.php'> here </a> to login<br>";
        exit;
    }


    include "dbConnect.php";

    $getJoke = htmlspecialchars(addslashes($_GET["newJoke"]));
    $getAnswer = htmlspecialchars(addslashes($_GET["answer"]));
    $userid =  $_SESSION['userid'];
    $blankString = "";

    // $getJoke = addslashes($getJoke);
    // $getAnswer = addslashes($getAnswer);

    echo "<h2>Adding joke $getJoke to database</h2>";
    // $sql = "INSERT INTO JokeTable (jokeID, JokeQuestion, JokeAnswer, userID) VALUES (NULL, '$getJoke', '$getAnswer', '$userid')";

    // $stmt = $conn->prepare("INSERT INTO JokeTable (jokeID, JokeQuestion, JokeAnswer, userID) VALUES (NULL, ?, ?, ?)");
    // $stmt->bind_param("ssi", $getJoke, $blankString, $userid);

    // $stmt->execute();
    // $stmt->close();

    $sql1 =("INSERT INTO JokeTable (jokeID, JokeQuestion, JokeAnswer, userID) VALUES (NULL, $getJoke, $getAnswer, $userid");
    $sql2 = ("UPDATE JokeTable SET JokeAnswer = $getAnswer WHERE JokeQuestion = $getJoke");
    $result1 = $conn->query($sql1);
    $result2 = $conn->query($sql2);

    if (!$conn->commit()) {
        echo "Transaction failed!";
        exit();
    }

    include "getAllJokes.php";

    echo "<a href='index.php'>Return to Main Page</a>";
?>
