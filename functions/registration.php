<?php
// Registration 
function registration()
{
    global $connection;

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_image = isset($_FILES['user_image']['name']) ? $_FILES['user_image']['name'] : null;
        $user_image_temp = isset($_FILES['user_image']['tmp_name']) ? $_FILES['user_image']['tmp_name'] : null;

        if (empty($username) || empty($user_email) || empty($user_password) || empty($user_firstname) || empty($user_lastname)) {
            return "Los campos no pueden estar vacios";
        } else {
            if (check_user($username)) {
                return "El usuario ya está en uso";
            } else {
                $username = htmlspecialchars(($username));
                $user_email = htmlspecialchars(($user_email));
                $user_password = htmlspecialchars(($user_password));
                $user_firstname = htmlspecialchars(($user_firstname));
                $user_lastname = htmlspecialchars(($user_lastname));

                move_uploaded_file($user_image_temp, "../images/users_avatars/$user_image");

                $user_password = password_hash($user_password, PASSWORD_DEFAULT);

                $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) 
                VALUES('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_image}', 'user') ";

                $create_user_query = mysqli_query($connection, $query);

                if (!$create_user_query) {
                    die('QUERY FAILED' . mysqli_error($connection));
                } else {
                    header("location: index.php");
                }
            }
        }
    }
}

// Check User
function check_user($username)
{
    global $connection;

    $query = "SELECT * FROM users WHERE username='$username'";
    $select_user = mysqli_query($connection, $query);

    if (mysqli_num_rows($select_user) > 0) {
        return true;
    } else {
        return false;
    }
}
