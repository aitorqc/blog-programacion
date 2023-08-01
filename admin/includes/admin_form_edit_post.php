<?php
if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
    $query = "SELECT * FROM posts WHERE post_id={$the_post_id}";

    $select_post_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_post_query)) {
        $post_title        = $row['post_title'];
        $post_author       = $row['post_author'];
        $post_category_id  = $row['post_category_id'];
        $post_status       = $row['post_status'];
        $post_image        = $row['post_image'];
        $post_tags         = $row['post_tags'];
        $post_content      = $row['post_content'];
    }
}

update_post($the_post_id);
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Titulo</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo htmlspecialchars(stripslashes($post_title)); ?>">
    </div>

    <div class="form-group">
        <label for="post_category">Categoría</label>
        <select name="post_category" id="post_category">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                if ($cat_id == $post_category_id) {
                    echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                } else {
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="status">Estado</label>
        <select name="post_status" id="status">
            <option value='<?php echo $post_status ?>' selected>
                <?php
                if ($post_status == 'published') {
                    echo "Publicado";
                } else {
                    echo "Borrador";
                }
                ?>
            </option>
            <?php
            if ($post_status == 'published') {
                echo "<option value='draft'>Borrador</option>";
            } else {
                echo "<option value='published'>Publicado</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="<?php echo $post_image; ?>">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>


    <div class="form-group">
        <label for="summernote">Contenido</label>
        <textarea class="form-control " name="post_content" id="summernote" cols="30" rows="10"><?php echo trim($post_content); ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Actualizar">
        <input class="btn btn-danger" type="submit" name="cancel_update_post" value="Cancelar">
    </div>
</form>