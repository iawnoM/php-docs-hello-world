<?php

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo $conn->host_info . "\n";
    echo "Connected successfully<br>";

    $sql = "SELECT JokeID, JokeQuestion, JokeAnswer, userID FROM JokeTable";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        while ($row = $result->fetch_assoc()) {
            
            echo "<h3>" . $row["JokeQuestion"] . "</h3>";

            echo  "<div><p>" . $row["JokeAnswer"] . "<br> submitted by user #" . $row['userID'] . "</p><div>";
        }
    } else {

        echo "0 results";
        
    }

?>