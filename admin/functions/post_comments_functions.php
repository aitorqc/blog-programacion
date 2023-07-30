<?php
function show_post_comments()
{
    global $connection;

    if (isset($_GET['p_id'])) {

        $post_id = $_GET['p_id'];

        $query = "SELECT * FROM comments WHERE comment_post_id='$post_id'";
        $select_comments = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_comments)) {
            $comment_id = $row['comment_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_approve = $row['comment_approve'];
            $comment_date = $row['comment_date'];

            echo "
            <tr>
                <td>$comment_id</td>
                <td>$comment_author</td>
                <td>$comment_content</td>
                <td>$comment_email</td>
                <td>" . (($comment_approve) ? "True" : "False") . "</td>
                <td>$comment_date</td>
                <td>
                    <form action='./comments.php' method='post'>
                        <input type='hidden' name='delete' value='{$comment_id}'>
                        <input type='submit' value='Delete'>
                    </form>
                </td>
                <td><a href='comments.php?source=edit_comment&c_id=$comment_id'>Edit</a></td>
                <td><a href='comments.php?approve_comment&c_id=$comment_id'>Approve</a></td>
            </tr>";
        }
    }
}
