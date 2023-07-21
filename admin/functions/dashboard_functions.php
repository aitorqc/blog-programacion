<?php
// Count Posts
function num_of_posts()
{
    global $connection;

    $query = "SELECT COUNT(*) AS total_posts FROM posts";
    $select_query = mysqli_query($connection, $query);
    if ($select_query) {
        $row = mysqli_fetch_assoc($select_query);
        // Acceder al valor del conteo de posts
        $total_posts = $row["total_posts"];
        return $total_posts;
    } else {
        return -1;
    }
}

// Count Categories
function num_of_categories()
{
    global $connection;

    $query = "SELECT COUNT(*) AS total_categories FROM categories";
    $select_query = mysqli_query($connection, $query);
    if ($select_query) {
        $row = mysqli_fetch_assoc($select_query);
        $total_categories = $row["total_categories"];
        return $total_categories;
    } else {
        return -1;
    }
}

// Count Users
function num_of_users()
{
    global $connection;

    $query = "SELECT COUNT(*) AS total_users FROM users";
    $select_query = mysqli_query($connection, $query);
    if ($select_query) {
        $row = mysqli_fetch_assoc($select_query);
        $total_users = $row["total_users"];
        return $total_users;
    } else {
        return -1;
    }
}

function num_of_comments(){
    global $connection;

    $query = "SELECT COUNT(*) AS total_comments FROM comments WHERE comment_approve='1'";
    $select_query = mysqli_query($connection, $query);
    if ($select_query) {
        $row = mysqli_fetch_assoc($select_query);
        $total_comments = $row["total_comments"];
        return $total_comments;
    } else {
        return -1;
    }
}
