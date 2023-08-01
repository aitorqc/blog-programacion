<?php
$error = add_user();
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Nombre de Usuario</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>

    <div class="form-group">
        <label for="user_password">Contraseña</label>
        <div class="input-group">
            <input type="password" class="form-control" name="user_password" id="user_password">
            <span class="input-group-addon" onclick="checkPassword()">
                <span id="password_icon" class="glyphicon glyphicon-eye-open"></span>
            </span>
            <script>
                function checkPassword() {
                    let x = document.getElementById("user_password");
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
        <label for="user_firstname">Nombre</label>
        <input type="text" class="form-control" name="user_firstname" id="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Apellidos</label>
        <input type="text" class="form-control" name="user_lastname" id="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" id="user_email">
    </div>

    <div class="form-group">
        <label for="user_image">Avatar</label>
        <input type="file" name="user_image" id="user_image">
    </div>

    <div class="form-group">
        <label for="user_role">Role</label>
        <select name="user_role" id="user_role">
            <option value="user">Usuario</option>
            <option value="admin">Administrador</option>
        </select>
    </div>

    <?php if ($error) {
        echo "
        <div class='alert alert-danger' role='alert'>
            {$error}
        </div>";
    } ?>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Crear">
    </div>
</form>