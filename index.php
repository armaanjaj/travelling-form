<?php
    $insert = false;
    if(isset($_POST['f_name'])){
        // set connection variables
        $server = "localhost";
        $username = "root";
        $password = "";

        // create connection
        $con = mysqli_connect($server, $username, $password);

        // verify connection
        if(!$con){
            die("Connection to this database failed due to" . mysqli_connect_error());
        }

        // read the incoming parameters
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $other = $_POST['desc'];

        // enter values in the queries
        $sql_query = "INSERT INTO `travelling_buddy`.`trip` (`f_name`, `l_name`, `email`, `phone`, `age`, `gender`, `other`) VALUES('$f_name', '$l_name', '$email', '$phone', '$age', '$gender', '$other')";

        // check if query runs successfully
        if($con->query($sql_query) == true){
            $insert = true;
        }
        else{
            echo "Error: $sql <br> $con->error";
        }

        // close the connection
        $con->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travelling buddy</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <img class="bg" src="./img/bg.jpg">
    <div class="container">
        <h1>Welcome to Travelling buddy</h1>
        <p>Enter details to confirm your participation in the trip.</p>

        <?php

        if($insert == true){
            echo "<h4 class='confirmation'>Thanks for submitting the form. See you soon.</h4>";
        }
        else{
            echo '<form action="index.php" method="POST" class="form">
                <fieldset>
                    <input type="text" name="f_name" placeholder="Enter your first name"><br>
                    <input type="text" name="l_name" placeholder="Enter your last name"><br>
                    <input type="email" name="email" placeholder="Enter your email"><br>
                    <input type="tel" name="phone" placeholder="Enter your phone number" maxlength="10"><br>
                    <input type="text" name="age" placeholder="Enter your age"><br>
                    <input type="text" name="gender" placeholder="Enter your gender"><br>
                    <textarea name="desc" cols="30" rows="10" placeholder="Enter any other information here"></textarea>
                    <br>
                    <input type="submit" class="btn submit" value="Go">
                    <input type="reset" class="btn reset">
                </fieldset>
            </form>';
        }

        ?>
    </div>
</body>
</html>