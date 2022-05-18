<?php

    session_start();

    include_once "../includes/header.php";
    include_once "../php_action/db-connect.php";
    include_once "../includes/navbar.php";
    include_once "../includes/logged-in-check.php";


?>

<div class="row">
    <div class="col s12 m6 l4">
        <div class="card large hoverable">
            <div class="card-content">
                <span class="card-title"><h4 class="center-align"> Informações:</h4></span>
                <br><br><br>
                <p id="userInfos">
                    <strong>Nome:</strong> <?php if($_SESSION['user_name'])echo($_SESSION['user_name']);?><br><br>
                    <strong>Posição:</strong> <?php if($_SESSION['is_goalkeeper'] == 1):?>
                        Goleiro
                        <?php else:?>
                        Jogador de linha
                        <?php endif;?>
                    <br><br><strong>Habilidade:</strong> <?php if(isset($_SESSION['user_level']))echo($_SESSION['user_level']);?>
                </p>
            </div>
        </div>
    </div>
    <div class="col s12 m6 l4">
        <div class="card large hoverable">
            <div class="card-content">
                <span class="card-title"><h4 class="center-align"> Jogos Disponíveis:</h4></span>
                <br><br><br>
                <p>

                    <?php
                        $sql_match = "SELECT * FROM matches";
                        $result = mysqli_query($connect, $sql_match);
                        $rows = mysqli_num_rows($result);
                        $data_match = mysqli_fetch_array($result);
                        if($rows <= 0):
                    ?>
                        <h5 class="center-align">Nenhum jogo disponível</h5>
                    <?php 
                        elseif($rows > 0 && $data_match['isMatchClosed'] == 0):
                    ?>
                        <h5 class="center-align"><?php echo $data_match['matchName'];?></h5><br>
                        <h6 class="center-align"><strong>Data:</strong><?php echo $data_match['matchDate'];?></h6>
                    <?php
                        //Verifies if the match is closed so the plain can't join it, and if the user is not the admin
                            if($_SESSION['is_admin'] != 1 && $data_match['isMatchClosed'] != 1):
                                $sql_user = "SELECT * FROM user WHERE userLogin = '$_SESSION[user_login]'";
                                $result_user = mysqli_query($connect, $sql_user);
                                $data_user = mysqli_fetch_array($result_user);
                                if($data_user['presence'] == 0):
                    ?>  
                                    <form action="../php_action/join-match.php" method="post" class="center-align">
                                        <br><br>
                                        <button type="submit" name="btn-join-match" class="green btn"><i class="left material-icons">assignment_turned_in</i>
                                        Confirmar presença</button>
                                    </form>
                    <?php

                                else:
                    ?>
                                    <form action="../php_action/join-match.php" method="post" class="center-align">
                                        <br><br>
                                        <button type="submit" name="btn-quit-match" class="grey btn"><i class="left material-icons">assignment_turned_in</i>
                                        Retirar presença</button>
                                    </form>
                    <?php
                                endif;
                            endif;
                        else:
                    ?>
                                <div class="center-align">
                                    <br>
                                    <h5 class="center-align">Fase de confirmação encerrada</h5>
                                    <br>
                                    <a href="view-teams.php" class="green btn"><i class="left material-icons">face</i>
                                    Visualizar times formados</a>
                                </div>    
                    <?php
                        endif;
                    ?>                                
                    
                </p>
            </div>
        </div>
    </div>
    <div class="col s12 m6 l4">
        <div class="card large hoverable">
            <div class="card-content">
                <span class="card-title"><h4 class="center-align"> Jogadores Cadastrados:</h4></span>
                <p>
                    <?php
                        $sql_rows = "SELECT * FROM user";
                        $result = mysqli_query($connect, $sql_rows);
                        $rows = mysqli_num_rows($result);
                        //Removing admin from the count
                        $cadastrados = $rows - 1;
                    ?>
                    <br><br>
                    <h3 class="center-align"><strong><?php echo($cadastrados);?></strong></h3><br>
                </p>
            </div>
        </div>
    </div>

    <!-- This session appears just for the admin -->
    <?php
        if($_SESSION['is_admin']):
    ?>
        <div class="center-align">
            <a href="../pages/admin.php" class="btn-large waves-effect waves-light green">Administração</a>
        </div>
    <?php
        endif;
    ?>
