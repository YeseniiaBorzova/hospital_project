<?php

function db_conn()
{
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "hospital";

    $conn = @mysqli_connect($server, $user, $pass, $db);

    if (!$conn) {
        session_unset();
        session_destroy();

        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}
