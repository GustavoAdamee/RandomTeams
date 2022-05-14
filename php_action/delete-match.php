<?php

    include_once "db-connect.php";
    include_once "treat-inputs.php";

    if(isset($_POST['btn-delete-match'])){
        $matchId = clearInput($_POST['matchId']);
        $sql_delete = "DELETE FROM matches WHERE id = '$matchId'";
        if(mysqli_query($connect,$sql_delete)){
            echo "<script>alert('Partida deletada com sucesso!');</script>";
            echo "<script>window.location.href='../pages/admin.php';</script>";
        }
        else{
            echo "<script>alert('Erro ao deletar partida!');</script>";
            echo "<script>window.location.href='../pages/admin.php';</script>";
        }
    }    

?>