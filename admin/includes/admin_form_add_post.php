<?php
add_post();
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Titulo</label>
        <input type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="category">Categoría</label>
        <select name="post_category" id="">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='$cat_id'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
    <label for="status">Estado</label>
        <select name="post_status" id="status">
            <option value="draft" selected>Borrador</option>
            <option value="published">Publicado</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Imagen</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="summernote">Contenido</label>
        <textarea class="form-control " name="post_content" id="summernote" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Crear">
    </div>
</form>