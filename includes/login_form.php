<div class="well">
    <h4>Iniciar Sesión</h4>
    <form action="" method="post">
        <div class="form-group">
            <input name="username" type="text" class="form-control" placeholder="Nombre de Usuario" autocomplete="username">
        </div>
        <div class="form-group">
            <div class="input-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" autocomplete="current-password">
                <span class="input-group-addon" onclick="checkPassword()">
                    <span id="password_icon" class="glyphicon glyphicon-eye-open"></span>
                </span>
                <script>
                    function checkPassword() {
                        let x = document.getElementById("password");
                        let icon = document.getElementById("password_icon");

                        if (x.type === "password") {
                            x.type = "text";
                            icon.classList.remove("glyphicon-eye-open");
                            icon.classList.add("glyphicon-eye-close");
                        } else {
                            x.type = "password";
                            icon.classList.remove("glyphicon-eye-close");
                            icon.classList.add("glyphicon-eye-open");
                        }
                    }
                </script>
            </div>
        </div>
        <div class="form-group">
            <a href="/cms/forgot.php">Has olvidado tu contraseña?</a>
        </div>
        <?php
        if ($error) {
            echo "
            <div class='alert alert-danger' role='alert'>
                {$error}
            </div>";
        }
        ?>
        <div class="form-group">
            <button class="btn btn-primary" name="login" type="submit">Iniciar Sesión</button>
        </div>
    </form>
</div>