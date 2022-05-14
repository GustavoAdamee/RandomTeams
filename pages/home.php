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
                    <strong>Posição:</strong> <?php if($_SESSION['goalkeeper'] == 1):?>
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
                <p>
                    
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
    <?php
        if($_SESSION['is_admin']):
    ?>
        <div>
            <a href="../pages/admin.php" class="btn-large waves-effect waves-light green">Administração</a>
        </div>
    <?php
        endif;
    ?>
</div>