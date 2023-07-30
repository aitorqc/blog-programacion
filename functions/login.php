<?php
function user_login()
{
    global $connection;

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT user_randSalt FROM users";
        $select_randSalt_query = mysqli_query($connection, $query);

        if (!$select_randSalt_query) {
            die("QUERY FAILED" . mysqli_error($connection));
        } else {
            while ($row = mysqli_fetch_array($select_randSalt_query)) {
                $salt = $row['user_randSalt'];
            }
            $password = crypt($password, $salt);

            $query = "SELECT * FROM users WHERE username='{$username}' AND user_password='{$password}'";
            $select_user_query = mysqli_query($connection, $query);
        }

        if (isset($select_user_query) && mysqli_num_rows($select_user_query) > 0) {
            while ($row = mysqli_fetch_assoc($select_user_query)) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['firstname'] = $row['user_firstname'];
                $_SESSION['lastname'] = $row['user_lastname'];
                $_SESSION['email'] = $row['user_email'];
                $_SESSION['user_role'] = $row['user_role'];
            }

            $session = session_id();
            $time = time();
            $time = date('Y-m-d H:i:s');
            insert_user_online($session, $time);

            header("Location: ./admin/index.php");
            ob_end_flush(); // Enviar los datos almacenados en búfer después de la cabecera de redirección
            exit();
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