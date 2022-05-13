<?php

    include_once "../includes/header.php";
    include_once "../php_action/db-connect.php";

?>

    <div class="row">
        <div class="container">
            <div class="center-align">
                <h1>Registrar-se</h1>
                
                <!-- Send to the back end the login data inserted by the user on the form -->
                <form action="../php_action/create-register.php" method="POST" class=" col s12 z-depth-6 card-panel">
                    <br>
                    <div class="input-field col s12">
                        <input type="text" name="login" id="login" required>
                        <label class="active" for="username">Usuário</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="login_check" id="login_check" required>
                        <label class="active" for="login_check">Repetir usuário</label>
                    </div>

                    <div class="input-field col s12">
                        <input type="password" name="password" id="password" required>
                        <label class="active" for="password">Senha</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="password" name="password_check" id="password_check" required>
                        <label class="active" for="password_check">Repetir senha</label>
                    </div>

                    <div class="input-field col s12">
                        <input type="text" name="name" id="name" required>
                        <label class="active" for="name">Insira seu nome</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="number" name="level" id="level" min="0" max="5" size="1" maxlength="1" required>
                        <label class="active" for="level">Insira seu nível de habilidade de (0 a 5)</label>
                    </div>
                    <div class="input-field col s12">
                        <h5>Você é goleiro?</h5>   
                        <div class="switch"> 
                            <label>
                                Não
                                <input type="checkbox" name="is_goalkeeper" id="is_goalkeeper">
                                <span class="lever"></span>
                                Sim
                            </label>
                        </div>
                    </div>
                    <button type="submit" name="btn-register" class="btn black left">Criar registro<i class="left material-icons">check</i></button>
                </form>

            </div>

        </div>
    </div>

    <br><br><br>
    <div class="center-align">
        <a href="../index.php" class="btn black">Página principal</a>
    </div>
    <br><br><br>

<?php

    include "../includes/footer.php";

?>