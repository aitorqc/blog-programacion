<?php include '../../includes/db.php'; ?>
<?php
session_start();

global $connection;

$session = session_id();
$current_time = time();
$current_time = date('Y-m-d H:i:s');

$query = "UPDATE users_online SET last_activity = '$current_time' WHERE session = '$session'";

if (mysqli_query($connection, $query)) {
    // Si la consulta se ejecutó correctamente, devolver el valor "hola"
    // Agregar un registro en un archivo de registro (por ejemplo, error_log)
    error_log("Campo last_activity actualizado correctamente para el usuario $session");
} else {
    // Si hubo un error en la consulta, devolver un mensaje de error
    echo "Error al actualizar el campo last_activity para el usuario $session: " . mysqli_error($connection);
    // Agregar un registro en un archivo de registro (por ejemplo, error_log)
    error_log("Error al actualizar el campo last_activity para el usuario $session: " . mysqli_error($connection));
}
