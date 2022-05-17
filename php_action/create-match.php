<?php

    session_start();

    include_once "db-connect.php";
    include_once "treat-inputs.php";

    if(isset($_POST['btn-match'])){
        $matchName = clearInput($_POST['matchName']);
        $matchDate = clearInput($_POST['matchDate']);
        $matchSize = clearInput($_POST['matchSize']);

        //Verifies if there are suficient players and goalkeepers to create a match 
        $sql_players = "SELECT * FROM user";
        $result_players = mysqli_query($connect, $sql_players);
        //removing admin from the count
        $players = mysqli_num_rows($result_players) - 1;
        $sql_goalkeepers = "SELECT * FROM user WHERE goalkeeper = 1";
        $result_goalkeepers = mysqli_query($connect, $sql_goalkeepers);
        $goalkeepers = mysqli_num_rows($result_goalkeepers);

        if($players < $matchSize * 2){
            echo "<script>alert('Não ha jogadores suficientes!');</script>";
            echo "<script>window.location.href='../pages/admin.php';</script>";
        }
        elseif($goalkeepers < 2){
            echo "<script>alert('Não ha goleadores suficientes!');</script>";
            echo "<script>window.location.href='../pages/admin.php';</script>";
        }
        else{
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
        
    }

?>
