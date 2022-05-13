<?php

    session_start();

    include_once "../includes/header.php";

?>

<nav>
    <div class="nav-wrapper green">
      <a href="#!" class="brand-logo center"><i class="large material-icons">code</i>Dev-Society</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="sass.html"><i class="material-icons">person</i></a></li>
        <li><h5><?php echo($_SESSION['user_login']);?></h5><li>
      </ul>
    </div>
</nav>

<div class="row">
    <div class="col s12 m6 l4">
        <div class="card large hoverable">
            <div class="card-content">
            <span class="card-title"><h4 class="center-align"> Sua habilidade:</h4></span>
            <p>
                
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
</div>