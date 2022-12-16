<?php

    include "dbConnect.php";
    $getKeyword = addslashes($_GET['keyword']);
    
    // $getKeyword = "%" . $getKeyword . "%";

    echo "<h2>Show all jokes with word \"$getKeyword\" in the joke</h2>";
    // $sql = "SELECT JokeID, JokeQuestion, JokeAnswer, userID, username

    //         FROM  joketable
            
    //         JOIN logindata on logindata.id = joketable.userID
            
    //         WHERE JokeQuestion like '%$getKeyword%'";

    $stmt = $conn->prepare("SELECT JokeID, JokeQuestion, JokeAnswer, userID, username FROM joketable
    
                            JOIN logindata on logindata.id = joketable.userID
                            
                            WHERE JokeQuestion LIKE ?");
    
    $stmt->bind_param("s", $getKeyword);

    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($ID, $jokeQuestion, $jokeAnswer, $userid, $username);

            
    // $result = $conn->query($sql);

    if ($stmt->num_rows > 0) {
        // output data of each row
        while ($row = $stmt->fetch()) {
            $safeJokeQ = $jokeQuestion;
            $safeAnswer = $jokeAnswer;

            echo "<h3>" . $jokeQuestion . "</h3>";

            echo  "<div><p>" . $safeAnswer . " -- Submitted by user: " . $username . "</p><div>";
        }
    } else {
        echo "0 results";
    }
?>