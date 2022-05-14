<?php

    session_start();

    include_once "db-connect.php";

    //Update user presence in the database
    if(isset($_POST['btn-join-match'])){
        $login = $_SESSION['user_login'];
        $sql_update = "UPDATE user SET presence = 1 WHERE userlogin = '$login'";
        mysqli_query($connect,$sql_update);
        echo "<script>window.location.href='../pages/home.php';</script>";
    }

    if(isset($_POST['btn-quit-match'])){
        $sql_update = "UPDATE user SET presence = 0 WHERE userlogin = '$_SESSION[user_login]'";
        mysqli_query($connect,$sql_update);
        echo "<script>window.location.href='../pages/home.php';</script>";
    }
?>