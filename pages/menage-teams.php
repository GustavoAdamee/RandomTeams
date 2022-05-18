<?php

    session_start();

    include_once "../includes/header.php";
    include_once "../php_action/db-connect.php";
    include_once "../includes/navbar.php";
    include_once "../includes/logged-in-check.php";
    
?>

    <div class="row">

        <div class="col s6">
            <h2 class="center-align">Confirmados</h2>
            
            <table class="centered striped">
                <thead>
                    <tr>
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
                        if($data['is_admin'] != 1 && $data['presence'] == 1):
                ?>
                    <tr>
                        <td><?php echo $data['userName'];?></td>
                        <td>
                            <?php if($data['goalkeeper'] == 1):?>
                            Goleiro
                            <?php else:?>
                            Jogador de linha
                            <?php endif;?>
                        </td>
                        <td> <?php echo $data['userLevel']; ?></td>
                    </tr>
                </tbody>
                <?php
                        endif;
                    endwhile;
                ?>
            </table>
        </div>
        <div class="col s6">
            <form action="../php_action/create-teams.php" method="post">
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <div class="center-align">
                    <button type="submit" name="btn-create-teams"class="black btn-large">Gerar equipes</button>
                </div>
            </form>
        </div>
        

    </div>

<?php

    include_once "../includes/footer.php";

?>