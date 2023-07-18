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

        echo "<tr>
        <td>{$post_id}</td>
        <td>{$post_author}</td>
        <td><a href='../index.php?p_id=$post_id'>$post_title</a></td>
        <td>{$post_category_id}</td>
        <td>{$post_status}</td>
        <td>{$post_image}</td>
        <td>{$post_tags}</td>
        <td>{$post_comments}</td>
        <td>{$post_date}</td>
        <td><a href='posts.php?delete=$post_id'>Delete</a></td>
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
        $post_author       = $_POST['post_author'];
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
        VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') ";

        $create_post_query = mysqli_query($connection, $query);

        if (!$create_post_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        } else {
            header("location: posts.php");
        }
    }
}

// Update Post
function update_post()
{
    global $connection;

    if (isset($_POST['update_post'])) {
        $post_title        = $_POST['post_title'];
        $post_author       = $_POST['post_author'];
        $post_category_id  = $_POST['post_category'];
        $post_status       = $_POST['post_status'];
        $post_image        = $_FILES['image']['name'];
        $post_image_temp   = $_FILES['image']['tmp_name'];
        $post_tags         = $_POST['post_tags'];
        $post_content      = $_POST['post_content'];

        $post_author = strtolower($post_author);
        $post_tags = strtolower($post_tags);

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if (empty($post_image)) {
            $post_image = check_image($the_post_id);
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

// Delete Post
function delete_post()
{
    global $connection;

    if (isset($_GET['delete'])) {
        $the_post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id={$the_post_id}";

        $delete_query = mysqli_query($connection, $query);

        header("Location: ./posts.php");
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
