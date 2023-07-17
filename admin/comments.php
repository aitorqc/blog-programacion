<?php include '../includes/db.php'; ?>
<?php include './includes/admin_header.php'; ?>
<?php include './includes/admin_modal_comment_delete.php'; ?>

<!-- functions -->
<?php include './functions/comments_functions.php'; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include './includes/admin_navigation.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
                    </h1>

                    <?php
                    pre_delete_comment();
                    delete_comment();

                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }

                    switch ($source) {
                        case 'edit_comment':
                            include './includes/admin_form_edit.comments.php';
                            break;

                        default:
                            include './includes/admin_view_all_comments.php';
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