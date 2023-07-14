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
        <td>{$post_title}</td>
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
