<?php

// Show Users
function show_users()
{
    global $connection;

    $query = 'SELECT * FROM users';
    $select_users = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $user_randSalt = $row['user_randSalt'];

        $password = str_repeat("*", strlen($user_password));

        echo "<tr>
        <td>{$user_id}</td>
        <td>{$username}</td>
        <td>{$password}</td>
        <td>{$user_firstname}</td>
        <td>{$user_lastname}</td>
        <td>{$user_email}</td>
        <td>{$user_image}</td>
        <td>{$user_role}</td>
        <td>{$user_randSalt}</td>
        <td><a href='users.php?delete=$user_id'>Delete</a></td>
        <td>" . (($user_role === "admin") ? "<a href='users.php?source=edit_user&u_id=$user_id'>Edit</a>" : "No Editable") . "</td>
        </tr>";
    }
}

// Add User
function add_user()
{
    global $connection;

    if (isset($_POST['create_user'])) {

        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp   = $_FILES['user_image']['tmp_name'];
        $user_role = $_POST['user_role'];

        $username = strtolower($username);
        $user_firstname = strtolower($user_firstname);
        $user_lastname = strtolower($user_lastname);
        $user_role = strtolower($user_role);

        move_uploaded_file($user_image_temp, "../images/users_avatars/$user_image");

        $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) 
        VALUES('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_image}', '{$user_role}') ";

        $create_user_query = mysqli_query($connection, $query);

        if (!$create_user_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        } else {
            header("location: users.php");
        }
    }
}

// Update User
function update_user($the_user_id)
{
    global $connection;

    if (isset($_POST['update_user'])) {

        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp   = $_FILES['user_image']['tmp_name'];
        $user_role = $_POST['user_role'];

        $username = strtolower($username);
        $user_firstname = strtolower($user_firstname);
        $user_lastname = strtolower($user_lastname);
        $user_role = strtolower($user_role);

        if (empty($user_image)) {
            $user_image = check_image($the_user_id);
        }else{
            move_uploaded_file($user_image_temp, "../images/users_avatars/$user_image");
        }

        $query = "UPDATE users SET ";
        $query .= "username  = '{$username}', ";
        $query .= "user_password = '{$user_password}', ";
        $query .= "user_firstname   =  '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_image   = '{$user_image}', ";
        $query .= "user_role= '{$user_role}' ";
        $query .= "WHERE user_id = {$the_user_id} ";

        $update_user_query = mysqli_query($connection, $query);

        if (!$update_user_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        } else {
            header("location: users.php");
        }
    } else if (isset($_POST['cancel_update_user'])) {
        header("location: ./users.php");
    }
}

// Check Image
function check_image($the_user_id)
{
    global $connection;

    $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
    $select_image = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($select_image)) {
        return $user_image = $row['user_image'];
    }
}
