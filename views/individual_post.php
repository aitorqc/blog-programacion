<?php include './functions/like.php'; ?>

<?php
$post_id = $_REQUEST['p_id'];

$query = "SELECT * FROM posts WHERE post_id={$post_id}";
$select_post_query = mysqli_query($connection, $query);

if (!$select_post_query) {
    die("QUERY FAILED" . mysqli_error($connection));
}

$count = mysqli_num_rows($select_post_query);

if ($count == 0) {
    echo "<h1> No se han encontrado resultados </h1>";
} else {

    while ($row = mysqli_fetch_assoc($select_post_query)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
?>
        <h2>
            <?php echo $post_title; ?>
        </h2>
        <p class="lead">
            Creador <a href='/cms/author/<?php echo $post_author; ?>'><?php echo $post_author; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Con Fecha: <?php echo $post_date; ?></p>
        <hr>
        <img class="img-responsive" src="/cms/images/<?php echo $post_image; ?>" alt="<?php echo $post_image; ?>">
        <hr>
        <p><?php echo $post_content; ?></p>
        <div class="row" style="margin-top: 3rem;">
            <?php add_like(); ?>
            <?php
            if (isset($_SESSION['user_role'])) {
            ?>
                <div class="col-md-6 text-left"> <!-- Columna izquierda alineada a la izquierda -->
                    <button id="likeButton" class="btn btn-primary" <?php echo (check_like($_SESSION['username'], $post_id)) ? "disabled" : "" ?>> <!-- Añadimos un ID al botón -->
                        <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Me gusta
                    </button>
                    <button id="dislikeButton" class="btn btn-danger" <?php echo (check_like($_SESSION['username'], $post_id)) ? "disabled" : "" ?>>
                        <!-- Añadimos un ID al botón -->
                        <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span> No me gusta
                    </button>
                </div>
            <?php
            }
            ?>
            <div class="col-md-6 col-xs-12 text-right"> <!-- Columna derecha alineada a la derecha -->
                <!-- Campo para mostrar los likes totales con el icono de corazón -->
                <span style="font-size: 1.6rem;">
                    <span><?php echo get_likes($post_id); ?></span>
                    <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                </span>
            </div>
        </div>

        <hr>
        <script>
            $(document).ready(function() {
                // Verificamos si el botón con ID 'likeButton' existe antes de agregar el evento click
                let post_id = <?php echo $post_id; ?>;
                let username = '<?php echo $_SESSION['username']; ?>';

                // Usamos el ID 'likeButton' para seleccionar el botón
                $('#likeButton').click(function() {
                    $.ajax({
                        url: "/cms/index.php?p_id=" + post_id,
                        type: 'post',
                        data: {
                            liked: 1,
                            post_id: post_id, // Sin comillas, para que se use el valor de la variable
                            username: username, // Sin comillas, para que se use el valor de la variable
                        },
                        success: function(response) {
                            // Maneja la respuesta del servidor
                            if (response) {
                                window.location.href = '/cms/post/<?php echo $post_id; ?>';
                            } else {
                                // Mostrar un mensaje de error si es necesario
                                console.error('Hubo un error al agregar el like.');
                            }
                        },
                        error: function(xhr, status, error) {
                            // Maneja el error si ocurre
                            console.error('Error en la petición AJAX');
                        }
                    });
                });

                // Usamos el ID 'likeButton' para seleccionar el botón
                $('#dislikeButton').click(function() {
                    $.ajax({
                        url: "/cms/index.php?p_id=" + post_id,
                        type: 'post',
                        data: {
                            liked: 0,
                            post_id: post_id, // Sin comillas, para que se use el valor de la variable
                            username: username, // Sin comillas, para que se use el valor de la variable
                        },
                        success: function(response) {
                            // Maneja la respuesta del servidor
                            if (response) {
                                window.location.href = '/cms/post/<?php echo $post_id; ?>';
                            } else {
                                // Mostrar un mensaje de error si es necesario
                                console.error('Hubo un error al agregar el like.');
                            }
                        },
                        error: function(xhr, status, error) {
                            // Maneja el error si ocurre
                            console.error('Error en la petición AJAX');
                        }
                    });
                });
            })
        </script>
    <?php
    }

    include './includes/comments.php';
    ?>
<?php
    $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id={$post_id}";
    $update_post_views = mysqli_query($connection, $query);
}
?>