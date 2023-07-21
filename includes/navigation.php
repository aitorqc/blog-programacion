<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">Start Bootstrap</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $query = 'SELECT * FROM categories';
                $selAllCatQuery = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($selAllCatQuery)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "
                        <li>
                            <a href='./index.php?category=$cat_id'>
                                {$cat_title}
                            </a>
                        </li>";
                }
                ?>
            </ul>

            <?php
            if (isset($_SESSION['user_role'])) {
                if ($_SESSION['user_role'] == 'admin') {
                    echo "
                    <p class='navbar-text navbar-right h4'>
                        <a href='admin'>ADMIN</a>
                    </p>";
                } else if ($_SESSION['user_role'] == 'user') {
                    echo "
                    <ul class='nav navbar-nav navbar-right'>
                        <li class='dropdown'>
                            <a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-user'></i>" . $_SESSION['username'] . "<b class='caret'></b></a>
                            <ul class='dropdown-menu'>
                                <li>
                                    <a href='#'><i class='fa fa-fw fa-user'></i> Profile</a>
                                </li>
                                <li>
                                    <a href='./functions/logout.php'><i class='fa fa-fw fa-power-off'></i> Log Out</a>
                                </li>
                            </ul>
                        </li>
                    </ul>";
                } else {
                }
            }
            ?>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>