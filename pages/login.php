<?php

    include_once "../includes/header.php";
    include_once "../php_action/db-connect.php";

?>

    <div class="row">
        <div class="container">
            <div class="center-align">
                <h1>LOGIN</h1>
                
                <!-- Send to the back end the login data inserted by the user on the form -->
                <form action="../php_action/login-verify.php" method="post">
                    <div class="input-field col s12">
                        <input type="text" name="login" id="login" required>
                        <label class="active" for="login">Usuário</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="password" name="password" id="password" required>
                        <label class="active" for="password">Senha</label>
                    </div>
                    <button type="submit" name="btn-login" class="btn black left">Login<i class="left material-icons">check</i></button>
                </form>

            </div>

        </div>
    </div>

    <br><br><br>
    <div class="center-align">
        <a href="../index.php" class="btn black">Página principal</a>
    </div>

<?php

    include "../includes/footer.php";

?>