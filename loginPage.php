<html>
    <head>
        <title>Login Page</title>
    </head>

    <body>
    <h1><center>Login Page</center></h1>
    
    <?php

        // Check connection
        include "dbConnect.php";
    
    ?>

    <!-- Get keyword from user -->
    <form class="form-horizontal" action="processLoginUnsecure.php" method="post">

        <label for="username">Username:</label>
        <input type="text" name="username" placeholder="your name"><br><br>

        <label for="password">Enter Password:</label>
        <input type="password" name="password" placeholder="e.g. chicken193"><br><br>

        <label class="col-md-4 control label" for="code">Google Authenticator Code</label>
        <input id="password" name="code" type="text" placeholder="" class="form-control input-md"><br><br>


        <input type="submit" value="Submit">
    </form>
    
    <!-- <div class="form-group">
        <div class="col-md-4">
            <p class="help-block">Enter your code from the authenticator app</p>
        </div>
    </div> -->
    
    <hr>
    </body>
</html>