<?php

    session_start();

    include_once "db-connect.php";
    include_once "treat-inputs.php";

    if(isset($_POST['btn-match'])){
        $matchName = clearInput($_POST['matchName']);
        $matchDate = clearInput($_POST['matchDate']);
        $matchSize = clearInput($_POST['matchSize']);

        $sql_match = "INSERT INTO matches(matchName, matchDate, matchSize) VALUES ('$matchName', '$matchDate', '$matchSize')";

        if(mysqli_query($connect,$sql_match)){
            echo "<script>alert('Partida criada com sucesso!');</script>";
            echo "<script>window.location.href='../pages/admin.php';</script>";
        }
        else{
            echo "<script>alert('Erro ao criar partida!');</script>";
            echo "<script>window.location.href='../pages/admin.php';</script>";
        }
    }

?>
