<?php

    session_start();

    include_once "../includes/header.php";
    include_once "../php_action/db-connect.php";
    include_once "../includes/navbar.php";
    include_once "../includes/logged-in-check.php";

    //Check if the button was clicked and swith the user status of presence
    if(isset($_POST['btn-presence'])){
        $id = $_POST['id'];
        $sql = "UPDATE user SET presence = 1 WHERE id = '$id'";
        mysqli_query($connect, $sql);
    }
    elseif(isset($_POST['btn-absence'])){
        $id = $_POST['id'];
        $sql = "UPDATE user SET presence = 0 WHERE id = '$id'";
        mysqli_query($connect, $sql);
    }

?>

    <div class="row">
        <!-- Check if there is a match to happen -->
    <?php
        $sql_match = "SELECT * FROM matches";
        $result = mysqli_query($connect, $sql_match);
        $rows = mysqli_num_rows($result);
        if($rows <= 0):
    ?>

        <div class="col s6" id="createMatch">
                <h2 class="left-align">Cadastro de Partida</h2>
                <form action="../php_action/create-match.php" method="post">
                    <div class="input-field col s12">
                        <input type="text" name="matchName" id="matchName" required>
                        <label class="active" for="matchName">Nome da partida</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="date" name="matchDate" id="matchDate" required>
                        <label class="active" for="matchDate">Data da partida</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="number" name="matchSize" id="matchSize" required>
                        <label for="matchSize">Número de jogadores em cada equipe</label>
                    </div>
                    <div class="center-align">
                        <button type="submit" name="btn-match" class="center green btn"><i class="left material-icons">add_box</i>Criar partida</button>
                    </div>
                </form>
        </div>
    <?php
        else:
    ?>
        <div class="col s6" id="createMatch">  
        <h2>Proxima partida</h2>
            <?php
                $data = mysqli_fetch_array($result);
                $matchName = $data['matchName'];
                $matchDate = $data['matchDate'];
                $matchSize = $data['matchSize'];
            ?>
            <h5><strong>Partida:</strong>  <?php echo($matchName);?></h5>
            <br><br>
            <h5><strong>Data:</strong>  <?php echo($matchDate);?></h5>
            <br><br>
            <h5><strong>Jogares por equipe:</strong>  <?php echo($matchSize);?></h5>
            <br><br>
            <div class="left-align">
                <form action="../php_action/delete-match.php" method="POST">
                    <input type="hidden" name="matchId" value="<?php echo($data['id']);?>">
                    <button type="submit" name="btn-delete-match" class="center red btn"><i class="left material-icons">delete</i>Deletar partida</button>
                </form>
            </div>
            <div class="center-align">
                <a href="menage-teams.php" class="green btn">Sortear times</a>
            </div>
        </div>
    <?php
        endif;
    ?>

      <div class="col s6">
            <h2 class="center-align">Jogadores Cadastrados</h2>
            <div class="row">
                <table class="centered striped">
                    <thead>
                        <tr>
                            <th>Presença</th>
                            <th>Nome</th>
                            <th>Posição</th>
                            <th>Habilidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql_rows = "SELECT * FROM user";
                            $result = mysqli_query($connect, $sql_rows);
                            while($data = mysqli_fetch_assoc($result)):
                                if($data['is_admin'] != 1):
                        ?>

                            <tr>
                                <!-- button to confirm or removes the users presence at the match -->
                                <td>
                                    <?php
                                        if($data['presence'] == 1):
                                    ?>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                            <button type="submit" name="btn-absence"class="green btn"><i class="material-icons">done</i></button>
                                        </form>
                                    <?php
                                        else:
                                    ?>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                            <button type="submit" name="btn-presence"class="grey btn"><i class="material-icons">done</i></button>
                                        </form>
                                    <?php
                                        endif;
                                    ?>
                                </td>
                                <td><?php echo($data['userName']);?></td>
                                <td><?php if($data['goalkeeper'] == 1):?>
                                    Goleiro
                                    <?php else:?>
                                    Jogador de linha
                                    <?php endif;?>
                                </td>
                                <td><?php echo($data['userLevel']);?></td>
                            </tr>
                        <?php
                                endif; 
                            endwhile;
                        ?>
                    </tbody>
                </table>
            </div>
      </div>
    </div>