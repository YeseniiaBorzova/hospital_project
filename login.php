<?php

session_start();

# process login form
if (isset($_POST["login"])) {
    session_unset();

    # set user session variables
    $_SESSION["user"] = $_POST["user"];
    $_SESSION["pass"] = $_POST["pass"];

    header("location: index.php");
} else {
    # redirect to a home page if user is already signed in
    if (isset($_SESSION["user"])) {
        header("location: index.php");
    }
}
?>
<!DOCTYPE html>
<style>
    Body {
        font-family: Calibri, Helvetica, sans-serif;
        background-color: lightskyblue;
    }
    button {
        background-color: darkblue;
        width: 20%;
        color: white;
        padding: 15px;
        margin: 10px 0px;
        border: none;
        cursor: pointer;
        transition-duration: 0.4s;
        opacity: 0.7;
    }
    button:hover{
        background-color: #3167ff;
        color: white;
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    }
    form {
        border: 3px solid #f1f1f1;
    }
    input[type=text], input[type=password] {
        width: 20%;
        margin: 8px 0;
        padding: 12px 20px;
        display: inline-block;
        border: 3px solid darkblue;
        box-sizing: border-box;
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    }
</style>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h3 style="font-size: 250%">Hospital system</h3>
<form method="post" action="login.php">

    <p>
        <b style="font-size: 200%">Username</b>
    </p>
    <p>
        <input type="text" name="user" required/>
    </p>
    <p>
        <b style="font-size: 200%">Password</b>
    </p>
    <p>
        <input type="password" name="pass" required/>
    </p>
    <p>
        <button type="submit" name="login" style="font-size: xx-large">Login</button>
    </p>
</form>
</body>
</html>