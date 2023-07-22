<?php
if (isset($_POST['create_comment'])) {
    $comment_post_id = $_GET['p_id'];
    $comment_author = $_SESSION['username'];
    $comment_email = $_SESSION['email'];
    $comment_content = $_POST['comment_content'];

    if (!empty($comment_content)) {
        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_date) 
    VALUES ('{$comment_post_id}', '{$comment_author}', '{$comment_email}', '{$comment_content}', now())";

        $create_comment_query = mysqli_query($connection, $query);

        if (!$create_comment_query) {
            die("QUERY FAILED" . mysqli_error($connection));
        }

        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 
    WHERE post_id = $comment_post_id";
        $update_comment_count = mysqli_query($connection, $query);
    }
}
?>

<!-- Comments Form -->
<?php
if (isset($_SESSION['user_role'])) {
    echo "
    <div class='well'>
        <h4>Leave a Comment:</h4>
        <div class='row'>
            <div class='col-xs-6'>".$_SESSION['username']."</div> 
            <div class='col-xs-6 text-right'>".$_SESSION['email']."</div>
        </div>
        <form action='' method='post' role='form'>
            <div class='form-group' style='margin-top: 1rem;'>
                <label for='comment_content'>Your Comment</label>
                <textarea id='comment_content' class='form-control' name='comment_content' rows='3'></textarea>
            </div>
            <button type='submit' class='btn btn-primary' name='create_comment'>Submit</button>
        </form>
    </div>";
}
?>
<hr>

<!-- Comment -->

<?php
$comment_post_id = $_GET['p_id'];

$query = "SELECT * FROM comments WHERE comment_post_id='$comment_post_id'
    ORDER BY comment_id DESC";
$select_comment_query = mysqli_query($connection, $query);

if (!$select_comment_query) {
    die('Query Failed' . mysqli_error($connection));
}

while ($row = mysqli_fetch_array($select_comment_query)) {
    $comment_date = $row['comment_date'];
    $comment_content = $row['comment_content'];
    $comment_author = $row['comment_author'];
    $comment_approve = $row['comment_approve'];

    $date_day = date("F j, Y", strtotime($comment_date));
    $date_hour = date("H:i", strtotime($comment_date));

    $comment_date_format = $date_day . " at " . $date_hour;

    echo ($comment_approve) ?
        "<div class='media'>
        <a class='pull-left' href='#'>
            <img class='media-object' src='http://placehold.it/64x64' alt=''>
        </a>
        <div class='media-body'>
            <h4 class='media-heading'>$comment_author
                <small>$comment_date_format</small>
            </h4>
            $comment_content
        </div>
    </div>" :
        "<div class='media'>
        <a class='pull-left' href='#'>
            <img class='media-object' src='http://placehold.it/64x64' alt=''>
        </a>
        <div class='media-body'>
            <h4 class='media-heading'>$comment_author
                [ Eliminated ]
            </h4>
        </div>
    </div>";
}
?>

</div>