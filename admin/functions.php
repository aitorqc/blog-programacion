<?php

// Add Categorie
function add_categorie()
{
    global $connection;

    if (isset($_POST['cat_title'])) {
        $cat_title = $_REQUEST['cat_title'];
        $escaped_title = mysqli_real_escape_string($connection, $cat_title);
        $escaped_title = strtoupper($escaped_title);

        if ($escaped_title == "" || empty($escaped_title)) {
            return "This field should not be empty";
        } else {
            $query = "SELECT * FROM categories WHERE cat_title='$escaped_title'";
            $select_categories = mysqli_query($connection, $query);

            if (isset($select_categories) && mysqli_num_rows($select_categories) > 0) {
                return "This field already exist";
            } else {
                $query = "INSERT INTO categories(cat_title) VALUE('{$escaped_title}')";
                $create_category_query = mysqli_query($connection, $query);

                header("Location: " . $_SERVER['PHP_SELF']);
                exit();

                if (!$create_category_query) {
                    die("QUERY FAILED" . mysqli_error($connection));
                }
            }
        }
    }
}

// Delete Categorie
function pre_delete_categorie()
{
    global $connection;

    if (isset($_GET['delete'])) {
        $the_cat_id = $_REQUEST['delete'];
        $escaped_id = mysqli_real_escape_string($connection, $the_cat_id);

        $query = "SELECT * FROM categories WHERE cat_id='$escaped_id'";
        $select_categories = mysqli_query($connection, $query);

        if (isset($select_categories) && mysqli_num_rows($select_categories) > 0) {
            echo "<script>
                showPopup(); // Mostrar el popup
                var deleteURL = 'categories.php?confirm_delete={$escaped_id}';

                // Redirigir a la página de eliminación al hacer clic en 'Eliminar'
                document.querySelector('#popup form').addEventListener('submit', function(event) {
                    event.preventDefault();
                    window.location.href = deleteURL;
                });
            </script>";
        }
    }
}

function delete_categorie()
{
    global $connection;

    if (isset($_GET['confirm_delete'])) {
        $the_cat_id = $_REQUEST['confirm_delete'];
        $escaped_id = mysqli_real_escape_string($connection, $the_cat_id);

        $query = "DELETE FROM categories WHERE cat_id='$escaped_id'";
        $delete_categorie = mysqli_query($connection, $query);

        header("Location: " . 'categories.php');
        exit();
    }
}

// Update Categorie
function pre_update_categorie()
{
    global $connection;

    if (isset($_GET['edit'])) {
        $the_cat_id = $_REQUEST['edit'];
        $escaped_id = mysqli_real_escape_string($connection, $the_cat_id);

        $query = "SELECT * FROM categories WHERE cat_id='$escaped_id'";
        $select_categories = mysqli_query($connection, $query);

        if (isset($select_categories) && mysqli_num_rows($select_categories) > 0) {
            $row = mysqli_fetch_assoc($select_categories);
            $cat_title_edit = $row['cat_title'];
            return $cat_title_edit;
        }
    }
}

function update_categorie()
{
    global $connection;

    if (isset($_POST["update_cat_title"]) && isset($_GET['edit'])) {
        $the_cat_id = $_REQUEST['edit'];
        $cat_title_edit = $_REQUEST["update_cat_title"];
        $escaped_id = mysqli_real_escape_string($connection, $the_cat_id);
        $escaped_title = mysqli_real_escape_string($connection, $cat_title_edit);
        $escaped_title = strtoupper($escaped_title);

        if ($escaped_title == "" || empty($escaped_title)) {
            return "This field should not be empty";
        } else {
            $query = "SELECT * FROM categories WHERE cat_title='$escaped_title'";
            $select_categories = mysqli_query($connection, $query);

            if (isset($select_categories) && mysqli_num_rows($select_categories) > 0) {
                return "This field already exist";
            } else {
                $query = "UPDATE categories SET cat_title='$escaped_title' WHERE cat_id='$escaped_id'";
                $update_query = mysqli_query($connection, $query);

                header("Location: " . $_SERVER['PHP_SELF']);
                exit();

                if (!$update_query) {
                    die("QUERY FAILED" . mysqli_error($connection));
                }
            }
        }
    }
}

// Show Categorie
function show_categories()
{
    global $connection;

    $query = 'SELECT * FROM categories';
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>
        <td>{$cat_id}</td>
        <td>{$cat_title}</td>
        <td><a href='categories.php?delete={$cat_id}&del_cat_title={$cat_title}'>Delete</a></td>
        <td><a href='categories.php?edit={$cat_id}'>Edit</a></td>
        </tr>";
    }
}
