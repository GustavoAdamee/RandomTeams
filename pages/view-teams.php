<?php

    session_start();

    include_once "../includes/header.php";
    include_once "../includes/navbar.php";
    include_once "../php_action/db-connect.php";
    include_once "../includes/logged-in-check.php";

?>

    <div>
        <h2 class="center-align">Times formados</h2>
    </div>

    <div class="row">

<!-- while loop showing all the teams and their players -->
<?php
    $sql_match_teams = "SELECT * FROM matches";
    $result_match = mysqli_query($connect, $sql_match_teams);
    $data_match = mysqli_fetch_array($result_match);

    $sql_user = "SELECT * FROM user WHERE NOT is_admin = 1 AND presence = 1";
    $result_user = mysqli_query($connect, $sql_user);
    $total_players = mysqli_num_rows($result_user);

    $total_teams = ceil( $total_players / $data_match['matchSize']);

    for($i = 0; $i < $total_teams; $i++):
?>
        <div class="col s12 m6 l4">
            <div class="card large hoverable">
                <div class="card-content">
                    <span class="card-title"><h4 class="center-align"> Time <?php echo $i+1 ?>:</h4></span>
        
<?php
        $sql_user = "SELECT * FROM user";
        $result_user = mysqli_query($connect, $sql_user);
        while($data_user = mysqli_fetch_array($result_user)):
            if($data_user["is_admin"] != 1 && $data_user["presence"] == 1 && $data_user["userTeam"] == $i):
?>
                    <p class="center-align"><?php echo $data_user['userName']; ?></p>
<?php
            endif;
        endwhile;
?>

                </div>
            </div>
        </div>

<?php
    endfor;
?>
    </div>

<?php

    include_once "../includes/footer.php";

?>
