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
        $comment_approve = $row['comment_approve'];
        $comment_date = $row['comment_date'];

        $comment_post_id = $row['comment_post_id'];

        echo "<tr>
            <td>$comment_id</td>
            <td>$comment_author</td>
            <td>$comment_content</td>
            <td>$comment_email</td>";

        $query = "SELECT * from posts WHERE post_id='$comment_post_id'";
        $select_post_query = mysqli_query($connection, $query);

        if (mysqli_num_rows($select_post_query) > 0) {
            while ($row = mysqli_fetch_assoc($select_post_query)) {
                $post_title = $row['post_title'];
                echo "<td><a href='../index.php?p_id=$comment_post_id'>$post_title</a></td>";
            }
        } else {
            echo "<td>[Post Eliminated]</td>";
        }

        echo "<td>" . (($comment_approve) ? "True" : "False") . "</td>";
        echo "<td>$comment_date</td>
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

// Update Comment
function update_comment($the_comment_id)
{
    global $connection;

    if (isset($_POST['update_comment'])) {
        $comment_content      = $_POST['comment_content'];

        $query = "UPDATE comments SET ";
        $query .= "comment_content  = '{$comment_content}', ";
        $query .= "comment_date   =  now() ";
        $query .= "WHERE comment_id = {$the_comment_id} ";


        $update_comment_query = mysqli_query($connection, $query);

        if (!$update_comment_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        } else {
            header("location: ./comments.php");
        }
    } else if (isset($_POST['cancel_update_comment'])) {
        header("location: ./comments.php");
    }
}

// Approve Comment
function approve_comment()
{
    global $connection;

    if (isset($_GET['approve_comment'])) {
        $the_comment_id = $_GET['c_id'];

        $query = "SELECT comment_approve from comments WHERE comment_id='$the_comment_id'";
        $select_comment_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_comment_query)) {
            $comment_approve = $row['comment_approve'];
        }

        $comment_approve = !$comment_approve;

        $query = "UPDATE comments SET ";
        $query .= "comment_approve  = '{$comment_approve}' ";
        $query .= "WHERE comment_id = {$the_comment_id} ";

        $update_comment_query = mysqli_query($connection, $query);

        header("location: comments.php");
    }
}

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

        $comment_post_id = select_comment_id($escaped_id);

        update_comment_count($comment_post_id);

        $query = "DELETE FROM comments WHERE comment_id='$escaped_id'";
        $delete_comment = mysqli_query($connection, $query);

        header("Location: " . 'comments.php');
        exit();
    }
}

function select_comment_id($escaped_id)
{
    global $connection;

    $query = "SELECT comment_post_id FROM comments 
    WHERE comment_id='$escaped_id'";

    $select_post_id = mysqli_query($connection, $query);

    $row = mysqli_fetch_assoc($select_post_id);

    $comment_post_id = $row['comment_post_id'];

    return $comment_post_id;
}

function update_comment_count($comment_post_id)
{
    global $connection;

    $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 
    WHERE post_id = $comment_post_id";

    $update_comment_count = mysqli_query($connection, $query);
}
