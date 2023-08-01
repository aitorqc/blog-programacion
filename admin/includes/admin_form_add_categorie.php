<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Crear Categoría</label>
        <input class="form-control" type="text" name="cat_title">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Crear">
    </div>
    <?php if ($add_error) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $add_error; ?>
        </div>
    <?php endif; ?>
</form>