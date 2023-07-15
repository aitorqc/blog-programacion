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

if (isset($_POST['update_post'])) {
    $post_title        = $_POST['post_title'];
    $post_author       = $_POST['post_author'];
    $post_category_id  = $_POST['post_category'];
    $post_status       = $_POST['post_status'];
    $post_image        = $_FILES['image']['name'];
    $post_image_temp   = $_FILES['image']['tmp_name'];
    $post_tags         = $_POST['post_tags'];
    $post_content      = $_POST['post_content'];

    $post_author = strtolower($post_author);
    $post_tags = strtolower($post_tags);

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if (empty($post_image)) {
        $post_image = check_image($the_post_id);
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title  = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date   =  now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags   = '{$post_tags}', ";
    $query .= "post_content= '{$post_content}', ";
    $query .= "post_image  = '{$post_image}' ";
    $query .= "WHERE post_id = {$the_post_id} ";


    $update_post_query = mysqli_query($connection, $query);

    if (!$update_post_query) {
        die('QUERY FAILED' . mysqli_error($connection));
    } else {
        header("location: posts.php");
    }
} else if (isset($_POST['cancel_update_post'])) {
    header("location: ./posts.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo htmlspecialchars(stripslashes($post_title)); ?>">
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <select name="post_category" id="">
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
        <label for="author">Author</label>
        <select name="post_author" id="">
            <?php
            $query = "SELECT * FROM posts";
            $select_posts = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_posts)) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];

                if ($post_id == $post_category_id) {
                    echo "<option selected value='{$post_author}'>{$post_author}</option>";
                } else {
                    echo "<option value='{$post_author}'>{$post_author}</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <select name="post_status" id="">
            <option value='<?php echo $post_status ?>'><?php echo $post_status; ?></option>
            <?php
            if ($post_status == 'published') {
                echo "<option value='draft'>Draft</option>";
            } else {
                echo "<option value='published'>Publish</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>


    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control " name="post_content" id="" cols="30" rows="10">
            <?php echo trim($post_content); ?>  
         </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Publish Post">
        <input class="btn btn-danger" type="submit" name="cancel_update_post" value="Cancel">
    </div>
</form>