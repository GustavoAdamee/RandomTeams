<?php

    include_once "db-connect.php";
    include_once "treat-inputs.php";

    if(isset($_POST['btn-login'])) {
        $login = clearInput($_POST['login']);
        $password = clearInput($_POST['password']);

        // Check if the username exists
        $sql = "SELECT * FROM user WHERE userlogin = '$login'";
        $result = mysqli_query($connect, $sql);
        if(mysqli_num_rows($result) == 1) {
            //Check the password
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['userpassword'])) {
                //Session start
                session_start();
                $_SESSION['logged_in'] = true;
                $_SESSION['user_login'] = $row['userlogin'];
                $_SESSION['user_level'] = $row['userLevel'];
                $_SESSION['is_goalkeeper'] = $row['goalkeeper'];
                $_SESSION['user_name'] = $row['userName'];
                if($row['is_admin'] == 1) {
                    $_SESSION['is_admin'] = true;
                }
                else{
                    $_SESSION['is_admin'] = false;
                }
                //Redirects are being used with scripts because it is safer
                die("<script>window.location.href='../pages/home.php';</script>");
            }
            echo "<script>alert('Senha incorreta!');</script>";
            die("<script>window.location.href='../pages/login.php';</script>");   
        }
        echo "<script>alert('Usuário não encontrado!');</script>";
        die("<script>window.location.href='../pages/login.php';</script>");
    }

?>