<?php

    include_once "db-connect.php";

    // Clear all the users inputs to avoid SQL injection and XSS attacks
    include_once "treat-inputs.php";


    if(isset($_POST['btn-register'])) {
        $login = clearInput($_POST['login']);
        $login_check = clearInput($_POST['login_check']);
        $password = clearInput($_POST['password']);
        $password_check = clearInput($_POST['password_check']);

        // Check if the login is already in use
        $sql = "SELECT * FROM user WHERE userlogin = '$login'";
        $result = mysqli_query($connect, $sql);
        if(mysqli_num_rows($result) == 0){
            
            //Check if the login and password are the same
            if($login == $login_check) {
                if($password == $password_check) {
                    
                    //New register can be created
                    $userName = clearInput($_POST['name']);
                    $userLevel = clearInput($_POST['level']);
                    $is_goalkeeper = clearInput($_POST['is_goalkeeper']);
                    if($is_goalkeeper == "on") {
                        $is_goalkeeper = 1;
                    } else {
                        $is_goalkeeper = 0;
                    }

                    $pass_hash = password_hash($password, PASSWORD_DEFAULT);
                    $sql_register = "INSERT INTO user(userlogin, userpassword, userName, userLevel, goalkeeper) VALUES ('$login', '$pass_hash', '$userName', 
                    '$userLevel', '$is_goalkeeper')";

                    if(mysqli_query($connect, $sql_register)) {
                        //Redirects are being used with scripts because it is safer
                        echo "<script>alert('Registro criado com sucesso!');</script>";
                        echo "<script>window.location.href='../index.php';</script>";
                    }
                    else {
                        echo "<script>alert('Erro ao criar registro!');</script>";
                        echo "<script>window.location.href='../pages/register.php';</script>";
                    }
    
                }
                echo "<script>alert('As senhas não conferem!');</script>";
                echo "<script>window.location.href='../pages/register.php';</script>";
            }
            echo "<script>alert('Não foi possível cadastrar o usuário!');</script>";
            echo "<script>window.location.href='../pages/register.php';</script>";
        }
        echo "<script>alert('O usuário já existe!');</script>";
        echo "<script>window.location.href='../pages/register.php';</script>";
    }

?>

