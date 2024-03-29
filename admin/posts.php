<?php include '../includes/db.php'; ?>
<?php include './includes/admin_header.php'; ?>
<?php include './includes/admin_modal_post_delete.php'; ?>

<!-- functions -->
<?php include './functions/posts_functions.php'; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include './includes/admin_navigation.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <h1 class="page-header pull-left">
                            Posts:
                        </h1>
                    </div>

                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }

                    switch ($source) {
                        case 'add_post':
                            include './includes/admin_form_add_post.php';
                            break;

                        case 'edit_post':
                            include './includes/admin_form_edit_post.php';
                            break;

                        default:
                            include 'includes/admin_view_all_posts.php';
                            break;
                    }
                    ?>

                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include './includes/admin_footer.php'; ?>