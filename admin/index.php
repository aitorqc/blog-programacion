<?php include '../includes/db.php'; ?>
<?php include './includes/admin_header.php'; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include './includes/admin_navigation.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header pull-left">
                        Panel de Administración:
                    </h1>
                </div>
            </div>

            <?php include './includes/dashboard.php'; ?>
        </div>

    </div>

</div>

<?php include './includes/admin_footer.php'; ?>