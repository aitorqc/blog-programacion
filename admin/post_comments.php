<?php include '../includes/db.php'; ?>
<?php include './includes/admin_header.php'; ?>
<?php include './includes/admin_modal_comment_delete.php'; ?>

<!-- functions -->
<?php include './functions/comments_functions.php'; ?>
<?php include './functions/post_comments_functions.php'; ?>

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
                            Comentarios:
                        </h1>
                    </div>

                    <h3 style="margin-bottom: 2rem;">
                        <?php
                        if (isset($_GET['p_id'])) {
                            $post_id = $_GET['p_id'];

                            $query = "SELECT post_title FROM posts WHERE post_id = $post_id";
                            $result = mysqli_query($connection, $query);

                            if ($result) {
                                // Obtiene el resultado de la consulta como un array asociativo
                                $row = mysqli_fetch_assoc($result);
                                $post_title = $row['post_title'];

                                echo $post_title;
                            }
                        }
                        ?>
                    </h3>

                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }

                    switch ($source) {
                        case 'edit_comment':
                            include './includes/admin_form_edit.comment.php';
                            break;

                        default:
                            include './includes/admin_view_post_comments.php';
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