<?php include '../includes/db.php'; ?>
<?php include './includes/admin_header.php'; ?>
<?php include './includes/admin_modal_delete.php'; ?>

<!-- functions -->
<?php include './functions.php'; ?>
<?php
$add_error = false;
$cat_title_edit = false;
$update_error = false;
?>

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

                    <div class="col-xs-6">
                        <?php
                        // Add Categorie
                        $add_error = add_categorie();
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                            <?php if ($add_error) {
                                echo "
                            <div class='alert alert-danger' role='alert'>
                                {$add_error}
                            </div>";
                            } ?>
                        </form>

                        <?php
                        // Delete or Update Categories
                        pre_delete_categorie();
                        $cat_title_edit = pre_update_categorie();
                        $update_error = update_categorie();
                        delete_categorie();
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Edit Category</label>
                                <input class="form-control" type="text" name="update_cat_title" value="<?php if (isset($cat_title_edit)) {
                                                                                                            echo $cat_title_edit;
                                                                                                        }; ?>" <?php echo isset($cat_title_edit) && $cat_title_edit ? '' : 'disabled'; ?>>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Edit Category" value="<?php if (isset($cat_title_edit)) {
                                                                                                                            echo $cat_title_edit;
                                                                                                                        }; ?>" <?php echo isset($cat_title_edit) && $cat_title_edit ? '' : 'disabled'; ?>>
                            </div>
                            <?php if ($update_error) {
                                echo "
                            <div class='alert alert-danger' role='alert'>
                                {$update_error}
                            </div>";
                            } ?>
                        </form>
                    </div>

                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                show_categories();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /#wrapper -->

<?php include './includes/admin_footer.php'; ?>