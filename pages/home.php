<?php

    session_start();

    include_once "../includes/header.php";
    include_once "../php_action/db-connect.php";


?>

<nav>
    <div class="nav-wrapper green">
      <a href="#!" class="brand-logo center"><i class="large material-icons">code</i>Dev-Society</a>
      <ul class="right hide-on-med-and-down">
        <li><i class="material-icons">person</i></li>
        <li><h5><?php echo($_SESSION['user_login']);?></h5><li>
      </ul>
    </div>
</nav>

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
                        if($rows <= 0):
                    ?>
                        <h5 class="center-align">Nenhum jogo disponível</h5>
                    <?php 
                        else:
                            $data = mysqli_fetch_array($result);
                    ?>
                        <h5 class="center-align"><?php echo $data['matchName'];?></h5><br>
                        <h6 class="center-align"><strong>Data:</strong><?php echo $data['matchDate'];?></h6>
                    <?php
                            if($_SESSION['is_admin'] != 1):
                                $sql_user = "SELECT * FROM user WHERE userLogin = '$_SESSION[user_login]'";
                                $result_user = mysqli_query($connect, $sql_user);
                                $data = mysqli_fetch_array($result_user);
                                if($data['presence'] == 0):
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

</div>