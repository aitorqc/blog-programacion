<?php
if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $post_value_id) {
        $option = $_POST['option'];
        $post_id = $post_value_id;

        switch ($option) {
            case 'published':
                $query = "UPDATE posts set post_status='published' WHERE post_id='{$post_id}'";
                $update_to_published = mysqli_query($connection, $query);
                break;
            case 'draft':
                $query = "UPDATE posts set post_status='draft' WHERE post_id='{$post_id}'";
                $update_to_draft = mysqli_query($connection, $query);
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id='{$post_id}'";
                $delete_posts = mysqli_query($connection, $query);
                break;
        }
    }
}

?>

<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div class="col-xs-4" id="bulkOptionContainer">
            <select class="form-control" name="option" id="option">
                <option value="" default>Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4" style="margin-bottom: 2rem;">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
        </div>
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category ID</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!-- LLamada a la funcion que carga todos los posts -->
            <?php show_posts(); ?>
            <?php pre_delete_post(); ?>
            <?php delete_post(); ?>
        </tbody>
    </table>
</form>