<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>
        <input class="form-control" type="text" name="update_cat_title" value="<?php if (isset($cat_title_edit)) {
                                                                                    echo $cat_title_edit;
                                                                                }; ?>" <?php echo isset($cat_title_edit) && $cat_title_edit ? '' : 'disabled'; ?>>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Edit Category" value="<?php if (isset($cat_title_edit)) {
                                                                                                    echo $cat_title_edit;
                                                                                                }; ?>" <?php echo isset($cat_title_edit) && $cat_title_edit ? '' : 'disabled'; ?>>
    </div>
    <?php if ($update_error) {
        echo "
        <div class='alert alert-danger' role='alert'>
            {$update_error}
        </div>";
    } ?>
</form>