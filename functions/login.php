<?php
function user_login()
{
    global $connection;

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE username='{$username}' AND user_password='{$password}'";

        $select_user_query = mysqli_query($connection, $query);

        if (isset($select_user_query) && mysqli_num_rows($select_user_query) > 0) {
            while ($row = mysqli_fetch_assoc($select_user_query)) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['firstname'] = $row['user_firstname'];
                $_SESSION['lastname'] = $row['user_lastname'];
                $_SESSION['user_role'] = $row['user_role'];
            }
           

            header("Location: ./admin/index.php");
            ob_end_flush(); // Enviar los datos almacenados en búfer después de la cabecera de redirección
            exit();
        } else {
            return "Something went wrong";
        }
    }
}
