<?php
// process_recovery_pass.php

// ... Código PHP para establecer la conexión a la base de datos ...

// Inicializamos el arreglo de respuesta
$response = array();

if (isset($_POST['recover_submit'])) {
    if (isset($_POST['email'])) {
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
                // Éxito en la inserción
                $response['success'] = true;
                $response['message'] = "Recibirás un correo con los pasos para restablecer la contraseña";
            } else {
                // Error en la inserción
                $response['success'] = false;
                $response['message'] = "Error al insertar los datos en la base de datos.";
            }

            mysqli_stmt_close($stmt_insert);
        } else {
            // Error: Usuario no encontrado
            $response['success'] = false;
            $response['message'] = "El email no corresponde a ningún usuario registrado.";
        }
    }
} else {
    // Error: No se envió el formulario correctamente
    $response['success'] = false;
    $response['message'] = "Error al enviar el formulario.";
}

// Enviamos la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);

var_dump($response);
?>
