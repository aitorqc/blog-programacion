<?php
function add_like()
{
    if (isset($_POST['liked'])) {
        global $connection;

        $username = htmlspecialchars($_POST['username']);
        $post_id = htmlspecialchars($_POST['post_id']);

        $query = "INSERT INTO likes (username, post_id)
        VALUES (?, ?)";

        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 'si', $username, $post_id);

        if (mysqli_stmt_execute($stmt)) {
            // Todo se ejecutó correctamente, enviar éxito
            echo json_encode(true);
        } else {
            // Hubo un error, enviar error
            echo json_encode(false);
        }
    }
}

function check_like($username, $post_id)
{
    global $connection;

    $username = htmlspecialchars($username);
    $post_id = htmlspecialchars($post_id);

    $query = "SELECT * FROM likes WHERE username=? AND post_id=?";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'si', $username, $post_id);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Verificamos si hay filas en el resultado
    if ($result && mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function get_likes($post_id)
{
    global $connection;

    $query = "SELECT * FROM likes WHERE post_id=?";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $post_id);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_num_rows($result);
    } else {
        return 0;
    }
}
