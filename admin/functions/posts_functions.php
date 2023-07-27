<?php

// Show Posts
function show_posts()
{
    global $connection;

    $query = 'SELECT * FROM posts';
    $select_posts = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_posts)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comments = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_views = $row['post_views_count'];

        echo
        "<tr>
            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='$post_id'></td>
            <td>{$post_id}</td>
            <td>{$post_author}</td>
            <td><a href='../index.php?p_id=$post_id'>{$post_title}</a></td>
            <td>{$post_category_id}</td>
            <td>{$post_status}</td>
            <td>{$post_image}</td>
            <td>{$post_tags}</td>
            <td>{$post_comments}</td>
            <td>{$post_views}</td>
            <td>{$post_date}</td>
            <td>
                <form action='' method='post'>
                    <input type='hidden' name='delete_post' value='{$post_id}'>
                    <input type='submit' value='Delete'>
                </form>
            </td>
            <td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>
        </tr>";
    }
}

// Add Post
function add_post()
{
    global $connection;

    if (isset($_POST['create_post'])) {

        $post_title        = $_POST['post_title'];
        $post_author       = $_SESSION['username'];
        $post_category_id  = $_POST['post_category'];
        $post_status       = $_POST['post_status'];
        $post_image        = $_FILES['image']['name'];
        $post_image_temp   = $_FILES['image']['tmp_name'];
        $post_tags         = $_POST['post_tags'];
        $post_content      = $_POST['post_content'];
        $post_date         = date('d-m-y');

        $post_author = strtolower($post_author);
        $post_tags = strtolower($post_tags);

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) 
        VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";

        $create_post_query = mysqli_query($connection, $query);

        if (!$create_post_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        } else {
            header("location: posts.php");
        }
    }
}

// Update Post
function update_post($the_post_id)
{
    global $connection;

    if (isset($_POST['update_post'])) {
        $post_title        = $_POST['post_title'];
        $post_author       = $_SESSION['username'];
        $post_category_id  = $_POST['post_category'];
        $post_status       = $_POST['post_status'];
        $post_image        = $_FILES['image']['name'];
        $post_image_temp   = $_FILES['image']['tmp_name'];
        $post_tags         = $_POST['post_tags'];
        $post_content      = $_POST['post_content'];

        $post_author = strtolower($post_author);
        $post_tags = strtolower($post_tags);

        if (empty($post_image)) {
            $post_image = check_image($the_post_id);
        } else {
            move_uploaded_file($post_image_temp, "../images/$post_image");
        }

        $query = "UPDATE posts SET ";
        $query .= "post_title  = '{$post_title}', ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_date   =  now(), ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_tags   = '{$post_tags}', ";
        $query .= "post_content= '{$post_content}', ";
        $query .= "post_image  = '{$post_image}' ";
        $query .= "WHERE post_id = {$the_post_id} ";

        $update_post_query = mysqli_query($connection, $query);

        if (!$update_post_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        } else {
            header("location: posts.php");
        }
    } else if (isset($_POST['cancel_update_post'])) {
        header("location: ./posts.php");
    }
}

// Check Image
function check_image($the_post_id)
{
    global $connection;

    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
    $select_image = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($select_image)) {
        return $post_image = $row['post_image'];
    }
}

// Delete Post
function pre_delete_post()
{
    global $connection;

    if (isset($_REQUEST['delete_post'])) {
        $post_id = $_REQUEST['delete_post'];

        $query = "SELECT * FROM posts WHERE post_id='$post_id'";
        $select_post = mysqli_query($connection, $query);

        if (isset($select_post) && mysqli_num_rows($select_post) > 0) {
            $row = mysqli_fetch_array($select_post);
            $post_title = $row['post_title'];
            echo "<script>
                showPopup('" . $post_title . "'); // Mostrar el popup
                var deleteURL = 'posts.php?confirm_delete={$post_id}';

                // Redirigir a la página de eliminación al hacer clic en 'Eliminar'
                document.querySelector('#popup form').addEventListener('submit', function(event) {
                    event.preventDefault();
                    window.location.href = deleteURL;
                });
            </script>";
        }
    }
}

// Delete Post
function delete_post()
{
    global $connection;

    if (isset($_GET['confirm_delete'])) {
        $the_post_id = $_REQUEST['confirm_delete'];
        $escaped_id = mysqli_real_escape_string($connection, $the_post_id);

        $query = "DELETE FROM posts WHERE post_id='$escaped_id'";
        $delete_post = mysqli_query($connection, $query);

        header("Location: " . 'posts.php');
        exit();
    }
}
