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
            $comment_approve = $row['comment_approve'];
            $comment_date = $row['comment_date'];

            $comment_author_query = "SELECT user_email FROM users WHERE user_name='$comment_author'";
            $comment_author_result = mysqli_query($connection, $comment_author_query);
            if ($comment_author_result) {
                // Obtener el resultado de la consulta
                $user_email_row = mysqli_fetch_assoc($comment_author_result);
                // Obtener el valor de user_email
                $comment_email = $user_email_row['user_email'];
            }
            
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
                        <input type='submit' value='Eliminar'>
                    </form>
                </td>
                <td><a href='comments.php?source=edit_comment&c_id=$comment_id'>Editar</a></td>
                <td><a href='comments.php?approve_comment&post_comments=$post_id&c_id=$comment_id'>Aprobar</a></td>
            </tr>";
        }
    }
}
