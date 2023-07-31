<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../admin/">CMS Admin</a>
    </div>

    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li><a href="../index.php">HOME</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['username']; ?><b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="../functions/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li id="index">
                <a href="./"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li id="posts">
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><span class="glyphicon glyphicon-list-alt"></span> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <a href="./posts.php">View Posts</a>
                    </li>
                    <li>
                        <a href="posts.php?source=add_post">Add Post</a>
                    </li>
                </ul>
            </li>
            <li id="categories">
                <a href="./categories.php"><i class="fa fa-fw fa-file"></i> Categories</a>
            </li>
            <li id="comments">
                <a href="./comments.php"><span class="glyphicon glyphicon-comment"></span> Comments</a>
            </li>
            <li id="users">
                <a href="javascript:;" data-toggle="collapse" data-target="#users_dropdown"><span class="glyphicon glyphicon-user"></span> Users <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="users_dropdown" class="collapse">
                    <li>
                        <a href="./users.php">View Users</a>
                    </li>
                    <li>
                        <a href="users.php?source=add_user">Add User</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
    <script>
        // Función para agregar la clase "active" al enlace correspondiente
        function setActiveLink() {
            const currentPageId = "<?php echo pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME); ?>";
            const menuItem = document.getElementById(currentPageId);

            console.log(currentPageId);

            if (menuItem) {
                menuItem.classList.add('active');
            }
        }

        // Llamar a la función para establecer el enlace activo en la carga de la página
        setActiveLink();
    </script>
</nav>