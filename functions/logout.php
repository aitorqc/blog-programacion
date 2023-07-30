<?php include '../includes/db.php'; ?>
<?php
session_start();

if ($_SESSION['username']) {
    global $connection;

    $session = session_id();
    // Eliminar usuario online
    mysqli_query($connection, "DELETE FROM users_online WHERE session='$session'");

    // Eliminar datos de sesion
    $_SESSION['username'] = null;
    $_SESSION['firstname'] = null;
    $_SESSION['lastname'] = null;
    $_SESSION['user_role'] = null;

    header('Location: ../index.php');
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
