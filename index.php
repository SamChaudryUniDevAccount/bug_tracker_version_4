<?php


include("dbconfig.php");

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // username and password sent from form

    echo "unsecured username is {$_POST['username']} and password is {$_POST['password']}";


    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']);

    echo "username is {$myusername} and password is {$mypassword}";

    $sql = "SELECT username , password FROM user WHERE username = '$myusername' and passcode = '$mypassword'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    echo $count;

    if($count == 1) {

        //session_register("myusername");

        $_SESSION['login_user'] = $myusername;
        echo "count is 1";
        header('location: landing.php');

    }else {

        $error = "Your Login Name or Password is invalid";

    }
}
else{
    ?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h1>It's Alive!!!</h1>

<form action="/" method="post">
    <div class="imgcontainer">
    </div>
    <div class="container">
        <label><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <button type="submit">Login</button>
    </div>
</form>

</body>
</html>

    <?php
}
?>


