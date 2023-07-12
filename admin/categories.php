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
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
                    </h1>

                    <div class="col-xs-6">
                        <?php
                        $error = false;
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if (isset($_POST['cat_title'])) {
                                $cat_title = $_REQUEST['cat_title'];

                                if ($cat_title == "" || empty($cat_title)) {
                                    $error = "This field should not be empty";
                                } else {
                                    // Escapar el título para evitar inyección de SQL (utilizando MySQLi)
                                    $escapedTitle = mysqli_real_escape_string($connection, $cat_title);
                                    $escapedTitle = strtoupper($escapedTitle);

                                    $query = "SELECT * FROM categories WHERE cat_title='$escapedTitle'";
                                    $select_categories = mysqli_query($connection, $query);

                                    if (isset($select_categories) && mysqli_num_rows($select_categories) > 0) {
                                        $error = "This field already exist";
                                    } else {
                                        $query = "INSERT INTO categories(cat_title) VALUE('{$escapedTitle}')";
                                        $create_category_query = mysqli_query($connection, $query);

                                        if (!$create_category_query) {
                                            die("QUERY FAILED" . mysqli_error($conection));
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input id="cat_title" class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                            <?php if ($error) {
                                echo "
                            <div class='alert alert-danger' role='alert'>
                                {$error}
                            </div>";
                            } ?>
                        </form>
                    </div>

                    <div class="col-xs-6">
                        <?php
                        $query = 'SELECT * FROM categories';
                        $select_categories = mysqli_query($connection, $query);
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($select_categories)) {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];

                                    echo "<tr>
                                    <td>{$cat_id}</td>
                                    <td>{$cat_title}</td>
                                    <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
                                    </tr>"
                                ?>
                                <?php } ?>
                                <?php
                                $alert = null;
                                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                                    echo 'get';
                                    if (isset($_GET['delete'])) {
                                        $the_cat_id = $_REQUEST['delete'];
                                        $escapedId = mysqli_real_escape_string($connection, $the_cat_id);

                                        $query = "SELECT * FROM categories WHERE cat_id='$escapedId'";
                                        $select_categories = mysqli_query($connection, $query);

                                        if (isset($select_categories) && mysqli_num_rows($select_categories) > 0) {
                                            $query = "DELETE FROM categories WHERE cat_id='$escapedId'";
                                            $delete_category_query = mysqli_query($connection, $query);

                                            header("Location: categories.php");

                                            if (!$delete_category_query) {
                                                die("QUERY FAILED" . mysqli_error($connection));
                                            }
                                        } else {
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include './includes/admin_footer.php'; ?>