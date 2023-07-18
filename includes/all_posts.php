<?php
$query = 'SELECT * FROM posts';
$select_all_posts_query = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = (substr($row['post_content'], 0, 300) . ' [ ... ]');

    $post_status = $row['post_status'];

    if($post_status === "draft"){

    }else{
        echo "
        <h2>
            <a href='index.php?p_id=" . $post_id . "'>" . $post_title . "</a>
        </h2>
        <p class='lead'>
            by <a href='index.php'>" . $post_author . "</a>
        </p>
        <p><span class='glyphicon glyphicon-time'></span> Posted on " . $post_date . "</p>
        <hr>
        <img class='img-responsive' src='images/" . $post_image . "' alt='$post_image'>
        <hr>
        <p>" . $post_content . "</p>
        <a class='btn btn-primary' href='index.php?p_id=" . $post_id . "'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
        <hr>";
    }
}
