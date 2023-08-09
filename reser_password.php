<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $token = $_GET['token']; // Usar GET para obtener el token de la URL

    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar que las contraseñas coincidan
    if ($new_password === $confirm_password) {

        // Verificar el token y el tiempo de expiración
        $query = "SELECT user_id FROM password_recover WHERE token = ? AND expiration > NOW()";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 's', $token);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) === 1) {
            mysqli_stmt_bind_result($stmt, $user_id);
            mysqli_stmt_fetch($stmt);

            // Actualizar la contraseña del usuario
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_query = "UPDATE users SET user_password = ? WHERE user_id = ?";
            $update_stmt = mysqli_prepare($connection, $update_query);
            mysqli_stmt_bind_param($update_stmt, 'si', $hashed_password, $user_id);
            mysqli_stmt_execute($update_stmt);

            // Eliminar el registro de recuperación de contraseña
            $delete_query = "DELETE FROM password_recover WHERE token = ?";
            $delete_stmt = mysqli_prepare($connection, $delete_query);
            mysqli_stmt_bind_param($delete_stmt, 's', $token);
            mysqli_stmt_execute($delete_stmt);

            $success = 'Contraseña actualizada exitosamente';
        } else {
            $error = 'Token inválido o expirado';
        }
    } else {
        $error = 'Las contraseñas no coinciden';
    }
}
?>

<div class="container">
    <div class="row vertical-center">
        <div class="col-md-4 col-md-offset-4">
            <h2 class="text-center">Recuperar Contraseña</h2>
            <form method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-md-3" for="new_password">Nueva Contraseña:</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="new_password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3" for="confirm_password">Confirmar Contraseña:</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="confirm_password" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
                    </div>
                </div>
                <div id="success-message" class="alert alert-<?php echo empty($success) ? "danger" : "success" ?>" role="alert" style="<?php echo (empty($success) && empty($error)) ? 'display:none;' : ''; ?>">
                    <?php echo empty($success) ? $error : $success; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Centra el contenido verticalmente */
    .vertical-center {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<?php include "includes/footer.php"; ?>