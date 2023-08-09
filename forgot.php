<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>

<?php

if (isset($_SESSION['username'])) {
    header("Location: /cms/");
    exit();
}

if (isset($_POST['recover_submit'])) {
    if (isset($_POST['email']) && strlen($_POST['email']) > 0) {
        $email = $_POST['email'];
        $token = bin2hex(openssl_random_pseudo_bytes(50));
        $time = date('Y-m-d H:i:s', strtotime('+24 hours'));

        $query = "SELECT user_id FROM users WHERE user_email = ?";
        $stmt = mysqli_prepare($connection, $query);
        // s -> string (para el email)
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $user_id);
        // Obtenemos el resultado
        mysqli_stmt_fetch($stmt);
        // Cerramos la declaración
        mysqli_stmt_close($stmt);

        if ($user_id) {
            $query = "INSERT INTO password_recover (user_id, token, expiration) VALUES (?, ?, ?)";
            $stmt_insert = mysqli_prepare($connection, $query);

            mysqli_stmt_bind_param($stmt_insert, 'iss', $user_id, $token, $time);

            // Ejecutamos la consulta de inserción
            mysqli_stmt_execute($stmt_insert);

            if (mysqli_stmt_affected_rows($stmt_insert) > 0) {
                $to = $email;
                $subject = 'Recuperación de Contraseña';
                $message = '
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Recuperación de Contraseña</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                        }
                        .container {
                            max-width: 600px;
                            margin: 0 auto;
                            padding: 20px;
                            border: 1px solid #ccc;
                            border-radius: 5px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        }
                        .button {
                            display: inline-block;
                            padding: 10px 20px;
                            background-color: #007bff;
                            color: #fff;
                            text-decoration: none;
                            border-radius: 5px;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h2>Recuperación de Contraseña</h2>
                        <p>Hola,</p>
                        <p>Recibes este correo porque has solicitado restablecer tu contraseña. Haz clic en el botón a continuación para continuar:</p>
                        <a class="button" href="https://blogaboutprogramming.online/reset_password.php?token=' . $token . '">Restablecer Contraseña</a>
                        <p>Si no has solicitado restablecer tu contraseña, puedes ignorar este correo.</p>
                        <p>Saludos,</p>
                        <p>Equipo de Soporte</p>
                    </div>
                </body>
                </html>
                ';
                
                $headers = 'From: soporte@blogaboutprogramming.online' . "\r\n" .
                    'Reply-To: soporte@blogaboutprogramming.online' . "\r\n" .
                    'Content-type: text/html; charset=UTF-8' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                $mailSent = mail($to, $subject, $message, $headers);

                if ($mailSent) {
                    $success = "Recibirás un correo con los pasos para restablecer la contraseña";
                } else {
                    $error = "El correo electrónico no se ha podido enviar";
                }

                mysqli_stmt_close($stmt_insert);
            }
        } else {
            $error = "El correo electrónico no se encuentra en nuestra base de datos";
        }
    } else {
        $error = "Introduce un correo electrónico";
    }
}
?>

<!-- Page Content -->
<div class="container-fluid" style="height: 80vh;">
    <div class="row centered">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">

                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Forgot Password?</h2>
                        <p>You can reset your password here.</p>
                        <div class="panel-body">

                            <form role="form" autocomplete="off" class="form" method="post" action="">

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                        <input id="email" name="email" placeholder="email address" class="form-control" type="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="recover_submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                </div>

                                <input type="hidden" class="hide" name="token" id="token" value="">

                                <div id="success-message" class="alert alert-<?php echo empty($success) ? "danger" : "success" ?>" role="alert" style="<?php echo (empty($success) && empty($error)) ? 'display:none;' : ''; ?>">
                                    <?php echo empty($success) ? $error : $success; ?>
                                </div>
                            </form>

                        </div>
                        <!-- Body-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        height: 100vh;
    }

    .centered {
        height: 100%;
        display: flex;
        align-items: center;
    }
</style>

<hr>

<?php include "includes/footer.php"; ?>