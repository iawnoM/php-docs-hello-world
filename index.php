<html>
    <head>
        <title>Jokes Page</title>
    </head>

    <body>
    <h1>Jokes Page</h1>
    <a href="loginPage.php">    LOGIN   </a><br>
    <a> OR </a><br>
    <a href="registerUser.php">REGISTER HERE</a><hr>
    
    <?php

        // Check connection
        include "dbConnect.php";


        // include "getAllJokes.php";
    
    ?>

    <!-- Get keyword from user -->
    <form action="searchKeyword.php">
        Enter keyword to search for:<br>
        <input type="text" name="keyword"><br>

        <input type="submit" value="Submit">
    </form>
    <hr>
    <form action="addJoke.php">
        Enter New Joke:<br>
        <input type="text" name="newJoke"><br>
        Answer: <br>
        <input type="text" name="answer"><br><br>
        <input type="submit" value="Submit">
    </form>

    <?php
        // Search Database for given word
        // include "searchKeyword.php";        


        $conn->close();
    ?>

    <a href = "bankingDemo/tester.php">BANKING DEMO</a>


    </body>
</html>