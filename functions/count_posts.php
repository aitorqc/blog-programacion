<?php
function count_posts()
{
    global $connection;

    $post_query_count = "SELECT * FROM posts WHERE post_status='published'";
    $find_count = mysqli_query($connection, $post_query_count);
    $count = mysqli_num_rows($find_count);

    return $count;
}

function count_posts_by_author($author)
{
    global $connection;

    $post_query_count = "SELECT * FROM posts WHERE post_author='$author' AND post_status='published'";
    $find_count = mysqli_query($connection, $post_query_count);
    $count = mysqli_num_rows($find_count);

    return $count;
}

function count_posts_by_category($category_id)
{
    global $connection;

    $post_query_count = "SELECT * FROM posts WHERE post_category_id LIKE '%$category_id%' AND post_status='published'";
    $find_count = mysqli_query($connection, $post_query_count);
    $count = mysqli_num_rows($find_count);

    return $count;
}

function count_posts_by_tag($search_term)
{
    global $connection;

    $post_query_count = "SELECT * FROM posts WHERE post_tags LIKE '%$search_term%' AND post_status='published'";
    $find_count = mysqli_query($connection, $post_query_count);
    $count = mysqli_num_rows($find_count);

    return $count;
}
