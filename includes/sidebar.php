<?php include './functions/login.php'; ?>

<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Tags Search</h4>
        <form action="index.php" method="get">
            <div class="input-group">
                <input name="search_term" type="text" class="form-control" placeholder="Search for...">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default" aria-label="Help">
                        GO
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Login -->
    <?php
    $error = user_login();
    if (isset($_SESSION['user_role'])) {
    } else {
        include 'login_form.php';
    }
    ?>

    <!-- Blog Categories Well -->
    <div class="well">
        <?php
        $query = 'SELECT * FROM categories';
        $select_all_categories_query = mysqli_query($connection, $query);
        ?>
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                    while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];

                        echo "<li><a href='index.php?category=$cat_id'>{$cat_title}</a>";
                    }
                    ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php
    $error = user_login();
    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === "user") {
        include 'widget.php';
    }
    ?>

</div>