<?php
$post_id = $_REQUEST['p_id'];

$query = "SELECT * FROM posts WHERE post_id={$post_id}";
$select_post_query = mysqli_query($connection, $query);

if (!$select_post_query) {
    die("QUERY FAILED" . mysqli_error($connection));
}

$count = mysqli_num_rows($select_post_query);

if ($count == 0) {
    echo "<h1> No se han encontrado resultados </h1>";
} else {

    while ($row = mysqli_fetch_assoc($select_post_query)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
?>
        <h2>
            <?php echo $post_title; ?>
        </h2>
        <p class="lead">
            Creador <a href='index.php?author=<?php echo $post_author; ?>'><?php echo $post_author; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Con Fecha: <?php echo $post_date; ?></p>
        <hr>
        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="<?php echo $post_image; ?>">
        <hr>
        <p><?php echo $post_content; ?></p>

        <hr>

    <?php
    }
    ?>
<?php
    $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id={$post_id}";
    $update_post_views = mysqli_query($connection, $query);
}
?>