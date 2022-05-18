<?php

    include_once "db-connect.php";
    include_once "treat-inputs.php";

    if(isset($_POST['btn-create-teams'])){
    //verifies how many teams will be created
        
        //Confirmed lone players
        $sql_rows = "SELECT * FROM user WHERE NOT goalkeeper = 1 AND presence = 1";
        $result_players = mysqli_query($connect, $sql_rows);
        $line_players = mysqli_num_rows($result_players);

        echo ("</br> Jogadores de linha = $line_players</br>");

        //number of goalkeepers
        $sql_goalkeepers = "SELECT * FROM user WHERE goalkeeper = 1 AND presence = 1";
        $result_goalkeepers = mysqli_query($connect, $sql_goalkeepers);
        $goalkeepers = mysqli_num_rows($result_goalkeepers);

        echo ("</br> Goleiros = $goalkeepers</br>");

        //Size of the teams
        $sql_rows = "SELECT * FROM matches";
        $result_matches = mysqli_query($connect, $sql_rows);
        $data_match = mysqli_fetch_assoc($result_matches);
        $team_size = (int)$data_match['matchSize'];

        echo "</br> Tamanho da equipe = $team_size</br>";

        //Number of teams
        $number_teams = ceil( ($line_players + $goalkeepers) / $team_size);

        echo "</br> Número de times = $number_teams</br>";

        // //Creates teams
        // //Check if there are too many goalkeepers
        if($goalkeepers > $number_teams){
            echo ("<script>alert('Não há espaço para os goleiros!');</script>");
            echo ("<script>window.location.href='../pages/menage-teams.php';</script>");
        }
        elseif($goalkeepers < $number_teams){
            echo ("<script>alert('Está faltando goleiros!');</script>");
            echo ("<script>window.location.href='../pages/menage-teams.php';</script>");
        }
        else{
            //create teams
            //Insert one goalkeeper per team
            $sql_goalkeeper = "SELECT * FROM user WHERE goalkeeper = 1 AND presence = 1";
            $result_goalkeeper = mysqli_query($connect, $sql_goalkeeper);
            $actual_team = 0;
            //UPDATE the team that each goalkeeper belongs to
            while($data_goalkeeper=mysqli_fetch_array($result_goalkeeper)){
                $id=$data_goalkeeper['id'];
                $sql_update = "UPDATE user SET userTeam = $actual_team WHERE id = $id";
                mysqli_query($connect, $sql_update);
                if($actual_team == $number_teams-1){
                    break;
                }
                $actual_team++;
            }

            //Insert the rest of the players
            $sql_players = "SELECT * FROM user WHERE NOT goalkeeper = 1 AND presence = 1";
            $result_players = mysqli_query($connect, $sql_players);
            $actual_team_iterator = 0;

            while($data_players=mysqli_fetch_array($result_players)){
                
                if($actual_team_iterator == $number_teams-1){
                    $actual_team_iterator=0;
                }
                else{
                    $actual_team_iterator++;
                }
                
                $id=$data_players['id'];
                $sql_update = "UPDATE user SET userTeam = $actual_team_iterator WHERE id = $id";
                mysqli_query($connect, $sql_update);
            }
            echo ("<script>window.location.href='../pages/view-teams.php';</script>");    
        }
    }

?>