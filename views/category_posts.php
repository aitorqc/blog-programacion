<?php
$category_id = $_REQUEST['category'];
$count_posts = count_posts_by_category($category_id);

if ($count_posts) {
    $records_per_page = 4;
    $pages = ceil($count_posts / $records_per_page);
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($current_page - 1) * $records_per_page;

    $query = "SELECT * FROM posts WHERE post_category_id LIKE '%$category_id%' AND post_status='published' LIMIT $start, $records_per_page";
    $search_query = mysqli_query($connection, $query);

    if (!$search_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($search_query)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = first_paragraph($row['post_content']);

        $post_status = $row['post_status'];

        if ($post_status === "draft") {
        } else {
?>
            <h2>
                <a href='index.php?p_id=<?php echo $post_id; ?>'><?php echo $post_title; ?></a>
            </h2>
            <p class='lead'>
                by <a href='index.php?author=<?php echo $post_author; ?>'><?php echo $post_author; ?></a>
            </p>
            <p><span class='glyphicon glyphicon-time'></span> Posted on <?php echo $post_date; ?></p>
            <hr>
            <img class='img-responsive' src="images/<?php echo $post_image; ?>" alt='$post_image'>
            <hr>
            <p><?php echo $post_content . " [ ... ]"; ?></p>
            <div class='btn-group' role='group' aria-label='Botones'>
                <a class='btn btn-primary' href='index.php?p_id=<?php echo $post_id; ?>'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
                <?php
                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                    echo "<a class='btn btn-primary' href='admin/posts.php?source=edit_post&p_id=$post_id'>Edit <span class='glyphicon glyphicon-cog'></span></a>";
                } else {
                }
                ?>
            </div>
            <hr>
<?php
        }
    }
    mysqli_free_result($search_query);
    include './includes/pager.php';
} else {
    echo "<h1> No Result </h1>";
}
?>
<style>
    .btn-group .btn {
        margin-right: 6px;
    }
</style>