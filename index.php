<?php include './includes/db.php'; ?>
<?php include './includes/header.php'; ?>
<!-- Navigation -->
<?php include './includes/navigation.php'; ?>

<!-- Page Content -->
<div class="container">
    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Cabecera
            </h1>

            <!-- Blog Posts -->
            <?php include './functions/resume_content_post.php'; ?>
            <?php include './functions/count_posts.php'; ?>
            <?php
            if (isset($_GET['search_term'])) {
                include './views/tags_posts.php';
            } else if (isset($_GET['category'])) {
                include './views/category_posts.php';
            } else if (isset($_GET['p_id'])) {
                include './views/individual_post.php';
                include './includes/comments.php';
                include './includes/sidebar.php';
            } else if (isset($_GET['author'])) {
                include './views/author_posts.php';
            } else {
                include './views/all_posts.php';
            }
            ?>

        </div>

        <?php (isset($_GET['p_id'])) ? "" : include './includes/sidebar.php'; ?>

        <hr>

    </div>
</div>

<!-- Footer -->
<?php include './includes/footer.php'; ?>