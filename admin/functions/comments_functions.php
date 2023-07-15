<?php
// Show comments
function show_comments()
{
    global $connection;

    $query = 'SELECT * FROM comments';
    $select_comments = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_comments)) {
        $comment_id = $row['comment_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_date = $row['comment_date'];

        echo "<tr>
            <td>$comment_id</td>
            <td>$comment_author</td>
            <td>$comment_email</td>
            <td>$comment_content</td>
            <td>$comment_date</td>
            <td>
                <form action='./comments.php' method='post'>
                    <input type='hidden' name='delete' value='{$comment_id}'>
                    <input type='submit' value='Delete'>
                </form>
            </td>
            <td><a href='comments.php?source=edit_post&p_id=$comment_id'>Edit</a></td>
        </tr>";
    }
}

// <td><a href='comments.php?delete=$comment_id'>Delete</a></td>

// Delete Comments
function pre_delete_comment()
{
    global $connection;

    if (isset($_POST['delete'])) {
        $comment_id = $_REQUEST['delete'];

        $query = "SELECT * FROM comments WHERE comment_id='$comment_id'";
        $select_comment = mysqli_query($connection, $query);

        if (isset($select_comment) && mysqli_num_rows($select_comment) > 0) {
            echo "<script>
                showPopup(); // Mostrar el popup
                var deleteURL = 'comments.php?confirm_delete={$comment_id}';

                // Redirigir a la página de eliminación al hacer clic en 'Eliminar'
                document.querySelector('#popup form').addEventListener('submit', function(event) {
                    event.preventDefault();
                    window.location.href = deleteURL;
                });
            </script>";
        }
    }
}

// Delete Comment
function delete_comment()
{
    global $connection;

    if (isset($_GET['confirm_delete'])) {
        $the_commment_id = $_REQUEST['confirm_delete'];
        $escaped_id = mysqli_real_escape_string($connection, $the_commment_id);

        $query = "DELETE FROM comments WHERE comment_id='$escaped_id'";
        $delete_comment = mysqli_query($connection, $query);

        header("Location: " . 'comments.php');
        exit();
    }
}
