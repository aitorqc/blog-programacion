<?php
if (isset($_GET['c_id'])) {
    $the_comment_id = $_GET['c_id'];
    $query = "SELECT * FROM comments WHERE comment_id={$the_comment_id}";

    $select_comment_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_comment_query)) {
        $comment_author        = $row['comment_author'];
        $comment_email         = $row['comment_email'];
        $comment_date          = $row['comment_date'];
        $comment_content       = $row['comment_content'];
    }
}

update_comment($the_comment_id);
?>

<form action="" method="post" enctype="multipart/form-data">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Author</th>
                <th scope="col">Email</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $comment_author ?></td>
                <td><?php echo $comment_email ?></td>
                <td><?php echo $comment_date ?></td>
            </tr>
            <tr>
        </tbody>
    </table>

    <div class="form-group">
        <label for="post_content">Comment Content</label>
        <textarea class="form-control " name="comment_content" id="" cols="30" rows="10">
            <?php echo trim($comment_content); ?>  
         </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_comment" value="Publish Comment">
        <input class="btn btn-danger" type="submit" name="cancel_update_comment" value="Cancel">
    </div>
</form>