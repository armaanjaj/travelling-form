<?php
    // declare global variables
    $insert = false;
    $f_nameErr = $l_nameErr = $emailErr = $phoneErr = $genderErr = $ageErr = "";
    $f_name = $l_name = $email = $phone = $gender = $age = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
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

        $error_exists = false;

        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // read the incoming parameters
        if (empty($_POST["f_name"])) {
            $f_nameErr = "First Name is required";
            $error_exists = true;
        } else {
            $f_name = validate($_POST['f_name']);
        }

        if (empty($_POST["l_name"])) {
            $l_nameErr = "Last name is required";
            $error_exists = true;
        } else {
            $l_name = validate($_POST['l_name']);
        }

        if (empty($_POST["age"])) {
            $ageErr = "Age is required";
            $error_exists = true;
        } else {
            $age = validate($_POST['age']);
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $error_exists = true;
        } else {
            $email = validate($_POST['email']);
        }

        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
            $error_exists = true;
        } else {
            $gender = validate($_POST['gender']);
        }

        if (empty($_POST["phone"])) {
            $phoneErr = "Phone is required";
            $error_exists = true;
        } else {
            $phone = validate($_POST['phone']);
        }

        $other = validate($_POST['desc']);

        if(!$error_exists){
            // enter values in the queries
            $sql_query = "INSERT INTO `travelling_buddy`.`trip` (`f_name`, `l_name`, `email`, `phone`, `age`, `gender`, `other`) VALUES('$f_name', '$l_name', '$email', '$phone', '$age', '$gender', '$other')";

            // check if query runs successfully
            if($con->query($sql_query) == true){
                $insert = true;
            }
            else{
                echo "Error: $sql <br> $con->error";
            }
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

        $action = htmlspecialchars($_SERVER['PHP_SELF']);
        $file_name = substr($action, strrpos($action, '/', 0)+1);

        if($insert == true){
            echo "<p class='confirmation'>Thanks for submitting the form. See you soon.</p>";
        }
        else{
            echo "<form action=".$file_name." method='POST' class='form'>
                <fieldset>
                    <input type='text' name='f_name' value='".$f_name."' placeholder='Enter your first name'>
                    <span class='error'>".$f_nameErr."</span><br>

                    <input type='text' name='l_name' value='".$l_name."' placeholder='Enter your last name'>
                    <span class='error'>".$l_nameErr."</span><br>

                    <input type='email' name='email' value='".$email."' placeholder='Enter your email'>
                    <span class='error'>".$emailErr."</span><br>

                    <input type='tel' name='phone' value='".$phone."' placeholder='Enter your phone number' maxlength='10'>
                    <span class='error'>".$phoneErr."</span><br>

                    <input type='text' name='age' value='".$age."' placeholder='Enter your age'>
                    <span class='error'>".$ageErr."</span><br>

                    <input type='text' name='gender' value='".$gender."' placeholder='Enter your gender'>
                    <span class='error'>".$genderErr."</span><br>

                    <textarea name='desc' cols='30' rows='10' placeholder='Enter any other information here'></textarea><br>

                    <input type='submit' class='btn submit' value='Go'>
                    <input type='reset' class='btn reset'>
                </fieldset>
            </form>";
        }

        ?>
    </div>
</body>
    <?php //include 'footer.php';?>
</html>