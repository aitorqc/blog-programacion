<?php include '../includes/db.php'; ?>
<?php include './includes/admin_header.php'; ?>
<?php include './includes/admin_modal_user_delete.php'; ?>

<!-- functions -->
<?php include './functions/users_functions.php'; ?>

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
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>

                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }

                    switch ($source) {
                        case 'add_user':
                            include './includes/admin_form_add_user.php';
                            break;

                        case 'edit_user':
                            include './includes/admin_form_edit_user.php';
                            break;

                        default:
                            include 'includes/admin_view_all_users.php';
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