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

function num_of_comments()
{
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

function num_of_views()
{
    global $connection;

    $query = "SELECT SUM(post_views_count) AS total_views FROM posts";
    $select_query = mysqli_query($connection, $query);
    if ($select_query) {
        $row = mysqli_fetch_assoc($select_query);
        $total_views = $row["total_views"];
        return $total_views;
    } else {
        return -1;
    }
}

function most_viewed()
{
    global $connection;

    $query = "SELECT post_title FROM posts WHERE post_views_count = (SELECT MAX(post_views_count) FROM posts)";
    $select_query = mysqli_query($connection, $query);
    if ($select_query) {
        $row = mysqli_fetch_assoc($select_query);
        $most_viewed = $row["post_title"];
        return $most_viewed;
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

function check_users_online()
{
    global $connection;

    $users_online_query = mysqli_query($connection, "SELECT * FROM users_online");
    if ($users_online_query) {
        $count_user = mysqli_num_rows($users_online_query);
        return $count_user;
    } else {
        return -1;
    }
}
