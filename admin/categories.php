<?php include '../includes/db.php'; ?>
<?php include './includes/admin_header.php'; ?>
<?php include './includes/admin_modal_categorie_delete.php'; ?>

<!-- functions -->
<?php include './functions/categories_functions.php'; ?>
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
                    <!-- Page Heading -->
                    <h1 class="page-header">
                        Categorías:
                    </h1>
                </div>

                <div class="col-lg-6">
                    <?php
                    // Add Categorie
                    $add_error = add_categorie();
                    // Delete or Update Categories
                    pre_delete_categorie();
                    delete_categorie();
                    $cat_title_edit = pre_update_categorie();
                    $update_error = update_categorie();
                    ?>
                    <?php include './includes/admin_form_add_categorie.php'; ?>
                    <?php include './includes/admin_form_edit_categorie.php'; ?>
                </div>

                <div class="col-lg-6">
                    <?php include './includes/admin_view_all_categories.php'; ?>
                </div>
            </div>

        </div>
    </div>

</div>

<?php include './includes/admin_footer.php'; ?>