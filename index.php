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
            <?php include './includes/all_posts.php'; ?>

            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <!-- Sidebar -->
        <?php include './includes/sidebar.php'; ?>

    </div>

    <hr>

    <!-- Footer -->
    <?php include './includes/footer.php'; ?>