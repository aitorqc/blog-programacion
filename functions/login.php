<?php
function user_login()
{
    global $connection;

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT user_password FROM users WHERE username='{$username}'";
        $select_hashed_password_query = mysqli_query($connection, $query);

        if ($select_hashed_password_query) {
            $row = mysqli_fetch_assoc($select_hashed_password_query);
            $stored_hashed_password = $row['user_password'];

            if (password_verify($password, $stored_hashed_password)) {
                $query = "SELECT * FROM users WHERE username='{$username}'";
                $select_user_query = mysqli_query($connection, $query);
            } else {
                return "Incorrect username or password";
            }

            if (isset($select_user_query) && mysqli_num_rows($select_user_query) > 0) {
                while ($row = mysqli_fetch_assoc($select_user_query)) {
                    $_SESSION['id'] = $row['user_id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['user_email'];
                    $_SESSION['user_role'] = $row['user_role'];
                }

                $session = session_id();
                $time = time();
                $time = date('Y-m-d H:i:s');
                insert_user_online($session, $time);

                header("Location: /cms/admin/index.php");
                ob_end_flush(); // Enviar los datos almacenados en búfer después de la cabecera de redirección
                exit();
            }
        } else {
            return "Incorrect username or password";
        }
    }
}


function insert_user_online($session, $time)
{
    global $connection;

    mysqli_query($connection, "INSERT INTO users_online(session, time, last_activity) VALUES('$session', '$time', '$time')");
}
