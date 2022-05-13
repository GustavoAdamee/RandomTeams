<?php

    // connect to database
    $server_name = "localhost";
    $user_name = "phpmyadmin";
    $password = "200502";
    $db_name = "crudSociety";

    $connect = mysqli_connect($server_name, $user_name, $password, $db_name);

    mysqli_select_db($connect, $db_name);
    mysqli_set_charset($connect, "utf8");

    if(mysqli_connect_error()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

?>