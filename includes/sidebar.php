<?php include './functions/login.php'; ?>

<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Buscar por Tags</h4>
        <form action="/cms/tag/" class="input-group">
            <input name="search_term" type="text" class="form-control" placeholder="Buscar..." onkeypress="handleKeyPress(event)">
            <div class="input-group-btn">
                <button type="button" class="btn btn-default" onclick="submitForm()">
                    Buscar
                </button>
            </div>
        </form>
        <script>
            function submitForm() {
                var search_term = document.querySelector('input[name="search_term"]').value;
                var url = "/cms/tag/" + encodeURIComponent(search_term);
                window.location.href = url;
            }

            function handleKeyPress(event) {
                if (event.keyCode === 13) {
                    // Si la tecla presionada es "Enter" (código 13), prevenir la acción predeterminada del formulario
                    event.preventDefault();
                    // Llamar a la función submitForm() para redirigir manualmente
                    submitForm();
                }
            }
        </script>
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
        <h4>Categorías</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                    while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];

                        echo "<li><a href='/cms/category/$cat_id'>{$cat_title}</a>";
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