<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "functions/registration.php"; ?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-center">
                                <div class="form-wrap">
                                    <h1 style="margin-bottom: 2.5rem;">Registrarse</h1>
                                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="username">Nombre de usuario</label>
                                            <input type="text" name="username" id="username" class="form-control" placeholder="Nombre de Usuario">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_firstname">Nombre</label>
                                            <input type="text" class="form-control" name="user_firstname" id="user_firstname" placeholder="Nombre">
                                        </div>

                                        <div class="form-group">
                                            <label for="user_lastname">Apellidos</label>
                                            <input type="text" class="form-control" name="user_lastname" id="user_lastname" placeholder="Apellidos">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_email">Email</label>
                                            <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Correo@ejemplo.com" autocomplete="username">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_password">Contraseña</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Contraseña" autocomplete="current-password">
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
                                        <div class="form-group" style="margin: 3rem 0;">
                                            <label for="user_image">Seleccionar Imagen</label>
                                            <input type="file" name="user_image" id="user_image">
                                        </div>
                                        <?php
                                        $error = registration();
                                        if ($error) {
                                            echo "
                                <div class='alert alert-danger' role='alert'>
                                    {$error}
                                </div>";
                                        }
                                        ?>
                                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Registrarse">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>