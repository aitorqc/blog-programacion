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
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- Blog Posts -->
            <?php
            if (isset($_GET['search_term'])) {
                include './includes/tags_posts.php';
            } else if (isset($_GET['category'])) {
                include './includes/category_posts.php';
            } else if (isset($_GET['p_id'])) {
                include './includes/individual_post.php';
                include './includes/comments.php';
                include './includes/sidebar.php';
            } else {
                include './includes/all_posts.php';
            }
            ?>

            <?php (isset($_GET['p_id'])) ? "" : include './includes/pager.php'; ?>
        </div>

        <?php (isset($_GET['p_id'])) ? "" : include './includes/sidebar.php'; ?>

        <hr>

    </div>
</div>


<!-- Footer -->
<?php include './includes/footer.php'; ?>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>